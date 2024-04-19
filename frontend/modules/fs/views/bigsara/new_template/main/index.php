<html>

<title>Financial Module Dashboard</title>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="../css/layout/font.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">
    <link href="../css/layout/layout.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">
    <link href="../css/fs.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">
    <link href="../css/fs_view.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">
    <link href="../css/fs.module.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.min.css" rel="stylesheet">

</head>

<body>
    <div class="row pr-0 pl-0">
        <div class="col-12">
            <div class="col-12 alert background-Planning">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-6 fst1-modulesdashboard">
                                Financial Module Dashboard
                            </div>
                            <div class="col-2 pr-0 pl-0">
                                <button class="btn btn-primary btn-Create-sb pb-2 pt-2 font-size-12" type="submit" data-bs-toggle="modal" data-bs-target="#staticBackdropmodulescreate">
                                    <img src="../images/icons/Light/Light/24px/Create(Big).png" class="module_CreateBig">
                                    Create
                                </button>
                            </div>
                            <div class="col-4 pr-0 pl-0" id="showButtonAddCompany"></div>

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-6" id="showCompanyGroup"></div>
                            <div class="col-5">
                                <div class="col-12">
                                    <input type="month" class="form-control" style="border-radius: 20px;font-size:12px;" name="dates" value="01/01/2018 - 01/15/2018" />
                                </div>
                            </div>
                            <div class="col-1">
                                <i class="fa fa-search font-size-16 pt-10" aria-hidden="true" type="submit"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="showData" style="height:90%;"></div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 text-center" id="showFooter"></div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdropmodulescreate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title text-primary" id="staticBackdropLabel"><i class="fa fa-magic text-primary" aria-hidden="true"></i> Create Financial Modules</h6>
                    <button type="button" class="btn-close font-size-13" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="col-12">
                                    <label for="exampleFormControl" class="form-label lb_moon"><span class="text-danger">*</span>
                                        Company</label>
                                    <select class="form-select pb-5 pt-5 font-size-13" aria-label="Default select example">
                                        <option selected value="">Select company</option>
                                        <option value="1">Tokyo consulting Firm</option>
                                        <option value="2">Tokyo Consulting Group</option>
                                        <option value="3">Tokyo Consulting Group</option>
                                    </select>
                                </div>
                                <div class="col-12 mt-30">
                                    <label for="start" class="form-label lb_moon"><span class="text-danger">*</span>
                                        Select FY Start Period</label>
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text pb-5 pt-5 font-size-13" id="addon-wrapping" type="date"><img src="../images/icons/Dark/24px/Calender.png" class="Calender_big">
                                            Forecast Period</span>
                                        <input class="form-control pb-5 pt-5 font-size-13" type="month" id="start" name="start" min="2018-03" value="2018-05" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-4 pt-20">
                                            <label for="exampleFormControl" class="form-label lb_moon">Previous</label>
                                            <div class="bg-light-Actual pb-5 pt-5">2022</div>
                                        </div>
                                        <div class="col-4 pt-20">
                                            <label for="exampleFormControl" class="form-label lb_moon">Actual</label>
                                            <div class="bg-light-Actual pb-5 pt-5">2023</div>
                                        </div>
                                        <div class="col-4 pt-20">
                                            <label for="exampleFormControl" class="form-label lb_moon">Forecasted
                                                Year</label>
                                            <div class="bg-light-Actual pb-5 pt-5">2024</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="col-12">
                                    <label for="exampleFormControl" class="form-label lb_moon"><span class="text-danger">*</span>
                                        Branch</label>
                                    <select class="form-select pb-5 pt-5 font-size-13" aria-label="Default select example">
                                        <option selected value="">Select company</option>
                                        <option value="1">Tokyo consulting Firm</option>
                                        <option value="2">Tokyo Consulting Group</option>
                                        <option value="3">Tokyo Consulting Group</option>
                                    </select>
                                </div>
                                <div class="col-12 mt-30">
                                    <label for="end" class="form-label lb_moon"><span class="text-danger">*</span>
                                        Select FY End Period</label>
                                    <div class="input-group flex-nowrap font-size-13">
                                        <span class="input-group-text pb-5 pt-5 font-size-13" id="addon-wrapping" type="date"><img src="../images/icons/Dark/24px/Calender.png" class="Calender_big">
                                            Forecast Previod</span>
                                        <input type="month" class="form-control pb-5 pt-5 font-size-13" id="start" name="start" min="2018-03" value="2018-05" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="border:none;">
                    <button type="button" class="btn outlinelightgray" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary putlineprimary" data-bs-dismiss="modal">Create</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="linechart" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="doughnut bg-1000" style="position:relative;">
    <canvas id="donutChart" style="width:50%;max-width:250px"></canvas>

    <script>
        const xValues = [];
        const yValues = [55, 49];
        const barColors = [
            "rgb(30, 98, 233)",
            "rgb(165, 166, 166)"
        ];

        new Chart("donutChart", {
            type: "doughnut",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            options: {
                title: {
                    display: true
                }
            }
        });
    </script>
</div> -->

    <div class="modal fade" id="modalAddCompanyGroup" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div id="showModalAddCompany"></div>
            </div>
        </div>
    </div>

    <!-- <div class="col-12 text-center" id="showFooter"></div> -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

</body>

</html>

<script>
    $(document).ready(function() {
        // $('input[name="dates"]').daterangepicker();
        getButtonAddCompany();
        getCompanyGroup();
    });

    function getCompanyGroup() {
        //var companyId = localStorage.getItem('companyId');
        $.ajax({
            url: 'ajax/index/get_company_group.php',
            type: 'POST',
            dataType: 'html',
            data: {
                //companyId: companyId
            },
            success: function(data) {
                $('#showCompanyGroup').html(data);
                getFooter(1);
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

    function changeCompanyGroup(companyId) {
        // localStorage.setItem("companyId", companyId);
        getCompanyGroup();
    }

    function getData(limit) {
        var company_group = $('#company_group').val();
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
            url: 'ajax/index/get_data.php',
            type: 'POST',
            dataType: 'html',
            data: {
                company_group: company_group,
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
                    title: 'แจ้งเตือน !',
                    text: "พบปัญหาการบันทึก กรุณาติดต่อผู้ดูแลระบบ" + msg,
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });

    }

    function getButtonAddCompany() {
        $.ajax({
            url: 'ajax/index/get_button_add_branch.php',
            type: 'POST',
            dataType: 'html',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $('#showButtonAddCompany').html(data);
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

    function getModalAddBranch() {
        var companyId = $('#company_group').val();
        $.ajax({
            beforeSend: function() {
                $("#modalAddCompanyGroup").modal("show");
                let loading = '<div class="text-center"><img src="../image/loading.gif" width="200px" height="200px" /><br/><h5 style="color:#93dbe9;">... LOADING ...</h5></div>';

                $('#showModalAddCompany').html(loading);

            },
            url: 'ajax/index/get_modal_add_branch.php',
            type: 'POST',
            dataType: 'html',
            data: {
                companyId: companyId
            },
            cache: false,
            success: function(data) {
                $('#showModalAddCompany').html(data);
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

    function addBranch() {
        var companyId = $('#companyId').val();
        var branchName = $('#branchName').val();
        var financial_start_month = $('#financial_start_month').val();

        if (companyId == "" || branchName == "" || financial_start_month == "") {
            Swal.fire({
                title: "Warning!!",
                text: "Please fill out the information completely.",
                icon: "warning"
            });
            return false;
        }

        let formData = new FormData($("#form_add_branch")[0]);
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
            url: 'ajax/index/add_branch.php',
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
                    }).then((result) => {
                        $("#modalAddCompanyGroup").modal("hide");
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
                    title: 'แจ้งเตือน !',
                    text: "พบปัญหาการบันทึก กรุณาติดต่อผู้ดูแลระบบ" + msg,
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });
    }

    function getFooter(page) {
        var companyId = $('#company_group').val();
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
            url: 'ajax/index/get_footer.php',
            type: 'POST',
            dataType: 'html',
            data: {
                page: page,
                companyId: companyId
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

    function getModalEditBranch(branchId) {
        var companyId = $('#company_group').val();
        $.ajax({
            beforeSend: function() {
                $("#modalAddCompanyGroup").modal("show");
                let loading = '<div class="text-center"><img src="../image/loading.gif" width="200px" height="200px" /><br/><h5 style="color:#93dbe9;">... LOADING ...</h5></div>';

                $('#showModalAddCompany').html(loading);

            },
            url: 'ajax/index/get_modal_edit_branch.php',
            type: 'POST',
            dataType: 'html',
            data: {
                companyId: companyId,
                branchId: branchId
            },
            cache: false,
            success: function(data) {
                $('#showModalAddCompany').html(data);
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