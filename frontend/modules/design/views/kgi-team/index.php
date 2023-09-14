<?php
$this->title = 'Team KGI';
?>

<div class="col-12 mt-90">
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
                <div class="col-12">
                    <table class="table table-striped">
                        <thead class="table-secondary">
                            <tr class="transform-none">
                                <th>KGI Contents</th>
                                <th>Company</th>
                                <th>Branch</th>
                                <th>Team KGI Contents</th>
                                <th>Priority</th>
                                <th>Employees</th>
                                <th>QR</th>
                                <th>target</th>
                                <th>Code</th>
                                <th>result</th>
                                <th>ratio</th>
                                <th>month</th>
                                <th>Unit</th>
                                <th>Last</th>
                                <th>next</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-bottom-white2">
                                <td class="over-blue">Increase Something</td>
                                <td>TCF</td>
                                <td><img src="<?= Yii::$app->homeUrl ?>image/Flag-Turkey.png" class="Flag-Turkey"> Izmir, Turkey</td>
                                <td>The number of clients per employee by team</td>
                                <td class="text-center">A</td>
                                <td>
                                    <div class="flex mb-5 -space-x-4">
                                        <img class="w-10 h-10 border-2 border-white rounded-full dark:border-gray-800" src="<?= Yii::$app->homeUrl ?>image/avatar1.png" class="image-avatar1">
                                        <img class="w-10 h-10 border-2 border-white rounded-full dark:border-gray-800" src="<?= Yii::$app->homeUrl ?>image/avatar2.png" class="image-avatar1">
                                        <img class="w-10 h-10 border-2 border-white rounded-full dark:border-gray-800" src="<?= Yii::$app->homeUrl ?>image/avatar3.png" class="image-avatar1">
                                        <a class="flex items-center justify-center w-10 h-10 text-xs font-medium text-dark bg-gray-700 border-2 border-white rounded-full hover:bg-gray-600 dark:border-gray-800" href="#">9</a>
                                    </div>
                                </td>
                                <td>Quality</td>
                                <td>2.5</td>
                                <td>
                                    >
                                </td>
                                <td>2.1</td>
                                <td>
                                    <div id="progress1">
                                        <div data-num="35" class="progress-item1"></div>
                                    </div>
                                </td>
                                <td>January</td>
                                <td>Monthly</td>
                                <td>2nd Feb, 2023</td>
                                <td>23rd Feb, 2023</td>
                                <td colspan="row">
                                    <span data-bs-toggle="modal" data-bs-target="#exampleModal3"> <img src="<?= Yii::$app->homeUrl ?>image/comment.png" class="comment-td-dropdown"></span>
                                    <span class="dropdown menulink" href="#" role="but ton" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"> <i class="fa fa-ellipsis-v on-cursor" aria-hidden="true"></i> </span>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">

                                        <li data-bs-toggle="modal" data-bs-target="#staticBackdrop11">
                                            <a class="dropdown-item"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                        </li>
                                        <li data-bs-toggle="modal" data-bs-target="#staticBackdrop10">
                                            <a class="dropdown-item"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                        </li>
                                        <li data-bs-toggle="modal" data-bs-target="#staticBackdrop11">
                                            <a class="dropdown-item"><i class="fa fa-trash-o text-danger" aria-hidden="true"></i></a>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        </tbody>
                        <tbody>
                            <tr class="border-bottom-white2">
                                <td class="over-blue">Increase Something</td>
                                <td>TCF</td>
                                <td><img src="<?= Yii::$app->homeUrl ?>image/Flag-Turkey.png" class="Flag-Turkey"> Izmir, Turkey</td>
                                <td>The number of clients per employee by team</td>
                                <td class="text-center">A</td>
                                <td>
                                    <div class="flex mb-5 -space-x-4">
                                        <img class="w-10 h-10 border-2 border-white rounded-full dark:border-gray-800" src="<?= Yii::$app->homeUrl ?>image/avatar1.png" class="image-avatar1">
                                        <img class="w-10 h-10 border-2 border-white rounded-full dark:border-gray-800" src="<?= Yii::$app->homeUrl ?>image/avatar2.png" class="image-avatar1">
                                        <img class="w-10 h-10 border-2 border-white rounded-full dark:border-gray-800" src="<?= Yii::$app->homeUrl ?>image/avatar3.png" class="image-avatar1">
                                        <a class="flex items-center justify-center w-10 h-10 text-xs font-medium text-dark bg-gray-700 border-2 border-white rounded-full hover:bg-gray-600 dark:border-gray-800" href="#">9</a>
                                    </div>
                                </td>
                                <td>Quality</td>
                                <td>2.5</td>
                                <td>
                                    >
                                </td>
                                <td>2.1</td>
                                <td>
                                    <div id="progress1">
                                        <div data-num="35" class="progress-item1"></div>
                                    </div>
                                </td>
                                <td>January</td>
                                <td>Monthly</td>
                                <td>2nd Feb, 2023</td>
                                <td>23rd Feb, 2023</td>
                                <td colspan="row">
                                    <span> <img src="<?= Yii::$app->homeUrl ?>image/comment.png" class="comment-td-dropdown"></span>
                                    <span class="dropdown menulink" href="#" role="but ton" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"> <i class="fa fa-ellipsis-v on-cursor" aria-hidden="true"></i> </span>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <li><a class="dropdown-item" href="#"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                        <li><a class="dropdown-item" href="#"><i class="fa fa-trash-o" style="color: tomato;" aria-hidden="true"></i></a></li>
                                    </ul>
                                </td>
                            </tr>
                        </tbody>
                        <tbody>
                            <tr class="border-bottom-white2">
                                <td class="over-blue">Increase Something</td>
                                <td>TCF</td>
                                <td><img src="<?= Yii::$app->homeUrl ?>image/Flag-Turkey.png" class="Flag-Turkey"> Izmir, Turkey</td>
                                <td>The number of clients per employee by team</td>
                                <td class="text-center">A</td>
                                <td>
                                    <div class="flex mb-5 -space-x-4">
                                        <img class="w-10 h-10 border-2 border-white rounded-full dark:border-gray-800" src="<?= Yii::$app->homeUrl ?>image/avatar1.png" class="image-avatar1">
                                        <img class="w-10 h-10 border-2 border-white rounded-full dark:border-gray-800" src="<?= Yii::$app->homeUrl ?>image/avatar2.png" class="image-avatar1">
                                        <img class="w-10 h-10 border-2 border-white rounded-full dark:border-gray-800" src="<?= Yii::$app->homeUrl ?>image/avatar3.png" class="image-avatar1">
                                        <a class="flex items-center justify-center w-10 h-10 text-xs font-medium text-dark bg-gray-700 border-2 border-white rounded-full hover:bg-gray-600 dark:border-gray-800" href="#">9</a>
                                    </div>
                                </td>
                                <td>Quality</td>
                                <td>2.5</td>
                                <td>
                                    >
                                </td>
                                <td>2.1</td>
                                <td>
                                    <div id="progress1">
                                        <div data-num="35" class="progress-item1"></div>
                                    </div>
                                </td>
                                <td>January</td>
                                <td>Monthly</td>
                                <td>2nd Feb, 2023</td>
                                <td>23rd Feb, 2023</td>
                                <td colspan="row">
                                    <span> <img src="<?= Yii::$app->homeUrl ?>image/comment.png" class="comment-td-dropdown"></span>
                                    <span class="dropdown menulink" href="#" role="but ton" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"> <i class="fa fa-ellipsis-v on-cursor" aria-hidden="true"></i> </span>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <li><a class="dropdown-item" href="#"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                        <li><a class="dropdown-item" href="#"><i class="fa fa-trash-o" style="color: tomato;" aria-hidden="true"></i></a></li>
                                    </ul>
                                </td>
                            </tr>
                        </tbody>
                        <tbody>
                            <tr class="border-bottom-white2">
                                <td class="over-blue">Increase Something</td>
                                <td>TCF</td>
                                <td><img src="<?= Yii::$app->homeUrl ?>image/Flag-Turkey.png" class="Flag-Turkey"> Izmir, Turkey</td>
                                <td>The number of clients per employee by team</td>
                                <td class="text-center">A</td>
                                <td>
                                    <div class="flex mb-5 -space-x-4">
                                        <img class="w-10 h-10 border-2 border-white rounded-full dark:border-gray-800" src="<?= Yii::$app->homeUrl ?>image/avatar1.png" class="image-avatar1">
                                        <img class="w-10 h-10 border-2 border-white rounded-full dark:border-gray-800" src="<?= Yii::$app->homeUrl ?>image/avatar2.png" class="image-avatar1">
                                        <img class="w-10 h-10 border-2 border-white rounded-full dark:border-gray-800" src="<?= Yii::$app->homeUrl ?>image/avatar3.png" class="image-avatar1">
                                        <a class="flex items-center justify-center w-10 h-10 text-xs font-medium text-dark bg-gray-700 border-2 border-white rounded-full hover:bg-gray-600 dark:border-gray-800" href="#">9</a>
                                    </div>
                                </td>
                                <td>Quality</td>
                                <td>2.5</td>
                                <td>
                                    >
                                </td>
                                <td>2.1</td>
                                <td>
                                    <div id="progress1">
                                        <div data-num="35" class="progress-item1"></div>
                                    </div>
                                </td>
                                <td>January</td>
                                <td>Monthly</td>
                                <td>2nd Feb, 2023</td>
                                <td>23rd Feb, 2023</td>
                                <td colspan="row">
                                    <span> <img src="<?= Yii::$app->homeUrl ?>image/comment.png" class="comment-td-dropdown"></span>
                                    <span class="dropdown menulink" href="#" role="but ton" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"> <i class="fa fa-ellipsis-v on-cursor" aria-hidden="true"></i> </span>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <li><a class="dropdown-item" href="#"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                        <li><a class="dropdown-item" href="#"><i class="fa fa-trash-o" style="color: tomato;" aria-hidden="true"></i></a></li>
                                    </ul>
                                </td>
                            </tr>
                        </tbody>
                        <tbody>
                            <tr class="border-bottom-white2">
                                <td class="over-blue">Increase Something</td>
                                <td>TCF</td>
                                <td><img src="<?= Yii::$app->homeUrl ?>image/Flag-Turkey.png" class="Flag-Turkey"> Izmir, Turkey</td>
                                <td>The number of clients per employee by team</td>
                                <td class="text-center">A</td>
                                <td>
                                    <div class="flex mb-5 -space-x-4">
                                        <img class="w-10 h-10 border-2 border-white rounded-full dark:border-gray-800" src="<?= Yii::$app->homeUrl ?>image/avatar1.png" class="image-avatar1">
                                        <img class="w-10 h-10 border-2 border-white rounded-full dark:border-gray-800" src="<?= Yii::$app->homeUrl ?>image/avatar2.png" class="image-avatar1">
                                        <img class="w-10 h-10 border-2 border-white rounded-full dark:border-gray-800" src="<?= Yii::$app->homeUrl ?>image/avatar3.png" class="image-avatar1">
                                        <a class="flex items-center justify-center w-10 h-10 text-xs font-medium text-dark bg-gray-700 border-2 border-white rounded-full hover:bg-gray-600 dark:border-gray-800" href="#">9</a>
                                    </div>
                                </td>
                                <td>Quality</td>
                                <td>2.5</td>
                                <td>
                                    >
                                </td>
                                <td>2.1</td>
                                <td>
                                    <div id="progress1">
                                        <div data-num="35" class="progress-item1"></div>
                                    </div>
                                </td>
                                <td>January</td>
                                <td>Monthly</td>
                                <td>2nd Feb, 2023</td>
                                <td>23rd Feb, 2023</td>
                                <td colspan="row">
                                    <span> <img src="<?= Yii::$app->homeUrl ?>image/comment.png" class="comment-td-dropdown"></span>
                                    <span class="dropdown menulink" href="#" role="but ton" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"> <i class="fa fa-ellipsis-v on-cursor" aria-hidden="true"></i> </span>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <li><a class="dropdown-item" href="#"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                        <li><a class="dropdown-item" href="#"><i class="fa fa-trash-o" style="color: tomato;" aria-hidden="true"></i></a></li>
                                    </ul>
                                </td>
                            </tr>
                        </tbody>
                        <tbody>
                            <tr class="border-bottom-white2">
                                <td class="over-blue">Increase Something</td>
                                <td>TCF</td>
                                <td><img src="<?= Yii::$app->homeUrl ?>image/Flag-Turkey.png" class="Flag-Turkey"> Izmir, Turkey</td>
                                <td>The number of clients per employee by team</td>
                                <td class="text-center">A</td>
                                <td>
                                    <div class="flex mb-5 -space-x-4">
                                        <img class="w-10 h-10 border-2 border-white rounded-full dark:border-gray-800" src="<?= Yii::$app->homeUrl ?>image/avatar1.png" class="image-avatar1">
                                        <img class="w-10 h-10 border-2 border-white rounded-full dark:border-gray-800" src="<?= Yii::$app->homeUrl ?>image/avatar2.png" class="image-avatar1">
                                        <img class="w-10 h-10 border-2 border-white rounded-full dark:border-gray-800" src="<?= Yii::$app->homeUrl ?>image/avatar3.png" class="image-avatar1">
                                        <a class="flex items-center justify-center w-10 h-10 text-xs font-medium text-dark bg-gray-700 border-2 border-white rounded-full hover:bg-gray-600 dark:border-gray-800" href="#">9</a>
                                    </div>
                                </td>
                                <td>Quality</td>
                                <td>2.5</td>
                                <td>
                                    >
                                </td>
                                <td>2.1</td>
                                <td>
                                    <div id="progress1">
                                        <div data-num="35" class="progress-item1"></div>
                                    </div>
                                </td>
                                <td>January</td>
                                <td>Monthly</td>
                                <td>2nd Feb, 2023</td>
                                <td>23rd Feb, 2023</td>
                                <td colspan="3">
                                    <span> <img src="<?= Yii::$app->homeUrl ?>image/comment.png" class="comment-td-dropdown"></span>
                                    <span class="dropdown menulink" href="#" role="but ton" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"> <i class="fa fa-ellipsis-v on-cursor" aria-hidden="true"></i> </span>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <li><a class="dropdown-item" href="#"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                        <li><a class="dropdown-item" href="#"><i class="fa fa-trash-o" style="color: tomato;" aria-hidden="true"></i></a></li>
                                    </ul>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-12 navigation-next">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link page-navigation" href="#"><i class="fa fa-chevron-left" aria-hidden="true"></i> Previous</a></li>
                        <li class="page-item"><a class="page-link page-navigation" href="#">1</a></li>
                        <li class="page-item"><a class="page-link page-navigation" href="#">2</a></li>
                        <li class="page-item"><a class="page-link page-navigation" href="#">3</a></li>
                        <li class="page-item"><a class="page-link page-navigation" href="#">Next <i class="fa fa-chevron-right" aria-hidden="true"></i></a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- modal Team KGI -->
<div class="modal fade" id="staticBackdrop10" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdro10" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom:none;">
                <div class="modal-title Modalfirstone" id="staticBackdrop"><i class="fa fa-line-chart" aria-hidden="true"></i> Increase Sales</div>
                <div class="modal-title badge rounded-pill bg-warning text-dark font-size-14">Completed</div>
            </div>
            <div class="text-end mr-20">
                <span class="border border-1 text-dark" style="border-radius: 15px;"> <span class="deadline-Backdrop3">Deadline</span> <span class="font-size-11">: Mon, Feb 12, 2023 &nbsp;</span></span>
            </div>
            <div class="text-end mt-10 mr-20">
                <span class="border border-1 text-dark" style="border-radius: 15px;"><span class="NextUpdate-Backdrop3">Next Update</span> <span class="font-size-11"> Tue, Mar 12, 2023 &nbsp;</span></span>
            </div>
            <div class="view-show-name">Tokyo Consulting Firm Limited </div>
            <div class="country-show-name">
                <img src="<?= Yii::$app->homeUrl ?>image/is.jpg" class="is-bangladresh2"> Dhaka, Bangladesh
            </div>
            <div class="modal-body mt-20">
                <div class="col-12 dashed-Backdrop3">
                    <div class="row mt-20">
                        <div class="col-lg-2 col-md-6 col-2">
                            <div class="col-12 padding-FEB-Backdrop3">
                                FEB
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-3">
                            <div class="col-12 Quant-ratio-Backdrop3">
                                Quant Ratio
                            </div>
                            <div class="col-12 diamond-con-Backdrop3">
                                <i class="fa fa-diamond" aria-hidden="true"></i> Quality
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-3">
                            <div class="col-12 bullseye-con-Backdrop3">
                                <i class="fa fa-bullseye" aria-hidden="true"></i> Target
                            </div>
                            <div class="col-12 million-number-Backdrop3">
                                1,000,000
                            </div>
                        </div>
                        <div class="col-lg-1 col-md-6 col-3">
                            <div class="col-12 padding-mark-Backdrop3">
                                >
                            </div>
                        </div>
                        <div class="col-lg-3 cl-md-6 col-3">
                            <div class="col-12 trophy-con-Backdrop3">
                                <i class="fa fa-trophy" aria-hidden="true"></i> Achieved/Actual
                            </div>
                            <div class="col-12 million-number-Backdrop3">
                                902,566
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2 col-md-6 col-6"></div>
                            <div class="col-lg-4 col-md-6 col-6">
                                <div class="col-12 padding-update-Backdrop3">
                                    Update Interval
                                </div>
                                <div class="col-12 update-mouth-Backdrop3">
                                    Monthly
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-6 mt-10">
                                <div class="col-12">
                                    <div class="progress">
                                        <div class="progress-bar" style="width:56%; background:#2F80ED;margin-left:-50px;"></div>
                                        <span class="badge rounded-pill  pro-load-Backdrop10">56%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 Description-Backdrop3">
                    Description
                </div>
                <div class="col-12 detailsDescription-Backdrop3">
                    The more people who have access to your point of sales system or place of business means more people have the possibility of buying from you and increasing your profits. The more people who have access to your point of sales system or place of business means more people have the possibility of buying from you and increasing your profits.
                </div>
                <div class="col-12 History-Backdrop3">
                    History
                </div>
                <hr>
                <div class="alert alert-light alertlight-Backdrop3">
                    <div class="row">
                        <div class="col-lg-5 col-md-6 col-12">
                            <div class="row">
                                <div class="col-2">
                                    <span class="badge rounded-pill bg-success"> ✓</span>

                                </div>
                                <div class="col-10">
                                    Stripe risk evaluation: normal
                                </div>
                                <div class="col-12 pl-60">
                                    <img src="<?= Yii::$app->homeUrl ?>image/Faruque.png" class="name-Backdrop3">
                                    <a href="#" class="font-size-12"> Mohammed Sharukh</a> <span class="font-size-12 text-secondary"> Title : Admin</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="col-12 text-secondary font-size-12">
                                <i class="fa fa-bullseye" aria-hidden="true"></i> Updated the information
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="row">
                                <div class="col-2">
                                    <img src="<?= Yii::$app->homeUrl ?>image/pdf.png" class="image-pdf-Backdrop3">
                                </div>
                                <div class="col-10 PM">
                                    August 22, 2018, 6:14 PM
                                    <div class="col-12 New">
                                        New Amount <strong> 200255</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="successbackdrop4"></div>
                </div>
                <div class="alert alert-light alertlight-Backdrop3">
                    <div class="row">
                        <div class="col-lg-5 col-md-6 col-12">
                            <div class="row">
                                <div class="col-2">
                                    <span class="badge rounded-pill bg-primary"> ✓</span>

                                </div>
                                <div class="col-10">
                                    Stripe risk evaluation: normal
                                </div>
                                <div class="col-12 pl-60">
                                    <img src="<?= Yii::$app->homeUrl ?>image/Faruque.png" class="name-Backdrop3">
                                    <a href="#" class="font-size-12"> Mohammed Sharukh</a> <span class="font-size-12 text-secondary"> Title : Admin</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="col-12 text-secondary font-size-12">
                                <i class="fa fa-bullseye" aria-hidden="true"></i> Payment approved and review closed
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="row">
                                <div class="col-2">
                                    <img src="<?= Yii::$app->homeUrl ?>image/pdf.png" class="image-pdf-Backdrop3">
                                </div>
                                <div class="col-10 PM">
                                    August 22, 2018, 6:14 PM
                                    <div class="col-12 New">
                                        New Amount <strong> 200255</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="successbackdrop4"></div>
                </div>
                <div class="alert alert-light alertlight-Backdrop3">
                    <div class="row">
                        <div class="col-lg-5 col-md-6 col-12">
                            <div class="row">
                                <div class="col-2">
                                    <span class="badge rounded-pill bg-primary"> ✓</span>

                                </div>
                                <div class="col-10">
                                    Stripe risk evaluation: normal
                                </div>
                                <div class="col-12 pl-60">
                                    <img src="<?= Yii::$app->homeUrl ?>image/Faruque.png" class="name-Backdrop3">
                                    <a href="#" class="font-size-12"> Mohammed Sharukh</a> <span class="font-size-12 text-secondary"> Title : Admin</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="col-12 text-secondary font-size-12">
                                <i class="fa fa-bullseye" aria-hidden="true"></i> Payment approved and review closed
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="row">
                                <div class="col-2">
                                    <img src="<?= Yii::$app->homeUrl ?>image/pdf.png" class="image-pdf-Backdrop3">
                                </div>
                                <div class="col-10 PM">
                                    August 22, 2018, 6:14 PM
                                    <div class="col-12 New">
                                        New Amount <strong> 200255</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="successbackdrop4"></div>
                </div>
                <div class="alert alert-light alertlight-Backdrop3">
                    <div class="row">
                        <div class="col-lg-5 col-md-6 col-12">
                            <div class="row">
                                <div class="col-2">
                                    <span class="badge rounded-pill bg-primary"> ✓</span>

                                </div>
                                <div class="col-10">
                                    Stripe risk evaluation: normal
                                </div>
                                <div class="col-12 pl-60">
                                    <img src="<?= Yii::$app->homeUrl ?>image/Faruque.png" class="name-Backdrop3">
                                    <a href="#" class="font-size-12"> Mohammed Sharukh</a> <span class="font-size-12 text-secondary"> Title : Admin</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="col-12 text-secondary font-size-12">
                                <i class="fa fa-bullseye" aria-hidden="true"></i> Payment approved and review closed
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="row">
                                <div class="col-2">
                                    <img src="<?= Yii::$app->homeUrl ?>image/pdf.png" class="image-pdf-Backdrop3">
                                </div>
                                <div class="col-10 PM">
                                    August 22, 2018, 6:14 PM
                                    <div class="col-12 New">
                                        New Amount <strong> 200255</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 text-end">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end modal Team KKGI -->


<!-- modal KGI delete -->
<div class="modal fade" id="staticBackdrop11" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdrop11" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom:none;">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-12 delete-Backdrop4">
                    Are you sure you want to do this?
                </div>
            </div>
            <div class="row text-center mt-20" style="border-bottom:none;">
                <div class="col-6 text-end">
                    <button type="button" class="btn btn-primary" style="width: 100px;" data-bs-dismiss="modal">Cancel</button>
                </div>
                <div class="col-6 text-start">
                    <button type="button" class="btn btn-danger" style="width: 100px;">Delete</button>
                    <div class="mt-40"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end modal KGI delete -->