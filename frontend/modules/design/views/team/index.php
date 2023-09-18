<?php

$this->title = 'Team';
?>

<div class="col-12 team-one mt-90">
    <div class="row">
        <div class="col-lg-1 col-md-6 col-12">
            <div class="col-12 branch-title">
                Team
            </div>
        </div>
        <div class="col-lg-2 col-md-6 col-12 mt-10">
            <button type="button" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Create</button>
        </div>
        <div class="col-lg-3 col-md-4 col-12 mt-10 bt-togg">
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
        <div class="col-lg-3 col-md-4 col-12 mt-10 bt-togg">
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
                <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="">
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-12 mt-10 bt-togg">
            <div class="input-group">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Department</button>
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
    <div class="col-12 mt-10">
        <div class="alert alert-secondary" role="alert">
            <div class="row">
                <div class="col-lg-2 col-md-6 col-12">
                    <div class="col-12">
                        <label for="exampleFormControlInput1" class="form-label" style="font-size: 13px;font-weight:700;"> Select Associate Company </label>
                        <select class="form-select Company-select" aria-label="Default select example">
                            <option selected>Select Company</option>
                            <option value="1">Tokyo Consulting Firm Pvt. Ltd</option>
                            <option value="2">Tokyo Consulting Firm Pvt. Ltd</option>
                            <option value="3">Tokyo Consulting Firm Pvt. Ltd</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-12">
                    <div class="col-12">
                        <label for="exampleFormControlInput1" class="form-label" style="font-size: 13px;font-weight:700;"> Select Associate Branch</label>
                        <select class="form-select Company-select" aria-label="Default select example">
                            <option selected>Select Branch</option>
                            <option value="1">Delhi, New Delhi</option>
                            <option value="2">China</option>
                            <option value="3">Columbia</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-12">
                    <div class="col-12">
                        <label for="exampleFormControlInput1" class="form-label" style="font-size: 12px;font-weight:700;"> Select Associate Department</label>
                        <select class="form-select Company-select" aria-label="Default select example">
                            <option selected>Select Department</option>
                            <option value="1">IT Services and IT Consulting</option>
                            <option value="2">IT</option>
                            <option value="3">Accountting</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-12">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label" style="font-size: 13px;font-weight:700;"> Team Name</label>
                        <input type="text" class="form-control Company-select" id="exampleFormControlInput1" placeholder="">
                    </div>
                </div>

                <div class="col-lg-2 col-md-6 col-12">
                    <div class="col-12">
                        <label for="exampleFormControlInput1" class="form-label" style="font-size: 13px;font-weight:700;"> Assign Employee</label>
                        <select class="form-select Company-select" aria-label="Default select example">
                            <option selected>Select Employee</option>
                            <option value="1">Hamish Marsh</option>
                            <option value="2">IT</option>
                            <option value="3">Accountting</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-12">
                    <div class="col-12">
                        <label for="exampleFormControlInput1" class="form-label" style="font-size: 13px;font-weight:700;"> Team Title</label>
                        <select class="form-select Company-select" aria-label="Default select example">
                            <option selected>Select set titles</option>
                            <option value="1">Leader</option>
                            <option value="2">IT</option>
                            <option value="3">Accountting</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-12 team-create0">
                    <button type="submit" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Create</button>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="alert alert-branch" role="alert">
                <div class="row">
                    <div class="col-lg-3 col-md-5 col-sm-3 col-12">
                        <div class="card" style="border: none;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6 bold-team">
                                        Team A
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn btn-outline-dark"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> </button>
                                        <button type="button" class="btn btn-outline-danger"><i class="fa fa-trash" aria-hidden="true"></i> </button>
                                    </div>
                                </div>
                                <div class="col-9 mt-10 department-tokyo">
                                    Tokyo Consulting Firm Limited
                                </div>
                                <div class="col-12 bangladresh-hrvc2">
                                    Branch: <img src="<?= Yii::$app->homeUrl ?>image/Round-Bangladesh.png" class="bangladresh-hrvc1"> Dhaka, Bangladesh
                                </div>
                                <div class="row mt-20">
                                    <div class="col-3">
                                        <i class="fa fa-users share-big mt-40" aria-hidden="true"></i>
                                    </div>
                                    <div class="col-2 show-height"></div>
                                    <div class="col-7 team-sizesmall">
                                        <p> Saige Fuentes > LEADER</p>
                                        <p> Bowen Higgins > Sub-Leader</p>
                                        <p>Leighton Kramer > Staff</p>
                                        <p> Kylan Gentry > Staff</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-5 col-sm-3 col-12">
                        <div class="card" style="border: none;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6 bold-team">
                                        Team A
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn btn-outline-dark"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> </button>
                                        <button type="button" class="btn btn-outline-danger"><i class="fa fa-trash" aria-hidden="true"></i> </button>
                                    </div>
                                </div>
                                <div class="col-9 mt-10 department-tokyo">
                                    Tokyo Consulting Firm Limited
                                </div>
                                <div class="col-12 bangladresh-hrvc2">
                                    Branch: <img src="<?= Yii::$app->homeUrl ?>image/Round-Bangladesh.png" class="bangladresh-hrvc1"> Dhaka, Bangladesh
                                </div>
                                <div class="row mt-20">
                                    <div class="col-3">
                                        <i class="fa fa-users share-big mt-40" aria-hidden="true"></i>
                                    </div>
                                    <div class="col-2 show-height"></div>
                                    <div class="col-7 team-sizesmall">
                                        <p> Saige Fuentes > LEADER</p>
                                        <p> Bowen Higgins > Sub-Leader</p>
                                        <p>Leighton Kramer > Staff</p>
                                        <p> Kylan Gentry > Staff</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-5 col-sm-3 col-12">
                        <div class="card" style="border: none;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6 bold-team">
                                        Team A
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn btn-outline-dark"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> </button>
                                        <button type="button" class="btn btn-outline-danger"><i class="fa fa-trash" aria-hidden="true"></i> </button>
                                    </div>
                                </div>
                                <div class="col-9 mt-10 department-tokyo">
                                    Tokyo Consulting Firm Limited
                                </div>
                                <div class="col-12 bangladresh-hrvc2">
                                    Branch: <img src="<?= Yii::$app->homeUrl ?>image/Round-Bangladesh.png" class="bangladresh-hrvc1"> Dhaka, Bangladesh
                                </div>
                                <div class="row mt-20">
                                    <div class="col-3">
                                        <i class="fa fa-users share-big mt-40" aria-hidden="true"></i>
                                    </div>
                                    <div class="col-2 show-height"></div>
                                    <div class="col-7 team-sizesmall">
                                        <p> Saige Fuentes > LEADER</p>
                                        <p> Bowen Higgins > Sub-Leader</p>
                                        <p>Leighton Kramer > Staff</p>
                                        <p> Kylan Gentry > Staff</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-5 col-sm-3 col-12">
                        <div class="card" style="border: none;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6 bold-team">
                                        Team A
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn btn-outline-dark"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> </button>
                                        <button type="button" class="btn btn-outline-danger"><i class="fa fa-trash" aria-hidden="true"></i> </button>
                                    </div>
                                </div>
                                <div class="col-9 mt-10 department-tokyo">
                                    Tokyo Consulting Firm Limited
                                </div>
                                <div class="col-12 bangladresh-hrvc2">
                                    Branch: <img src="<?= Yii::$app->homeUrl ?>image/Round-Bangladesh.png" class="bangladresh-hrvc1"> Dhaka, Bangladesh
                                </div>
                                <div class="row mt-20">
                                    <div class="col-3">
                                        <i class="fa fa-users share-big mt-40" aria-hidden="true"></i>
                                    </div>
                                    <div class="col-2 show-height"></div>
                                    <div class="col-7 team-sizesmall">
                                        <p> Saige Fuentes > LEADER</p>
                                        <p> Bowen Higgins > Sub-Leader</p>
                                        <p>Leighton Kramer > Staff</p>
                                        <p> Kylan Gentry > Staff</p>
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