<?php
include("../../../config/main_function.php");
$secure = "-%ekla!(m09)%1A7";
$connection = connectDB($secure);

$companyId = mysqli_real_escape_string($connection, $_POST['companyId']);
?>
<div class="modal-header">
    <h6 class="modal-title text-primary">Create New Branch</h6>
    <button type="button" class="btn-close font-size-13" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form id="form_add_branch">
        <div class="col-12">
            <div class="row">
                <div class="col-lg-12 pt-4" style="text-align:center;">
                    <div class="form-group">
                        <div class="BroweForFile">
                            <label><strong>Branch Logo Image</strong></label>
                            <div id="show_branch_logo">
                                <label for="branch_logo">
                                    <a><img id="logo" src="../image/file-plus.png" width="90px" height="90px" /></a>
                                </label>
                            </div><br />
                            <input type="file" name="branch_logo" id="branch_logo" hidden onchange="ImageReadURL(this, value, '#logo')" accept="image/*">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 pt-4">
                    <label for="branchName" class="form-label lb_moon">Branch Name<span class="text-danger">*</span></label>
                    <input type="text" name="branchName" id="branchName" class="form-control pb-5 pt-5 font-size-13">
                </div>
                <div class="col-lg-6">
                    <label for="financial_start_month" class="form-label lb_moon">Financial Start Month<span class="text-danger">*</span></label>
                    <select class="form-select pb-5 pt-5 font-size-13" name="financial_start_month" id="financial_start_month">
                        <option disabled selected value="">--- Select Financial Start Month ---</option>ƒ
                        <?php
                        $months = (object)[1 => "January", 2 => "February", 3 => "March", 4 => "April", 5 => "May", 6 => "June", 7 => "July", 8 => "August", 9 => "September", 10 => "October", 11 => "November", 12 => "December"];
                        foreach ($months as $index => $month) { ?>
                            <option value="<?php echo $index; ?>"><?php echo $month; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-lg-6 pt-4">
                    <label for="companyId" class="form-label lb_moon">Company Group<span class="text-danger">*</span></label>
                    <?php
                    $sql_select = "SELECT * FROM company a WHERE a.companyId = '$companyId';";
                    $res_select = mysqli_query($connection, $sql_select)  or die($connection->error);
                    $row_select = mysqli_fetch_assoc($res_select);
                    ?>
                    <input type="text" class="form-control pb-5 pt-5 font-size-13" value="<?php echo $row_select['companyName']; ?>" readonly>
                    <input type="hidden" name="companyId" id="companyId" class="form-control pb-5 pt-5 font-size-13" value="<?php echo $companyId; ?>" readonly>
                </div>
                <div class="col-lg-12 pt-4">
                    <label for="note" class="form-label lb_moon">note</label>
                    <input type="text" name="note" id="note" class="form-control pb-5 pt-5 font-size-13" placeholder="description">
                </div>
            </div>
        </div>
    </form>
</div>
<div class="modal-footer" style="border:none;">
    <button type="button" class="btn outlinelightgray" data-bs-dismiss="modal">Cancel</button>
    <button type="button" class="btn btn-primary putlineprimary" onclick="addBranch()">Create</button>
</div>

<script>
    function ImageReadURL(input, value, show_position) {
        let fty = ["jpg", "jpeg", "png"];
        let permiss = 0;
        let file_type = value.split('.');
        file_type = file_type[file_type.length - 1];
        if (jQuery.inArray(file_type, fty) !== -1) {
            let reader = new FileReader();
            reader.onload = function(e) {
                $(show_position).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        } else if (value == "") {
            $(show_position).attr('src', old_file);
            $(input).val("");
        } else {
            swal({
                title: "เกิดข้อผิดพลาด!",
                text: "อัพโหลดได้เฉพาะไฟล์นามสกุล (.jpg .jpeg .png) เท่านั้น!",
                type: "warning"
            });
            $(show_position).attr('src', old_file);
            $(input).val("");
            return false;
        }
    }
</script>