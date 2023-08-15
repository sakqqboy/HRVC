<?php

/** @var yii\web\View $this */

$this->title = 'KPI Summary';
?>

<div class="col-12" style="margin-top: 90px;">
    <div class="col-6 title-summary">
        KPI Summary
    </div>
    <div class="row mt-20">
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
                <option value="1">IT</option>
                <option value="2">Account</option>
                <option value="3">Law</option>
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
                <button type="submit" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i></button>
                <input type="search" class="form-control label-search" placeholder="search" aria-label="search" aria-describedby="addon-wrapping">
            </div>
        </div>
    </div>
</div>

<div class="col-12">
    <div class="alert alert-light" role="alert">
        <div class="row">
            <div class="col-lg-6  title-february text-start">
                <i class="fa fa-calendar" aria-hidden="true"></i> January 2023
            </div>
            <div class="col-lg-6 text-end">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa fa-list-ul" aria-hidden="true"></i></span>
                        <span class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="col-12">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12 small-title-february">
                    <div class="col-12">
                        <p> 01 Business Performance and processing speed should be greater than the last quarter </p>
                    </div>
                    <div class="col-12 mt-40">
                        <p> 02 Business Performance and processing speed should be greater than the last quarter </p>
                    </div>
                    <div class="col-12 mt-40">
                        <p> 03 Business Performance and processing speed should be greater than the last quarter </p>
                    </div>
                    <div class="col-12 mt-40">
                        <p> 04 Business Performance and processing speed should be greater than the last quarter </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="col-12">
                        <div class="progress">
                            <div class="progress-bar" style="width:50%; background:#2F80ED;"></div>
                            <span class="badge rounded-pill  pro-load">50%</span>
                        </div>
                    </div>
                    <div class="col-12 mt-40">
                        <div class="progress">
                            <div class="progress-bar" style="width:40%; background:#2F80ED;"></div>
                            <span class="badge rounded-pill  pro-load">40%</span>
                        </div>
                    </div>
                    <div class="col-12 mt-40">
                        <div class="progress">
                            <div class="progress-bar" style="width:56%; background:#2F80ED;"></div>
                            <span class="badge rounded-pill pro-load">56%</span>
                        </div>
                    </div>
                    <div class="col-12 mt-40">
                        <div class="progress">
                            <div class="progress-bar" style="width:78%; background:#2F80ED;"></div>
                            <span class="badge rounded-pill  pro-load">78%</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="col-12">
                        <button type="button" class="btn  btn-outline-secondary" data-bs-toggle="modal" href="#exampleModalToggle" role="button"> <i class="fa fa-eye" aria-hidden="true"></i></button>&nbsp;
                        <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalToggleLabel">01</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Business Performance and processing speed should be greater than the last quarter
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal">Next</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalToggleLabel2">02</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Hide this modal and show the first with the button below.
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" data-bs-dismiss="modal">Back</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="button" class="btn  btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>&nbsp;
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form>
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
                                                        <button type="button" class="btn btn-outline-secondary group-mounthly1">monthly</button>
                                                        <button type="button" class="btn btn-outline-secondary group-mounthly1">weekly</button>
                                                        <button type="button" class="btn btn-outline-secondary group-mounthly1">daily</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Send message</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="button" class="btn  btn-outline-secondary"> <i class="fa fa-plus-circle" aria-hidden="true"></i></button>&nbsp;
                        <button type="button" class="btn  btn-outline-danger"> <i class="fa fa-trash" aria-hidden="true"></i></button>
                        </table>
                    </div>
                    <div class="col-12 mt-20">
                        <button type="button" class="btn  btn-outline-secondary"> <i class="fa fa-eye" aria-hidden="true"></i></button>&nbsp;
                        <button type="button" class="btn  btn-outline-secondary"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>&nbsp;
                        <button type="button" class="btn  btn-outline-secondary"> <i class="fa fa-plus-circle" aria-hidden="true"></i></button>&nbsp;
                        <button type="button" class="btn  btn-outline-danger"> <i class="fa fa-trash" aria-hidden="true"></i></button>
                    </div>
                    <div class="col-12 mt-20">
                        <button type="button" class="btn  btn-outline-secondary"> <i class="fa fa-eye" aria-hidden="true"></i></button>&nbsp;
                        <button type="button" class="btn  btn-outline-secondary"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>&nbsp;
                        <button type="button" class="btn  btn-outline-secondary"> <i class="fa fa-plus-circle" aria-hidden="true"></i></button>&nbsp;
                        <button type="button" class="btn  btn-outline-danger"> <i class="fa fa-trash" aria-hidden="true"></i></button>
                    </div>
                    <div class="col-12 mt-20">
                        <button type="button" class="btn  btn-outline-secondary"> <i class="fa fa-eye" aria-hidden="true"></i></button>&nbsp;
                        <button type="button" class="btn  btn-outline-secondary"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>&nbsp;
                        <button type="button" class="btn  btn-outline-secondary"> <i class="fa fa-plus-circle" aria-hidden="true"></i></button>&nbsp;
                        <button type="button" class="btn  btn-outline-danger"> <i class="fa fa-trash" aria-hidden="true"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-12">
    <div class="alert alert-light" role="alert">
        <div class="row">
            <div class="col-lg-6  title-february text-start">
                <i class="fa fa-calendar" aria-hidden="true"></i> February 2023
            </div>
            <div class="col-lg-6  text-end">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa fa-list-ul" aria-hidden="true"></i></span>
                        <span class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                    </div>
                </div>
            </div>
        </div>

        <hr>
        <div class="col-12">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12 small-title-february">
                    <div class="col-12">
                        01 Business Performance and processing speed should be greater than the last quarter
                    </div>

                    <div class="col-12 mt-40">
                        <p> 02 Business Performance and processing speed should be greater than the last quarter </p>
                    </div>
                    <div class="col-12 mt-40">
                        <p> 03 Business Performance and processing speed should be greater than the last quarter </p>
                    </div>
                    <div class="col-12 mt-40">
                        <p> 04 Business Performance and processing speed should be greater than the last quarter </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="col-12">
                        <div class="progress">
                            <div class="progress-bar" style="width:50%; background:#2F80ED;"></div>
                            <span class="badge rounded-pill  pro-load">50%</span>
                        </div>
                    </div>
                    <div class="col-12 mt-40">
                        <div class="progress">
                            <div class="progress-bar" style="width:40%; background:#2F80ED;"></div>
                            <span class="badge rounded-pill  pro-load">40%</span>
                        </div>
                    </div>
                    <div class="col-12 mt-40">
                        <div class="progress">
                            <div class="progress-bar" style="width:56%; background:#2F80ED;"></div>
                            <span class="badge rounded-pill  pro-load">56%</span>
                        </div>
                    </div>
                    <div class="col-12 mt-40">
                        <div class="progress">
                            <div class="progress-bar" style="width:78%; background:#2F80ED;"></div>
                            <span class="badge rounded-pill  pro-load">78%</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="col-12">
                        <button type="button" class="btn  btn-outline-secondary"> <i class="fa fa-eye" aria-hidden="true"></i></button>&nbsp;
                        <button type="button" class="btn  btn-outline-secondary"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>&nbsp;
                        <button type="button" class="btn  btn-outline-secondary"> <i class="fa fa-plus-circle" aria-hidden="true"></i></button>&nbsp;
                        <button type="button" class="btn  btn-outline-danger"> <i class="fa fa-trash" aria-hidden="true"></i></button>
                        </table>
                    </div>
                    <div class="col-12 mt-20">
                        <button type="button" class="btn  btn-outline-secondary"> <i class="fa fa-eye" aria-hidden="true"></i></button>&nbsp;
                        <button type="button" class="btn  btn-outline-secondary"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>&nbsp;
                        <button type="button" class="btn  btn-outline-secondary"> <i class="fa fa-plus-circle" aria-hidden="true"></i></button>&nbsp;
                        <button type="button" class="btn  btn-outline-danger"> <i class="fa fa-trash" aria-hidden="true"></i></button>
                    </div>
                    <div class="col-12 mt-20">
                        <button type="button" class="btn  btn-outline-secondary"> <i class="fa fa-eye" aria-hidden="true"></i></button>&nbsp;
                        <button type="button" class="btn  btn-outline-secondary"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>&nbsp;
                        <button type="button" class="btn  btn-outline-secondary"> <i class="fa fa-plus-circle" aria-hidden="true"></i></button>&nbsp;
                        <button type="button" class="btn  btn-outline-danger"> <i class="fa fa-trash" aria-hidden="true"></i></button>
                    </div>
                    <div class="col-12 mt-20">
                        <button type="button" class="btn  btn-outline-secondary"> <i class="fa fa-eye" aria-hidden="true"></i></button>&nbsp;
                        <button type="button" class="btn  btn-outline-secondary"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>&nbsp;
                        <button type="button" class="btn  btn-outline-secondary"> <i class="fa fa-plus-circle" aria-hidden="true"></i></button>&nbsp;
                        <button type="button" class="btn  btn-outline-danger"> <i class="fa fa-trash" aria-hidden="true"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-12">
    <div class="alert alert-light" role="alert">
        <div class="row">
            <div class="col-lg-6  title-february text-start">
                <i class="fa fa-calendar" aria-hidden="true"></i> March 2023
            </div>
            <div class="col-lg-6  text-end">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa fa-list-ul" aria-hidden="true"></i></span>
                        <span class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                    </div>
                </div>
            </div>
        </div>

        <hr>
        <div class="col-12">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12 small-title-february">
                    <div class="col-12">
                        01 Business Performance and processing speed should be greater than the last quarter
                    </div>

                    <div class="col-12 mt-40">
                        <p> 02 Business Performance and processing speed should be greater than the last quarter </p>
                    </div>
                    <div class="col-12 mt-40">
                        <p> 03 Business Performance and processing speed should be greater than the last quarter </p>
                    </div>
                    <div class="col-12 mt-40">
                        <p> 04 Business Performance and processing speed should be greater than the last quarter </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="col-12">
                        <div class="progress">
                            <div class="progress-bar" style="width:50%; background:#2F80ED;"></div>
                            <span class="badge rounded-pill  pro-load">50%</span>
                        </div>
                    </div>
                    <div class="col-12 mt-40">
                        <div class="progress">
                            <div class="progress-bar" style="width:40%; background:#2F80ED;"></div>
                            <span class="badge rounded-pill  pro-load">40%</span>
                        </div>
                    </div>
                    <div class="col-12 mt-40">
                        <div class="progress">
                            <div class="progress-bar" style="width:56%; background:#2F80ED;"></div>
                            <span class="badge rounded-pill  pro-load">56%</span>

                        </div>
                    </div>
                    <div class="col-12 mt-40">
                        <div class="progress">
                            <div class="progress-bar" style="width:78%; background:#2F80ED;"></div>
                            <span class="badge rounded-pill  pro-load">78%</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="col-12">
                        <button type="button" class="btn  btn-outline-secondary"> <i class="fa fa-eye" aria-hidden="true"></i></button>&nbsp;
                        <button type="button" class="btn  btn-outline-secondary"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>&nbsp;
                        <button type="button" class="btn  btn-outline-secondary"> <i class="fa fa-plus-circle" aria-hidden="true"></i></button>&nbsp;
                        <button type="button" class="btn  btn-outline-danger"> <i class="fa fa-trash" aria-hidden="true"></i></button>
                        </table>
                    </div>
                    <div class="col-12 mt-20">
                        <button type="button" class="btn  btn-outline-secondary"> <i class="fa fa-eye" aria-hidden="true"></i></button>&nbsp;
                        <button type="button" class="btn  btn-outline-secondary"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>&nbsp;
                        <button type="button" class="btn  btn-outline-secondary"> <i class="fa fa-plus-circle" aria-hidden="true"></i></button>&nbsp;
                        <button type="button" class="btn  btn-outline-danger"> <i class="fa fa-trash" aria-hidden="true"></i></button>
                    </div>
                    <div class="col-12 mt-20">
                        <button type="button" class="btn  btn-outline-secondary"> <i class="fa fa-eye" aria-hidden="true"></i></button>&nbsp;
                        <button type="button" class="btn  btn-outline-secondary"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>&nbsp;
                        <button type="button" class="btn  btn-outline-secondary"> <i class="fa fa-plus-circle" aria-hidden="true"></i></button>&nbsp;
                        <button type="button" class="btn  btn-outline-danger"> <i class="fa fa-trash" aria-hidden="true"></i></button>
                    </div>
                    <div class="col-12 mt-20">
                        <button type="button" class="btn  btn-outline-secondary"> <i class="fa fa-eye" aria-hidden="true"></i></button>&nbsp;
                        <button type="button" class="btn  btn-outline-secondary"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>&nbsp;
                        <button type="button" class="btn  btn-outline-secondary"> <i class="fa fa-plus-circle" aria-hidden="true"></i></button>&nbsp;
                        <button type="button" class="btn  btn-outline-danger"> <i class="fa fa-trash" aria-hidden="true"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-12">
    <div class="alert alert-light" role="alert">
        <div class="row">
            <div class="col-lg-6  title-february text-start">
                <i class="fa fa-calendar" aria-hidden="true"></i> April 2023
            </div>
            <div class="col-lg-6  text-end">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa fa-list-ul" aria-hidden="true"></i></span>
                        <span class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                    </div>
                </div>
            </div>
        </div>

        <hr>
        <div class="col-12">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12 small-title-february">
                    <div class="col-12">
                        01 Business Performance and processing speed should be greater than the last quarter
                    </div>

                    <div class="col-12 mt-40">
                        <p> 02 Business Performance and processing speed should be greater than the last quarter </p>
                    </div>
                    <div class="col-12 mt-40">
                        <p> 03 Business Performance and processing speed should be greater than the last quarter </p>
                    </div>
                    <div class="col-12 mt-40">
                        <p> 04 Business Performance and processing speed should be greater than the last quarter </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="col-12">
                        <div class="progress">
                            <div class="progress-bar" style="width:50%; background:#2F80ED;"></div>
                            <span class="badge rounded-pill  pro-load">40%</span>
                        </div>
                    </div>
                    <div class="col-12 mt-40">
                        <div class="progress">
                            <div class="progress-bar" style="width:40%; background:#2F80ED;"></div>
                            <span class="badge rounded-pill  pro-load">40%</span>
                        </div>
                    </div>
                    <div class="col-12 mt-40">
                        <div class="progress">
                            <div class="progress-bar" style="width:40%; background:#2F80ED;"></div>
                            <span class="badge rounded-pill  pro-load">40%</span>
                        </div>
                    </div>
                    <div class="col-12 mt-40">
                        <div class="progress">
                            <div class="progress-bar" style="width:78%; background:#2F80ED;"></div>
                            <span class="badge rounded-pill  pro-load">40%</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="col-12">
                        <button type="button" class="btn  btn-outline-secondary"> <i class="fa fa-eye" aria-hidden="true"></i></button>&nbsp;
                        <button type="button" class="btn  btn-outline-secondary"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>&nbsp;
                        <button type="button" class="btn  btn-outline-secondary"> <i class="fa fa-plus-circle" aria-hidden="true"></i></button>&nbsp;
                        <button type="button" class="btn  btn-outline-danger"> <i class="fa fa-trash" aria-hidden="true"></i></button>
                        </table>
                    </div>
                    <div class="col-12 mt-20">
                        <button type="button" class="btn  btn-outline-secondary"> <i class="fa fa-eye" aria-hidden="true"></i></button>&nbsp;
                        <button type="button" class="btn  btn-outline-secondary"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>&nbsp;
                        <button type="button" class="btn  btn-outline-secondary"> <i class="fa fa-plus-circle" aria-hidden="true"></i></button>&nbsp;
                        <button type="button" class="btn  btn-outline-danger"> <i class="fa fa-trash" aria-hidden="true"></i></button>
                    </div>
                    <div class="col-12 mt-20">
                        <button type="button" class="btn  btn-outline-secondary"> <i class="fa fa-eye" aria-hidden="true"></i></button>&nbsp;
                        <button type="button" class="btn  btn-outline-secondary"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>&nbsp;
                        <button type="button" class="btn  btn-outline-secondary"> <i class="fa fa-plus-circle" aria-hidden="true"></i></button>&nbsp;
                        <button type="button" class="btn  btn-outline-danger"> <i class="fa fa-trash" aria-hidden="true"></i></button>
                    </div>
                    <div class="col-12 mt-20">
                        <button type="button" class="btn  btn-outline-secondary"> <i class="fa fa-eye" aria-hidden="true"></i></button>&nbsp;
                        <button type="button" class="btn  btn-outline-secondary"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>&nbsp;
                        <button type="button" class="btn  btn-outline-secondary"> <i class="fa fa-plus-circle" aria-hidden="true"></i></button>&nbsp;
                        <button type="button" class="btn  btn-outline-danger"> <i class="fa fa-trash" aria-hidden="true"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-12">
    <img src="<?= Yii::$app->homeUrl ?>image/15.png" class="nnma">
</div>