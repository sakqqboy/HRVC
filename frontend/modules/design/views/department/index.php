<?php

$this->title = 'Department';
?>

<div class="col-12 department-one" style="margin-top: 90px;">
    <div class="row">
        <div class="col-lg-2 col-md-6 col-12">
            <div class="col-12 branch-title">
                Department
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-12 mt-10">
            <button type="button" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Create</button>
        </div>
        <div class="col-lg-3 col-md-6 col-12 mt-10 bt-togg">
            <div class="input-group">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Branch</button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#">Separated link</a></li>
                </ul>
                <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Tokyo Consulting Firm Pvt. Ltd">
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-12 mt-10 bt-togg">
            <div class="input-group">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Company</button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#">Separated link</a></li>
                </ul>
                <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Tokyo Consulting Firm Pvt. Ltd">
            </div>
        </div>
    </div>
    <div class="col-12 mt-30">
        <div class="alert alert-secondary" role="alert">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="col-12">
                        <label for="exampleFormControlInput1" class="form-label" style="font-weight: 700;"> Select Associate Company </label>
                        <select class="form-select" aria-label="Default select example">
                            <option selected>select Company</option>
                            <option value="1">Tokyo Consulting Firm Pvt. Ltd</option>
                            <option value="2">Tokyo Consulting Firm Pvt. Ltd</option>
                            <option value="3">Tokyo Consulting Firm Pvt. Ltd</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="col-12">
                        <label for="exampleFormControlInput1" class="form-label" style="font-weight: 700;"> Select Associate Branch</label>
                        <select class="form-select" aria-label="Default select example">
                            <option selected>select Branch</option>
                            <option value="1">IT Services and IT Consulting</option>
                            <option value="2">China</option>
                            <option value="3">Columbia</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-12">
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label" style="font-weight: 700;"> Department Name</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-12">
                    <div class="col-12">
                        <label for="exampleFormControlInput1" class="form-label" style="font-weight: 700;"> Set titles</label>
                        <select class="form-select" aria-label="Default select example">
                            <option selected>select set titles</option>
                            <option value="1">Manager</option>
                            <option value="2">IT</option>
                            <option value="3">Accountting</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-12 pt-30">
                    <button type="submit" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Create</button>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="alert alert-branch" role="alert">
                <div class="row">
                    <div class="col-lg-3 col-md-5 col-sm-3 col-12">
                        <div class="card" style="border: none;border-radius:10px;">
                            <div class="card-body">
                                <div class="col-12 txt-bold">
                                    Accounts & Taxation
                                </div>
                                <div class="row">
                                    <div class="col-6 department-tokyo">
                                        Tokyo Consulting Firm Limited
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn btn-outline-dark"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> </button>
                                        <button type="button" class="btn btn-outline-danger"><i class="fa fa-trash" aria-hidden="true"></i> </button>
                                    </div>
                                    <div class="col-12 bangladresh-hrvc2">
                                        Branch: <img src="<?= Yii::$app->homeUrl ?>image/Round-Bangladesh.png" class="bangladresh-hrvc1"> Dhaka, Bangladesh
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3 share-big">
                                        <img src="<?= Yii::$app->homeUrl ?>image/Vector.png" class="image-vector">
                                    </div>
                                    <div class="col-2 show-height"></div>
                                    <div class="col-3 title-margin">
                                        Title
                                    </div>
                                    <div class="col-4 department-sizesmall">
                                        Manager
                                        Supervisor
                                        Assistant Supervisor
                                        Manager
                                        Assistant Manager
                                        Intern
                                        Director
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-5 col-sm-3 col-12">
                        <div class="card" style="border: none; border-radius:10px;">
                            <div class="card-body">
                                <div class="col-12 txt-bold">
                                    IT Services
                                </div>
                                <div class="row">
                                    <div class="col-6 department-tokyo">
                                        Tokyo Consulting Firm Limited
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn btn-outline-dark"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> </button>
                                        <button type="button" class="btn btn-outline-danger"><i class="fa fa-trash" aria-hidden="true"></i> </button>
                                    </div>
                                    <div class="col-12 bangladresh-hrvc2">
                                        Branch: <img src="<?= Yii::$app->homeUrl ?>image/Round-Bangladesh.png" class="bangladresh-hrvc1"> Dhaka, Bangladesh
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3 share-big">
                                        <img src="<?= Yii::$app->homeUrl ?>image/Vector.png" class="image-vector">
                                    </div>
                                    <div class="col-2 show-height"></div>
                                    <div class="col-3 title-margin">
                                        Titles
                                    </div>
                                    <div class="col-4 department-sizesmall">
                                        Manager
                                        Supervisor
                                        Assistant Supervisor
                                        Manager
                                        Assistant Manager
                                        Intern
                                        Director
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-5 col-sm-3 col-12">
                        <div class="card" style="border: none;border-radius:10px;">
                            <div class="card-body">
                                <div class="col-12 txt-bold">
                                    Accounts & Taxation
                                </div>
                                <div class="row">
                                    <div class="col-6 department-tokyo">
                                        Tokyo Consulting Firm Limited
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn btn-outline-dark"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> </button>
                                        <button type="button" class="btn btn-outline-danger"><i class="fa fa-trash" aria-hidden="true"></i> </button>
                                    </div>
                                    <div class="col-12 bangladresh-hrvc2">
                                        Branch: <img src="<?= Yii::$app->homeUrl ?>image/Round-Bangladesh.png" class="bangladresh-hrvc1"> Dhaka, Bangladesh
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3 share-big">
                                        <img src="<?= Yii::$app->homeUrl ?>image/Vector.png" class="image-vector">
                                    </div>
                                    <div class="col-2 show-height"></div>
                                    <div class="col-3 title-margin">
                                        Titles
                                    </div>
                                    <div class="col-4 department-sizesmall">
                                        Manager
                                        Supervisor
                                        Assistant Supervisor
                                        Manager
                                        Assistant Manager
                                        Intern
                                        Director
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-5 col-sm-3 col-12">
                        <div class="card" style="border: none;border-radius:10px;">
                            <div class="card-body">
                                <div class="col-12 txt-bold">
                                    Marketing
                                </div>
                                <div class="row">
                                    <div class="col-6 department-tokyo">
                                        Tokyo Consulting Firm Limited
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn btn-outline-dark"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> </button>
                                        <button type="button" class="btn btn-outline-danger"><i class="fa fa-trash" aria-hidden="true"></i> </button>
                                    </div>
                                    <div class="col-12 bangladresh-hrvc2">
                                        Branch: <img src="<?= Yii::$app->homeUrl ?>image/Round-Bangladesh.png" class="bangladresh-hrvc1"> Dhaka, Bangladesh
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3 share-big">
                                        <img src="<?= Yii::$app->homeUrl ?>image/Vector.png" class="image-vector">
                                    </div>
                                    <div class="col-2 show-height"></div>
                                    <div class="col-3 title-margin">
                                        Titles
                                    </div>
                                    <div class="col-4 department-sizesmall">
                                        Manager
                                        Supervisor
                                        Assistant Supervisor
                                        Manager
                                        Assistant Manager
                                        Intern
                                        Director
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>