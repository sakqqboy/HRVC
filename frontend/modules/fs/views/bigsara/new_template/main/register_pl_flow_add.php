<html>

<title>PL register flow</title>

<Head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="../css/layout/font.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">
    <link href="../css/layout/layout.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">
    <link href="../css/fs.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">
    <link href="../css/pl.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.min.css" rel="stylesheet">
</Head>

<body>
    <div class="alert background-Planning mt-10 font-family">
        <div class="row mt-10">
            <div class="col-2 pb-100">
                <?php
                include 'pl_menu.php';
                ?>
            </div>
            <div class="col-10 pt-10 pr-10 pl-10 font-family" style="background-color: white;">
                <div class="row">
                    <div class="col-2">
                        <div class="col-12 font-size-16 font-b">
                            Register PL Flow <br>
                            <font id="show_branch" class="text-primary">Register PL Flow</font>
                        </div>
                    </div>
                    <div class="col-6">
                        <button class="btn btn-primary pt-2 pb-2 font-size-12" onclick="getModalAddPL()"> <i class="fa fa-magic" aria-hidden="true"></i> ADD </button>
                        <button class="btn btn-success pt-2 pb-2 font-size-12" onclick="downloadSample()"> <img src="../images/icons/Dark/48px/download-up.png" class="download-up_png"> Download Sample </button>
                        <button type="button" class="btn btn-purple text-white pb-2 pt-2 font-size-12" onclick="getModalImportPL()"><img src="../images/icons/Dark/48px/import-white.png" class="download-up_png"> <span class="font-size-10"> IMPORT ACCOUNT </span></button>
                        <a href="fs_index.php?branch=<?php echo $_GET['branch']; ?>" class="btn btn-secondary pb-2 pt-2 font-size-12"> <i class="fa fa-cog" aria-hidden="true"></i> <span class="font-size-10"> INITIAL SETTING </span></a>
                        <!-- <button type="button" class="btn btn-success pb-2 pt-2 font-size-12" onclick="getModalImportData()"><img src="../images/icons/Dark/48px/import-white.png" class="download-up_png"> <span class="font-size-10"> IMPORT DATA </span></button> -->
                    </div>
                    <!-- <div class="col-2 text-end"> -->
                    <!-- <a href="branch_pl_data.php?id=<?php echo $_GET['id']; ?>" class="btn btn-success pb-2 pt-2 font-size-12"><span class="font-size-10"> INITIAL SETTING </span></a> -->
                    <!-- </div> -->
                    <div class="col-4 text-end">
                        <div class="row">
                            <div class="col-10 pr-0 pl-0">
                                <input class="form-control font-size-13" type="search" placeholder="PL category breakdown">
                            </div>
                            <div class="col-2 pl-0">
                                <a href="" class="btn btn-outline-secondary">
                                    <i class="fa fa-refresh" aria-hidden="true" style="font-size: 15px;"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 content-box mt-10">
                    <div class="nav-top-menu-pl pl-20">
                        <div class="row">
                            <div class="col-2  pt-10 pb-10 font-size-13">
                                <i class="fa fa-check-circle" aria-hidden="true"></i>
                                Fixed PL Categories
                            </div>
                            <div class="col-2  pt-10 pb-10 pl-0 font-size-13">
                                <i class="fa fa-check-circle" aria-hidden="true"></i>
                                Registered Items
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-10 pt-20 pb-20" style="background-color: white;border-radius:10px;">
                        <div class="row pl-20 pr-20 pb-10" id="showData">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 text-center" id="showFooter">
    </div>

    <!-- Modal -->
    <div class="modal fade" id="flowadd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title text-primary" id="exampleModalLabel"><i class="fa fa-magic" aria-hidden="true"></i> ADD PL Flow</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-12">
                        <div class="col-6">
                            <label for="" class="form-label font-size-14"><span class="text-danger">*</span> Select PL code</label>
                            <select class="form-select pb-5 pt-5 font-size-13" aria-label="Default select example">
                                <option selected value="">select</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col-6 mt-20">
                            <label for="" class="form-label font-size-14"><span class="text-danger">*</span> PL Account Name</label>
                            <select class="form-select pb-5 pt-5 font-size-13" aria-label="Default select example">
                                <option selected value="">select</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-6 mt-20">
                                <label for="" class="form-label font-size-14"><span class="text-danger">*</span> PL Sub-Categories</label>
                                <select class="form-select pb-5 pt-5 font-size-13" aria-label="Default select example">
                                    <option selected value="">select</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <div class="col-6 mt-20">
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Note</label>
                                    <textarea class="form-control font-size-12" id="exampleFormControlTextarea1" rows="5" placeholder="Discription"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-6" style="margin-top: -65px;">
                            <label for="" class="form-label font-size-14"><span class="text-danger">*</span> Cash Flow Categories</label>
                            <select class="form-select pb-5 pt-5 font-size-13" aria-label="Default select example">
                                <option selected value="">select</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col-6 mt-15">
                            <label for="" class="form-label font-size-14"><span class="text-danger">*</span> Cash Flow Type</label>
                            <div class="row pl-10 pr-10 pt-10 font-size-12">
                                <div class="col-3 form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="" value="" style="border-radius: 50px;margin-left:7px;">
                                    <label class="form-check-label" for=""></label> None
                                </div>
                                <div class="col-3 form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="" value="" style="border-radius: 50px;">
                                    <label class=" form-check-label" for=""></label> Increase (+)
                                </div>
                                <div class="col-4 form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="" value="" style="border-radius: 50px;">
                                    <label class=" form-check-label" for=""></label> Decmane (-)
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="modal-footer" style="border:none;">
                    <button type="button" class="btn btn-outline-secondary pt-4 pb-4  font-size-14" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary pt-4 pb-4 font-size-14" data-bs-dismiss="modal">Create</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdropimporfiletup" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">IMPORT DATA</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="col-12 text-center mt-10 pt-20 pb-20">
                        <div class="row">
                            <div class="col-12">
                                <div class="custom-file">
                                    <input id="logo" type="file" class="custom-file-input" name="excelFile" id="excelFile">
                                    <label for="logo" class="custom-file-label">Choose file...</label>
                                </div>
                            </div>
                        </div>
                        <!-- <div id="drop_zone" class="offset-3 col-6 drop-zone mt-20">
                            <label class="drop-zone__prompt" for="file_input">Drag & Drop or choose files to upload<br>CSV file</label>
                            <input type="file" id="file_input" multiple style="display:none;z-index:99">
                            <script src="../js/upload.js?v=<?= date("YmdHis"); ?>"></script>
                            <div class="offset-3 col-6 mt-30">
                                <button class="import-button">
                                    <label for="file_input">
                                        <i class="fa fa-upload mr-10" aria-hidden="true"></i>
                                        IMPORT CSV FILE
                                    </label>
                                </button>
                                </label>
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
                        </div> -->
                        <div class="row mt-20">
                            <div class="col-6 text-end">
                                <button class="btn btn-danger pt-5 pb-5  font-size-15 font-b" data-bs-dismiss="modal" aria-label="close" style="width:120px;letter-spacing:1px;">
                                    Cancel</button>
                            </div>
                            <div class="col-6 text-start">
                                <button class="btn btn-primary pt-5 pb-5  font-size-15 font-b" data-bs-dismiss="modal" aria-label="submit" style="width:120px;letter-spacing:1px;">
                                    Done
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalPL" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div id="showModalPL"></div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalImportPL" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div id="showModalImportPL"></div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.all.min.js"></script>
    <script>
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const branchId = urlParams.get('branch');

        let now_page = 1;

        $(document).ready(function() {
            $.ajax({
                type: "post",
                url: "ajax/register_pl_flow_add/get_branch.php",
                data: {
                    branchId: branchId
                },
                dataType: "json",
                success: function(response) {
                    if (response.result == 1) {
                        $('#show_branch').html(response.branchName);
                    }
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
                        title: 'Warning !',
                        text: "There was a recording problem. Please contact the system administrator. " + msg,
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            });
            getFooter(now_page);
        });

        function getData(limit) {
            $.ajax({
                beforeSend: function() {
                    swal.fire({
                        html: '<img src="../image/loading.gif" width="200px" height="200px" /><br/><h5 style="color:#93dbe9;">... LOADING ...</h5>',
                        showConfirmButton: false,
                        onRender: function() {
                            $('.swal2-content').prepend(sweet_loader);
                        }
                    });
                },
                url: 'ajax/register_pl_flow_add/get_data.php',
                type: 'POST',
                dataType: 'html',
                data: {
                    branchId: branchId,
                    limit: limit
                },
                success: function(data) {
                    Swal.close();
                    $('#showData').html(data);
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
                        title: 'Warning !',
                        text: "There was a recording problem. Please contact the system administrator. " + msg,
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            });

        }

        function getFooter(page) {
            let limit = (page - 1) * 6;
            $.ajax({
                beforeSend: function() {
                    swal.fire({
                        html: '<img src="../image/loading.gif" width="200px" height="200px" /><br/><h5 style="color:#93dbe9;">... LOADING ...</h5>',
                        showConfirmButton: false,
                        onRender: function() {
                            $('.swal2-content').prepend(sweet_loader);
                        }
                    });
                },
                url: 'ajax/register_pl_flow_add/get_footer.php',
                type: 'POST',
                dataType: 'html',
                data: {
                    page: page,
                    branchId: branchId
                },
                success: function(data) {
                    getData(limit);
                    Swal.close();
                    $('#showFooter').html(data);
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
                        title: 'Warning !',
                        text: "There was a recording problem. Please contact the system administrator. " + msg,
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            });
        }

        function downloadSample() {
            window.open('ajax/register_pl_flow_add/export_excel.php?id=' + branchId);
        }

        function getModalAddPL() {
            $.ajax({
                beforeSend: function() {
                    $("#modalPL").modal("show");
                    let loading = '<div class="text-center"><img src="../image/loading.gif" width="200px" height="200px" /><br/><h5 style="color:#93dbe9;">... LOADING ...</h5></div>';

                    $('#showModalPL').html(loading);

                },
                url: 'ajax/register_pl_flow_add/get_modal_add_PL.php',
                type: 'POST',
                dataType: 'html',
                data: {
                    branchId: branchId
                },
                cache: false,
                success: function(data) {
                    $('#showModalPL').html(data);
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
                        title: 'Warning !',
                        text: "There was a recording problem. Please contact the system administrator. " + msg,
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            });
        }

        function addPLFlow() {
            var acc_code = $('#acc_code').val();
            var acc_name = $('#acc_name').val();
            var pl_major_id = $('#pl_major_id').val();
            var pl_medium_id = $('#pl_medium_id').val();
            var breakdown_id = $('#breakdown_id').val();
            var cash_flow_id = $('#cash_flow_id').val();
            var cash_flow_type = $('input[name="cash_flow_type"]').val();

            if (acc_code == "" || acc_name == "" || pl_major_id == "" || pl_medium_id == "" || breakdown_id == "" || cash_flow_id == "" || cash_flow_type == "") {
                Swal.fire({
                    title: "Warning!!",
                    text: "Please fill out the information completely.",
                    icon: "warning"
                });
                return false;
            }

            let formData = new FormData($("#form_addPLFlow")[0]);
            formData.append('branchId', branchId);
            $.ajax({
                beforeSend: function() {
                    swal.fire({
                        html: '<img src="../image/loading.gif" width="200px" height="200px" /><br/><h5 style="color:#93dbe9;">... LOADING ...</h5>',
                        showConfirmButton: false,
                        onRender: function() {
                            $('.swal2-content').prepend(sweet_loader);
                        }
                    });
                },
                url: 'ajax/register_pl_flow_add/add_PL_flow.php',
                type: 'POST',
                dataType: 'json',
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    if (data.result == 1) {
                        getFooter(data.page);
                        Swal.fire({
                            icon: "success",
                            title: "Your work has been saved",
                            showConfirmButton: false,
                            timer: 1500
                        }).then((data) => {
                            $('#modalPL').modal('hide')
                            location.reload();
                        });
                    }
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
                        title: 'Warning !',
                        text: "There was a recording problem. Please contact the system administrator. " + msg,
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            });
        }

        function editPLFlow() {
            var acc_code = $('#acc_code').val();
            var acc_name = $('#acc_name').val();
            var pl_major_id = $('#pl_major_id').val();
            var pl_medium_id = $('#pl_medium_id').val();
            var breakdown_id = $('#breakdown_id').val();
            var cash_flow_id = $('#cash_flow_id').val();
            var cash_flow_type = $('input[name="cash_flow_type"]').val();

            if (acc_code == "" || acc_name == "" || pl_major_id == "" || pl_medium_id == "" || breakdown_id == "" || cash_flow_id == "" || cash_flow_type == "") {
                Swal.fire({
                    title: "Warning!!",
                    text: "Please fill out the information completely.",
                    icon: "warning"
                });
                return false;
            }

            let formData = new FormData($("#form_editPLFlow")[0]);
            formData.append('branchId', branchId);
            $.ajax({
                beforeSend: function() {
                    swal.fire({
                        html: '<img src="../image/loading.gif" width="200px" height="200px" /><br/><h5 style="color:#93dbe9;">... LOADING ...</h5>',
                        showConfirmButton: false,
                        onRender: function() {
                            $('.swal2-content').prepend(sweet_loader);
                        }
                    });
                },
                url: 'ajax/register_pl_flow_add/edit_PL_flow.php',
                type: 'POST',
                dataType: 'json',
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    if (data.result == 1) {
                        getFooter(data.page);
                        Swal.fire({
                            icon: "success",
                            title: "Your work has been saved",
                            showConfirmButton: false,
                            timer: 1500
                        }).then((data) => {
                            $('#modalPL').modal('hide')
                            location.reload();
                        });
                    }
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
                        title: 'Warning !',
                        text: "There was a recording problem. Please contact the system administrator. " + msg,
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            });
        }

        function getModalEditPL(account_id) {
            $.ajax({
                beforeSend: function() {
                    $("#modalPL").modal("show");
                    let loading = '<div class="text-center"><img src="../image/loading.gif" width="200px" height="200px" /><br/><h5 style="color:#93dbe9;">... LOADING ...</h5></div>';

                    $('#showModalPL').html(loading);

                },
                url: 'ajax/register_pl_flow_add/get_modal_edit_PL.php',
                type: 'POST',
                dataType: 'html',
                data: {
                    branchId: branchId,
                    account_id: account_id
                },
                cache: false,
                success: function(data) {
                    $('#showModalPL').html(data);
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
                        title: 'Warning !',
                        text: "There was a recording problem. Please contact the system administrator. " + msg,
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            });
        }

        function getModalImportPL() {
            $.ajax({
                beforeSend: function() {
                    $("#modalImportPL").modal("show");
                    let loading = '<div class="text-center"><img src="../image/loading.gif" width="200px" height="200px" /><br/><h5 style="color:#93dbe9;">... LOADING ...</h5></div>';

                    $('#showModalImportPL').html(loading);

                },
                url: 'ajax/register_pl_flow_add/get_modal_import_PL.php',
                type: 'POST',
                dataType: 'html',
                data: {
                    branchId: branchId
                },
                cache: false,
                success: function(data) {
                    $('#showModalImportPL').html(data);
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
                        title: 'Warning !',
                        text: "There was a recording problem. Please contact the system administrator. " + msg,
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            });
        }

        function importPLFlow() {

            var formData = new FormData($("#form_ImportPLFlow")[0]);
            formData.append("branchId", branchId);

            Swal.fire({
                title: "Warning!!",
                text: "Please fill out the information completely.",
                icon: "warning"
            });

            Swal.fire({
                title: "Please confirm to complete the transaction.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        beforeSend: function() {
                            swal.fire({
                                html: '<img src="../image/loading.gif" width="200px" height="200px" /><br/><h5 style="color:#93dbe9;">... UPLOADING ...</h5>',
                                showConfirmButton: false,
                                onRender: function() {
                                    $('.swal2-content').prepend(sweet_loader);
                                }
                            });
                        },
                        type: 'POST',
                        url: 'ajax/register_pl_flow_add/import_data.php',
                        data: formData,
                        processData: false,
                        contentType: false,
                        catch: false,
                        dataType: 'json',
                        success: function(data) {
                            console.log(data);
                            if (data.response == 0) {
                                Swal.fire({
                                    icon: "error",
                                    title: "An error occurred !",
                                    text: "Please check the file.",
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then((data) => {
                                    window.open("ajax/register_pl_flow_add/ErrorFiles.xlsx", '_blank');
                                });
                            }
                            if (data.response == 1) {
                                Swal.fire({
                                    icon: "success",
                                    title: "Your work has been saved",
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then((data) => {
                                    location.reload();
                                });
                            }
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
                                title: 'Warning !',
                                text: "There was a recording problem. Please contact the system administrator. " + msg,
                                icon: 'error',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    })
                } else {
                    return false;
                }
            });

        }
    </script>
</body>

</html>