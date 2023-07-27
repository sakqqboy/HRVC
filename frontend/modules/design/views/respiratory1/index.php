<?php

/** @var yii\web\View $this */

$this->title = 'KPI 1 Respiratory ';
?>

<div class="col-12" style="margin-top: 120px;">
    <div class="row">
        <div class="col-lg-3 Respiratory1">
            KPI1 Respiratory
        </div>
        <div class="col-lg-3">
            <a href="<?= Yii::$app->homeUrl ?>site/create1"> <button class="btn btn-success" type="submit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Creatae KPI1 Group </button></a>
        </div>
        <div class="col-lg-6 text-end">
            <div class="row">
                <div class="col-6">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="birthday1">From</span>
                        <input type="date" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                </div>
                <div class="col-6">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="birthday1">To</span>
                        <input type="date" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 mt-20">
        <div class="row">
            <div class="col-lg-6">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation" style="color:backpx;">
                        <button class="nav-link active" id="all1-tab" data-bs-toggle="tab" data-bs-target="#all1" type="button" role="tab" aria-controls="all-1" aria-selected="true">All</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Company</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Title</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Status</button>
                    </li>
                </ul>
            </div>

            <div class="col-lg-6">
                <div class="row">
                    <div class="col-5">
                        12 <i class="fa fa-eye" aria-hidden="true"></i>
                        Export <i class="fa fa-refresh" aria-hidden="true"></i>
                    </div>
                    <div class="col-7 text-end">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-outline-primary"><i class="fa fa-list-ul" aria-hidden="true"></i> List</button>
                            <button type="button" class="btn btn-outline-primary"><i class="fa fa-th-large" aria-hidden="true"></i> Calendrer</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <table class="table table-bordered mt-30 table-font-small">
                    <thead>
                        <tr>
                            <th scope="col">SL</th>
                            <th scope="col">KPI1 Name</th>
                            <th scope="col">Company Name</th>
                            <th scope="col">Branch</th>
                            <th scope="col">Title</th>
                            <th scope="col">Target</th>
                            <th scope="col">Create Date</th>
                            <th scope="col">Deadline</th>
                            <th scope="col">Unit</th>
                            <th scope="col">Status</th>
                            <th scope="col">Achievement Ratio</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Increase Sales</td>
                            <td>Tokyo Consulting Firm Limited</td>
                            <td>Dhaka, BD </td>
                            <td>jr. Executive</td>
                            <td>৳1,000,000</td>
                            <td>07-12-2023</td>
                            <td>12-31-2023</td>
                            <td>Month</td>
                            <td>Active</td>
                            <td>
                                <div class="progress">
                                    <div class="progress-bar" style="width:50%; background:#2F80ED;"></div>
                                    <span class="badge rounded-pill  pro-load1">50%</span>
                                </div>
                            </td>
                            <td>
                                <i class="fa fa-eye buttton-eye1" aria-hidden="true"></i>
                                <i class="fa fa-pencil-square-o button-pencil1" aria-hidden="true" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"></i>
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
                                <i class="fa fa-trash buton-delete1" aria-hidden="true" data-bs-toggle="modal" data-bs-target="#staticBackdrop"></i>
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
                            <td>Increase Sales</td>
                            <td>Tokyo Consulting Firm Limited</td>
                            <td>Dhaka, BD </td>
                            <td>jr. Executive</td>
                            <td>৳1,000,000</td>
                            <td>07-12-2023</td>
                            <td>12-31-2023</td>
                            <td>Month</td>
                            <td>Finished</td>
                            <td>
                                <div class="progress">
                                    <div class="progress-bar" style="width:30%; background:#2F80ED;"></div>
                                    <span class="badge rounded-pill  pro-load1">30%</span>
                                </div>
                            </td>
                            <td>
                                <i class="fa fa-eye buttton-eye1" aria-hidden="true"></i>
                                <i class="fa fa-pencil-square-o button-pencil1" aria-hidden="true" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"></i>
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
                                <i class="fa fa-trash buton-delete1" aria-hidden="true" data-bs-toggle="modal" data-bs-target="#staticBackdrop"></i>
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
                            <td>Increase Sales</td>
                            <td>Tokyo Consulting Firm Limited</td>
                            <td>Dhaka, BD </td>
                            <td>jr. Executive</td>
                            <td>৳1,000,000</td>
                            <td>07-12-2023</td>
                            <td>12-31-2023</td>
                            <td>Month</td>
                            <td>Finished</td>
                            <td>
                                <div class="progress">
                                    <div class="progress-bar" style="width:30%; background:#2F80ED;"></div>
                                    <span class="badge rounded-pill  pro-load1">30%</span>
                                </div>
                            </td>
                            <td><i class="fa fa-eye buttton-eye1" aria-hidden="true"></i>
                                <i class="fa fa-pencil-square-o button-pencil1" aria-hidden="true"></i>
                                <i class="fa fa-trash buton-delete1" aria-hidden="true"></i>
                            </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Increase Sales</td>
                            <td>Tokyo Consulting Firm Limited</td>
                            <td>Dhaka, BD </td>
                            <td>jr. Executive</td>
                            <td>৳1,000,000</td>
                            <td>07-12-2023</td>
                            <td>12-31-2023</td>
                            <td>Month</td>
                            <td>Finished</td>
                            <td>
                                <div class="progress">
                                    <div class="progress-bar" style="width:30%; background:#2F80ED;"></div>
                                    <span class="badge rounded-pill  pro-load1">30%</span>
                                </div>
                            </td>
                            <td>
                                <i class="fa fa-eye buttton-eye1" aria-hidden="true"></i>
                                <i class="fa fa-pencil-square-o button-pencil1" aria-hidden="true" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"></i>
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
                                <i class="fa fa-trash buton-delete1" aria-hidden="true" data-bs-toggle="modal" data-bs-target="#staticBackdrop"></i>
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
                            <td>Increase Sales</td>
                            <td>Tokyo Consulting Firm Limited</td>
                            <td>Dhaka, BD </td>
                            <td>jr. Executive</td>
                            <td>৳1,000,000</td>
                            <td>07-12-2023</td>
                            <td>12-31-2023</td>
                            <td>Month</td>
                            <td>Finished</td>
                            <td>
                                <div class="progress">
                                    <div class="progress-bar" style="width:30%; background:#2F80ED;"></div>
                                    <span class="badge rounded-pill  pro-load1">30%</span>
                                </div>
                            </td>
                            <td>
                                <i class="fa fa-eye buttton-eye1" aria-hidden="true"></i>
                                <i class="fa fa-pencil-square-o button-pencil1" aria-hidden="true" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"></i>
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
                                <i class="fa fa-trash buton-delete1" aria-hidden="true" data-bs-toggle="modal" data-bs-target="#staticBackdrop"></i>
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
                            <td>Increase Sales</td>
                            <td>Tokyo Consulting Firm Limited</td>
                            <td>Dhaka, BD </td>
                            <td>jr. Executive</td>
                            <td>৳1,000,000</td>
                            <td>07-12-2023</td>
                            <td>12-31-2023</td>
                            <td>Month</td>
                            <td>Finished</td>
                            <td>
                                <div class="progress">
                                    <div class="progress-bar" style="width:30%; background:#2F80ED;"></div>
                                    <span class="badge rounded-pill  pro-load1">30%</span>
                                </div>
                            </td>
                            <td>
                                <i class="fa fa-eye buttton-eye1" aria-hidden="true"></i>
                                <i class="fa fa-pencil-square-o button-pencil1" aria-hidden="true" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"></i>
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
                                <i class="fa fa-trash buton-delete1" aria-hidden="true" data-bs-toggle="modal" data-bs-target="#staticBackdrop"></i>
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
                            <td>Increase Sales</td>
                            <td>Tokyo Consulting Firm Limited</td>
                            <td>Dhaka, BD </td>
                            <td>jr. Executive</td>
                            <td>৳1,000,000</td>
                            <td>07-12-2023</td>
                            <td>12-31-2023</td>
                            <td>Month</td>
                            <td>Finished</td>
                            <td>
                                <div class="progress">
                                    <div class="progress-bar" style="width:30%; background:#2F80ED;"></div>
                                    <span class="badge rounded-pill  pro-load1">30%</span>
                                </div>
                            </td>
                            <td>
                                <i class="fa fa-eye buttton-eye1" aria-hidden="true"></i>
                                <i class="fa fa-pencil-square-o button-pencil1" aria-hidden="true" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"></i>
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
                                <i class="fa fa-trash buton-delete1" aria-hidden="true" data-bs-toggle="modal" data-bs-target="#staticBackdrop"></i>
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
                            <td>Increase Sales</td>
                            <td>Tokyo Consulting Firm Limited</td>
                            <td>Dhaka, BD </td>
                            <td>jr. Executive</td>
                            <td>৳1,000,000</td>
                            <td>07-12-2023</td>
                            <td>12-31-2023</td>
                            <td>Month</td>
                            <td>Finished</td>
                            <td>
                                <div class="progress">
                                    <div class="progress-bar" style="width:30%; background:#2F80ED;"></div>
                                    <span class="badge rounded-pill  pro-load1">30%</span>
                                </div>
                            </td>
                            <td>
                                <i class="fa fa-eye buttton-eye1" aria-hidden="true"></i>
                                <i class="fa fa-pencil-square-o button-pencil1" aria-hidden="true" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"></i>
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
                                <i class="fa fa-trash buton-delete1" aria-hidden="true" data-bs-toggle="modal" data-bs-target="#staticBackdrop"></i>
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
                            <td>Increase Sales</td>
                            <td>Tokyo Consulting Firm Limited</td>
                            <td>Dhaka, BD </td>
                            <td>jr. Executive</td>
                            <td>৳1,000,000</td>
                            <td>07-12-2023</td>
                            <td>12-31-2023</td>
                            <td>Month</td>
                            <td>Finished</td>
                            <td>
                                <div class="progress">
                                    <div class="progress-bar" style="width:30%; background:#2F80ED;"></div>
                                    <span class="badge rounded-pill  pro-load1">30%</span>
                                </div>
                            </td>
                            <td>
                                <i class="fa fa-eye buttton-eye1" aria-hidden="true"></i>
                                <i class="fa fa-pencil-square-o button-pencil1" aria-hidden="true" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"></i>
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
                                <i class="fa fa-trash buton-delete1" aria-hidden="true" data-bs-toggle="modal" data-bs-target="#staticBackdrop"></i>
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
                            <td>Increase Sales</td>
                            <td>Tokyo Consulting Firm Limited</td>
                            <td>Dhaka, BD </td>
                            <td>jr. Executive</td>
                            <td>৳1,000,000</td>
                            <td>07-12-2023</td>
                            <td>12-31-2023</td>
                            <td>Month</td>
                            <td>Finished</td>
                            <td>
                                <div class="progress">
                                    <div class="progress-bar" style="width:30%; background:#2F80ED;"></div>
                                    <span class="badge rounded-pill  pro-load1">30%</span>
                                </div>
                            </td>
                            <td>
                                <i class="fa fa-eye buttton-eye1" aria-hidden="true"></i>
                                <i class="fa fa-pencil-square-o button-pencil1" aria-hidden="true" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"></i>
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
                                <i class="fa fa-trash buton-delete1" aria-hidden="true" data-bs-toggle="modal" data-bs-target="#staticBackdrop"></i>
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
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
        </div>
    </div>
</div>