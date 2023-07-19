<?php

$this->title = 'Dashboard';

?>
<div class="col-12">
    <div class="col-6 table-KPI">
        <p>KGI Management</p>
    </div>
</div>

<div class="col-12">
    <div class="row">
        <div class="col-lg-8 col-md-6 col-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th><i class="fa fa-list-ol" aria-hidden="true"></i> All KPI</th>
                        <th><i class="fa fa-flag-o" aria-hidden="true"></i> KGI 1</th>
                        <th><i class="fa fa-flag-o" aria-hidden="true"></i> KGI 2</th>
                        <th><i class="fa fa-bullseye" aria-hidden="true"></i> KPI1</th>
                        <th><i class="fa fa-bullseye" aria-hidden="true"></i> KPI2</th>
                        <th><i class="fa fa-calendar-o" aria-hidden="true"></i> Previous Activity</th>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="col-lg-3">
            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                <div class="btn-group" role="group" aria-label="First group">
                    <button type="button" class="btn btn-outline-primary">month</button>
                    <button type="button" class="btn btn-outline-primary">week</button>
                    <button type="button" class="btn btn-outline-primary">day</button>
                    <button type="button" class="btn btn-outline-primary">filter by</button>
                </div>
            </div>
        </div>
        <div class="col-lg-1 r-l">
            <div class="btn-group" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-primary"> <i class="fa fa-angle-left" aria-hidden="true"></i></button>
                <button type="button" class="btn btn-primary"> <i class="fa fa-angle-right" aria-hidden="true"></i></button>
            </div>
        </div>
    </div>
    <div class="col-12 mt-20">
        <div class="row">
            <div class="col-3">
                <button type="button" class="btn btn-outline-dark twenty">25 <i class="fa fa-eye" aria-hidden="true"></i></button>
                <button type="button" class="btn btn-outline-dark branch-Export" data-mdb-ripple-color="dark"> Export </button>
                <button type="button" class="btn btn-outline-dark branch-refresh" data-mdb-ripple-color="dark"><i class="fa fa-refresh" aria-hidden="true"></i></button>
                <button type="button" class="btn btn-outline-dark branch-filter" data-mdb-ripple-color="dark"> <i class="fa fa-filter" aria-hidden="true"></i> </button>
            </div>
            <div class="col-lg-1 col-6">
                <select class="form-select select-1" aria-label="Default select example">
                    <option selected>KGI/KPI</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>
            <div class="col-lg-1 col-6">
                <select class="form-select select-departments1" aria-label="Default select example">
                    <option selected>Departments</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>
            <div class="col-lg-1 col-6">
                <select class="form-select select-team1" aria-label="Default select example">
                    <option selected>Team</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>
            <div class="col-lg-2 col-6">
                <select class="form-select select-title1" aria-label="Default select example">
                    <option selected>Title</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>
            <div class="col-lg-1 col-6">
                <select class="form-select select-employee1" aria-label="Default select example">
                    <option selected>Employee</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>
            <div class="col-lg-2 col-6">
                <div class="input-group mb-3 group-date-from1" action="/action_page.php">
                    <span class="input-group-text group-text-from1" id="inputGroup-sizing-default">From</span>
                    <input type="date" id="birthday" class="form-control control-day1" name="birthday" aria-label="Sizing example input" aria-describedby="">
                </div>
            </div>
            <div class="col-lg-2 col-6">
                <div class="input-group mb-3 group-date-to1" action="/action_page.php">
                    <span class="input-group-text group-text-to1" id="inputGroup-sizing-default">To</span>
                    <input type="date" id="birthday" class="form-control control-day1" name="birthday" aria-label="Sizing example input" aria-describedby="">
                </div>
                <form class="d-flex search-submit">
                    <input class="form-control me-2 label-search" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success success-search" type="submit"><i class="fa fa-search success-search" aria-hidden="true"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>

<table class="table table-bordered mt-20">
    <thead>
        <thead>
            <tr>
                <th class="text-center">Branch</th>
                <th class="text-center">Contents</th>
                <th class="text-center">Unit</th>
                <th class="text-center">Target</th>
                <th class="text-center">Result</th>
                <th class="text-center">Achieved Ratio</th>
                <th class="text-center">Finance</th>
                <th class="text-center">KGI2</th>
                <th class="text-center">KPI</th>
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


<div class="col-12">
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <div class="card card-border">
                <div class="card-body">
                    <i class="fa fa-glass" aria-hidden="true"></i> Achievement Ratio <span class="space"> 4/10</span>
                    <div class="progress" style="height: 5px;margin-top: 20px;">
                        <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <div class="card card-border">
                <div class="card-body">
                    <i class="fa fa-trophy" aria-hidden="true"></i> Missed or Unachieved <span class="space"> 2/4</span>
                    <div class="progress" style="height: 5px;margin-top: 20px;">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 60%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <div class="card card-border">
                <div class="card-body">
                    <i class="fa fa-flag-o" aria-hidden="true"></i></i> KPI In Progress<span class="space"> 4/6</span>
                    <div class="progress" style="height: 5px;margin-top: 20px;">
                        <div class="progress-bar" role="progressbar" style="width: 80%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <div class="card card-border">
                <div class="card-body">
                    <i class="fa fa-bullseye" aria-hidden="true"></i> KGI In Progress<span class="space"> 4/6</span>
                    <div class="progress" style="height: 5px;margin-top: 20px;">
                        <div class="progress-bar" role="progressbar" style="width: 85%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>