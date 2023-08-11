<?php

$this->title = 'Title';
?>

<div class="col-12" style="margin-top: 90px;">
    <div class="row">
        <div class="col-lg-1 col-md-6 col-12">
            <div class="col-12 branch-title">
                Title
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-12 mt-10">
            <button type="button" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Create</button>
        </div>
    </div>
    <div class="row mt-50">
        <div class="col-lg-5 col-md-6 col-4">
            <div class="alert alert-secondary backtitle" role="alert" style="width: 17rem; height:3.2rem;">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <button class="nav-link title1-top" id="pills-title-tab" data-bs-toggle="pill" data-bs-target="#pills-title" type="button" role="tab" aria-controls="pills-title" aria-selected="true">Title</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link title1-top" id="pills-Management-tab" data-bs-toggle="pill" data-bs-target="#pills-Management-Layer" type="button" role="tab" aria-controls="pills-Management-Layer" aria-selected="false">Management Layer</button>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-4 text-end">
            <button type="button" class="btn btn-outline-primary"> <i class="fa fa-filter" aria-hidden="true"></i></button>
        </div>
        <div class="col-lg-3 col-md-6 col-4">
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
                <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="">
            </div>
        </div>
    </div>
    <div class="col-12 mt-30">
        <div class="alert alert-secondary" role="alert">
            <div class="row">
                <div class="col-lg-2 col-md-6 col-12">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label"> Title Name</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="col-12">
                        <label for="exampleFormControlInput1" class="form-label"> Select Company</label>
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Select company</option>
                            <option value="1">Delhi, New Delhi</option>
                            <option value="2">China</option>
                            <option value="3">Columbia</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="col-12">
                        <label for="exampleFormControlInput1" class="form-label"> Select Branch</label>
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Select Branch</option>
                            <option value="1">IT Services and IT Consulting</option>
                            <option value="2">IT</option>
                            <option value="3">Accountting</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-12">
                    <div class="col-12">
                        <label for="exampleFormControlInput1" class="form-label"> Select Layer</label>
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Select Layer</option>
                            <option value="1">TM</option>
                            <option value="2">IT</option>
                            <option value="3">Accountting</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-12">
                    <button type="submit" class="btn btn-success mt-30"><i class="fa fa-plus" aria-hidden="true"></i> Create</button>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="alert alert-branch" role="alert">
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-sm-3 col-12">
                        <div class="card" style="border: none;border-radius:10px;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-2">
                                        <div class="col-12">
                                            <img src="<?= Yii::$app->homeUrl ?>image/user.png" class="name-user">
                                        </div>
                                    </div>
                                    <div class="col-1 show-height"></div>
                                    <div class="col-6">
                                        <div class="col-12 manager">
                                            Manager <span class="badge rounded-pill bg-primary">TM</span>

                                        </div>
                                        <div class="col-12 Consulting-Firm">
                                            Tokyo Consulting Firm Limited
                                        </div>
                                        <div class="col-12 branch-country">
                                            Branch: <img src="<?= Yii::$app->homeUrl ?>image/Round-Bangladesh.png" class="bangladresh-hrvc1"> Dhaka, Bangladesh
                                        </div>
                                    </div>
                                    <div class="col-3 mt-20">
                                        <button type="button" class="btn btn-outline-secondary but0"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                        <button type="button" class="btn btn-outline-danger but0"><i class="fa fa-trash" aria-hidden="true"></i> </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-3 col-12">
                        <div class="card" style="border: none;border-radius:10px;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-2">
                                        <div class="col-12">
                                            <img src="<?= Yii::$app->homeUrl ?>image/user.png" class="name-user">
                                        </div>
                                    </div>
                                    <div class="col-1 show-height"></div>
                                    <div class="col-6">
                                        <div class="col-12 manager">
                                            Executive <span class="badge rounded-pill bg-primary">LM</span>

                                        </div>
                                        <div class="col-12 Consulting-Firm">
                                            Tokyo Consulting Firm Limited
                                        </div>
                                        <div class="col-12 branch-country">
                                            Branch: <img src="<?= Yii::$app->homeUrl ?>image/Round-Bangladesh.png" class="bangladresh-hrvc1"> Dhaka, Bangladesh
                                        </div>
                                    </div>
                                    <div class="col-3 mt-20">
                                        <button type="button" class="btn btn-outline-secondary but0"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                        <button type="button" class="btn btn-outline-danger but0"><i class="fa fa-trash" aria-hidden="true"></i> </button>
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