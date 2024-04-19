<html>

<title>PL register flow</title>

<Head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="../css/layout/font.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">
    <link href="../css/layout/layout.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">
    <link href="../css/fs.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">
    <link href="../css/pl.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">



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
                    <div class="col-8 font-size-16 font-b">
                        Register PL Flow
                    </div>
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
                        <div class="row pl-20 pr-20 pb-10">
                            <?php
                            for ($i = 1; $i <= 6; $i++) {
                            ?>
                                <div class="col-4">
                                    <div class="card pl-20 pr-20">
                                        <div class="col-6 border-buttom font-size-13">
                                            <span class="fw-bold">1. PL-01 <span class="pl-20">Sales</span></span>
                                        </div>
                                        <div class="col-6 pl_textsale">
                                            sales
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>

                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    </div>
    </div>
</body>

</html>