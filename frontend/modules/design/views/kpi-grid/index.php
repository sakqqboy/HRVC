<?php
$this->title = 'KPI Grid View';
?>

<div class="col-12 mt-90">
    <div class="col-12">
        <i class="fa fa-tachometer font-size-20" aria-hidden="true"></i> <strong class="font-size-20"> Performance Indicator Matrices (PIM)</strong>
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
        <div class="alert alert-white-4">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12 key1">
                    <div class="row">
                        <div class="col-6 key2">
                            Key Performance Indicator
                        </div>
                        <div class="col-6">
                            <button type="button" class="btn btn-primary font-size-14" data-bs-toggle="modal" data-bs-target="#exampleModal7"><i class="fa fa-magic" aria-hidden="true"></i> Create New KPI</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-12 col-12 New-KFI">
                    <div class="col-12">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-filter" aria-hidden="true"></i></span>
                            <select class="form-select font-size-13" aria-label="Example select">
                                <option selected value="">Company</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                            <select class="form-select font-size-13" aria-label="Example select">
                                <option selected value="">Branch</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                            <select class="form-select font-size-13" aria-label="Example select">
                                <option selected value="">Month</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                            <select class="form-select font-size-13" aria-label="Example select">
                                <option selected value="">Type</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                            <select class="form-select font-size-13" aria-label="Example select">
                                <option selected value="">Status</option>
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
                    <div class="tab-pane fade show active" id="pills-Performance" role="tabpanel" aria-labelledby="pills-Performance-tab">
                        <div class="card example-5 scrollbar-ripe-malinka">
                            <div class="col-12 card card-radius">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-12 clients-employee">
                                        <i class="fa fa-tachometer" aria-hidden="true"></i> The Number Of Clients Per Employee
                                    </div>
                                    <div class="col-lg-1 col-md-6 col-12">
                                        <span class="badge rounded-pill bg-warning text-dark">Completed</span>
                                    </div>
                                    <div class="col-lg-1 col-md-6 col-12 month-feb">
                                        FEBRUARY
                                    </div>
                                    <div class="col-lg-1 col-md-6 col-12">
                                        <span class="badge rounded-pill bg-white">
                                            <div class="flex mb-5 -space-x-4">
                                                <img class="w-10 h-10 border-2 border-white rounded-full dark:border-gray-800" src="<?= Yii::$app->homeUrl ?>image/avatar1.png" class="image-avatar1">
                                                <img class="w-10 h-10 border-2 border-white rounded-full dark:border-gray-800" src="<?= Yii::$app->homeUrl ?>image/avatar2.png" class="image-avatar1">
                                                <img class="w-10 h-10 border-2 border-white rounded-full dark:border-gray-800" src="<?= Yii::$app->homeUrl ?>image/avatar3.png" class="image-avatar1">
                                                <a class="flex items-center justify-center w-10 h-10 text-xs font-medium text-dark bg-gray-700 border-2 border-white rounded-full hover:bg-gray-600 dark:border-gray-800" href="#">9</a>
                                            </div>
                                        </span>
                                    </div>
                                    <div class="col-lg-1 col-md-6 col-12 text-end">
                                        <span class="badge rounded-pill bg-bsc"><i class="fa fa-users" aria-hidden="true"></i> 3</span>
                                    </div>
                                    <div class="col-lg-2 col-md-6 col-12">
                                        <div class="flex-tokyo">
                                            Tokyo Consulting Firm Limited
                                        </div>
                                        <p class="tokyo-ima"> <img src="<?= Yii::$app->homeUrl ?>image/is.jpg" class="image-flex"> Dhaka, Bangladesh</p>
                                    </div>
                                    <div class="col-lg-2 col-md-6 col-12 text-end">
                                        <button class="btn btn-outline-secondary font-size-10"><i class="fa fa-eye" aria-hidden="true"></i></button>
                                        <button class="btn btn-outline-danger font-size-10"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                    </div>
                                    <div class="col-lg-2 col-md-6 col-12">
                                        <div class="col-12">
                                            <span class="badge rounded-pill slds-badge">
                                                Deadline <span class="text-dark font-size-10">: Mon,Feb 28,2024</span>
                                            </span>
                                        </div>
                                        <div class="col-12 top-teamcontent">
                                            Team Content
                                        </div>
                                        <div class="col-12 font-size-12 pt-10">
                                            This is a sample KGI content
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-6 col-12 sample-bordersolid">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="col-12 font-size-12 pt-5">
                                                    Quant Ratio
                                                </div>
                                                <div class="col-12 Quality-diamond">
                                                    <i class="fa fa-diamond" aria-hidden="true"></i> Quality
                                                </div>
                                                <div class="col-12 font-size-10 pt-40" style="width: 10rem;">
                                                    Update Interval
                                                </div>
                                                <div class="col-12 Quality-monthly0">
                                                    Monthly
                                                </div>
                                            </div>
                                            <div class="col-md-6 pt-40">
                                                <div class="col-12 font-size-12">
                                                    Priority
                                                </div>
                                                <div class="col-12">
                                                    <div class="circle-update">A</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-12 progress-bordersolid">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="col-12 target-progress">
                                                    <i class="fa fa-bullseye" aria-hidden="true"></i> Target
                                                </div>
                                                <div class="col-12 target-million">
                                                    <?= number_format(1000000) ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="col-12 target-plush">
                                                    >
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="col-12 target-progress">
                                                    Result <i class="fa fa-trophy" aria-hidden="true"></i>
                                                </div>
                                                <div class="col-12 target-million">
                                                    <?= number_format(902566) ?>
                                                </div>
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
                                                <div class="col-12 refresh0">
                                                    <i class="fa fa-refresh" aria-hidden="true"></i> Latest Update
                                                </div>
                                                <div class="col-12 font-size-12 pt-5" style="font-weight: 700;">
                                                    Tue, Mar 12, 2023
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="col-12 pencil-nextupdate">
                                                    Next Update <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                </div>
                                                <div class="col-12 font-size-12 pt-5 text-end" style="font-weight: 700;">
                                                    Tue, Mar 12, 2023
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-md-6 col-12 card-bordersolid">
                                        <div class="row mt-20">
                                            <div class="col-md-6">
                                                <div class="col-12 dashed1">
                                                    <strong class="text-dark font-size-13"> Issue</strong>
                                                    <p class="font-size-11 text-dark pt-5">Now use Lorem Ipsum as their default model text, and a search</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="col-12 dashed1">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <strong class="text-dark font-size-13"> Solution</strong>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <img src="<?= Yii::$app->homeUrl ?>image/comment.png" class="imagecomment">
                                                        </div>
                                                    </div>
                                                    <p class="font-size-11 text-dark pt-5">Now use Lorem Ipsum as their default model text, and a search </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 card card-radius">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-12 clients-employee">
                                        <i class="fa fa-tachometer" aria-hidden="true"></i> The Number Of Clients Per Employee
                                    </div>
                                    <div class="col-lg-1 col-md-6 col-12">
                                        <span class="badge rounded-pill bg-warning text-dark">Completed</span>
                                    </div>
                                    <div class="col-lg-1 col-md-6 col-12 month-feb">
                                        FEBRUARY
                                    </div>
                                    <div class="col-lg-1 col-md-6 col-12">
                                        <span class="badge rounded-pill bg-white">
                                            <div class="flex mb-5 -space-x-4">
                                                <img class="w-10 h-10 border-2 border-white rounded-full dark:border-gray-800" src="<?= Yii::$app->homeUrl ?>image/avatar1.png" class="image-avatar1">
                                                <img class="w-10 h-10 border-2 border-white rounded-full dark:border-gray-800" src="<?= Yii::$app->homeUrl ?>image/avatar2.png" class="image-avatar1">
                                                <img class="w-10 h-10 border-2 border-white rounded-full dark:border-gray-800" src="<?= Yii::$app->homeUrl ?>image/avatar3.png" class="image-avatar1">
                                                <a class="flex items-center justify-center w-10 h-10 text-xs font-medium text-dark bg-gray-700 border-2 border-white rounded-full hover:bg-gray-600 dark:border-gray-800" href="#">9</a>
                                            </div>
                                        </span>
                                    </div>
                                    <div class="col-lg-1 col-md-6 col-12 text-end">
                                        <span class="badge rounded-pill bg-bsc"><i class="fa fa-users" aria-hidden="true"></i> 3</span>
                                    </div>
                                    <div class="col-lg-2 col-md-6 col-12">
                                        <div class="flex-tokyo">
                                            Tokyo Consulting Firm Limited
                                        </div>
                                        <p class="tokyo-ima"> <img src="<?= Yii::$app->homeUrl ?>image/is.jpg" class="image-flex"> Dhaka, Bangladesh</p>
                                    </div>
                                    <div class="col-lg-2 col-md-6 col-12 text-end">
                                        <button class="btn btn-outline-secondary font-size-10"><i class="fa fa-eye" aria-hidden="true"></i></button>
                                        <button class="btn btn-outline-danger font-size-10"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                    </div>
                                    <div class="col-lg-2 col-md-6 col-12">
                                        <div class="col-12">
                                            <span class="badge rounded-pill slds-badge">
                                                Deadline <span class="text-dark font-size-10">: Mon,Feb 28,2024</span>
                                            </span>
                                        </div>
                                        <div class="col-12 top-teamcontent">
                                            Team Content
                                        </div>
                                        <div class="col-12 font-size-12 pt-10">
                                            This is a sample KGI content
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-6 col-12 sample-bordersolid">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="col-12 font-size-12 pt-5">
                                                    Quant Ratio
                                                </div>
                                                <div class="col-12 Quality-diamond">
                                                    <i class="fa fa-diamond" aria-hidden="true"></i> Quality
                                                </div>
                                                <div class="col-12 font-size-10 pt-40" style="width: 10rem;">
                                                    Update Interval
                                                </div>
                                                <div class="col-12 Quality-monthly0">
                                                    Monthly
                                                </div>
                                            </div>
                                            <div class="col-md-6 pt-40">
                                                <div class="col-12 font-size-12">
                                                    Priority
                                                </div>
                                                <div class="col-12">
                                                    <div class="circle-update">A</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-12 progress-bordersolid">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="col-12 target-progress">
                                                    <i class="fa fa-bullseye" aria-hidden="true"></i> Target
                                                </div>
                                                <div class="col-12 target-million">
                                                    <?= number_format(1000000) ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="col-12 target-plush">
                                                    >
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="col-12 target-progress">
                                                    Result <i class="fa fa-trophy" aria-hidden="true"></i>
                                                </div>
                                                <div class="col-12 target-million">
                                                    <?= number_format(902566) ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-20">
                                            <div class="progress">
                                                <div class="progress-bar" style="width:25%; background:#2F80ED;"></div>
                                                <span class="badge rounded-pill  pro-load2">25%</span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="col-12 refresh0">
                                                    <i class="fa fa-refresh" aria-hidden="true"></i> Latest Update
                                                </div>
                                                <div class="col-12 font-size-12 pt-5" style="font-weight: 700;">
                                                    Tue, Mar 12, 2023
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="col-12 pencil-nextupdate">
                                                    Next Update <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                </div>
                                                <div class="col-12 font-size-12 pt-5 text-end" style="font-weight: 700;">
                                                    Tue, Mar 12, 2023
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-md-6 col-12 card-bordersolid">
                                        <div class="row mt-20">
                                            <div class="col-md-6">
                                                <div class="col-12 dashed1">
                                                    <strong class="text-dark font-size-13"> Issue</strong>
                                                    <p class="font-size-11 text-dark pt-5">Now use Lorem Ipsum as their default model text, and a search </p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="col-12 dashed1">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <strong class="text-dark font-size-13"> Solution</strong>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <img src="<?= Yii::$app->homeUrl ?>image/comment.png" class="imagecomment">
                                                        </div>
                                                    </div>
                                                    <p class="font-size-11 text-dark pt-5">Now use Lorem Ipsum as their default model text, and a search </p>
                                                </div>
                                            </div>
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
</div>

<!-- modal edit kpi-grid -->
<div class="modal fade" id="exampleModal7" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="staticBackdrop"><i class="fa fa-magic" aria-hidden="true"></i>Create KPI</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="col-12" style="margin-top: -20px; padding-left:20px; font-size: 13px;">
                <i class="fa fa-clock-o" aria-hidden="true"></i> Key Performance Indicator
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-6">
                        <div class="col-12">
                            <label for="exampleFormControlInput1" class="form-label"><strong class="red">*</strong> Company KPI Contents</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="col-12 mt-20">
                            <label for="input" class="form-label"><strong class="red">*</strong> Company (Single)</label>
                            <select class="form-select" aria-label="Default select example">
                                <option selected value="">Select Company</option>
                                <option value="1">Tokyo Consulting Firm Danışmanlık</option>
                                <option value="2">Tokyo Consulting Firm Pvt. Ltd.</option>
                                <option value="3">Tokyo Consulting Firm PLC</option>
                                <option value="4">Tokyo Consulting Firm Pt.</option>
                                <option value="5">Tokyo Consulting Firm</option>
                            </select>
                        </div>
                        <div class="col-12 mt-20">
                            <label for="input" class="form-label"><strong class="red">*</strong> Branch (Single)</label>
                            <select class="form-select" aria-label="Default select example">
                                <option selected value="">Select Branch</option>
                                <option value="1">Branch 1</option>
                                <option value="2">Branch 2</option>
                                <option value="3">Branch 3</option>
                                <option value="4">Branch 4</option>
                                <option value="5">Branch 5</option>
                            </select>
                        </div>
                        <div class="col-12 mt-20">
                            <label for="input" class="form-label"><strong class="red">*</strong> Check Unit</label>
                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                <button type="button" class="btn btn-outline-secondary">Monthly</button>
                                <button type="button" class="btn btn-outline-secondary">Weekly</button>
                                <button type="button" class="btn btn-outline-secondary">Quaterly</button>
                                <button type="button" class="btn btn-outline-secondary">Daily</button>
                            </div>
                        </div>
                        <div class="col-12 mt-20">
                            <div class="input-group">
                                <label for="input" class="form-label"><strong class="red">*</strong> Select Period</label>
                                <div class="input-group">
                                    <span class="input-group-text font-size-12"><i class="fa fa-calendar-o" aria-hidden="true"></i> &nbsp;&nbsp; Date</span>
                                    <input type="date" class="form-control font-size-12">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-10">
                            <label for="exampleFormControl" class="form-label font-size-14"><strong class="red">*</strong> Target Amount</label>
                            <input type="number" class="form-control font-size-13 text-end">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-6">
                        <div class="col-12">
                            <label for="exampleFormControlTextarea1" class="form-label"> KPI Details</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="4"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-6 pt-10">
                                <label for="exampleFormControl" class="form-label font-size-13"><strong class="red">*</strong> Quant Ratio</label>
                                <select class="form-select font-size-13" aria-label="Default select example">
                                    <option selected value="">Quantity or Quality</option>
                                    <option value="1">January</option>
                                    <option value="2">June</option>
                                    <option value="3">July</option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 col-6 pt-10">
                                <label for="exampleFormControl" class="form-label font-size-13"><strong class="red">*</strong> Priority</label>
                                <select class="form-select font-size-13" aria-label="Default select example">
                                    <option selected value="">A/B/C</option>
                                    <option value="1"></option>
                                    <option value="2"></option>
                                    <option value="3"></option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 col-6 pt-10">
                                <label for="exampleFormControl" class="form-label font-size-13"><strong class="red">*</strong> Amount Type</label>
                                <select class="form-select font-size-13" aria-label="Default select example">
                                    <option selected value="">% or Number</option>
                                    <option value="1"></option>
                                    <option value="2"></option>
                                    <option value="3"></option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 col-6 pt-10">
                                <label for="exampleFormControl" class="form-label font-size-13"><strong class="red">*</strong> Code</label>
                                <select class="form-select font-size-13" aria-label="Default select example">
                                    <option selected value="">
                                        <=>
                                    </option>
                                    <option value="1"></option>
                                    <option value="2"></option>
                                    <option value="3"></option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 col-6 pt-10">
                                <label for="exampleFormControl" class="form-label font-size-13"><strong class="red">*</strong> Status</label>
                                <select class="form-select font-size-13" aria-label="Default select example">
                                    <option selected value="">Active/Finished</option>
                                    <option value="1"></option>
                                    <option value="2"></option>
                                    <option value="3"></option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 col-6 pt-10">
                                <label for="exampleFormControl" class="form-label font-size-13"><strong class="red">*</strong> Month</label>
                                <select class="form-select font-size-13" aria-label="Default select example">
                                    <option selected value="">Select Month</option>
                                    <option value="1">January</option>
                                    <option value="2"></option>
                                    <option value="3"></option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="exampleFormControl" class="form-label font-size-13"><strong class="red">*</strong> Result</label>
                                <input type="number" class="form-control font-size-13 text-end">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 pt-10">
                    Set Ratio Formula
                </div>
                <div class="col-12 pt-10">
                    <select class="form-select font-size-12 alert-primary-12 text-dark" aria-label="Default select example">
                        <option selected value="">Use Custom Formula</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div class="alert alert-primary-12 mt-10" role="alert">
                    <div class="alert alert-light">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-12">
                                <a href="#"> <span class="badge bg-secondary text-white font-size-14"> <i class="fa fa-bullseye" aria-hidden="true"></i> Target</span></a>

                                <a href="#"> <span class="badge bg-secondary text-white font-size-14"> <i class="fa fa-trophy" aria-hidden="true"></i> Result </span></a>
                            </div>
                            <div class="col-lg-8 col-md-6 col-12 targrt-small">
                                <a href="#"><span class="badge bg-primary text-white pl-10 pr-10"> +</span></a>

                                <a href="#"> <span class="badge bg-primary text-white pl-10 pr-10"> - </button></a>

                                <a href="#"> <span class="badge bg-primary text-white pl-10 pr-10"> / </span></a>

                                <a href="#"> <span class="badge bg-primary text-white pl-10 pr-10"> x </span></a>

                                <a href="#"> <span class="badge bg-secondary text-white pl-10 pr-10"> ( </span></a>

                                <a href="#"> <span class="badge bg-secondary text-white  pl-10 pr-10"> ) </span></a>
                            </div>
                        </div>
                    </div>
                    <div class="alert alert-light">
                        <div class="col-12 ">
                            <input type="text" class="form-control" style="border: none;" placeholder="( [ Target ] + [ Result ] - [ Target ] )">
                        </div>
                        <div class="mt-50"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="border: none;">
                <button type=" button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Create</button>
            </div>
        </div>
    </div>
</div>
<!-- end -->