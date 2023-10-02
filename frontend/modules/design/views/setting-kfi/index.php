<?php
$this->title = 'Setting KFI';
?>
<div class="col-12 mt-90">
    <div class="col-12">
        <i class="fa fa-tachometer font-size-20" aria-hidden="true"></i> <strong class="font-size-20"> Assign Management</strong>
    </div>
    <div class="col-12 mt-20">
        <div class="alert alert2-secondary2">
            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link text-dark" id="pills-Financial-tab" data-bs-toggle="pill" data-bs-target="#pills-Financial" type="button" role="tab" aria-controls="pills-Financial" aria-selected="true"><i class="fa fa-line-chart" aria-hidden="true"></i> Key Financial Indicator</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link text-dark" id="pills-Group-tab" data-bs-toggle="pill" data-bs-target="#pills-Group" type="button" role="tab" aria-controls="pills-Group" aria-selected="false"><i class="fa fa-flag-o" aria-hidden="true"></i> Key Group Indicator</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link text-dark" id="pills-Performance-tab" data-bs-toggle="pill" data-bs-target="#pills-Performance" type="button" role="tab" aria-controls="pills-Performance" aria-selected="false"><i class="fa fa-clock-o" aria-hidden="true"></i> Key Performance Indicator</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link text-dark" id="pills-Action-tab" data-bs-toggle="pill" data-bs-target="#pills-Action" type="button" role="tab" aria-controls="pills-Action" aria-selected="false"><i class="fa fa-list-ul" aria-hidden="true"></i> Key Action Indicator</a>
                </li>
            </ul>
        </div>
        <div class="alert alert-white-5">
            <div class="row">
                <div class="col-lg-9 col-md-6 col-12">
                    <div class="col-12">
                        Key Financial Indicator
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="col-12">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-filter" aria-hidden="true"></i></span>
                            <select class="form-select font-size-13" aria-label="Default select example">
                                <option selected value="">Month</option>
                                <option value="1">January</option>
                                <option value="2">February</option>
                                <option value="3">March</option>
                                <option value="4">April</option>
                                <option value="5">May</option>
                                <option value="6">June</option>
                                <option value="7">July </option>
                                <option value="8">August</option>
                                <option value="9">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                            <select class="form-select font-size-13" aria-label="Default select example">
                                <option selected value="">Status</option>
                                <option value="1">one</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="alert alert-light mt-20" role="alert">
                <table class="table table-striped">
                    <thead class="table table-secondary">
                        <tr class="secondary-setting">
                            <th>KFI Contents</th>
                            <th>Company</th>
                            <th>Branch</th>
                            <th>Assign Employee</th>
                            <th>Target</th>
                            <th>Month</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="setting-fontsize">
                            <td>Increase sales in a way that company gains</td>
                            <td>
                                <div class="row">
                                    <div class="col-5">
                                        <span class="badge rounded-pill bg-setting">
                                            <img class="Image-Description" src="<?= Yii::$app->homeUrl ?>image/logo-tcg.png">
                                            <img class="Image-Description" src="<?= Yii::$app->homeUrl ?>image/1.png">
                                            <button id="hs-dropdown-avatar-more" class="number-rounded">
                                                <span class="font-medium leading-none">5</span>
                                            </button>
                                        </span>
                                    </div>
                                    <div class="col-5">
                                        <div class="setting-upload">
                                            <i class="fa fa-building-o building1" aria-hidden="true"></i>
                                        </div>
                                        <i class="fa fa-plus-circle circle5" data-bs-target="#exampleModalToggle" data-bs-toggle="modal"></i>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col-5">
                                        <span class="badge rounded-pill bg-setting">
                                            <img class="Image-Description" src="<?= Yii::$app->homeUrl ?>image/Flag-Turkey.png">
                                            <img class="Image-Description" src="<?= Yii::$app->homeUrl ?>image/Flag-Brazil.png">
                                            <button id="hs-dropdown-avatar-more" class="number-rounded">
                                                <span class="font-medium leading-none">5</span>
                                            </button>
                                        </span>
                                    </div>
                                    <div class="col-3">
                                        <div class="dashedshare" data-bs-toggle="modal" data-bs-target="#modallink">
                                            <i class="fa fa-share-alt share-alt-setting" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col-5">
                                        <span class="badge rounded-pill bg-setting">
                                            <img class="Image-Description" src="<?= Yii::$app->homeUrl ?>image/employee1.png">
                                            <img class="Image-Description" src="<?= Yii::$app->homeUrl ?>image/employee2.png">
                                            <button id="hs-dropdown-avatar-more" class="number-rounded">
                                                <span class="font-medium leading-none">5</span>
                                            </button>
                                        </span>
                                    </div>
                                    <div class="col-3">
                                        <div class="setting-upload">
                                            <i class="fa fa-user user0m" aria-hidden="true"></i>
                                        </div>
                                        <i class="fa fa-plus-circle circle5" data-bs-target="#exampleModalemployeeSearch" data-bs-toggle="modal"></i>
                                    </div>
                                </div>
                            </td>
                            <td><?= number_format(1000000) ?></td>
                            <td>January</td>
                            <td class="text-primary">Active</td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr class="setting-fontsize">
                            <td>Increase sales in a way that company gains</td>
                            <td>
                                <div class="row">
                                    <div class="col-5">
                                        <span class="badge rounded-pill bg-setting">
                                            <button id="hs-dropdown-avatar-more" class="number-rounded">
                                                <span class="font-medium leading-none">0</span>
                                            </button>
                                        </span>
                                    </div>
                                    <div class="col-3">

                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col-5">
                                        <span class="badge rounded-pill bg-setting">
                                            <button id="hs-dropdown-avatar-more" class="number-rounded">
                                                <span class="font-medium leading-none">0</span>
                                            </button>
                                        </span>
                                    </div>
                                    <div class="col-3">
                                        <div class="dashedshare">
                                            <i class="fa fa-share-alt share-alt-setting" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col-5">
                                        <span class="badge rounded-pill bg-setting">
                                            <button id="hs-dropdown-avatar-more" class="number-rounded">
                                                <span class="font-medium leading-none">0</span>
                                            </button>
                                        </span>
                                    </div>
                                    <div class="col-3">

                                    </div>
                                </div>
                            </td>
                            <td><?= number_format(52) ?></td>
                            <td>January</td>
                            <td class="text-danger">In Active</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-sm dialog-allshow">
        <div class="modal-content">
            <div class="mcontainer">
                <div id="exampleModalToggleLabel">
                    <div class="row">
                        <div class="col-lg-1 col-12 pl-50">
                            <div class="col-12 ">
                                <div class="Resolve-c"><i class="fa fa-building ml-8 font-size-11" aria-hidden="true"></i></div>
                                <span class="company-c"> </span>
                            </div>
                        </div>
                        <div class="col-lg-4 col-12 mt-20 pl-30">Company</div>
                        <div class="col-lg-1 col-12">
                            <div class="col-12">
                                <div class="Resolve-c"><i class="fa fa-share-alt ml-8 font-size-11" aria-hidden="true"></i></i></div>
                                <span class="company-c"> </span>
                            </div>
                        </div>
                        <div class="col-lg-4 col-12 mt-20 pl-30">Branch</div>
                    </div>
                    <hr>
                </div>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-4 text-end">
                        <div class="col-12">
                            <img src="<?= Yii::$app->homeUrl ?>image/logo-tcg.png" class="company-image2">
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="col-12">
                            <div class="font-size-16"> TCF</div>
                        </div>
                        <div class="col-12">
                            <img src="<?= Yii::$app->homeUrl ?>image/Flag-Turkey.png" class="image-izmir">
                            <span class="font-size-14">Izmir, Turkey</span>
                        </div>
                    </div>
                    <div class="mt-20"></div>
                    <div class="col-lg-4 text-end">
                        <div class="col-12">
                            <img src="<?= Yii::$app->homeUrl ?>image/Flag-Brazil.png" class="company-image2">
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="col-12">
                            <div class="font-size-16"> TCFBD</div>
                        </div>
                        <div class="col-12">
                            <img src="<?= Yii::$app->homeUrl ?>image/Flag-Turkey.png" class="image-izmir">
                            <span class="font-size-14">Izmir, Turkey</span>
                        </div>
                    </div>
                    <div class="mt-20"></div>
                    <div class="col-lg-4 text-end">
                        <div class="col-12">
                            <img src="<?= Yii::$app->homeUrl ?>image/logo-hrvc.png" class="company-image2">
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="col-12">
                            <div class="font-size-16"> TCH</div>
                        </div>
                        <div class="col-12">
                            <img src="<?= Yii::$app->homeUrl ?>image/Flag-Turkey.png" class="image-izmir">
                            <span class="font-size-14">Izmir, Turkey</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modallink" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modallink" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered dialog-allshow1">
        <div class="modal-content header-company">
            <div class="container">
                <div id="modallink">
                    <div class="row">
                        <div class="col-lg-1 col-12 pl-50">
                            <div class="col-12 ">
                                <div class="Resolve-c"><i class="fa fa-building ml-8 font-size-11" aria-hidden="true"></i></div>
                                <span class="company-c"> </span>
                            </div>
                        </div>
                        <div class="col-lg-4 col-12 mt-20 pl-30">Company</div>
                        <div class="col-lg-1 col-12">
                            <div class="col-12">
                                <div class="Resolve-c"><i class="fa fa-share-alt ml-8 font-size-11" aria-hidden="true"></i></i></div>
                                <span class="company-c"> </span>
                            </div>
                        </div>
                        <div class="col-lg-4 col-12 mt-20">Branch</div>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="card card-company">
                    <div class="row">
                        <div class="col-lg-5 col-12">
                            <div class="col-12">
                                <div class="form-check mt-10">
                                    <input class="form-check-input" type="checkbox" value="" id="flex1">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        &nbsp;&nbsp; <img src="<?= Yii::$app->homeUrl ?>image/logo-hrvc.png" class="company-image3">
                                        <span class="font-size-10">HRVC</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-check mt-15">
                                    <input class="form-check-input" type="checkbox" value="" id="flex2">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        &nbsp;&nbsp; <img src="<?= Yii::$app->homeUrl ?>image/logo-tcg.png" class="company-image3">
                                        <span class="font-size-10">TCG</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-check mt-15">
                                    <input class="form-check-input" type="checkbox" value="" id="flex3">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        &nbsp;&nbsp; <img src="<?= Yii::$app->homeUrl ?>image/Roof.png" class="company-image3">
                                        <span class="font-size-10">TCF</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="col-12 mt-5">
                                <select class="form-select font-size-13" aria-label="Default select example">
                                    <option selected value="">Select Branch</option>
                                    <option value="">All</option>
                                    <option value="">Two</option>
                                    <option value="">Three</option>
                                </select>
                            </div>
                            <div class="col-12 mt-15">
                                <select class="form-select font-size-13" aria-label="Default select example">
                                    <option selected value="">Select Branch</option>
                                    <option value="">One</option>
                                    <option value="">Two</option>
                                    <option value="">Three</option>
                                </select>
                            </div>
                            <div class="col-12 mt-15">
                                <select class="form-select font-size-13" aria-label="Default select example">
                                    <option selected value="">Select Branch</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="Resolve" data-bs-dismiss="modal">Resolve</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModalemployeeSearch" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalemployeeSearch" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered dialog-allshow2">
        <div class="modal-content">
            <div class="container">
                <div id="exampleModalemployeeSearch">
                    <div class="row">
                        <div class="col-lg-1 col-12 pl-30">
                            <div class="col-12 ">
                                <div class="Resolve-c"><i class="fa fa-user ml-8 font-size-11" aria-hidden="true"></i></div>
                                <span class="company-c"> </span>
                            </div>
                        </div>
                        <div class="col-lg-4 col-12 mt-20 pl-30 Employees-0"> Employees</div>
                        <div class="col-lg-6 col-12 mt-20">
                            <div class="col-12">
                                <form class="d-flex">
                                    <input class="form-control me-2 shadow bg-body rounded pl-40" type="search" placeholder="Search" aria-label="Search">
                                    <span type="submit" class="submit-search"> <i class="fa fa-search" aria-hidden="true"></i></i></span>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="card card-company">
                    <div class="row">
                        <div class="col-lg-5 col-12">
                            <div class="col-12">
                                <div class="form-check mt-10">
                                    <input class="form-check-input" type="checkbox" value="" id="">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        &nbsp;&nbsp; <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="company-image3">
                                        <span class="font-size-11">Ehsan </span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-check mt-15">
                                    <input class="form-check-input" type="checkbox" value="" id="">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        &nbsp;&nbsp; <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="company-image3">
                                        <span class="font-size-11">Amir Vai</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-check mt-15">
                                    <input class="form-check-input" type="checkbox" value="" id="">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        &nbsp;&nbsp; <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="company-image3">
                                        <span class="font-size-11">Ehsan Vai</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="Resolve" data-bs-dismiss="modal">Resolve</div>
                    </div>
                </div>
            </div>
        </div>
    </div>