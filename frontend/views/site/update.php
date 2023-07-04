<?php

/** @var yii\web\View $this */

use Codeception\Lib\Connector\Yii2;
use yii\bootstrap5\Carousel;

$this->title = 'Update';
?>





<div class="col-12">
    <div class="col-12 update-page">
        KGI/KPI Management Update Page
    </div>
</div>

<div class="alert alert-light" role="alert">
    <div class="col-12">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Add KGI</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">KGI Settings</button>
            </li>

        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="AddKGI" role="tabpanel" aria-labelledby="addKGI-tab">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="mb-3">
                            <label for="formGroupExampleInput" class="form-label mt-20"> <span class="moon-red">*</span> KGI Name</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="">
                        </div>
                        <div class="mb-3">
                            <label for="formGroupExampleInput2" class="form-label"><span class="moon-red">*</span> Select Country </label>
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Bangladresh</option>
                                <option value="1">brazil</option>
                                <option value="2">japan</option>
                                <option value="3">thailand</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="formGroupExampleInput2" class="form-label"><span class="moon-red">*</span> Depasrtment </label>
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Select The Branch</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="formGroupExampleInput2" class="form-label"><span class="moon-red">*</span> Dream Team </label>
                            <select class="form-select" aria-label="Default select example">
                                <option selected> IT Team</option>
                                <option value="1">Support</option>
                                <option value="2">IT network</option>
                                <option value="3">IT services</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Assigned Employee</label>
                            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Use @ tag to Assign an employee">
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <label for="exampleFormControlInput1" class="form-label"> <span class="moon-red">*</span> Start Date</label>
                                <div class="input-group mb-3" action="/action_page.php">
                                    <span class="input-group-text example-calendar" id="inputGroup-sizing-default"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                    <input type="date" id="birthday" class="form-control example-calendar" name="birthday" aria-label="Sizing example input" aria-describedby="">
                                </div>
                            </div>
                            <div class="col-4">
                                <label for="exampleFormControlInput1" class="form-label"> <span class="moon-red">*</span> End Date</label>
                                <div class="input-group mb-3" action="/action_page.php">
                                    <span class="input-group-text example-calendar" id="inputGroup-sizing-default"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                    <input type="date" id="birthday" class="form-control example-calendar" name="birthday" aria-label="Sizing example input" aria-describedby="">
                                </div>
                            </div>
                            <div class="col-4">
                                <label for="exampleFormControlInput1" class="form-label"> <span class="moon-red">*</span> Cycle</label>
                                <div class="btn-group" role="group" aria-label="Basic outlined example">
                                    <button type="button" class="btn btn-outline-secondary group-mounthly">monthly</button>
                                    <button type="button" class="btn btn-outline-secondary group-mounthly">weekly</button>
                                    <button type="button" class="btn btn-outline-secondary group-mounthly">daily</button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <label for="exampleFormControlInput1" class="form-label"> <span class="moon-red">*</span> Target Amount</label>
                                <div class="input-group mb-3">
                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">USD</button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Action</a></li>
                                        <li><a class="dropdown-item" href="#">Another action</a></li>
                                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item" href="#">Separated link</a></li>
                                    </ul>
                                    <input type="text" class="form-control" aria-label="Text input with dropdown button">
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <label for="exampleFormControlInput1" class="form-label"> <span class="moon-red">*</span> Amount Type</label>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>select from menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" onclick="move()" type="checkbox" value="" id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">
                                    Calculate progress through tasks
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-12 mt-20">
                            <div id="myProgress">
                                <div id="myBar"></div>
                            </div>
                            <br>
                            <!-- <button class="btn btn-outline-primary" onclick="move()">Click Me</button> -->
                        </div>
                        <div class="col-lg-12 mt-20">
                            <label for="exampleFormControlInput1" class="form-label"> <i class="fa fa-tag" aria-hidden="true"></i> Tags (Maximum 10)</label>
                            <div class="mb-3">
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="col-12 name-Description">
                            KGI Description
                        </div>
                        <div class="alert alert-light mt-10" role="alert">
                            <span> File <i class="fa fa-minus" aria-hidden="true"></i> </span>
                            <span> Edit <i class="fa fa-minus icon-minimize" aria-hidden="true"></i> </span>
                            <span> View <i class="fa fa-minus icon-minimize" aria-hidden="true"></i> </span>
                            <span> Insert <i class="fa fa-minus icon-minimize" aria-hidden="true"></i> </span>
                            <span> Format <i class="fa fa-minus icon-minimize" aria-hidden="true"></i> </span>
                            <span> Tools <i class="fa fa-minus icon-minimize" aria-hidden="true"></i> </span>
                            <span> Table <i class="fa fa-minus icon-minimize" aria-hidden="true"></i> </span>
                            <hr>
                            <div class="row">
                                <div class="col-2">
                                    <span>
                                        <select class="form-select sl-font" aria-label="Default select example">
                                            <option selected>Verdana</option>
                                            <option value="1">Calibri</option>
                                            <option value="2">Angsana New</option>
                                            <option value="3">Klavika Bd</option>
                                        </select>
                                    </span>
                                </div>
                                <div class="col-2">
                                    <span>
                                        <select class="form-select sl-size" aria-label="Default select example">
                                            <option selected>8</option>
                                            <option value="1">9</option>
                                            <option value="2">10</option>
                                            <option value="3">11</option>
                                            <option value="3">12</option>
                                            <option value="3">13</option>
                                            <option value="3">14</option>
                                            <option value="3">15</option>
                                            <option value="3">16</option>
                                            <option value="3">17</option>
                                        </select>
                                    </span>
                                </div>
                                <div class="col-8">
                                    <span> <i class="fa fa-font pl-10 from-add" aria-hidden="true"></i></span>
                                    <span> <i class="fa fa-bold pl-10 from-add" aria-hidden="true"></i> </span>
                                    <span> <i class="fa fa-underline pl-10 from-add" aria-hidden="true"></i></span>
                                    <span> <i class="fa fa-italic pl-10 from-add" aria-hidden="true"></i></span>
                                    <span> <i class="fa fa-align-left pl-10 from-add" aria-hidden="true"></i></span>
                                    <span> <i class="fa fa-align-center pl-10 from-add" aria-hidden="true"></i></span>
                                    <span> <i class="fa fa-align-right pl-10 from-add" aria-hidden="true"></i></span>
                                    <span> <i class="fa fa-align-justify pl-10 from-add" aria-hidden="true"></i></span>
                                    <span> <i class="fa fa-picture-o pl-10 from-add" aria-hidden="true"></i></span>
                                    <span> <i class="fa fa-link pl-10 from-add" aria-hidden="true"></i></span>
                                    <span> <i class="fa fa-list-ul pl-10 from-add" aria-hidden="true"></i></span>
                                    <span> <i class="fa fa-list-ol pl-10 from-add" aria-hidden="true"></i></span>
                                    <span> <i class="fa fa-clock-o pl-10 from-add" aria-hidden="true"></i></span>
                                </div>
                            </div>
                            <div class="col-12" style="padding-top: 500px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
        </div>

    </div>
</div>