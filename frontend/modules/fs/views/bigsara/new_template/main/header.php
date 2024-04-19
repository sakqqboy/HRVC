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
    <div class="row">
        <div class="col-12">
            <div class="col-12 alert background-Planning">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-5 fst1-modulesdashboard">
                                Financial Module Dashboard
                            </div>
                            <div class="col-2">
                                <button class="btn btn-primary btn-Create-sb pb-2 pt-2 pl-10" type="submit" data-bs-toggle="modal" data-bs-target="#staticBackdropmodulescreate"> <img src="../images/icons/Light/Light/24px/Create(Big).png" class="module_CreateBig">
                                    Create</button>
                            </div>
                            <div class="col-4" id="showButtonAddCompany"></div>

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