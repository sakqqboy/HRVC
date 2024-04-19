<html>

<title>Financial Planning view</title>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="../css/layout/font.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">
    <link href="../css/layout/layout.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">
    <link href="../css/fs.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">
    <link href="../css/fs_view.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">
</head>


<body>
    <div class="col-12">
        <div class="col-12 alert background-Planning">
            <div class="col-12 planning">
                <img src="../images/icons/Dark/48px/FinanicalPlanning.png" class="images_Dark_FinanicalPlanning">
                Financial Planning
            </div>
            <div class="col-12 mt-10">
                <div class="shadow pb-5 pt-5 mb-5 bg-body rounded alert2-secondary3">
                    <ul class="nav nav-pills" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <!-- <a class="nav-link text-dark" id="pills-Forcast-tab" data-bs-toggle="pill" data-bs-target="#pills-Forcast" type="button" role="tab" aria-controls="pills-Forcast" aria-selected="true"><img src="../images/icons/Dark/48px/PL-Forecast.png" class="images_performance_PL">Dash Board</a> -->
                            <!-- <a class="nav-link text-dark" id="pills-Forcast-tab" href="fs_dashboard.php" data-bs-toggle="pill" type="button" role="tab" aria-controls="pills-Forcast" aria-selected="true"><img src="../images/icons/Dark/48px/PL-Forecast.png" class="images_performance_PL">Dash Board</a> -->
                            <a class="nav-link text-dark active" id="pills-Forcast-tab" href="fs_dashboard.php" >
                                <img src="../images/icons/Dark/48px/PL-Forecast.png" class="images_performance_PL">Dash Board
                            </a>

                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link text-dark" id="pills-Golden-tab" data-bs-toggle="pill" type="button" role="tab" aria-controls="pills-Golden" aria-selected="false"><img src="../images/icons/Dark/48px/Golden-Ratio.png" class="images_performance_PL"> Golden Ratio</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link text-dark" id="pills-Accounts-tab" data-bs-toggle="pill" type="button" role="tab" aria-controls="pills-Accounts" aria-selected="false"><img src="../images/icons/Dark/48px/Designation-1.png" class="images_performance_PL"> Forecast Accounts</a>
                        </li>
                    </ul>
                </div>
            </div>