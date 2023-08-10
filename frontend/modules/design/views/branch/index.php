<?php

$this->title = 'Branch';
?>

<div class="col-12" style="margin-top: 90px;">
    <div class="row">
        <div class="col-lg-2 col-md-6 col-12">
            <div class="col-12 branch-title">
                Branch
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-12 mt-10">
            <button type="button" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Create</button>
        </div>
        <div class="col-4 text-end">
            <button type="button" class="btn btn-outline-primary"> <i class="fa fa-filter" aria-hidden="true"></i></button>
        </div>
        <div class="col-3">
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
                <div class="col-lg-2 col-md-6 col-12">
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label"> Branch Name</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="col-12">
                        <label for="exampleFormControlInput1" class="form-label"> Select Associate Company </label>
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
                        <label for="exampleFormControlInput1" class="form-label"> Country</label>
                        <select class="form-select" aria-label="Default select example">
                            <option selected>select Country</option>
                            <option value="1">Bangladresh</option>
                            <option value="2">China</option>
                            <option value="3">Columbia</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-12">
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label"> Concerned Industry</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
                        </div>
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
                    <div class="col-lg-4 col-md-5 col-sm-3 col-4">
                        <div class="card" style="border: none;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-2">
                                        <img src="<?= Yii::$app->homeUrl ?>image/TCF-BD.png" class="card-tcf">
                                    </div>
                                    <div class="col-10">
                                        <div class="col-12">
                                            Tokyo Consulting Firm Philippine
                                        </div>
                                        <div class="col-12">
                                            <img src="<?= Yii::$app->homeUrl ?>image/Round-Bangladesh.png" class="card-round"> Dhaka, Bangladesh
                                        </div>
                                        <div class="row">
                                            <div class="col-1">
                                                <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                                            </div>
                                            <div class="col-5" style="font-size: 13px;">
                                                IT Services and IT Consulting
                                            </div>
                                            <div class="col-5" style="padding-top:5px;">
                                                <button class="btn btn-outline-secondary" type="button" style="font-size: 13px;"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                                <button class="btn btn-outline-danger" type="button" style="font-size: 13px;"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-5 col-sm-3 col-4">
                        <div class="card" style="border: none;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-2">
                                        <img src="<?= Yii::$app->homeUrl ?>image/TCF-BD.png" class="card-tcf">
                                    </div>
                                    <div class="col-10">
                                        <div class="col-12">
                                            Tokyo Consulting Firm Philippine
                                        </div>
                                        <div class="col-12">
                                            <img src="<?= Yii::$app->homeUrl ?>image/Round-Bangladesh.png" class="card-round"> Dhaka, Bangladesh
                                        </div>
                                        <div class="row">
                                            <div class="col-1">
                                                <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                                            </div>
                                            <div class="col-5" style="font-size: 13px;">
                                                IT Services and IT Consulting
                                            </div>
                                            <div class="col-5" style="padding-top:5px;">
                                                <button class="btn btn-outline-secondary" type="button" style="font-size: 13px;"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                                <button class="btn btn-outline-danger" type="button" style="font-size: 13px;"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-5 col-sm-3 col-4">
                        <div class="card" style="border: none;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-2">
                                        <img src="<?= Yii::$app->homeUrl ?>image/TCF-BD.png" class="card-tcf">
                                    </div>
                                    <div class="col-10">
                                        <div class="col-12">
                                            Tokyo Consulting Firm Philippine
                                        </div>
                                        <div class="col-12">
                                            <img src="<?= Yii::$app->homeUrl ?>image/Round-Bangladesh.png" class="card-round"> Dhaka, Bangladesh
                                        </div>
                                        <div class="row">
                                            <div class="col-1">
                                                <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                                            </div>
                                            <div class="col-5" style="font-size: 13px;">
                                                IT Services and IT Consulting
                                            </div>
                                            <div class="col-5" style="padding-top:5px;">
                                                <button class="btn btn-outline-secondary" type="button" style="font-size: 13px;"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                                <button class="btn btn-outline-danger" type="button" style="font-size: 13px;"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-5 col-sm-3 col-4">
                        <div class="card" style="border: none;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-2">
                                        <img src="<?= Yii::$app->homeUrl ?>image/TCF-BD.png" class="card-tcf">
                                    </div>
                                    <div class="col-10">
                                        <div class="col-12">
                                            Tokyo Consulting Firm Philippine
                                        </div>
                                        <div class="col-12">
                                            <img src="<?= Yii::$app->homeUrl ?>image/Round-Bangladesh.png" class="card-round"> Dhaka, Bangladesh
                                        </div>
                                        <div class="row">
                                            <div class="col-1">
                                                <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                                            </div>
                                            <div class="col-5" style="font-size: 13px;">
                                                Finance
                                            </div>
                                            <div class="col-5" style="padding-top:5px;">
                                                <button class="btn btn-outline-secondary" type="button" style="font-size: 13px;"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                                <button class="btn btn-outline-danger" type="button" style="font-size: 13px;"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-5 col-sm-3 col-4">
                        <div class="card" style="border: none;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-2">
                                        <img src="<?= Yii::$app->homeUrl ?>image/TCF-BD.png" class="card-tcf">
                                    </div>
                                    <div class="col-10">
                                        <div class="col-12">
                                            Tokyo Consulting Firm Philippine
                                        </div>
                                        <div class="col-12">
                                            <img src="<?= Yii::$app->homeUrl ?>image/Round-Bangladesh.png" class="card-round"> Dhaka, Bangladesh
                                        </div>
                                        <div class="row">
                                            <div class="col-1">
                                                <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                                            </div>
                                            <div class="col-5" style="font-size: 13px;">
                                                Finance
                                            </div>
                                            <div class="col-5" style="padding-top:5px;">
                                                <button class="btn btn-outline-secondary" type="button" style="font-size: 13px;"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                                <button class="btn btn-outline-danger" type="button" style="font-size: 13px;"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-5 col-sm-3 col-4">
                        <div class="card" style="border: none;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-2">
                                        <img src="<?= Yii::$app->homeUrl ?>image/TCF-BD.png" class="card-tcf">
                                    </div>
                                    <div class="col-10">
                                        <div class="col-12">
                                            Tokyo Consulting Firm Philippine
                                        </div>
                                        <div class="col-12">
                                            <img src="<?= Yii::$app->homeUrl ?>image/Round-Bangladesh.png" class="card-round"> Dhaka, Bangladesh
                                        </div>
                                        <div class="row">
                                            <div class="col-1">
                                                <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                                            </div>
                                            <div class="col-5" style="font-size: 13px;">
                                                Finance
                                            </div>
                                            <div class="col-5" style="padding-top:5px;">
                                                <button class="btn btn-outline-secondary" type="button" style="font-size: 13px;"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                                <button class="btn btn-outline-danger" type="button" style="font-size: 13px;"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-5 col-sm-3 col-4">
                        <div class="card" style="border: none;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-2">
                                        <img src="<?= Yii::$app->homeUrl ?>image/TCF-BD.png" class="card-tcf">
                                    </div>
                                    <div class="col-10">
                                        <div class="col-12">
                                            Tokyo Consulting Firm Philippine
                                        </div>
                                        <div class="col-12">
                                            <img src="<?= Yii::$app->homeUrl ?>image/Round-Bangladesh.png" class="card-round"> Dhaka, Bangladesh
                                        </div>
                                        <div class="row">
                                            <div class="col-1">
                                                <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                                            </div>
                                            <div class="col-5" style="font-size: 13px;">
                                                IT Services and IT Consulting
                                            </div>
                                            <div class="col-5" style="padding-top:5px;">
                                                <button class="btn btn-outline-secondary" type="button" style="font-size: 13px;"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                                <button class="btn btn-outline-danger" type="button" style="font-size: 13px;"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-5 col-sm-3 col-4">
                        <div class="card" style="border: none;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-2">
                                        <img src="<?= Yii::$app->homeUrl ?>image/TCF-BD.png" class="card-tcf">
                                    </div>
                                    <div class="col-10">
                                        <div class="col-12">
                                            Tokyo Consulting Firm Philippine
                                        </div>
                                        <div class="col-12">
                                            <img src="<?= Yii::$app->homeUrl ?>image/Round-Bangladesh.png" class="card-round"> Dhaka, Bangladesh
                                        </div>
                                        <div class="row">
                                            <div class="col-1">
                                                <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                                            </div>
                                            <div class="col-5" style="font-size: 13px;">
                                                IT Services and IT Consulting
                                            </div>
                                            <div class="col-5" style="padding-top:5px;">
                                                <button class="btn btn-outline-secondary" type="button" style="font-size: 13px;"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                                <button class="btn btn-outline-danger" type="button" style="font-size: 13px;"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-5 col-sm-3 col-4">
                        <div class="card" style="border: none;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-2">
                                        <img src="<?= Yii::$app->homeUrl ?>image/TCF-BD.png" class="card-tcf">
                                    </div>
                                    <div class="col-10">
                                        <div class="col-12">
                                            Tokyo Consulting Firm Philippine
                                        </div>
                                        <div class="col-12">
                                            <img src="<?= Yii::$app->homeUrl ?>image/Round-Bangladesh.png" class="card-round"> Dhaka, Bangladesh
                                        </div>
                                        <div class="row">
                                            <div class="col-1">
                                                <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                                            </div>
                                            <div class="col-5" style="font-size: 13px;">
                                                IT Services and IT Consulting
                                            </div>
                                            <div class="col-5" style="padding-top:5px;">
                                                <button class="btn btn-outline-secondary" type="button" style="font-size: 13px;"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                                <button class="btn btn-outline-danger" type="button" style="font-size: 13px;"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-5 col-sm-3 col-4">
                        <div class="card" style="border: none;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-2">
                                        <img src="<?= Yii::$app->homeUrl ?>image/TCF-BD.png" class="card-tcf">
                                    </div>
                                    <div class="col-10">
                                        <div class="col-12">
                                            Tokyo Consulting Firm Philippine
                                        </div>
                                        <div class="col-12">
                                            <img src="<?= Yii::$app->homeUrl ?>image/Round-Bangladesh.png" class="card-round"> Dhaka, Bangladesh
                                        </div>
                                        <div class="row">
                                            <div class="col-1">
                                                <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                                            </div>
                                            <div class="col-5" style="font-size: 13px;">
                                                IT Services and IT Consulting
                                            </div>
                                            <div class="col-5" style="padding-top:5px;">
                                                <button class="btn btn-outline-secondary" type="button" style="font-size: 13px;"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                                <button class="btn btn-outline-danger" type="button" style="font-size: 13px;"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-5 col-sm-3 col-4">
                        <div class="card" style="border: none;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-2">
                                        <img src="<?= Yii::$app->homeUrl ?>image/TCF-BD.png" class="card-tcf">
                                    </div>
                                    <div class="col-10">
                                        <div class="col-12">
                                            Tokyo Consulting Firm Philippine
                                        </div>
                                        <div class="col-12">
                                            <img src="<?= Yii::$app->homeUrl ?>image/Round-Bangladesh.png" class="card-round"> Dhaka, Bangladesh
                                        </div>
                                        <div class="row">
                                            <div class="col-1">
                                                <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                                            </div>
                                            <div class="col-5" style="font-size: 13px;">
                                                IT Services and IT Consulting
                                            </div>
                                            <div class="col-5" style="padding-top:5px;">
                                                <button class="btn btn-outline-secondary" type="button" style="font-size: 13px;"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                                <button class="btn btn-outline-danger" type="button" style="font-size: 13px;"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-5 col-sm-3 col-4">
                        <div class="card" style="border: none;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-2">
                                        <img src="<?= Yii::$app->homeUrl ?>image/TCF-BD.png" class="card-tcf">
                                    </div>
                                    <div class="col-10">
                                        <div class="col-12">
                                            Tokyo Consulting Firm Philippine
                                        </div>
                                        <div class="col-12">
                                            <img src="<?= Yii::$app->homeUrl ?>image/Round-Bangladesh.png" class="card-round"> Dhaka, Bangladesh
                                        </div>
                                        <div class="row">
                                            <div class="col-1">
                                                <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                                            </div>
                                            <div class="col-5" style="font-size: 13px;">
                                                IT Services and IT Consulting
                                            </div>
                                            <div class="col-5" style="padding-top:5px;">
                                                <button class="btn btn-outline-secondary" type="button" style="font-size: 13px;"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                                <button class="btn btn-outline-danger" type="button" style="font-size: 13px;"><i class="fa fa-trash" aria-hidden="true"></i></button>
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
    </div>
</div>