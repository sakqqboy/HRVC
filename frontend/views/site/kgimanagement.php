<?php

$this->title = 'Dashboard';
?>
<div class="col-12">
    <div class="row">
        <div class="col-6 table-KPI">
            <p>KGI Management</p>
        </div>
        <div class="col-6 text-end title-Update">
            <button type="submit" class="btn btn-success"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Update KPI/KGI </button>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true"> <i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp; &nbsp;All</button>
                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false"> <i class="fa fa-flag-o" aria-hidden="true"></i>&nbsp; &nbsp;KGI 1 </button>
                <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false"> <i class="fa fa-flag-o" aria-hidden="true"></i>&nbsp; &nbsp;KGI 2</button>
                <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false"> <i class="fa fa-bullseye" aria-hidden="true"></i>&nbsp; &nbsp;KPI1</button>
                <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false"> <i class="fa fa-bullseye" aria-hidden="true"></i>&nbsp; &nbsp;KPI2</button>
                <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false"> <i class="fa fa-calendar-o" aria-hidden="true"></i>&nbsp; &nbsp;Previous Activity</button>
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
            </div>

            <div class="col-lg-12 mt-40 font-title1">
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
                        <select class="form-select branch-select1" aria-label="Default select example">
                            <option selected>KGI/KPI</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div class="col">
                        <select class="form-select select-departments1" aria-label="Default select example">
                            <option selected>Departments</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div class="col">
                        <select class="form-select select-team1" aria-label="Default select example">
                            <option selected>Team</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div class="col">
                        <select class="form-select select-title1" aria-label="Default select example">
                            <option selected>Title</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div class="col">
                        <select class="form-select select-employee1" aria-label="Default select example">
                            <option selected>Employee</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div class="col">
                        <div class="input-group mb-3 group-date-from1" action="/action_page.php">
                            <span class="input-group-text group-text-from1" id="inputGroup-sizing-default">From</span>
                            <input type="date" id="birthday" class="form-control control-day1" name="birthday" aria-label="Sizing example input" aria-describedby="">
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-group mb-3 group-date-to1" action="/action_page.php">
                            <span class="input-group-text group-text-to1" id="inputGroup-sizing-default">To</span>
                            <input type="date" id="birthday" class="form-control control-day1" name="birthday" aria-label="Sizing example input" aria-describedby="">
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-group flex-nowrap search-submit">
                            <button type="submit" class="btn btn-outline-dark"><i class="fa fa-search" aria-hidden="true"></i></button>
                            <input type="search" class="form-control label-search" placeholder="search" aria-label="search" aria-describedby="addon-wrapping">
                        </div>
                    </div>
                </div>
                <div class="tab-content" id="nav-tabContent">
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
                </div>
            </div>
        </div>
    </div>
</div>

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