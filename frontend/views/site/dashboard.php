<?php

/** @var yii\web\View $this */

use yii\bootstrap5\Carousel;

$this->title = 'Dashboard';
?>


<div class="col-12">
    <div class="col-6 table-KPI">
        <p>KPI & KGI Management</p>
    </div>
    <div class="row">
        <div class="col-lg-12">

            <!-- <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true"> <i class="fa fa-list-ol" aria-hidden="true"></i> &nbsp; &nbsp;All</button>
                    <div class="col">
                        <select class="form-select branch-select" aria-label="Default select example">
                            <option selected>KGI/KPI</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false"> <i class="fa fa-flag-o" aria-hidden="true"></i> &nbsp; &nbsp;KGI 1 </button>
                    <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false"> <i class="fa fa-flag-o" aria-hidden="true"></i> KGI 2</button>
                    <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false"> <i class="fa fa-bullseye" aria-hidden="true"></i> KPI1</button>
                    <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false"> <i class="fa fa-bullseye" aria-hidden="true"></i> KPI2</button>
                    <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false"> <i class="fa fa-calendar-minus-o" aria-hidden="true"></i> Previous Activity</button>
                    <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups" style="margin-left: 180px;">
                        <div class="btn-group pr-10" role="group" aria-label="First group">
                            <button type="button" class="btn btn-outline-primary">month</button>
                            <button type="button" class="btn btn-outline-primary">week</button>
                            <button type="button" class="btn btn-outline-primary">day</button>
                            <button type="button" class="btn btn-outline-primary">filter by</button>
                        </div>
                    </div>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-primary"> <i class="fa fa-angle-left" aria-hidden="true"></i></button>
                        <button type="button" class="btn btn-primary"> <i class="fa fa-angle-right" aria-hidden="true"></i></button>
                    </div>
                </div> -->

            <!-- <div class="col-lg-12 mt-40 font-title">
                    <div class="row">
                        <div class="col">
                            <button type="button" class="btn btn-outline-dark branch-eye"> 25 &nbsp;<i class="fa fa-eye" aria-hidden="true"></i></button>
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-outline-dark branch-Export" data-mdb-ripple-color="dark"> Export </button>
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-outline-dark branch-refresh" data-mdb-ripple-color="dark"><i class="fa fa-refresh" aria-hidden="true"></i></button>
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-outline-dark branch-filter" data-mdb-ripple-color="dark"> <i class="fa fa-filter" aria-hidden="true"></i> </button>
                        </div>
                        <div class="col">
                            <select class="form-select branch-select" aria-label="Default select example">
                                <option selected>KGI/KPI</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col">
                            <select class="form-select select-departments" aria-label="Default select example">
                                <option selected>Departments</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col">
                            <select class="form-select select-team" aria-label="Default select example">
                                <option selected>Team</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col">
                            <select class="form-select select-title" aria-label="Default select example">
                                <option selected>Title</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col">
                            <select class="form-select select-employee" aria-label="Default select example">
                                <option selected>Employee</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col">
                            <div class="input-group mb-3 group-date-from" action="/action_page.php">
                                <span class="input-group-text group-text-from" id="inputGroup-sizing-default">From</span>
                                <input type="date" id="birthday" class="form-control control-day" name="birthday" aria-label="Sizing example input" aria-describedby="">
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-group mb-3 group-date-to" action="/action_page.php">
                                <span class="input-group-text group-text-from" id="inputGroup-sizing-default">To</span>
                                <input type="date" id="birthday" class="form-control control-day" name="birthday" aria-label="Sizing example input" aria-describedby="">
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-group flex-nowrap search-submit">
                                <button type="submit" class="btn btn-outline-dark"><i class="fa fa-search" aria-hidden="true"></i></button>
                                <input type="search" class="form-control label-search" placeholder="search" aria-label="search" aria-describedby="addon-wrapping">
                            </div>
                        </div>
                    </div> -->
            <!-- <div class="tab-content" id="nav-tabContent">
                    <table class="table table-striped">
                        <thead>
                            <thead>
                                <tr>
                                    <th>Branch</th>
                                    <th>Contents</th>
                                    <th>Unit</th>
                                    <th>Target</th>
                                    <th>Result</th>
                                    <th>Achieved Ratio</th>
                                    <th>Finance</th>
                                    <th>KGI2</th>
                                    <th>KPI</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                        </thead>
                        <tbody class="tdody-font">
                            <tr>
                                <td>
                                    <table class="table mb-0"> <img src="<?= Yii::$app->homeUrl ?>image/Round-Bangladesh.png" class="width-Round-Bangladesh"> Bangladesh</table>
                                </td>
                                <td>
                                    <table class="table mb-0 txt-sales"> Sales</table>
                                </td>
                                <td>
                                    <table class="table mb-0"> Month </table>
                                </td>
                                <td>
                                    <table class="table mb-0"> ৳1,000,000 </table>
                                </td>
                                <td>
                                    <table class="table mb-0"> ৳800,000 </table>
                                </td>
                                <td>
                                    <table class="table mb-0"> 80%</table>
                                </td>
                                <td>
                                    <table class="table mb-0"> Data</table>
                                </td>
                                <td>
                                    <table class="table mb-0"> 3</table>
                                </td>
                                <td>
                                    <table class="table mb-0"> 4</table>
                                </td>
                                <td>
                                    <table class="table mb-0">
                                        <button type="button" class="btn  btn-outline-secondary"> <i class="fa fa-eye" aria-hidden="true"></i></button>&nbsp;
                                        <button type="button" class="btn  btn-outline-secondary"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>&nbsp;
                                        <button type="button" class="btn  btn-outline-secondary"> <i class="fa fa-plus-circle" aria-hidden="true"></i></button>&nbsp;
                                        <button type="button" class="btn  btn-outline-danger"> <i class="fa fa-trash" aria-hidden="true"></i></button>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table class="table mb-0"> <img src="<?= Yii::$app->homeUrl ?>image/Round-Bangladesh.png" class="width-Round-Bangladesh"> Bangladesh</table>
                                </td>
                                <td>
                                    <table class="table mb-0"> Sales</table>
                                </td>
                                <td>
                                    <table class="table mb-0"> Month </table>
                                </td>
                                <td>
                                    <table class="table mb-0"> ৳1,000,000 </table>
                                </td>
                                <td>
                                    <table class="table mb-0"> ৳800,000 </table>
                                </td>
                                <td>
                                    <table class="table mb-0"> 80%</table>
                                </td>
                                <td>
                                    <table class="table mb-0"> Data</table>
                                </td>
                                <td>
                                    <table class="table mb-0"> 3</table>
                                </td>
                                <td>
                                    <table class="table mb-0"> 4</table>
                                </td>
                                <td>
                                    <table class="table mb-0">
                                        <button type="button" class="btn  btn-outline-secondary"> <i class="fa fa-eye" aria-hidden="true"></i></button>&nbsp;
                                        <button type="button" class="btn  btn-outline-secondary"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>&nbsp;
                                        <button type="button" class="btn  btn-outline-secondary"> <i class="fa fa-plus-circle" aria-hidden="true"></i></button>&nbsp;
                                        <button type="button" class="btn  btn-outline-danger"> <i class="fa fa-trash" aria-hidden="true"></i></button>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table class="table mb-0"> <img src="<?= Yii::$app->homeUrl ?>image/Round-Bangladesh.png" class="width-Round-Bangladesh"> Bangladesh</table>
                                </td>
                                <td>
                                    <table class="table mb-0"> Sales</table>
                                </td>
                                <td>
                                    <table class="table mb-0"> Month </table>
                                </td>
                                <td>
                                    <table class="table mb-0"> ৳1,000,000 </table>
                                </td>
                                <td>
                                    <table class="table mb-0"> ৳800,000 </table>
                                </td>
                                <td>
                                    <table class="table mb-0"> 80%</table>
                                </td>
                                <td>
                                    <table class="table mb-0"> Data</table>
                                </td>
                                <td>
                                    <table class="table mb-0"> 3</table>
                                </td>
                                <td>
                                    <table class="table mb-0"> 4</table>
                                </td>
                                <td>
                                    <table class="table mb-0">
                                        <button type="button" class="btn  btn-outline-secondary"> <i class="fa fa-eye" aria-hidden="true"></i></button>&nbsp;
                                        <button type="button" class="btn  btn-outline-secondary"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>&nbsp;
                                        <button type="button" class="btn  btn-outline-secondary"> <i class="fa fa-plus-circle" aria-hidden="true"></i></button>&nbsp;
                                        <button type="button" class="btn  btn-outline-danger"> <i class="fa fa-trash" aria-hidden="true"></i></button>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

                    </div>
                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">

                    </div>
                </div> -->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true"><i class="fa fa-list-ol" aria-hidden="true"></i> &nbsp; &nbsp;All</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="branch-tab" data-bs-toggle="tab" data-bs-target="#branch" type="button" role="tab" aria-controls="branch" aria-selected="false">
                        <select class="form-select branch-select" aria-label="Default select example">
                            <option selected>branch</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="departments-tab" data-bs-toggle="tab" data-bs-target="#departments" type="button" role="tab" aria-controls="departments" aria-selected="false">
                        <select class="form-select select-departments" aria-label="Default select example">
                            <option selected>departments</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="Team-tab" data-bs-toggle="tab" data-bs-target="#Team" type="button" role="tab" aria-controls="Team" aria-selected="false">
                        <select class="form-select select-team" aria-label="Default select example">
                            <option selected>Team</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="title-tab" data-bs-toggle="tab" data-bs-target="#title" type="button" role="tab" aria-controls="title" aria-selected="false">
                        <select class="form-select select-title" aria-label="Default select example">
                            <option selected>Title</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="employee-tab" data-bs-toggle="tab" data-bs-target="#employee" type="button" role="tab" aria-controls="employee" aria-selected="false">
                        <select class="form-select select-employee" aria-label="Default select example">
                            <option selected>Employee</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </button>
                </li>
                <div class="col-lg-2 ml-20 mt-10">
                    <div class="input-group mb-3 group-date-from" action="/action_page.php">
                        <span class="input-group-text group-text-from" id="inputGroup-sizing-default">From</span>
                        <input type="date" id="birthday" class="form-control control-day" name="birthday" aria-label="Sizing example input" aria-describedby="">
                    </div>
                </div>
                <div class="col-lg-2 mt-10">
                    <div class="input-group mb-3 group-date-to" action="/action_page.php">
                        <span class="input-group-text group-text-to" id="inputGroup-sizing-default">To</span>
                        <input type="date" id="birthday" class="form-control control-day" name="birthday" aria-label="Sizing example input" aria-describedby="">
                    </div>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="col-12">
                    <div class="row">
                        <div class="col-lg-2 col-md-6 col-12">
                            <div class="tab-pane fade show active show-fade-one" id="home" role="tabpanel" aria-labelledby="home-tab">KGI Group Dashboard</div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-12">
                            <button type="submit" class="btn btn-success title-Update"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Create KGI 1 Group</button>
                        </div>
                        <div class="col-lg-2 col-md-6 col-12 title-Respiratory">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> KGI 1 Respiratory</button>
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
                                <button type="button" class="btn btn-outline-primary"><i class="fa fa-th-large" aria-hidden="true"></i> Calendrer</button>
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
                            <td><i class="fa fa-eye buttton-eye" aria-hidden="true"></i>
                                <i class="fa fa-pencil-square-o button-pencil" aria-hidden="true"></i>
                                <i class="fa fa-plus-square button-plus" aria-hidden="true"></i>
                                <i class="fa fa-trash buton-delete" aria-hidden="true"></i>
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
                            <td><i class="fa fa-eye buttton-eye" aria-hidden="true"></i>
                                <i class="fa fa-pencil-square-o button-pencil" aria-hidden="true"></i>
                                <i class="fa fa-plus-square button-plus" aria-hidden="true"></i>
                                <i class="fa fa-trash buton-delete" aria-hidden="true"></i>
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
                            <td><i class="fa fa-eye buttton-eye" aria-hidden="true"></i>
                                <i class="fa fa-pencil-square-o button-pencil" aria-hidden="true"></i>
                                <i class="fa fa-plus-square button-plus" aria-hidden="true"></i>
                                <i class="fa fa-trash buton-delete" aria-hidden="true"></i>
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
                            <td><i class="fa fa-eye buttton-eye" aria-hidden="true"></i>
                                <i class="fa fa-pencil-square-o button-pencil" aria-hidden="true"></i>
                                <i class="fa fa-plus-square button-plus" aria-hidden="true"></i>
                                <i class="fa fa-trash buton-delete" aria-hidden="true"></i>
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
                            <td><i class="fa fa-eye buttton-eye" aria-hidden="true"></i>
                                <i class="fa fa-pencil-square-o button-pencil" aria-hidden="true"></i>
                                <i class="fa fa-plus-square button-plus" aria-hidden="true"></i>
                                <i class="fa fa-trash buton-delete" aria-hidden="true"></i>
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
                            <td><i class="fa fa-eye buttton-eye" aria-hidden="true"></i>
                                <i class="fa fa-pencil-square-o button-pencil" aria-hidden="true"></i>
                                <i class="fa fa-plus-square button-plus" aria-hidden="true"></i>
                                <i class="fa fa-trash buton-delete" aria-hidden="true"></i>
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
                            <td><i class="fa fa-eye buttton-eye" aria-hidden="true"></i>
                                <i class="fa fa-pencil-square-o button-pencil" aria-hidden="true"></i>
                                <i class="fa fa-plus-square button-plus" aria-hidden="true"></i>
                                <i class="fa fa-trash buton-delete" aria-hidden="true"></i>
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
                            <td><i class="fa fa-eye buttton-eye" aria-hidden="true"></i>
                                <i class="fa fa-pencil-square-o button-pencil" aria-hidden="true"></i>
                                <i class="fa fa-plus-square button-plus" aria-hidden="true"></i>
                                <i class="fa fa-trash buton-delete" aria-hidden="true"></i>
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
                            <td><i class="fa fa-eye buttton-eye" aria-hidden="true"></i>
                                <i class="fa fa-pencil-square-o button-pencil" aria-hidden="true"></i>
                                <i class="fa fa-plus-square button-plus" aria-hidden="true"></i>
                                <i class="fa fa-trash buton-delete" aria-hidden="true"></i>
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
                            <td><i class="fa fa-eye buttton-eye" aria-hidden="true"></i>
                                <i class="fa fa-pencil-square-o button-pencil" aria-hidden="true"></i>
                                <i class="fa fa-plus-square button-plus" aria-hidden="true"></i>
                                <i class="fa fa-trash buton-delete" aria-hidden="true"></i>
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