<?php

/** @var yii\web\View $this */

use Codeception\Lib\Connector\Yii2;
use yii\bootstrap5\Carousel;

$this->title = 'KPI Summary';
?>

<div class="col-12" style="margin-top: 90px;">
    <div class="col-12 title-summary">
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
                        <p><progress value="0" max="100" style="--value: 35; --max: 100;"></progress></p>
                    </div>
                    <div class="col-12 mt-40">
                        <p> <progress value="0" max="100" style="--value: 45; --max: 100;"></progress></p>
                    </div>
                    <div class="col-12 mt-40">
                        <p> <progress value="0" max="100" style="--value: 73; --max: 100;"></progress></p>
                    </div>
                    <div class="col-12 mt-40">
                        <p> <progress value="0" max="100" style="--value: 98; --max: 100;"></progress></p>
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
                        <p><progress value="0" max="100" style="--value: 45; --max: 100;"></progress></p>
                    </div>
                    <div class="col-12 mt-40">
                        <p> <progress value="0" max="100" style="--value: 75; --max: 100;"></progress></p>
                    </div>
                    <div class="col-12 mt-40">
                        <p> <progress value="0" max="100" style="--value: 63; --max: 100;"></progress></p>
                    </div>
                    <div class="col-12 mt-40">
                        <p> <progress value="0" max="100" style="--value: 100; --max: 100;"></progress></p>
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
                        <p><progress value="0" max="100" style="--value: 45; --max: 100;"></progress></p>
                    </div>
                    <div class="col-12 mt-40">
                        <p> <progress value="0" max="100" style="--value: 75; --max: 100;"></progress></p>
                    </div>
                    <div class="col-12 mt-40">
                        <p> <progress value="0" max="100" style="--value: 63; --max: 100;"></progress></p>
                    </div>
                    <div class="col-12 mt-40">
                        <p> <progress value="0" max="100" style="--value: 100; --max: 100;"></progress></p>
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
                        <p><progress value="0" max="100" style="--value: 45; --max: 100;"></progress></p>
                    </div>
                    <div class="col-12 mt-40">
                        <p> <progress value="0" max="100" style="--value: 75; --max: 100;"></progress></p>
                    </div>
                    <div class="col-12 mt-40">
                        <p> <progress value="0" max="100" style="--value: 63; --max: 100;"></progress></p>
                    </div>
                    <div class="col-12 mt-40">
                        <p> <progress value="0" max="100" style="--value: 100; --max: 100;"></progress></p>
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