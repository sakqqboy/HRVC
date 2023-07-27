<?php

/** @var yii\web\View $this */

use yii\bootstrap5\Carousel;

$this->title = 'kpi2 group';
?>

<div class="col-12">
    <div class="col-6 table-KPI">
        <p>KPI & KGI Management</p>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true"><i class="fa fa-list-ol" aria-hidden="true"></i> &nbsp; &nbsp;All</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="branch-tab" data-bs-toggle="tab" data-bs-target="#branch" type="button" role="tab" aria-controls="branch" aria-selected="false">
                        <select class="form-select branch-select-1" aria-label="Default select example">
                            <option selected>branch</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="departments-tab" data-bs-toggle="tab" data-bs-target="#departments" type="button" role="tab" aria-controls="departments" aria-selected="false">
                        <select class="form-select select-departments-1" aria-label="Default select example">
                            <option selected>departments</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="Team-tab" data-bs-toggle="tab" data-bs-target="#Team" type="button" role="tab" aria-controls="Team" aria-selected="false">
                        <select class="form-select select-team-1" aria-label="Default select example">
                            <option selected>Team</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="title-tab" data-bs-toggle="tab" data-bs-target="#title" type="button" role="tab" aria-controls="title" aria-selected="false">
                        <select class="form-select select-title-1" aria-label="Default select example">
                            <option selected>Title</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="employee-tab" data-bs-toggle="tab" data-bs-target="#employee" type="button" role="tab" aria-controls="employee" aria-selected="false">
                        <select class="form-select select-employee-1" aria-label="Default select example">
                            <option selected>Employee</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </button>
                </li>
                <div class="col-lg-2 ml-20 mt-10">
                    <div class="input-group mb-3 group-date-from-1" action="/action_page.php">
                        <span class="input-group-text group-text-from-1" id="inputGroup-sizing-default">From</span>
                        <input type="date" id="birthday" class="form-control control-day-1" name="birthday" aria-label="Sizing example input" aria-describedby="">
                    </div>
                </div>
                <div class="col-lg-2 mt-10">
                    <div class="input-group mb-3 group-date-to-1" action="/action_page.php">
                        <span class="input-group-text group-text-to-1" id="inputGroup-sizing-default">To</span>
                        <input type="date" id="birthday" class="form-control control-day-1" name="birthday" aria-label="Sizing example input" aria-describedby="">
                    </div>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="col-12">
                    <div class="row">
                        <div class="col-lg-2 col-md-6 col-12">
                            <div class="tab-pane fade show active show-fade-one" id="home" role="tabpanel" aria-labelledby="home-tab">KGI2 Group Dashboard</div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-12">
                            <a href="<?= Yii::$app->homeUrl ?>site/create1"><button type="submit" class="btn btn-success title-Update"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Create KGI 2 Group</button></a>
                        </div>
                        <div class="col-lg-2 col-md-6 col-12 title-Respiratory">
                            <a href="<?= Yii::$app->homeUrl ?>site/respiratory1"><button type="submit" class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> KGI 2 Respiratory</button></a>
                        </div>
                        <div class="col-lg-1 col-md-6 col-12 title-calendar1">
                            12 <i class="fa fa-eye" aria-hidden="true"></i>
                        </div>
                        <div class="col-lg-1 col-md-6 col-12 title-calendar1">
                            Export
                        </div>
                        <div class="col-lg-1 col-md-6 col-12 title-refresh">
                            <i class="fa fa-refresh" aria-hidden="true"></i>
                        </div>
                        <div class="col-lg-3 col-md-6 col-12 title-calendar2">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-outline-primary"><i class="fa fa-list-ul" aria-hidden="true"></i> List</button>
                                <button type="button" class="btn btn-outline-primary" id="calender"><i class="fa fa-th-large" aria-hidden="true"></i> Calendrer</button>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered mt-30 table-font-small">
                    <thead>
                        <tr>
                            <th scope="col">SL</th>
                            <th scope="col">Team</th>
                            <th scope="col">Branch</th>
                            <th scope="col">Contents</th>
                            <th scope="col">Unit</th>
                            <th scope="col">Target</th>
                            <th scope="col">Result</th>
                            <th scope="col">Achieved Ratio</th>
                            <th scope="col">Finance</th>
                            <th scope="col">KGI2</th>
                            <th scope="col">KPI1</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Q1 - 23</td>
                            <td> <img src="<?= Yii::$app->homeUrl ?>image/Round-Bangladesh.png" class="width-Round-table"> Dhaka, BD</td>
                            <td>Sales</td>
                            <td>Quarterly</td>
                            <td>>1,000,000</td>
                            <td>৳800,000</td>
                            <td>80%</td>
                            <td>458,764,554</td>
                            <td>3</td>
                            <td>4</td>
                            <td>
                                <i class="fa fa-eye buttton-eye" aria-hidden="true"></i>
                                <i class="fa fa-pencil-square-o button-pencil" aria-hidden="true" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"></i>
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form>
                                                    <div class="col-12">
                                                        <label for="recipient-name" class="col-form-label"><span class="red">*</span> KGI1 Name</label>
                                                        <input type="text" class="form-control" id="recipient-name">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <label for="message-text" class="col-form-label"><span class="red">*</span> KGI 1 Description</label>
                                                            <textarea class="form-control" id="message-text"></textarea>
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="message-text" class="col-form-label"><span class="red">*</span> Unit </label>
                                                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                                <button type="button" class="btn btn-outline-primary">Monthly</button>
                                                                <button type="button" class="btn btn-outline-primary">Weekly</button>
                                                                <button type="button" class="btn btn-outline-primary">Daily</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="recipient-name" class="col-form-label"><span class="red">*</span> Company</label>
                                                        <input type="text" class="form-control" id="recipient-name">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <label for="exampleFormControlInput1" class="form-label"><span class="red">*</span> Branch</label>
                                                            <select class="form-select" aria-label="Default select example">
                                                                <option selected></option>
                                                                <option value="1">One</option>
                                                                <option value="2">Two</option>
                                                                <option value="3">Three</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-4">
                                                            <label for="exampleFormControlInput1" class="form-label"><span class="red">*</span> Start Date</label>
                                                            <input type="date" class="form-control" id="exampleFormControlInput1" placeholder="">
                                                        </div>
                                                        <div class="col-4">
                                                            <label for="exampleFormControlInput1" class="form-label"><span class="red">*</span> End Date</label>
                                                            <input type="date" class="form-control" id="exampleFormControlInput1" placeholder="">
                                                        </div>
                                                        <div class="col-6 mt-10">
                                                            <label for="exampleFormControlInput1" class="form-label"><span class="red">*</span> Title</label>
                                                            <select class="form-select" aria-label="Default select example">
                                                                <option selected></option>
                                                                <option value="1">One</option>
                                                                <option value="2">Two</option>
                                                                <option value="3">Three</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-6 mt-20">
                                                            <label for="exampleFormControlInput1" class="form-label"> Assigned Employee</label>
                                                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Use @ tag to Assign an employee">
                                                        </div>
                                                        <div class="col-6 mt-10">
                                                            <label for="exampleFormControlInput1" class="form-label"> Target Amount</label>
                                                            <div class="input-group mb-3">
                                                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">BDT</button>
                                                                <ul class="dropdown-menu">
                                                                    <li><a class="dropdown-item" href="#">10,000,000</a></li>
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
                                                        <div class="col-6 mt-10">
                                                            <label for="exampleFormControlInput1" class="form-label"> Achievement</label>
                                                            <div class="input-group mb-3">
                                                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">BDT</button>
                                                                <ul class="dropdown-menu">
                                                                    <li><a class="dropdown-item" href="#">8000,00</a></li>
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
                                                        <div class="col-6">
                                                            <label for="exampleFormControlInput1" class="form-label"><span class="red">*</span> Amount Type </label>
                                                            <select class="form-select" aria-label="Default select example">
                                                                <option selected>& or number</option>
                                                                <option value="1">One</option>
                                                                <option value="2">Two</option>
                                                                <option value="3">Three</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="exampleFormControlInput1" class="form-label"><span class="red">*</span> Check</label>
                                                            <select class="form-select" aria-label="Default select example">
                                                                <option selected>& or number</option>
                                                                <option value="1">One</option>
                                                                <option value="2">Two</option>
                                                                <option value="3">Three</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-4 mt-10">
                                                            <label for="exampleFormControlInput1" class="form-label"> Progress</label>
                                                            <div class="progress">
                                                                <div class="progress-bar" role="progressbar" style="width: 60%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">60%</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-4 mt-10">
                                                            <label for="exampleFormControlInput1" class="form-label"> Active</label>
                                                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Yes or no">
                                                        </div>
                                                        <div class="col-4 mt-10">
                                                            <i class="fa fa-tag" aria-hidden="true"></i> Tags (Maximum 10)
                                                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="button" class="btn btn-primary">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <i class="fa fa-trash buton-delete" aria-hidden="true" data-bs-toggle="modal" data-bs-target="#staticBackdrop"></i>
                                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel"></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body want-delete">
                                                Do You Want To Delete?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="button" class="btn btn-primary">Confirm</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Q1 - 23</td>
                            <td> <img src="<?= Yii::$app->homeUrl ?>image/Round-Bangladesh.png" class="width-Round-table"> Dhaka, BD</td>
                            <td>Variable cost</td>
                            <td>Quarterly</td>
                            <td>>1,000,000</td>
                            <td>৳800,000</td>
                            <td>80%</td>
                            <td>458,764,554</td>
                            <td>3</td>
                            <td>4</td>
                            <td>
                                <i class="fa fa-eye buttton-eye" aria-hidden="true"></i>
                                <i class="fa fa-pencil-square-o button-pencil" aria-hidden="true" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"></i>
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form>
                                                    <div class="col-12">
                                                        <label for="recipient-name" class="col-form-label"><span class="red">*</span> KGI1 Name</label>
                                                        <input type="text" class="form-control" id="recipient-name">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <label for="message-text" class="col-form-label"><span class="red">*</span> KGI 1 Description</label>
                                                            <textarea class="form-control" id="message-text"></textarea>
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="message-text" class="col-form-label"><span class="red">*</span> Unit </label>
                                                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                                <button type="button" class="btn btn-outline-primary">Monthly</button>
                                                                <button type="button" class="btn btn-outline-primary">Weekly</button>
                                                                <button type="button" class="btn btn-outline-primary">Daily</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="recipient-name" class="col-form-label"><span class="red">*</span> Company</label>
                                                        <input type="text" class="form-control" id="recipient-name">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <label for="exampleFormControlInput1" class="form-label"><span class="red">*</span> Branch</label>
                                                            <select class="form-select" aria-label="Default select example">
                                                                <option selected></option>
                                                                <option value="1">One</option>
                                                                <option value="2">Two</option>
                                                                <option value="3">Three</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-4">
                                                            <label for="exampleFormControlInput1" class="form-label"><span class="red">*</span> Start Date</label>
                                                            <input type="date" class="form-control" id="exampleFormControlInput1" placeholder="">
                                                        </div>
                                                        <div class="col-4">
                                                            <label for="exampleFormControlInput1" class="form-label"><span class="red">*</span> End Date</label>
                                                            <input type="date" class="form-control" id="exampleFormControlInput1" placeholder="">
                                                        </div>
                                                        <div class="col-6 mt-10">
                                                            <label for="exampleFormControlInput1" class="form-label"><span class="red">*</span> Title</label>
                                                            <select class="form-select" aria-label="Default select example">
                                                                <option selected></option>
                                                                <option value="1">One</option>
                                                                <option value="2">Two</option>
                                                                <option value="3">Three</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-6 mt-20">
                                                            <label for="exampleFormControlInput1" class="form-label"> Assigned Employee</label>
                                                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Use @ tag to Assign an employee">
                                                        </div>
                                                        <div class="col-6 mt-10">
                                                            <label for="exampleFormControlInput1" class="form-label"> Target Amount</label>
                                                            <div class="input-group mb-3">
                                                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">BDT</button>
                                                                <ul class="dropdown-menu">
                                                                    <li><a class="dropdown-item" href="#">10,000,000</a></li>
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
                                                        <div class="col-6 mt-10">
                                                            <label for="exampleFormControlInput1" class="form-label"> Achievement</label>
                                                            <div class="input-group mb-3">
                                                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">BDT</button>
                                                                <ul class="dropdown-menu">
                                                                    <li><a class="dropdown-item" href="#">8000,00</a></li>
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
                                                        <div class="col-6">
                                                            <label for="exampleFormControlInput1" class="form-label"><span class="red">*</span> Amount Type </label>
                                                            <select class="form-select" aria-label="Default select example">
                                                                <option selected>& or number</option>
                                                                <option value="1">One</option>
                                                                <option value="2">Two</option>
                                                                <option value="3">Three</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="exampleFormControlInput1" class="form-label"><span class="red">*</span> Check</label>
                                                            <select class="form-select" aria-label="Default select example">
                                                                <option selected>& or number</option>
                                                                <option value="1">One</option>
                                                                <option value="2">Two</option>
                                                                <option value="3">Three</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-4 mt-10">
                                                            <label for="exampleFormControlInput1" class="form-label"> Progress</label>
                                                            <div class="progress">
                                                                <div class="progress-bar" role="progressbar" style="width: 60%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">60%</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-4 mt-10">
                                                            <label for="exampleFormControlInput1" class="form-label"> Active</label>
                                                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Yes or no">
                                                        </div>
                                                        <div class="col-4 mt-10">
                                                            <i class="fa fa-tag" aria-hidden="true"></i> Tags (Maximum 10)
                                                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="button" class="btn btn-primary">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <i class="fa fa-trash buton-delete" aria-hidden="true" data-bs-toggle="modal" data-bs-target="#staticBackdrop"></i>
                                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel"></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body want-delete">
                                                Do You Want To Delete?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="button" class="btn btn-primary">Confirm</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Q1 - 23</td>
                            <td> <img src="<?= Yii::$app->homeUrl ?>image/Round-Bangladesh.png" class="width-Round-table"> Dhaka, BD</td>
                            <td>Gross Profit</td>
                            <td>Quarterly</td>
                            <td>=1,000,000</td>
                            <td>৳800,000</td>
                            <td>80%</td>
                            <td>458,764,554</td>
                            <td>3</td>
                            <td>4</td>
                            <td>
                                <i class="fa fa-eye buttton-eye" aria-hidden="true"></i>
                                <i class="fa fa-pencil-square-o button-pencil" aria-hidden="true" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"></i>
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form>
                                                    <div class="col-12">
                                                        <label for="recipient-name" class="col-form-label"><span class="red">*</span> KGI1 Name</label>
                                                        <input type="text" class="form-control" id="recipient-name">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <label for="message-text" class="col-form-label"><span class="red">*</span> KGI 1 Description</label>
                                                            <textarea class="form-control" id="message-text"></textarea>
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="message-text" class="col-form-label"><span class="red">*</span> Unit </label>
                                                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                                <button type="button" class="btn btn-outline-primary">Monthly</button>
                                                                <button type="button" class="btn btn-outline-primary">Weekly</button>
                                                                <button type="button" class="btn btn-outline-primary">Daily</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="recipient-name" class="col-form-label"><span class="red">*</span> Company</label>
                                                        <input type="text" class="form-control" id="recipient-name">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <label for="exampleFormControlInput1" class="form-label"><span class="red">*</span> Branch</label>
                                                            <select class="form-select" aria-label="Default select example">
                                                                <option selected></option>
                                                                <option value="1">One</option>
                                                                <option value="2">Two</option>
                                                                <option value="3">Three</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-4">
                                                            <label for="exampleFormControlInput1" class="form-label"><span class="red">*</span> Start Date</label>
                                                            <input type="date" class="form-control" id="exampleFormControlInput1" placeholder="">
                                                        </div>
                                                        <div class="col-4">
                                                            <label for="exampleFormControlInput1" class="form-label"><span class="red">*</span> End Date</label>
                                                            <input type="date" class="form-control" id="exampleFormControlInput1" placeholder="">
                                                        </div>
                                                        <div class="col-6 mt-10">
                                                            <label for="exampleFormControlInput1" class="form-label"><span class="red">*</span> Title</label>
                                                            <select class="form-select" aria-label="Default select example">
                                                                <option selected></option>
                                                                <option value="1">One</option>
                                                                <option value="2">Two</option>
                                                                <option value="3">Three</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-6 mt-20">
                                                            <label for="exampleFormControlInput1" class="form-label"> Assigned Employee</label>
                                                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Use @ tag to Assign an employee">
                                                        </div>
                                                        <div class="col-6 mt-10">
                                                            <label for="exampleFormControlInput1" class="form-label"> Target Amount</label>
                                                            <div class="input-group mb-3">
                                                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">BDT</button>
                                                                <ul class="dropdown-menu">
                                                                    <li><a class="dropdown-item" href="#">10,000,000</a></li>
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
                                                        <div class="col-6 mt-10">
                                                            <label for="exampleFormControlInput1" class="form-label"> Achievement</label>
                                                            <div class="input-group mb-3">
                                                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">BDT</button>
                                                                <ul class="dropdown-menu">
                                                                    <li><a class="dropdown-item" href="#">8000,00</a></li>
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
                                                        <div class="col-6">
                                                            <label for="exampleFormControlInput1" class="form-label"><span class="red">*</span> Amount Type </label>
                                                            <select class="form-select" aria-label="Default select example">
                                                                <option selected>& or number</option>
                                                                <option value="1">One</option>
                                                                <option value="2">Two</option>
                                                                <option value="3">Three</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="exampleFormControlInput1" class="form-label"><span class="red">*</span> Check</label>
                                                            <select class="form-select" aria-label="Default select example">
                                                                <option selected>& or number</option>
                                                                <option value="1">One</option>
                                                                <option value="2">Two</option>
                                                                <option value="3">Three</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-4 mt-10">
                                                            <label for="exampleFormControlInput1" class="form-label"> Progress</label>
                                                            <div class="progress">
                                                                <div class="progress-bar" role="progressbar" style="width: 60%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">60%</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-4 mt-10">
                                                            <label for="exampleFormControlInput1" class="form-label"> Active</label>
                                                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Yes or no">
                                                        </div>
                                                        <div class="col-4 mt-10">
                                                            <i class="fa fa-tag" aria-hidden="true"></i> Tags (Maximum 10)
                                                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="button" class="btn btn-primary">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <i class="fa fa-trash buton-delete" aria-hidden="true" data-bs-toggle="modal" data-bs-target="#staticBackdrop"></i>
                                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel"></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body want-delete">
                                                Do You Want To Delete?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="button" class="btn btn-primary">Confirm</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Q1 - 23</td>
                            <td> <img src="<?= Yii::$app->homeUrl ?>image/Round-Bangladesh.png" class="width-Round-table"> Dhaka, BD</td>
                            <td>Fixed Expense</td>
                            <td>Quarterly</td>
                            <td>>1,000,000</td>
                            <td>৳800,000</td>
                            <td>80%</td>
                            <td>458,764,554</td>
                            <td>3</td>
                            <td>4</td>
                            <td>
                                <i class="fa fa-eye buttton-eye" aria-hidden="true"></i>

                                <i class="fa fa-pencil-square-o button-pencil" aria-hidden="true" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"></i>
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form>
                                                    <div class="col-12">
                                                        <label for="recipient-name" class="col-form-label"><span class="red">*</span> KGI1 Name</label>
                                                        <input type="text" class="form-control" id="recipient-name">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <label for="message-text" class="col-form-label"><span class="red">*</span> KGI 1 Description</label>
                                                            <textarea class="form-control" id="message-text"></textarea>
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="message-text" class="col-form-label"><span class="red">*</span> Unit </label>
                                                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                                <button type="button" class="btn btn-outline-primary">Monthly</button>
                                                                <button type="button" class="btn btn-outline-primary">Weekly</button>
                                                                <button type="button" class="btn btn-outline-primary">Daily</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="recipient-name" class="col-form-label"><span class="red">*</span> Company</label>
                                                        <input type="text" class="form-control" id="recipient-name">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <label for="exampleFormControlInput1" class="form-label"><span class="red">*</span> Branch</label>
                                                            <select class="form-select" aria-label="Default select example">
                                                                <option selected></option>
                                                                <option value="1">One</option>
                                                                <option value="2">Two</option>
                                                                <option value="3">Three</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-4">
                                                            <label for="exampleFormControlInput1" class="form-label"><span class="red">*</span> Start Date</label>
                                                            <input type="date" class="form-control" id="exampleFormControlInput1" placeholder="">
                                                        </div>
                                                        <div class="col-4">
                                                            <label for="exampleFormControlInput1" class="form-label"><span class="red">*</span> End Date</label>
                                                            <input type="date" class="form-control" id="exampleFormControlInput1" placeholder="">
                                                        </div>
                                                        <div class="col-6 mt-10">
                                                            <label for="exampleFormControlInput1" class="form-label"><span class="red">*</span> Title</label>
                                                            <select class="form-select" aria-label="Default select example">
                                                                <option selected></option>
                                                                <option value="1">One</option>
                                                                <option value="2">Two</option>
                                                                <option value="3">Three</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-6 mt-20">
                                                            <label for="exampleFormControlInput1" class="form-label"> Assigned Employee</label>
                                                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Use @ tag to Assign an employee">
                                                        </div>
                                                        <div class="col-6 mt-10">
                                                            <label for="exampleFormControlInput1" class="form-label"> Target Amount</label>
                                                            <div class="input-group mb-3">
                                                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">BDT</button>
                                                                <ul class="dropdown-menu">
                                                                    <li><a class="dropdown-item" href="#">10,000,000</a></li>
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
                                                        <div class="col-6 mt-10">
                                                            <label for="exampleFormControlInput1" class="form-label"> Achievement</label>
                                                            <div class="input-group mb-3">
                                                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">BDT</button>
                                                                <ul class="dropdown-menu">
                                                                    <li><a class="dropdown-item" href="#">8000,00</a></li>
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
                                                        <div class="col-6">
                                                            <label for="exampleFormControlInput1" class="form-label"><span class="red">*</span> Amount Type </label>
                                                            <select class="form-select" aria-label="Default select example">
                                                                <option selected>& or number</option>
                                                                <option value="1">One</option>
                                                                <option value="2">Two</option>
                                                                <option value="3">Three</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="exampleFormControlInput1" class="form-label"><span class="red">*</span> Check</label>
                                                            <select class="form-select" aria-label="Default select example">
                                                                <option selected>& or number</option>
                                                                <option value="1">One</option>
                                                                <option value="2">Two</option>
                                                                <option value="3">Three</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-4 mt-10">
                                                            <label for="exampleFormControlInput1" class="form-label"> Progress</label>
                                                            <div class="progress">
                                                                <div class="progress-bar" role="progressbar" style="width: 60%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">60%</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-4 mt-10">
                                                            <label for="exampleFormControlInput1" class="form-label"> Active</label>
                                                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Yes or no">
                                                        </div>
                                                        <div class="col-4 mt-10">
                                                            <i class="fa fa-tag" aria-hidden="true"></i> Tags (Maximum 10)
                                                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="button" class="btn btn-primary">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <i class="fa fa-trash buton-delete" aria-hidden="true" data-bs-toggle="modal" data-bs-target="#staticBackdrop"></i>
                                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel"></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body want-delete">
                                                Do You Want To Delete?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="button" class="btn btn-primary">Confirm</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Q1 - 23</td>
                            <td> <img src="<?= Yii::$app->homeUrl ?>image/Round-Bangladesh.png" class="width-Round-table"> Dhaka, BD</td>
                            <td>Operating profit</td>
                            <td>Quarterly</td>
                            <td>>1,000,000</td>
                            <td>৳800,000</td>
                            <td>80%</td>
                            <td>458,764,554</td>
                            <td>3</td>
                            <td>4</td>
                            <td>
                                <i class="fa fa-eye buttton-eye" aria-hidden="true"></i>
                                <i class="fa fa-pencil-square-o button-pencil" aria-hidden="true" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"></i>
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form>
                                                    <div class="col-12">
                                                        <label for="recipient-name" class="col-form-label"><span class="red">*</span> KGI1 Name</label>
                                                        <input type="text" class="form-control" id="recipient-name">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <label for="message-text" class="col-form-label"><span class="red">*</span> KGI 1 Description</label>
                                                            <textarea class="form-control" id="message-text"></textarea>
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="message-text" class="col-form-label"><span class="red">*</span> Unit </label>
                                                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                                <button type="button" class="btn btn-outline-primary">Monthly</button>
                                                                <button type="button" class="btn btn-outline-primary">Weekly</button>
                                                                <button type="button" class="btn btn-outline-primary">Daily</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="recipient-name" class="col-form-label"><span class="red">*</span> Company</label>
                                                        <input type="text" class="form-control" id="recipient-name">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <label for="exampleFormControlInput1" class="form-label"><span class="red">*</span> Branch</label>
                                                            <select class="form-select" aria-label="Default select example">
                                                                <option selected></option>
                                                                <option value="1">One</option>
                                                                <option value="2">Two</option>
                                                                <option value="3">Three</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-4">
                                                            <label for="exampleFormControlInput1" class="form-label"><span class="red">*</span> Start Date</label>
                                                            <input type="date" class="form-control" id="exampleFormControlInput1" placeholder="">
                                                        </div>
                                                        <div class="col-4">
                                                            <label for="exampleFormControlInput1" class="form-label"><span class="red">*</span> End Date</label>
                                                            <input type="date" class="form-control" id="exampleFormControlInput1" placeholder="">
                                                        </div>
                                                        <div class="col-6 mt-10">
                                                            <label for="exampleFormControlInput1" class="form-label"><span class="red">*</span> Title</label>
                                                            <select class="form-select" aria-label="Default select example">
                                                                <option selected></option>
                                                                <option value="1">One</option>
                                                                <option value="2">Two</option>
                                                                <option value="3">Three</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-6 mt-20">
                                                            <label for="exampleFormControlInput1" class="form-label"> Assigned Employee</label>
                                                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Use @ tag to Assign an employee">
                                                        </div>
                                                        <div class="col-6 mt-10">
                                                            <label for="exampleFormControlInput1" class="form-label"> Target Amount</label>
                                                            <div class="input-group mb-3">
                                                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">BDT</button>
                                                                <ul class="dropdown-menu">
                                                                    <li><a class="dropdown-item" href="#">10,000,000</a></li>
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
                                                        <div class="col-6 mt-10">
                                                            <label for="exampleFormControlInput1" class="form-label"> Achievement</label>
                                                            <div class="input-group mb-3">
                                                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">BDT</button>
                                                                <ul class="dropdown-menu">
                                                                    <li><a class="dropdown-item" href="#">8000,00</a></li>
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
                                                        <div class="col-6">
                                                            <label for="exampleFormControlInput1" class="form-label"><span class="red">*</span> Amount Type </label>
                                                            <select class="form-select" aria-label="Default select example">
                                                                <option selected>& or number</option>
                                                                <option value="1">One</option>
                                                                <option value="2">Two</option>
                                                                <option value="3">Three</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="exampleFormControlInput1" class="form-label"><span class="red">*</span> Check</label>
                                                            <select class="form-select" aria-label="Default select example">
                                                                <option selected>& or number</option>
                                                                <option value="1">One</option>
                                                                <option value="2">Two</option>
                                                                <option value="3">Three</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-4 mt-10">
                                                            <label for="exampleFormControlInput1" class="form-label"> Progress</label>
                                                            <div class="progress">
                                                                <div class="progress-bar" role="progressbar" style="width: 60%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">60%</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-4 mt-10">
                                                            <label for="exampleFormControlInput1" class="form-label"> Active</label>
                                                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Yes or no">
                                                        </div>
                                                        <div class="col-4 mt-10">
                                                            <i class="fa fa-tag" aria-hidden="true"></i> Tags (Maximum 10)
                                                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="button" class="btn btn-primary">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <i class="fa fa-trash buton-delete" aria-hidden="true" data-bs-toggle="modal" data-bs-target="#staticBackdrop"></i>
                                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel"></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body want-delete">
                                                Do You Want To Delete?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="button" class="btn btn-primary">Confirm</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Q1 - 23</td>
                            <td> <img src="<?= Yii::$app->homeUrl ?>image/Round-Bangladesh.png" class="width-Round-table"> Dhaka, BD</td>
                            <td>Break-Even Point</td>
                            <td>Quarterly</td>
                            <td>=1,000,000</td>
                            <td>৳800,000</td>
                            <td>80%</td>
                            <td>458,764,554</td>
                            <td>3</td>
                            <td>4</td>
                            <td>
                                <i class="fa fa-eye buttton-eye" aria-hidden="true"></i>
                                <i class="fa fa-pencil-square-o button-pencil" aria-hidden="true" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"></i>
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form>
                                                    <div class="col-12">
                                                        <label for="recipient-name" class="col-form-label"><span class="red">*</span> KGI1 Name</label>
                                                        <input type="text" class="form-control" id="recipient-name">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <label for="message-text" class="col-form-label"><span class="red">*</span> KGI 1 Description</label>
                                                            <textarea class="form-control" id="message-text"></textarea>
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="message-text" class="col-form-label"><span class="red">*</span> Unit </label>
                                                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                                <button type="button" class="btn btn-outline-primary">Monthly</button>
                                                                <button type="button" class="btn btn-outline-primary">Weekly</button>
                                                                <button type="button" class="btn btn-outline-primary">Daily</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="recipient-name" class="col-form-label"><span class="red">*</span> Company</label>
                                                        <input type="text" class="form-control" id="recipient-name">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <label for="exampleFormControlInput1" class="form-label"><span class="red">*</span> Branch</label>
                                                            <select class="form-select" aria-label="Default select example">
                                                                <option selected></option>
                                                                <option value="1">One</option>
                                                                <option value="2">Two</option>
                                                                <option value="3">Three</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-4">
                                                            <label for="exampleFormControlInput1" class="form-label"><span class="red">*</span> Start Date</label>
                                                            <input type="date" class="form-control" id="exampleFormControlInput1" placeholder="">
                                                        </div>
                                                        <div class="col-4">
                                                            <label for="exampleFormControlInput1" class="form-label"><span class="red">*</span> End Date</label>
                                                            <input type="date" class="form-control" id="exampleFormControlInput1" placeholder="">
                                                        </div>
                                                        <div class="col-6 mt-10">
                                                            <label for="exampleFormControlInput1" class="form-label"><span class="red">*</span> Title</label>
                                                            <select class="form-select" aria-label="Default select example">
                                                                <option selected></option>
                                                                <option value="1">One</option>
                                                                <option value="2">Two</option>
                                                                <option value="3">Three</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-6 mt-20">
                                                            <label for="exampleFormControlInput1" class="form-label"> Assigned Employee</label>
                                                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Use @ tag to Assign an employee">
                                                        </div>
                                                        <div class="col-6 mt-10">
                                                            <label for="exampleFormControlInput1" class="form-label"> Target Amount</label>
                                                            <div class="input-group mb-3">
                                                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">BDT</button>
                                                                <ul class="dropdown-menu">
                                                                    <li><a class="dropdown-item" href="#">10,000,000</a></li>
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
                                                        <div class="col-6 mt-10">
                                                            <label for="exampleFormControlInput1" class="form-label"> Achievement</label>
                                                            <div class="input-group mb-3">
                                                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">BDT</button>
                                                                <ul class="dropdown-menu">
                                                                    <li><a class="dropdown-item" href="#">8000,00</a></li>
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
                                                        <div class="col-6">
                                                            <label for="exampleFormControlInput1" class="form-label"><span class="red">*</span> Amount Type </label>
                                                            <select class="form-select" aria-label="Default select example">
                                                                <option selected>& or number</option>
                                                                <option value="1">One</option>
                                                                <option value="2">Two</option>
                                                                <option value="3">Three</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="exampleFormControlInput1" class="form-label"><span class="red">*</span> Check</label>
                                                            <select class="form-select" aria-label="Default select example">
                                                                <option selected>& or number</option>
                                                                <option value="1">One</option>
                                                                <option value="2">Two</option>
                                                                <option value="3">Three</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-4 mt-10">
                                                            <label for="exampleFormControlInput1" class="form-label"> Progress</label>
                                                            <div class="progress">
                                                                <div class="progress-bar" role="progressbar" style="width: 60%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">60%</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-4 mt-10">
                                                            <label for="exampleFormControlInput1" class="form-label"> Active</label>
                                                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Yes or no">
                                                        </div>
                                                        <div class="col-4 mt-10">
                                                            <i class="fa fa-tag" aria-hidden="true"></i> Tags (Maximum 10)
                                                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="button" class="btn btn-primary">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <i class="fa fa-trash buton-delete" aria-hidden="true" data-bs-toggle="modal" data-bs-target="#staticBackdrop"></i>
                                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel"></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body want-delete">
                                                Do You Want To Delete?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="button" class="btn btn-primary">Confirm</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Q1 - 23</td>
                            <td> <img src="<?= Yii::$app->homeUrl ?>image/Round-Bangladesh.png" class="width-Round-table"> Dhaka, BD</td>
                            <td>Gross profit ratio</td>
                            <td>Quarterly</td>
                            <td>=1,000,000</td>
                            <td>৳800,000</td>
                            <td>80%</td>
                            <td>458,764,554</td>
                            <td>3</td>
                            <td>4</td>
                            <td>
                                <i class="fa fa-eye buttton-eye" aria-hidden="true"></i>
                                <i class="fa fa-pencil-square-o button-pencil" aria-hidden="true" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"></i>
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form>
                                                    <div class="col-12">
                                                        <label for="recipient-name" class="col-form-label"><span class="red">*</span> KGI1 Name</label>
                                                        <input type="text" class="form-control" id="recipient-name">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <label for="message-text" class="col-form-label"><span class="red">*</span> KGI 1 Description</label>
                                                            <textarea class="form-control" id="message-text"></textarea>
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="message-text" class="col-form-label"><span class="red">*</span> Unit </label>
                                                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                                <button type="button" class="btn btn-outline-primary">Monthly</button>
                                                                <button type="button" class="btn btn-outline-primary">Weekly</button>
                                                                <button type="button" class="btn btn-outline-primary">Daily</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="recipient-name" class="col-form-label"><span class="red">*</span> Company</label>
                                                        <input type="text" class="form-control" id="recipient-name">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <label for="exampleFormControlInput1" class="form-label"><span class="red">*</span> Branch</label>
                                                            <select class="form-select" aria-label="Default select example">
                                                                <option selected></option>
                                                                <option value="1">One</option>
                                                                <option value="2">Two</option>
                                                                <option value="3">Three</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-4">
                                                            <label for="exampleFormControlInput1" class="form-label"><span class="red">*</span> Start Date</label>
                                                            <input type="date" class="form-control" id="exampleFormControlInput1" placeholder="">
                                                        </div>
                                                        <div class="col-4">
                                                            <label for="exampleFormControlInput1" class="form-label"><span class="red">*</span> End Date</label>
                                                            <input type="date" class="form-control" id="exampleFormControlInput1" placeholder="">
                                                        </div>
                                                        <div class="col-6 mt-10">
                                                            <label for="exampleFormControlInput1" class="form-label"><span class="red">*</span> Title</label>
                                                            <select class="form-select" aria-label="Default select example">
                                                                <option selected></option>
                                                                <option value="1">One</option>
                                                                <option value="2">Two</option>
                                                                <option value="3">Three</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-6 mt-20">
                                                            <label for="exampleFormControlInput1" class="form-label"> Assigned Employee</label>
                                                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Use @ tag to Assign an employee">
                                                        </div>
                                                        <div class="col-6 mt-10">
                                                            <label for="exampleFormControlInput1" class="form-label"> Target Amount</label>
                                                            <div class="input-group mb-3">
                                                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">BDT</button>
                                                                <ul class="dropdown-menu">
                                                                    <li><a class="dropdown-item" href="#">10,000,000</a></li>
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
                                                        <div class="col-6 mt-10">
                                                            <label for="exampleFormControlInput1" class="form-label"> Achievement</label>
                                                            <div class="input-group mb-3">
                                                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">BDT</button>
                                                                <ul class="dropdown-menu">
                                                                    <li><a class="dropdown-item" href="#">8000,00</a></li>
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
                                                        <div class="col-6">
                                                            <label for="exampleFormControlInput1" class="form-label"><span class="red">*</span> Amount Type </label>
                                                            <select class="form-select" aria-label="Default select example">
                                                                <option selected>& or number</option>
                                                                <option value="1">One</option>
                                                                <option value="2">Two</option>
                                                                <option value="3">Three</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="exampleFormControlInput1" class="form-label"><span class="red">*</span> Check</label>
                                                            <select class="form-select" aria-label="Default select example">
                                                                <option selected>& or number</option>
                                                                <option value="1">One</option>
                                                                <option value="2">Two</option>
                                                                <option value="3">Three</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-4 mt-10">
                                                            <label for="exampleFormControlInput1" class="form-label"> Progress</label>
                                                            <div class="progress">
                                                                <div class="progress-bar" role="progressbar" style="width: 60%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">60%</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-4 mt-10">
                                                            <label for="exampleFormControlInput1" class="form-label"> Active</label>
                                                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Yes or no">
                                                        </div>
                                                        <div class="col-4 mt-10">
                                                            <i class="fa fa-tag" aria-hidden="true"></i> Tags (Maximum 10)
                                                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="button" class="btn btn-primary">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <i class="fa fa-trash buton-delete" aria-hidden="true" data-bs-toggle="modal" data-bs-target="#staticBackdrop"></i>
                                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel"></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body want-delete">
                                                Do You Want To Delete?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="button" class="btn btn-primary">Confirm</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Q1 - 23</td>
                            <td> <img src="<?= Yii::$app->homeUrl ?>image/Round-Bangladesh.png" class="width-Round-table"> Dhaka, BD</td>
                            <td>Variable ratio</td>
                            <td>Quarterly</td>
                            <td>=1,000,000</td>
                            <td>৳800,000</td>
                            <td>80%</td>
                            <td>458,764,554</td>
                            <td>3</td>
                            <td>4</td>
                            <td>
                                <i class="fa fa-eye buttton-eye" aria-hidden="true"></i>
                                <i class="fa fa-pencil-square-o button-pencil" aria-hidden="true" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"></i>
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form>
                                                    <div class="col-12">
                                                        <label for="recipient-name" class="col-form-label"><span class="red">*</span> KGI1 Name</label>
                                                        <input type="text" class="form-control" id="recipient-name">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <label for="message-text" class="col-form-label"><span class="red">*</span> KGI 1 Description</label>
                                                            <textarea class="form-control" id="message-text"></textarea>
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="message-text" class="col-form-label"><span class="red">*</span> Unit </label>
                                                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                                <button type="button" class="btn btn-outline-primary">Monthly</button>
                                                                <button type="button" class="btn btn-outline-primary">Weekly</button>
                                                                <button type="button" class="btn btn-outline-primary">Daily</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="recipient-name" class="col-form-label"><span class="red">*</span> Company</label>
                                                        <input type="text" class="form-control" id="recipient-name">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <label for="exampleFormControlInput1" class="form-label"><span class="red">*</span> Branch</label>
                                                            <select class="form-select" aria-label="Default select example">
                                                                <option selected></option>
                                                                <option value="1">One</option>
                                                                <option value="2">Two</option>
                                                                <option value="3">Three</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-4">
                                                            <label for="exampleFormControlInput1" class="form-label"><span class="red">*</span> Start Date</label>
                                                            <input type="date" class="form-control" id="exampleFormControlInput1" placeholder="">
                                                        </div>
                                                        <div class="col-4">
                                                            <label for="exampleFormControlInput1" class="form-label"><span class="red">*</span> End Date</label>
                                                            <input type="date" class="form-control" id="exampleFormControlInput1" placeholder="">
                                                        </div>
                                                        <div class="col-6 mt-10">
                                                            <label for="exampleFormControlInput1" class="form-label"><span class="red">*</span> Title</label>
                                                            <select class="form-select" aria-label="Default select example">
                                                                <option selected></option>
                                                                <option value="1">One</option>
                                                                <option value="2">Two</option>
                                                                <option value="3">Three</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-6 mt-20">
                                                            <label for="exampleFormControlInput1" class="form-label"> Assigned Employee</label>
                                                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Use @ tag to Assign an employee">
                                                        </div>
                                                        <div class="col-6 mt-10">
                                                            <label for="exampleFormControlInput1" class="form-label"> Target Amount</label>
                                                            <div class="input-group mb-3">
                                                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">BDT</button>
                                                                <ul class="dropdown-menu">
                                                                    <li><a class="dropdown-item" href="#">10,000,000</a></li>
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
                                                        <div class="col-6 mt-10">
                                                            <label for="exampleFormControlInput1" class="form-label"> Achievement</label>
                                                            <div class="input-group mb-3">
                                                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">BDT</button>
                                                                <ul class="dropdown-menu">
                                                                    <li><a class="dropdown-item" href="#">8000,00</a></li>
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
                                                        <div class="col-6">
                                                            <label for="exampleFormControlInput1" class="form-label"><span class="red">*</span> Amount Type </label>
                                                            <select class="form-select" aria-label="Default select example">
                                                                <option selected>& or number</option>
                                                                <option value="1">One</option>
                                                                <option value="2">Two</option>
                                                                <option value="3">Three</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="exampleFormControlInput1" class="form-label"><span class="red">*</span> Check</label>
                                                            <select class="form-select" aria-label="Default select example">
                                                                <option selected>& or number</option>
                                                                <option value="1">One</option>
                                                                <option value="2">Two</option>
                                                                <option value="3">Three</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-4 mt-10">
                                                            <label for="exampleFormControlInput1" class="form-label"> Progress</label>
                                                            <div class="progress">
                                                                <div class="progress-bar" role="progressbar" style="width: 60%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">60%</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-4 mt-10">
                                                            <label for="exampleFormControlInput1" class="form-label"> Active</label>
                                                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Yes or no">
                                                        </div>
                                                        <div class="col-4 mt-10">
                                                            <i class="fa fa-tag" aria-hidden="true"></i> Tags (Maximum 10)
                                                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="button" class="btn btn-primary">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <i class="fa fa-trash buton-delete" aria-hidden="true" data-bs-toggle="modal" data-bs-target="#staticBackdrop"></i>
                                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel"></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body want-delete">
                                                Do You Want To Delete?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="button" class="btn btn-primary">Confirm</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Q1 - 23</td>
                            <td> <img src="<?= Yii::$app->homeUrl ?>image/Round-Bangladesh.png" class="width-Round-table"> Dhaka, BD</td>
                            <td>Labor ratio</td>
                            <td>Quarterly</td>
                            <td>>1,000,000</td>
                            <td>৳800,000</td>
                            <td>80%</td>
                            <td>458,764,554</td>
                            <td>3</td>
                            <td>4</td>
                            <td>
                                <i class="fa fa-eye buttton-eye" aria-hidden="true"></i>
                                <i class="fa fa-pencil-square-o button-pencil" aria-hidden="true" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"></i>
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form>
                                                    <div class="col-12">
                                                        <label for="recipient-name" class="col-form-label"><span class="red">*</span> KGI1 Name</label>
                                                        <input type="text" class="form-control" id="recipient-name">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <label for="message-text" class="col-form-label"><span class="red">*</span> KGI 1 Description</label>
                                                            <textarea class="form-control" id="message-text"></textarea>
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="message-text" class="col-form-label"><span class="red">*</span> Unit </label>
                                                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                                <button type="button" class="btn btn-outline-primary">Monthly</button>
                                                                <button type="button" class="btn btn-outline-primary">Weekly</button>
                                                                <button type="button" class="btn btn-outline-primary">Daily</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="recipient-name" class="col-form-label"><span class="red">*</span> Company</label>
                                                        <input type="text" class="form-control" id="recipient-name">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <label for="exampleFormControlInput1" class="form-label"><span class="red">*</span> Branch</label>
                                                            <select class="form-select" aria-label="Default select example">
                                                                <option selected></option>
                                                                <option value="1">One</option>
                                                                <option value="2">Two</option>
                                                                <option value="3">Three</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-4">
                                                            <label for="exampleFormControlInput1" class="form-label"><span class="red">*</span> Start Date</label>
                                                            <input type="date" class="form-control" id="exampleFormControlInput1" placeholder="">
                                                        </div>
                                                        <div class="col-4">
                                                            <label for="exampleFormControlInput1" class="form-label"><span class="red">*</span> End Date</label>
                                                            <input type="date" class="form-control" id="exampleFormControlInput1" placeholder="">
                                                        </div>
                                                        <div class="col-6 mt-10">
                                                            <label for="exampleFormControlInput1" class="form-label"><span class="red">*</span> Title</label>
                                                            <select class="form-select" aria-label="Default select example">
                                                                <option selected></option>
                                                                <option value="1">One</option>
                                                                <option value="2">Two</option>
                                                                <option value="3">Three</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-6 mt-20">
                                                            <label for="exampleFormControlInput1" class="form-label"> Assigned Employee</label>
                                                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Use @ tag to Assign an employee">
                                                        </div>
                                                        <div class="col-6 mt-10">
                                                            <label for="exampleFormControlInput1" class="form-label"> Target Amount</label>
                                                            <div class="input-group mb-3">
                                                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">BDT</button>
                                                                <ul class="dropdown-menu">
                                                                    <li><a class="dropdown-item" href="#">10,000,000</a></li>
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
                                                        <div class="col-6 mt-10">
                                                            <label for="exampleFormControlInput1" class="form-label"> Achievement</label>
                                                            <div class="input-group mb-3">
                                                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">BDT</button>
                                                                <ul class="dropdown-menu">
                                                                    <li><a class="dropdown-item" href="#">8000,00</a></li>
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
                                                        <div class="col-6">
                                                            <label for="exampleFormControlInput1" class="form-label"><span class="red">*</span> Amount Type </label>
                                                            <select class="form-select" aria-label="Default select example">
                                                                <option selected>& or number</option>
                                                                <option value="1">One</option>
                                                                <option value="2">Two</option>
                                                                <option value="3">Three</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="exampleFormControlInput1" class="form-label"><span class="red">*</span> Check</label>
                                                            <select class="form-select" aria-label="Default select example">
                                                                <option selected>& or number</option>
                                                                <option value="1">One</option>
                                                                <option value="2">Two</option>
                                                                <option value="3">Three</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-4 mt-10">
                                                            <label for="exampleFormControlInput1" class="form-label"> Progress</label>
                                                            <div class="progress">
                                                                <div class="progress-bar" role="progressbar" style="width: 60%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">60%</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-4 mt-10">
                                                            <label for="exampleFormControlInput1" class="form-label"> Active</label>
                                                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Yes or no">
                                                        </div>
                                                        <div class="col-4 mt-10">
                                                            <i class="fa fa-tag" aria-hidden="true"></i> Tags (Maximum 10)
                                                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="button" class="btn btn-primary">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <i class="fa fa-trash buton-delete" aria-hidden="true" data-bs-toggle="modal" data-bs-target="#staticBackdrop"></i>
                                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel"></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body want-delete">
                                                Do You Want To Delete?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="button" class="btn btn-primary">Confirm</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Q1 - 23</td>
                            <td> <img src="<?= Yii::$app->homeUrl ?>image/Round-Bangladesh.png" class="width-Round-table"> Dhaka, BD</td>
                            <td>Labor Productivity</td>
                            <td>Quarterly</td>
                            <td>>1,000,000</td>
                            <td>৳800,000</td>
                            <td>80%</td>
                            <td>458,764,554</td>
                            <td>3</td>
                            <td>4</td>
                            <td>
                                <i class="fa fa-eye buttton-eye" aria-hidden="true"></i>
                                <i class="fa fa-pencil-square-o button-pencil" aria-hidden="true" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"></i>
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form>
                                                    <div class="col-12">
                                                        <label for="recipient-name" class="col-form-label"><span class="red">*</span> KGI1 Name</label>
                                                        <input type="text" class="form-control" id="recipient-name">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <label for="message-text" class="col-form-label"><span class="red">*</span> KGI 1 Description</label>
                                                            <textarea class="form-control" id="message-text"></textarea>
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="message-text" class="col-form-label"><span class="red">*</span> Unit </label>
                                                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                                <button type="button" class="btn btn-outline-primary">Monthly</button>
                                                                <button type="button" class="btn btn-outline-primary">Weekly</button>
                                                                <button type="button" class="btn btn-outline-primary">Daily</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="recipient-name" class="col-form-label"><span class="red">*</span> Company</label>
                                                        <input type="text" class="form-control" id="recipient-name">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <label for="exampleFormControlInput1" class="form-label"><span class="red">*</span> Branch</label>
                                                            <select class="form-select" aria-label="Default select example">
                                                                <option selected></option>
                                                                <option value="1">One</option>
                                                                <option value="2">Two</option>
                                                                <option value="3">Three</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-4">
                                                            <label for="exampleFormControlInput1" class="form-label"><span class="red">*</span> Start Date</label>
                                                            <input type="date" class="form-control" id="exampleFormControlInput1" placeholder="">
                                                        </div>
                                                        <div class="col-4">
                                                            <label for="exampleFormControlInput1" class="form-label"><span class="red">*</span> End Date</label>
                                                            <input type="date" class="form-control" id="exampleFormControlInput1" placeholder="">
                                                        </div>
                                                        <div class="col-6 mt-10">
                                                            <label for="exampleFormControlInput1" class="form-label"><span class="red">*</span> Title</label>
                                                            <select class="form-select" aria-label="Default select example">
                                                                <option selected></option>
                                                                <option value="1">One</option>
                                                                <option value="2">Two</option>
                                                                <option value="3">Three</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-6 mt-20">
                                                            <label for="exampleFormControlInput1" class="form-label"> Assigned Employee</label>
                                                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Use @ tag to Assign an employee">
                                                        </div>
                                                        <div class="col-6 mt-10">
                                                            <label for="exampleFormControlInput1" class="form-label"> Target Amount</label>
                                                            <div class="input-group mb-3">
                                                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">BDT</button>
                                                                <ul class="dropdown-menu">
                                                                    <li><a class="dropdown-item" href="#">10,000,000</a></li>
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
                                                        <div class="col-6 mt-10">
                                                            <label for="exampleFormControlInput1" class="form-label"> Achievement</label>
                                                            <div class="input-group mb-3">
                                                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">BDT</button>
                                                                <ul class="dropdown-menu">
                                                                    <li><a class="dropdown-item" href="#">8000,00</a></li>
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
                                                        <div class="col-6">
                                                            <label for="exampleFormControlInput1" class="form-label"><span class="red">*</span> Amount Type </label>
                                                            <select class="form-select" aria-label="Default select example">
                                                                <option selected>& or number</option>
                                                                <option value="1">One</option>
                                                                <option value="2">Two</option>
                                                                <option value="3">Three</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="exampleFormControlInput1" class="form-label"><span class="red">*</span> Check</label>
                                                            <select class="form-select" aria-label="Default select example">
                                                                <option selected>& or number</option>
                                                                <option value="1">One</option>
                                                                <option value="2">Two</option>
                                                                <option value="3">Three</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-4 mt-10">
                                                            <label for="exampleFormControlInput1" class="form-label"> Progress</label>
                                                            <div class="progress">
                                                                <div class="progress-bar" role="progressbar" style="width: 60%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">60%</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-4 mt-10">
                                                            <label for="exampleFormControlInput1" class="form-label"> Active</label>
                                                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Yes or no">
                                                        </div>
                                                        <div class="col-4 mt-10">
                                                            <i class="fa fa-tag" aria-hidden="true"></i> Tags (Maximum 10)
                                                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="button" class="btn btn-primary">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <i class="fa fa-trash buton-delete" aria-hidden="true" data-bs-toggle="modal" data-bs-target="#staticBackdrop"></i>
                                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel"></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body want-delete">
                                                Do You Want To Delete?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="button" class="btn btn-primary">Confirm</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
            </div>
        </div>
    </div>
</div>