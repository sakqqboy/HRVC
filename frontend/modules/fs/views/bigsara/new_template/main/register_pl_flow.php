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
                    <div class="col-2">
                        <div class="col-12 font-size-16 font-b">
                            Register PL Flow
                        </div>
                    </div>
                    <div class="col-4">
                        <button class="btn btn-primary pt-2 pb-2 font-size-12" data-bs-toggle="modal" data-bs-target="#flowadd"> <i class="fa fa-magic" aria-hidden="true"></i> ADD</button>
                        <button class="btn btn-success pt-2 pb-2 font-size-12"> <img src="../images/icons/Dark/48px/download-up.png" class="download-up_png"> Download Sample</button>
                        <button type="button" class="btn btn-purple text-white pb-2 pt-2 font-size-12" data-bs-toggle="modal" data-bs-target="#staticBackdropimporfiletup"><img src="../images/icons/Dark/48px/import-white.png" class="download-up_png"> <span class="font-size-10"> IMPORT</span></button>

                    </div>
                    <div class="col-2 text-end">
                        <button type="button" class="btn btn-light Data"> <i class="fa fa-arrow-circle-down" aria-hidden="true"></i> Export</button>
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
                            for ($i = 1; $i <= 3; $i++) {
                            ?>
                                <div class="col-4">
                                    <div class="card pl-20 pr-20">

                                        <div class="row pl-10 pr-10 pt-10 pb-10">
                                            <div class="col-lg-6 font-size-12">
                                                PL Account Name
                                            </div>
                                            <div class="col-lg-6 text-end">
                                                <div class="badge bg-light  text-secondary" style="cursor: pointer;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></div>
                                                <div class="badge bg-light text-danger" style="cursor: pointer;"><i class="fa fa-trash-o" aria-hidden="true"></i></div>
                                            </div>
                                        </div>

                                        <div class="col-12  font-size-13 pl-10 pr-10">
                                            <span class="font-b">01. PL-03-> <span class="pl-5 font-size-11">MenuFacturing Cost(CS)</span></span>
                                        </div>
                                        <div class="col-12 border-left pl-10 pr-10 mt-10">
                                            <div class="col-12">
                                                <span class="font-size-10">PL Categories</span> <span class="font-b pl-10 font-size-12">Material Expense</span>
                                            </div>
                                            <div class="col-12 pt-20 font-size-12">
                                                <span class="font-size-10"> PL Sub-Company</span> <span class="font-b pl-10">Variable Expense</span>
                                            </div>
                                        </div>
                                        <div class="col-12 pt-15 pl-10 pr-10 font-size-12">
                                            <span class="font-size-10"> Cash From Categories</span> <span class="font-b pl-10">Account Payable</span>
                                        </div>
                                        <div class="col-12 text-end mt-20 pr-10 pb-10">
                                            <div class="row">
                                                <div class="col-8 font-size-12">
                                                    Type
                                                </div>
                                                <div class="col-4 font-size-12 font-b" style="cursor: pointer;">
                                                    Increase (+)
                                                </div>
                                            </div>
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
    <div class="col-12 text-center">
        <div class="btn-group" role="group" aria-label="First group">
            <button type="button" class="btn btn-light font-size-11"> <i class="fa fa-chevron-left" aria-hidden="true"></i>
                Previous</button>
        </div>
        <div class="btn-group" role="group" aria-label="Second group">
            <button type="button" class="btn btn-light font-size-11">1</button>
            <button type="button" class="btn btn-light font-size-11">2</button>
            <button type="button" class="btn btn-light font-size-11">3</button>
            <button type="button" class="btn btn-light font-size-11">4</button>
        </div>
        <div class="btn-group" role="group" aria-label="Third group">
            <button type="button" class="btn btn-light font-size-11"> Next <i class="fa fa-chevron-right" aria-hidden="true"></i></button>
        </div>
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
                <div class="modal-body">
                    <div class="col-12 text-center mt-10 pt-20 pb-20">
                        <div class="row">
                            <div class="col-10" style="margin-left:-90px;">
                                <span class="text-danger">*</span>
                                <span class="font-size-14 text-secondary" style="letter-spacing: 0.5px;">Select PL DATA Import Year</span>
                            </div>
                            <div class="col-2">
                                <div class="alert alert-success font-size-12 pb-4 pt-4">
                                    <i class="fa fa-check-circle mr-5" aria-hidden="true"></i>Successfully added
                                </div>
                            </div>
                        </div>

                        <div class="row mt-10 pb-10 font-size-14">
                            <div class="col-12 mt-10">
                                <div class="row">
                                    <div class="col-3" style="margin-left: 220px;">
                                        <input type="checkbox" class="form-check-input"> Previous
                                    </div>
                                    <div class="col-3" style="margin-left: -90px;">
                                        <input type="checkbox" class="form-check-input"> Actual
                                    </div>
                                    <div class="col-3" style="margin-left: -90px;">
                                        <input type="checkbox" class="form-check-input"> Forecast
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-10">
                                <div class="btn-group" role="group" aria-label="Basic outlined example">
                                    <button type="button" class="btn btn-outline-primary font-size-13 pl-70 pr-70">Previous</button>
                                    <button type="button" class="btn btn-outline-primary font-size-13 pl-70 pr-70">Actual</button>
                                    <button type="button" class="btn btn-outline-primary font-size-13 pl-70 pr-70">Forecast</button>
                                </div>
                            </div>
                            <div class="col-12 mt-10">
                                <div class="text-group" role="group" aria-label="Basic outlined example">
                                    <?php
                                    for ($i = 1; $i <= 3; $i++) {
                                    ?>
                                        <span type="text" class="font-size-13 pl-77 pr-77 pt-7 pb-7" style="background-color:#f2f2f2;">2020</span>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div id="drop_zone" class="offset-3 col-6 drop-zone mt-20">
                            <label class="drop-zone__prompt" for="file_input">Drag & Drop or choose files to upload<br>CSV file</label>
                            <input type="file" id="file_input" multiple style="display:none;z-index:99">
                            <script src="../js/upload.js?v=<?= date("YmdHis"); ?>"></script>
                            <div class="offset-3 col-6 mt-30">

                                <button class="import-button">
                                    <label for="file_input">
                                        <i class="fa fa-upload mr-10" aria-hidden="true"></i>
                                        IMPORT
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
                        </div>
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

</body>

</html>