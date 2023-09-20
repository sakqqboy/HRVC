<?php
$this->title = 'Employee KPI';
?>

<div class="col-12 mt-90">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-8">
            <i class="fa fa-tachometer font-size-20" aria-hidden="true"></i> <strong class="font-size-20"> Performance Indicator Matrices (PIM)</strong>
        </div>
        <!-- <div class="col-lg-4 col-md-4 col-4 view-goback text-end">
            <i class="fa fa-caret-left" aria-hidden="true"></i> Go Back
        </div> -->
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
        <div class="alert alert-white-4">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-12 key1">
                    <div class="row">
                        <div class="col-md-3 key3">
                            Key Performance Indicator
                        </div>
                        <div class="col-md-2">
                            <span class="badge rounded-pill  bg-secondary-bsc"><i class="fa fa-user" aria-hidden="true"></i> TAKASHASI SAN</span>
                        </div>
                        <div class="col-md-4 font-size-12 pl-30">
                            Tokyo Consulting Firm Limited
                            <p><img src="<?= Yii::$app->homeUrl ?>image/is.jpg" class="image-employeekgi"> Dhaka, Bangladesh</p>
                        </div>
                        <div class="col-md-3">
                            <button type="button" class="btn btn-primary font-size-12" data-bs-toggle="modal" data-bs-target="#staticBackdropCreatekpi"><i class="fa fa-magic" aria-hidden="true"></i> Create New KPI</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-12 col-12 New-KFI">
                    <div class="col-12">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-filter" aria-hidden="true"></i></span>
                            <select class="form-select font-size-13" aria-label="Example select">
                                <option selected value="">Month</option>
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
                        <div class="col-4 new-light-4 text-end">
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
                            <th>month</th>
                            <th>Single KGI Contents &nbsp;&nbsp; <i class="fa fa-pencil-square-o" aria-hidden="true"></i></th>
                            <th>Priority</th>
                            <th>QR</th>
                            <th>target</th>
                            <th>Code</th>
                            <th>result</th>
                            <th>ratio</th>
                            <th>Unit</th>
                            <th>Last</th>
                            <th>next</th>
                            <th colspan="row"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-bottom-white2">
                            <td class="over-blue">Increase Something</td>
                            <td>January</td>
                            <td>The number of clients per employee by team</td>
                            <td>A</td>
                            <td>Quality</td>
                            <td class="text-center">2.5</td>
                            <td class="text-center">
                                >
                            </td>
                            <td class="text-center">2.1</td>
                            <td>
                                <div id="progress1">
                                    <div data-num="35" class="progress-item1"></div>
                                </div>
                            </td>
                            <td>Monthly</td>
                            <td>2nd Feb, 2023</td>
                            <td>23rd Feb, 2023</td>
                            <td colspan="row">
                                <span data-bs-toggle="modal" data-bs-target="#exampleModalcomment4"> <img src="<?= Yii::$app->homeUrl ?>image/comment.png" class="comment-td-dropdown"></span>
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
                            <td>January</td>
                            <td>The number of clients per employee by team</td>
                            <td>A</td>
                            <td>Quality</td>
                            <td class="text-center">2.5</td>
                            <td class="text-center">
                                >
                            </td>
                            <td class="text-center">2.1</td>
                            <td>
                                <div id="progress1">
                                    <div data-num="35" class="progress-item1"></div>
                                </div>
                            </td>
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
                            <td>January</td>
                            <td>The number of clients per employee by team</td>
                            <td>A</td>
                            <td>Quality</td>
                            <td class="text-center">2.5</td>
                            <td class="text-center">
                                >
                            </td>
                            <td class="text-center">2.1</td>
                            <td>
                                <div id="progress1">
                                    <div data-num="35" class="progress-item1"></div>
                                </div>
                            </td>
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
                            <td>January</td>
                            <td>The number of clients per employee by team</td>
                            <td>A</td>
                            <td>Quality</td>
                            <td class="text-center">2.5</td>
                            <td class="text-center">
                                >
                            </td>
                            <td class="text-center">2.1</td>
                            <td>
                                <div id="progress1">
                                    <div data-num="35" class="progress-item1"></div>
                                </div>
                            </td>
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
                            <td>January</td>
                            <td>The number of clients per employee by team</td>
                            <td>A</td>
                            <td>Quality</td>
                            <td class="text-center">2.5</td>
                            <td class="text-center">
                                >
                            </td>
                            <td class="text-center">2.1</td>
                            <td>
                                <div id="progress1">
                                    <div data-num="35" class="progress-item1"></div>
                                </div>
                            </td>
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
                            <td>January</td>
                            <td>The number of clients per employee by team</td>
                            <td>A</td>
                            <td>Quality</td>
                            <td class="text-center">2.5</td>
                            <td class="text-center">
                                >
                            </td>
                            <td class="text-center">2.1</td>
                            <td>
                                <div id="progress1">
                                    <div data-num="35" class="progress-item1"></div>
                                </div>
                            </td>
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
    </div>
</div>


<!-- modal createkpi -->
<div class="modal fade" id="staticBackdropCreatekpi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropCreatekpi" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="staticBackdrop"><i class="fa fa-magic" aria-hidden="true"></i> Create KPI</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="col-12" style="margin-top: -20px; padding-left:20px; font-size: 13px;">
                <i class="fa fa-tachometer" aria-hidden="true"></i> Key Financial Indicator
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-6">
                        <div class="col-12">
                            <label for="exampleFormControlInput1" class="form-label"><strong class="red">*</strong> Company KPI Contents</label>
                            <input class="form-control" type="text" value="The number of clients per employee" aria-label="The number of clients per employee" disabled readonly>
                        </div>
                        <div class="col-12 pt-5">
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
                        <div class="col-12 pt-5">
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
                        <div class="col-12 pt-10">
                            <label for="input" class="form-label"><strong class="red">*</strong> Check Unit</label>
                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                <button type="button" class="btn btn-outline-secondary">Monthly</button>
                                <button type="button" class="btn btn-outline-secondary">Weekly</button>
                                <button type="button" class="btn btn-outline-secondary">Quaterly</button>
                                <button type="button" class="btn btn-outline-secondary">Daily</button>
                            </div>
                        </div>
                        <div class="col-6 pt-5">
                            <div class="input-group">
                                <label for="input" class="form-label"><strong class="red">*</strong> Select Period</label>
                                <div class="input-group">
                                    <span class="input-group-text font-size-12"><i class="fa fa-calendar-o" aria-hidden="true"></i> &nbsp;&nbsp; Date</span>
                                    <input type="date" class="form-control font-size-12">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 pt-5">
                            <label for="exampleFormControl" class="form-label font-size-13"><strong class="red">*</strong> Target Amount</label>
                            <input type="number" class="form-control font-size-13 text-end">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-6">
                        <div class="col-12">
                            <label for="exampleFormControlTextarea1" class="form-label"> Single KPI Content</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="1"></textarea>
                        </div>
                        <div class="col-12 pt-5">
                            <label for="exampleFormControlTextarea1" class="form-label"> KPI Details</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="1"></textarea>
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
                            <div class="col-12 pt-5">
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


<!-- modal comment employee kgi -->
<div class="modal fade" id="exampleModalcomment4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="border: none;">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-tachometer" aria-hidden="true"></i> <strong>The number of clients per employee</strong> </h5>
                <div class="modal-title"> <strong>Tokyo Consulting Firm Limited</strong> </div>
            </div>
            <div class="col-12 padding-employee">Dhaka, Bangladesh <img src="<?= Yii::$app->homeUrl ?>image/is.jpg" class="is-bangladresh3"></div>
            <div class="modal-body">
                <div class="col-12">
                    <i class="fa fa-exclamation-triangle text-warning" aria-hidden="true"></i> Report an Issue
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="col-12 line-height-employee">
                            I am having a problem in this work, i can’t work It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                        </div>
                        <div class="col-12 mt-20">
                            <input class="form-control">
                        </div>
                        <div class="row">
                            <div class="col-2">
                                <button type="file" class="btn cilp-send"> <i class="fa fa-paperclip" aria-hidden="true"></i></button>
                            </div>
                            <div class="col-2">
                                <button type="button" class="btn btn-secondary send-paper">Send</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end -->


<!-- modal edit employee kpi -->
<div class="modal fade" id="exampleModal4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="border:none;">
                <h5 class="modal-title text-primary" id="exampleModalLabel"><i class="fa fa-magic" aria-hidden="true"></i> Edit KPI</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="col-12 pl-20">
                <i class="fa fa-tachometer" aria-hidden="true"></i> Key Goal Indicator
            </div>
            <div class="modal-body">
                <div class="col-12">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label"> <strong>Company KPI Contents</strong></label>
                        <input class="form-control" type="text" value="The number of clients per employee" aria-label="The number of clients per employee" disabled readonly>
                    </div>
                </div>
                <div class="col-12 mt-20">
                    <div class="mb-3">
                        <label for="exampleFormControlInput2" class="form-label"> <strong>Single KPI Contents</strong></label>
                        <input type="text" class="form-control" id="">
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="border: none;">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Update</button>
            </div>
        </div>
    </div>
</div>
<!-- end -->




<!-- modal view single kpi -->
<div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom:none;">
                <div class="modal-title Modalfirstone" id="exampleModalLabel"><i class="fa fa-tachometer" aria-hidden="true"></i>Increase Something</div>
                <div class="modal-title"> Single KPI Contents</div>
                <div class="modal-title circle-update-team"> A</div>
                <div class="modal-title badge rounded-pill bg-warning text-dark font-size-14">Completed</div>
            </div>
            <div class="text-end mr-20">
                <span class="border border-1 text-dark" style="border-radius: 15px;"> <span class="deadline-Backdrop3">Deadline</span> <span class="font-size-11">: Mon, Feb 12, 2023 &nbsp;</span></span>
            </div>
            <div class="text-end mt-10 mr-20">
                <span class="border border-1 text-dark" style="border-radius: 15px;"><span class="NextUpdate-Backdrop3">Next Update</span> <span class="font-size-11"> Tue, Mar 12, 2023 &nbsp;</span></span>
            </div>
            <div class="view-show-name">Tokyo Consulting Firm Limited </div>
            <div class="teamClients"> Ten Clients employee</div>
            <div class="country-show-name">
                <img src="<?= Yii::$app->homeUrl ?>image/is.jpg" class="is-bangladresh2"> Dhaka, Bangladesh
            </div>
            <div class="san">
                <span class="badge rounded-pill  bg-secondary-bsc text-secondary text-white"><i class="fa fa-user" aria-hidden="true"></i> TAKASHASI SAN</span>
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
                                <?= number_format(1000000) ?>
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
                                <?= number_format(902566) ?>
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
                <div class="col-12 detailsDescription-Backdrop3 pl-20">
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
<!-- end -->

<!-- modal delete employee kgi -->
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
<!-- end -->