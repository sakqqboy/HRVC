<?php
include("../../../config/main_function.php");
$secure = "-%ekla!(m09)%1A7";
$connection = connectDB($secure);

$branchId = mysqli_real_escape_string($connection, $_POST['branchId']);
$account_id = mysqli_real_escape_string($connection, $_POST['account_id']);

$sql_select = "SELECT a.*,b.pl_major_id FROM tbl_branch_pl_account_code a
LEFT JOIN tbl_pl_medium_df b ON a.pl_medium_id = b.pl_medium_id
WHERE a.branchId = '$branchId' AND a.account_id = '$account_id'";
$res_select = mysqli_query($connection, $sql_select)  or die($connection->error);
$row_select = mysqli_fetch_assoc($res_select);
?>

<form id="form_editPLFlow">
    <input type="hidden" name="account_id" id="account_id" class="form-control pb-5 pt-5 font-size-13" value="<?php echo $account_id; ?>">
    <input type="hidden" name="med" id="med" class="form-control pb-5 pt-5 font-size-13" value="<?php echo $row_select['pl_medium_id']; ?>">
    <div class="modal-header">
        <h6 class="modal-title text-primary"><i class="fa fa-magic" aria-hidden="true"></i> EDIT PL Flow</h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-6 pt-10">
                <label for="acc_code " class="form-label font-size-14">Accounting Code <span class="text-danger">*</span></label>
                <input type="text" name="acc_code" id="acc_code" class="form-control pb-5 pt-5 font-size-13" value="<?php echo $row_select['acc_code']; ?>">
            </div>
            <div class="col-6 pt-10">
                <label for="acc_name" class="form-label font-size-14">Accounting Name <span class="text-danger">*</span></label>
                <input type="text" name="acc_name" id="acc_name" class="form-control pb-5 pt-5 font-size-13" value="<?php echo $row_select['acc_name']; ?>">
            </div>
            <div class="col-6 pt-10">
                <label for="pl_major_id" class="form-label font-size-14">Major items of PL <span class="text-danger">*</span></label>
                <select class="form-select pb-5 pt-5 font-size-13" name="pl_major_id" id="pl_major_id" onchange="getMediumItemsofPL()">
                    <option disabled selected value="">---- select ----</option>
                    <?php $sql_MajorItems = "SELECT * FROM tbl_pl_major_df";
                    $res_MajorItems = mysqli_query($connection, $sql_MajorItems) or die($connection->error);
                    while ($row_MajorItems = mysqli_fetch_assoc($res_MajorItems)) {
                    ?>
                        <option value="<?php echo $row_MajorItems['pl_major_id']; ?>" <?php echo ($row_select['pl_major_id'] == $row_MajorItems['pl_major_id']) ? "selected" : ""; ?>><?php echo $row_MajorItems['major_name']; ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="col-6 pt-10">
                <label for="pl_medium_id" class="form-label font-size-14">Medium item of PL <span class="text-danger">*</span></label>
                <select class="form-select pb-5 pt-5 font-size-13" name="pl_medium_id" id="pl_medium_id">
                    <option selected value="">---- select ----</option>
                </select>
            </div>
            <div class="col-6 pt-10">
                <label for="breakdown_id" class="form-label font-size-14">Breakdown Category <span class="text-danger">*</span></label>
                <select class="form-select pb-5 pt-5 font-size-13" name="breakdown_id" id="breakdown_id">
                    <option selected value="">---- select ----</option>
                    <?php
                    $sql_BreakdownCategory = "SELECT * FROM tbl_pl_breakdown_df;";
                    $res_BreakdownCategory = mysqli_query($connection, $sql_BreakdownCategory) or die($connection->error);
                    while ($row_BreakdownCategory = mysqli_fetch_assoc($res_BreakdownCategory)) {
                    ?>
                        <option value="<?php echo $row_BreakdownCategory['breakdown_id']; ?>" <?php echo ($row_select['breakdown_id'] == $row_BreakdownCategory['breakdown_id']) ? "selected" : ""; ?>><?php echo $row_BreakdownCategory['breakdown_name']; ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="col-6 pt-10">
                <label for="cash_flow_id" class="form-label font-size-14">Cash Flow category <span class="text-danger">*</span></label>
                <select class="form-select pb-5 pt-5 font-size-13" name="cash_flow_id" id="cash_flow_id">
                    <option selected value="">---- select ----</option>
                    <?php
                    $sql_CashFlowCategory = "SELECT * FROM tbl_pl_cash_flow_df;";
                    $res_CashFlowCategory = mysqli_query($connection, $sql_CashFlowCategory) or die($connection->error);
                    while ($row_CashFlowCategory = mysqli_fetch_assoc($res_CashFlowCategory)) {
                    ?>
                        <option value="<?php echo $row_CashFlowCategory['cash_flow_id']; ?>" <?php echo ($row_select['cash_flow_id'] == $row_CashFlowCategory['cash_flow_id']) ? "selected" : ""; ?>><?php echo $row_CashFlowCategory['cash_flow_name']; ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="col-12 pt-10">
                <label for="" class="form-label font-size-14">Increase and Decrease in Cash Flow <?php echo $row_select['cash_flow_type']; ?><span class="text-danger">*</span></label>
                <div class="row pl-10 pr-10 pt-10 font-size-12">
                    <div class="col-3 form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="None" name="cash_flow_type" value="0" style="border-radius: 50px;margin-left:7px;" <?php echo $row_select['cash_flow_type']=='0'?'checked':''; ?> >
                        <label class="form-check-label" for="None"></label> None
                    </div>
                    <div class="col-3 form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="Increase" name="cash_flow_type" value="1" style="border-radius: 50px;" <?php echo $row_select['cash_flow_type']=='1'?'checked':''; ?>>
                        <label class=" form-check-label" for="Increase"></label> Increase (+)
                    </div>
                    <div class="col-4 form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="Decrease" name="cash_flow_type" value="2" style="border-radius: 50px;" <?php echo $row_select['cash_flow_type']=='2'?'checked':''; ?>>
                        <label class=" form-check-label" for="Decrease"></label> Decrease (-)
                    </div>
                </div>
            </div>
            <div class="col-12 pt-10">
                <label for="note" class="form-label font-size-14">Note</label>
                <input type="text" name="note" id="note" class="form-control pb-5 pt-5 font-size-13" placeholder="Description" value="<?php echo $row_select['note']; ?>">
            </div>
        </div>

    </div>
    <div class="modal-footer" style="border:none;">
        <button type="button" class="btn btn-outline-secondary pt-4 pb-4  font-size-14" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary pt-4 pb-4 font-size-14" onclick="editPLFlow()">Edit</button>
    </div>
</form>

<script>
    $(document).ready(function() {
        getMediumItemsofPL();
    });

    function getMediumItemsofPL() {
        let MajorItems = $("#pl_major_id").val();
        let med = $("#med").val();
        
        $.ajax({
            url: 'ajax/register_pl_flow_add/get_medium_Items_of_PL.php',
            type: 'POST',
            dataType: 'html',
            cache: false,
            data: {
                MajorItems: MajorItems,
                med: med
            },
            success: function(data) {
                $('#pl_medium_id').html(data);
            },
            error: function(jqXHR, exception) {
                var msg = '';
                if (jqXHR.status === 0) {
                    msg = 'Not connect. Verify Network.';
                } else if (jqXHR.status == 404) {
                    msg = 'Requested page not found. [404]';
                } else if (jqXHR.status == 500) {
                    msg = 'Internal Server Error [500].';
                } else if (exception === 'parsererror') {
                    msg = 'Requested JSON parse failed.';
                } else if (exception === 'timeout') {
                    msg = 'Time out error.';
                } else if (exception === 'abort') {
                    msg = 'Ajax request aborted.';
                } else {
                    msg = 'Uncaught Error. ' + jqXHR.responseText;
                }

                Swal.fire({
                    title: 'แจ้งเตือน !',
                    text: "พบปัญหาการบันทึก กรุณาติดต่อผู้ดูแลระบบ" + msg,
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });
    }
</script>