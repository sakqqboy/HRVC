<?php
include("../../../config/main_function.php");
$secure = "-%ekla!(m09)%1A7";
$connection = connectDB($secure);

?>

<form id="form_ImportPLData">
    <div class="modal-header">
        <h6 class="modal-title text-primary"><i class="fa fa-magic" aria-hidden="true"></i> IMPORT PL DATA</h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>

    <!-- <div class="modal-body">
        <div class="col-12 text-center mt-10 pt-20 pb-20">
            <div class="row">
                <div class="custom-file mt-20">
                    <input id="logo" type="file" class="custom-file-input" name="excelFile">
                </div>
            </div>
        </div>
    </div> -->

    <div class="modal-body">
        <div class="col-12 text-center mt-10 pt-20 pb-20">

            <div id="drop_zone" class="offset-3 col-6 drop-zone mt-20">
                <label class="drop-zone__prompt" for="file_input">Drag & Drop or choose files to upload<br>CSV file</label>
                <input type="file" id="file_input" name="excelFile" style="display:none;z-index:99">
                <div class="offset-3 col-6 mt-30">
                    <button type="button" class="btn btn-primary pt-5 pb-5  font-size-15 font-b">
                        <label for="file_input">
                            <i class="fa fa-upload mr-10" aria-hidden="true"></i>
                            IMPORT
                        </label>
                    </button>
                </div>
            </div>
            <div class="row mt-20">
                <div class="offset-4 col-4 download-progress">
                    <div class="col-12 text-start mb-10">
                        <img src="../images/excel.png" style="height: 45px;" class="mr-10">
                        <span class="font-size-14 font-b">Filename.csv</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <div class="modal-footer d-flex justify-content-center" style="border:none;">
        <button type="button" class="btn btn-danger pt-4 pb-4  font-size-14" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary pt-4 pb-4 font-size-14" onclick="importPLData()">DONE</button>
    </div>
</form>