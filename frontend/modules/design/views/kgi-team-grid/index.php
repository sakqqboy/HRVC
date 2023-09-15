<?php
$this->title = 'Team Grid';
?>

<div class="col-12 mt-90">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-8">
            <i class="fa fa-tachometer font-size-20" aria-hidden="true"></i> <strong class="font-size-20"> Performance Indicator Matrices (PIM)</strong>
        </div>
        <div class="col-lg-4 col-md-4 col-4 view-goback text-end">
            <i class="fa fa-caret-left" aria-hidden="true"></i> Go Back
        </div>
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
                <li class="nav-item presentation-end" role="presentation">
                    <a class="nav-link text-dark" id="pills-Setting-tab" data-bs-toggle="pill" data-bs-target="#pills-Setting" type="button" role="tab" aria-controls="pills-Action" aria-selected="false"><i class="fa fa-cog" aria-hidden="true"></i> Assign</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="alert alert-white-4">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-12 key1">
                <div class="row">
                    <div class="col-5 key1">
                        Key Goal Indicators
                    </div>
                    <div class="col-6">
                        <span class="badge rounded-pill  bg-secondary-bsc"><i class="fa fa-users" aria-hidden="true"></i> Team A, Accounts & Taxation</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-12 col-12 New-KFI">
                <div class="col-12">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-filter" aria-hidden="true"></i></span>
                        <select class="form-select font-size-13" aria-label="Example select">
                            <option selected>Company</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                        <select class="form-select font-size-13" aria-label="Example select">
                            <option selected>Branch</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                        <select class="form-select font-size-13" aria-label="Example select">
                            <option selected>Month</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                        <select class="form-select font-size-13" aria-label="Example select">
                            <option selected>Type</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                        <select class="form-select font-size-13" aria-label="Example select">
                            <option selected>Status</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12 New-date">
                <div class="row">
                    <div class="col-8">
                        <div class="input-group">
                            <label class="input-group-text font-size-13" for="">Date</label>
                            <input type="date" class="form-control font-size-13" name="birthday" id="">
                        </div>
                    </div>
                    <div class="col-4 new-light-4">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-outline-primary font-size-13"><i class="fa fa-list-ul" aria-hidden="true"></i></button>
                            <button type="button" class="btn btn-outline-primary font-size-13"><i class="fa fa-th-large" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-Group" role="tabpanel" aria-labelledby="pills-Group-tab">
                    <div class="card example-6 scrollbar-ripe-malinka">
                        <div class="row">
                            <div class="col-lg-6 col-6 col-6 card card-radius">
                                <div class="row">
                                    <div class="col-md-5 team-grid-clients">
                                        <div class="col-12">
                                            <i class="fa fa-flag-o" aria-hidden="true"></i> The Number Of Clients Per Employee
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="col-12">
                                            <span class="badge rounded-pill bg-warning text-dark">Completed</span>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="col-12 team-tokyo">
                                            Tokyo Consulting Firm Limited
                                        </div>
                                        <div class="font-size-12 text-end">
                                            <img src="<?= Yii::$app->homeUrl ?>image/is.jpg" class="image-flex"> Dhaka, Bangladesh
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-10">
                                        <div class="col-12">
                                            <span class="border border-1 boderradius-dead"> <span class="borderdeadline">Deadline</span> : Mon, Feb 28, 2024</span>
                                        </div>
                                        <div class="col-12 top-teamcontent">
                                            Team Content
                                        </div>
                                        <div class="col-12 font-size-12 pt-10">
                                            This is a sample KGI content
                                        </div>
                                        <div class="col-12 font-size-12 mt-20">
                                            Priority
                                        </div>
                                        <div class="col-12">
                                            <div class="circle-update">A</div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-20 solid2-kgi">
                                        <div class="col-12 font-size-12 text-secondary">
                                            Quant Ratio
                                        </div>
                                        <div class="col-12 Quality-diamond">
                                            <i class="fa fa-diamond" aria-hidden="true"></i> Quality
                                        </div>
                                        <div class="col-12 pt-20 pl-80 font-size-11">
                                            <strong>FEBRUARY</strong>
                                        </div>
                                        <div class="col-12 font-size-10 pt-20" style="width: 10rem;">
                                            Update Interval
                                        </div>
                                        <div class="col-12 Quality-monthly0">
                                            Monthly
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-20 solid3">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="col-12 target-progress1">
                                                    <i class="fa fa-bullseye" aria-hidden="true"></i> Target
                                                </div>
                                                <div class="col-12 result-million">
                                                    453,0000
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="col-12 target-plush1">
                                                    >
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="col-12 target-progress1">
                                                    Result <i class="fa fa-trophy" aria-hidden="true"></i>
                                                </div>
                                                <div class="col-12 result-million">
                                                    904,0000
                                                </div>
                                            </div>
                                            <div class="col-12 mt-20">
                                                <div class="progress">
                                                    <div class="progress-bar" style="width:25%;"></div>
                                                    <span class="badge rounded-pill  pro-load2">25%</span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="col-12 refresh1">
                                                        <i class="fa fa-refresh" aria-hidden="true"></i> Latest Update
                                                    </div>
                                                    <div class="col-12 font-size-10 pt-5" style="font-weight: 700;">
                                                        Tue, Mar 12, 2023
                                                    </div>
                                                </div>
                                                <div class="col-md-6  text-end">
                                                    <div class="col-12 pencil-nextupdate1">
                                                        Next Update <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                    </div>
                                                    <div class="col-12 font-size-10 pt-5" style="font-weight: 700;">
                                                        Tue, Mar 12, 2023
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row  mt-20">
                                    <div class="col-9 text-end">
                                        <span class="badge rounded-pill bg-white">
                                            <div class="flex mb-5 -space-x-4">
                                                <img class="w-10 h-10 border-2 border-white rounded-full dark:border-gray-800" src="<?= Yii::$app->homeUrl ?>image/avatar1.png" class="image-avatar1">
                                                <img class="w-10 h-10 border-2 border-white rounded-full dark:border-gray-800" src="<?= Yii::$app->homeUrl ?>image/avatar2.png" class="image-avatar1">
                                                <img class="w-10 h-10 border-2 border-white rounded-full dark:border-gray-800" src="<?= Yii::$app->homeUrl ?>image/avatar3.png" class="image-avatar1">
                                                <a class="flex items-center justify-center w-10 h-10 text-xs font-medium text-dark bg-gray-700 border-2 border-white rounded-full hover:bg-gray-600 dark:border-gray-800" href="#">9</a>
                                            </div>
                                        </span>
                                    </div>
                                    <div class="col-3 text-end">
                                        <button class="btn btn-outline-secondary font-size-10"><i class="fa fa-eye" aria-hidden="true"></i></button>
                                        <button class="btn btn-outline-danger font-size-10"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-6 col-6 card card-radius">
                                <div class="row">
                                    <div class="col-md-5 team-grid-clients">
                                        <div class="col-12">
                                            <i class="fa fa-flag-o" aria-hidden="true"></i> The Number Of Clients Per Employee
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="col-12">
                                            <span class="badge rounded-pill bg-warning text-dark">Completed</span>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="col-12 team-tokyo">
                                            Tokyo Consulting Firm Limited
                                        </div>
                                        <div class="font-size-12 text-end">
                                            <img src="<?= Yii::$app->homeUrl ?>image/is.jpg" class="image-flex"> Dhaka, Bangladesh
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-10">
                                        <div class="col-12">
                                            <span class="border border-1 boderradius-dead"> <span class="borderdeadline">Deadline</span> : Mon, Feb 28, 2024</span>
                                        </div>
                                        <div class="col-12 top-teamcontent">
                                            Team Content
                                        </div>
                                        <div class="col-12 font-size-12 pt-10">
                                            This is a sample KGI content
                                        </div>
                                        <div class="col-12 font-size-12 mt-20">
                                            Priority
                                        </div>
                                        <div class="col-12">
                                            <div class="circle-update">A</div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-20 solid2-kgi">
                                        <div class="col-12 font-size-12 text-secondary">
                                            Quant Ratio
                                        </div>
                                        <div class="col-12 Quality-diamond">
                                            <i class="fa fa-diamond" aria-hidden="true"></i> Quality
                                        </div>
                                        <div class="col-12 pt-20 pl-80 font-size-11">
                                            <strong>FEBRUARY</strong>
                                        </div>
                                        <div class="col-12 font-size-10 pt-20" style="width: 10rem;">
                                            Update Interval
                                        </div>
                                        <div class="col-12 Quality-monthly0">
                                            Monthly
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-20 solid3">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="col-12 target-progress1">
                                                    <i class="fa fa-bullseye" aria-hidden="true"></i> Target
                                                </div>
                                                <div class="col-12 result-million">
                                                    453,0000
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="col-12 target-plush1">
                                                    >
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="col-12 target-progress1">
                                                    Result <i class="fa fa-trophy" aria-hidden="true"></i>
                                                </div>
                                                <div class="col-12 result-million">
                                                    904,0000
                                                </div>
                                            </div>
                                            <div class="col-12 mt-20">
                                                <div class="progress">
                                                    <div class="progress-bar" style="width:25%;"></div>
                                                    <span class="badge rounded-pill  pro-load2">25%</span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="col-12 refresh1">
                                                        <i class="fa fa-refresh" aria-hidden="true"></i> Latest Update
                                                    </div>
                                                    <div class="col-12 font-size-10 pt-5" style="font-weight: 700;">
                                                        Tue, Mar 12, 2023
                                                    </div>
                                                </div>
                                                <div class="col-md-6  text-end">
                                                    <div class="col-12 pencil-nextupdate1">
                                                        Next Update <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                    </div>
                                                    <div class="col-12 font-size-10 pt-5" style="font-weight: 700;">
                                                        Tue, Mar 12, 2023
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row  mt-20">
                                    <div class="col-9 text-end">
                                        <span class="badge rounded-pill bg-white">
                                            <div class="flex mb-5 -space-x-4">
                                                <img class="w-10 h-10 border-2 border-white rounded-full dark:border-gray-800" src="<?= Yii::$app->homeUrl ?>image/avatar1.png" class="image-avatar1">
                                                <img class="w-10 h-10 border-2 border-white rounded-full dark:border-gray-800" src="<?= Yii::$app->homeUrl ?>image/avatar2.png" class="image-avatar1">
                                                <img class="w-10 h-10 border-2 border-white rounded-full dark:border-gray-800" src="<?= Yii::$app->homeUrl ?>image/avatar3.png" class="image-avatar1">
                                                <a class="flex items-center justify-center w-10 h-10 text-xs font-medium text-dark bg-gray-700 border-2 border-white rounded-full hover:bg-gray-600 dark:border-gray-800" href="#">9</a>
                                            </div>
                                        </span>
                                    </div>
                                    <div class="col-3 text-end">
                                        <button class="btn btn-outline-secondary font-size-10"><i class="fa fa-eye" aria-hidden="true"></i></button>
                                        <button class="btn btn-outline-danger font-size-10"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-6 col-6 card card-radius">
                                <div class="row">
                                    <div class="col-md-5 team-grid-clients">
                                        <div class="col-12">
                                            <i class="fa fa-flag-o" aria-hidden="true"></i> The Number Of Clients Per Employee
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="col-12">
                                            <span class="badge rounded-pill bg-warning text-dark">Completed</span>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="col-12 team-tokyo">
                                            Tokyo Consulting Firm Limited
                                        </div>
                                        <div class="font-size-12 text-end">
                                            <img src="<?= Yii::$app->homeUrl ?>image/is.jpg" class="image-flex"> Dhaka, Bangladesh
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-10">
                                        <div class="col-12">
                                            <span class="border border-1 boderradius-dead"> <span class="borderdeadline">Deadline</span> : Mon, Feb 28, 2024</span>
                                        </div>
                                        <div class="col-12 top-teamcontent">
                                            Team Content
                                        </div>
                                        <div class="col-12 font-size-12 pt-10">
                                            This is a sample KGI content
                                        </div>
                                        <div class="col-12 font-size-12 mt-20">
                                            Priority
                                        </div>
                                        <div class="col-12">
                                            <div class="circle-update">A</div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-20 solid2-kgi">
                                        <div class="col-12 font-size-12 text-secondary">
                                            Quant Ratio
                                        </div>
                                        <div class="col-12 Quality-diamond">
                                            <i class="fa fa-diamond" aria-hidden="true"></i> Quality
                                        </div>
                                        <div class="col-12 pt-20 pl-80 font-size-11">
                                            <strong>FEBRUARY</strong>
                                        </div>
                                        <div class="col-12 font-size-10 pt-20" style="width: 10rem;">
                                            Update Interval
                                        </div>
                                        <div class="col-12 Quality-monthly0">
                                            Monthly
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-20 solid3">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="col-12 target-progress1">
                                                    <i class="fa fa-bullseye" aria-hidden="true"></i> Target
                                                </div>
                                                <div class="col-12 result-million">
                                                    453,0000
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="col-12 target-plush1">
                                                    >
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="col-12 target-progress1">
                                                    Result <i class="fa fa-trophy" aria-hidden="true"></i>
                                                </div>
                                                <div class="col-12 result-million">
                                                    904,0000
                                                </div>
                                            </div>
                                            <div class="col-12 mt-20">
                                                <div class="progress">
                                                    <div class="progress-bar" style="width:25%;"></div>
                                                    <span class="badge rounded-pill  pro-load2">25%</span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="col-12 refresh1">
                                                        <i class="fa fa-refresh" aria-hidden="true"></i> Latest Update
                                                    </div>
                                                    <div class="col-12 font-size-10 pt-5" style="font-weight: 700;">
                                                        Tue, Mar 12, 2023
                                                    </div>
                                                </div>
                                                <div class="col-md-6  text-end">
                                                    <div class="col-12 pencil-nextupdate1">
                                                        Next Update <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                    </div>
                                                    <div class="col-12 font-size-10 pt-5" style="font-weight: 700;">
                                                        Tue, Mar 12, 2023
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row  mt-20">
                                    <div class="col-9 text-end">
                                        <span class="badge rounded-pill bg-white">
                                            <div class="flex mb-5 -space-x-4">
                                                <img class="w-10 h-10 border-2 border-white rounded-full dark:border-gray-800" src="<?= Yii::$app->homeUrl ?>image/avatar1.png" class="image-avatar1">
                                                <img class="w-10 h-10 border-2 border-white rounded-full dark:border-gray-800" src="<?= Yii::$app->homeUrl ?>image/avatar2.png" class="image-avatar1">
                                                <img class="w-10 h-10 border-2 border-white rounded-full dark:border-gray-800" src="<?= Yii::$app->homeUrl ?>image/avatar3.png" class="image-avatar1">
                                                <a class="flex items-center justify-center w-10 h-10 text-xs font-medium text-dark bg-gray-700 border-2 border-white rounded-full hover:bg-gray-600 dark:border-gray-800" href="#">9</a>
                                            </div>
                                        </span>
                                    </div>
                                    <div class="col-3 text-end">
                                        <button class="btn btn-outline-secondary font-size-10"><i class="fa fa-eye" aria-hidden="true"></i></button>
                                        <button class="btn btn-outline-danger font-size-10"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-6 col-6 card card-radius">
                                <div class="row">
                                    <div class="col-md-5 team-grid-clients">
                                        <div class="col-12">
                                            <i class="fa fa-flag-o" aria-hidden="true"></i> The Number Of Clients Per Employee
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="col-12">
                                            <span class="badge rounded-pill bg-warning text-dark">Completed</span>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="col-12 team-tokyo">
                                            Tokyo Consulting Firm Limited
                                        </div>
                                        <div class="font-size-12 text-end">
                                            <img src="<?= Yii::$app->homeUrl ?>image/is.jpg" class="image-flex"> Dhaka, Bangladesh
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-10">
                                        <div class="col-12">
                                            <span class="border border-1 boderradius-dead"> <span class="borderdeadline">Deadline</span> : Mon, Feb 28, 2024</span>
                                        </div>
                                        <div class="col-12 top-teamcontent">
                                            Team Content
                                        </div>
                                        <div class="col-12 font-size-12 pt-10">
                                            This is a sample KGI content
                                        </div>
                                        <div class="col-12 font-size-12 mt-20">
                                            Priority
                                        </div>
                                        <div class="col-12">
                                            <div class="circle-update">A</div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-20 solid2-kgi">
                                        <div class="col-12 font-size-12 text-secondary">
                                            Quant Ratio
                                        </div>
                                        <div class="col-12 Quality-diamond">
                                            <i class="fa fa-diamond" aria-hidden="true"></i> Quality
                                        </div>
                                        <div class="col-12 pt-20 pl-80 font-size-11">
                                            <strong>FEBRUARY</strong>
                                        </div>
                                        <div class="col-12 font-size-10 pt-20" style="width: 10rem;">
                                            Update Interval
                                        </div>
                                        <div class="col-12 Quality-monthly0">
                                            Monthly
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-20 solid3">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="col-12 target-progress1">
                                                    <i class="fa fa-bullseye" aria-hidden="true"></i> Target
                                                </div>
                                                <div class="col-12 result-million">
                                                    453,0000
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="col-12 target-plush1">
                                                    >
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="col-12 target-progress1">
                                                    Result <i class="fa fa-trophy" aria-hidden="true"></i>
                                                </div>
                                                <div class="col-12 result-million">
                                                    904,0000
                                                </div>
                                            </div>
                                            <div class="col-12 mt-20">
                                                <div class="progress">
                                                    <div class="progress-bar" style="width:25%;"></div>
                                                    <span class="badge rounded-pill  pro-load2">25%</span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="col-12 refresh1">
                                                        <i class="fa fa-refresh" aria-hidden="true"></i> Latest Update
                                                    </div>
                                                    <div class="col-12 font-size-10 pt-5" style="font-weight: 700;">
                                                        Tue, Mar 12, 2023
                                                    </div>
                                                </div>
                                                <div class="col-md-6  text-end">
                                                    <div class="col-12 pencil-nextupdate1">
                                                        Next Update <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                    </div>
                                                    <div class="col-12 font-size-10 pt-5" style="font-weight: 700;">
                                                        Tue, Mar 12, 2023
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row  mt-20">
                                    <div class="col-9 text-end">
                                        <span class="badge rounded-pill bg-white">
                                            <div class="flex mb-5 -space-x-4">
                                                <img class="w-10 h-10 border-2 border-white rounded-full dark:border-gray-800" src="<?= Yii::$app->homeUrl ?>image/avatar1.png" class="image-avatar1">
                                                <img class="w-10 h-10 border-2 border-white rounded-full dark:border-gray-800" src="<?= Yii::$app->homeUrl ?>image/avatar2.png" class="image-avatar1">
                                                <img class="w-10 h-10 border-2 border-white rounded-full dark:border-gray-800" src="<?= Yii::$app->homeUrl ?>image/avatar3.png" class="image-avatar1">
                                                <a class="flex items-center justify-center w-10 h-10 text-xs font-medium text-dark bg-gray-700 border-2 border-white rounded-full hover:bg-gray-600 dark:border-gray-800" href="#">9</a>
                                            </div>
                                        </span>
                                    </div>
                                    <div class="col-3 text-end">
                                        <button class="btn btn-outline-secondary font-size-10"><i class="fa fa-eye" aria-hidden="true"></i></button>
                                        <button class="btn btn-outline-danger font-size-10"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </ul>
    </div>
</div>