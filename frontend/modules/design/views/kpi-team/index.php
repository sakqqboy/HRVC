<?php
$this->title = 'Team KPI';
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
                            <div class="col-5 key3">
                                Key Performance Indicator
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
                                <th>KPI Contents</th>
                                <th>Company</th>
                                <th>Branch</th>
                                <th>Team KPI Contents</th>
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
                                    <span data-bs-toggle="modal" data-bs-target="#exampleModal"> <img src="<?= Yii::$app->homeUrl ?>image/comment.png" class="comment-td-dropdown"></span>
                                    <span class="dropdown menulink" href="#" role="but ton" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"> <i class="fa fa-ellipsis-v on-cursor" aria-hidden="true"></i> </span>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">

                                        <li data-bs-toggle="modal" data-bs-target="#exampleModal4">
                                            <a class="dropdown-item"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                        </li>
                                        <li data-bs-toggle="modal" data-bs-target="#exampleModal3">
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