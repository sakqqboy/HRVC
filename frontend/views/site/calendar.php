<?php

/** @var yii\web\View $this */

use Codeception\Lib\Connector\Yii2;
use yii\bootstrap5\Carousel;

$this->title = 'Summary';
?>

<div class="col-12 pl-30" style="margin-top: 90px;">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-12">
            <div class="col-12 size-font-june">
                June 2023
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-12 mt-30">
            <button type="submit" class="btn btn-success"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Update KPI/KGI </button>
        </div>
        <div class="col-lg-3 col-md-6 col-12 mt-30 text-end">
            <button type="submit" class="btn btn-primary"> 360° Evaluation <i class="fa fa-external-link" aria-hidden="true"></i></button>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-1">
            <button id="btnPrev" type="button" class="btn btn-primary button-lf"><i class="fa fa-chevron-left fontas-left" aria-hidden="true"></i></button>
            <button id="btnNext" type="button" class="btn btn-primary button-lf"><i class="fa fa-chevron-right fontas-right" aria-hidden="true"></i></button>
        </div>
        <div class="col-lg-2">
            <div class="input-group mb-3 input-calendar-from" style="width: 10rem;" action="/action_page.php">
                <span class="input-group-text select-calendar-from" id="inputGroup-sizing-default">From</span>
                <input type="date" id="birthday" class="form-control select-calendar-from" name="birthday" aria-label="Sizing example input" aria-describedby="">
            </div>
        </div>
        <div class="col-lg-2">
            <div class="input-group mb-3 input-calendar-to" style="width: 10rem;" action="/action_page.php">
                <span class="input-group-text select-calendar-to" id="inputGroup-sizing-default">To</span>
                <input type="date" id="birthday" class="form-control select-calendar-to" name="birthday" aria-label="Sizing example input" aria-describedby="">
            </div>
        </div>
        <div class="col-lg-1">
            <button type="button" class="btn btn-outline-primary button-filter" data-mdb-ripple-color="dark"> <i class="fa fa-filter" aria-hidden="true"></i> </button>
        </div>
        <div class="col-lg-1">
            <select class="form-select calendar-branch" aria-label="Default select example">
                <option selected>branch</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
        </div>
        <div class="col-lg-1">
            <select class="form-select calendar-Departments" aria-label="Default select example">
                <option selected>Departments</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
        </div>
        <div class="col-lg-1">
            <select class="form-select calendar-Team" aria-label="Default select example">
                <option selected>Team</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
        </div>
        <div class="col-lg-1">
            <select class="form-select calendar-Title" aria-label="Default select example">
                <option selected>Title</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
        </div>
        <div class="col-lg-1">
            <select class="form-select calendar-Employee" aria-label="Default select example">
                <option selected>Employee</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
        </div>
        <div class="col-lg-1">
            <div class="btn-group input-calendar-month" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-outline-primary calendar-month">Month</button>
                <button type="button" class="btn btn-outline-primary calendar-month">Week</button>
                <button type="button" class="btn btn-outline-primary calendar-month">day</button>
                <button type="button" class="btn btn-outline-primary calendar-month">Filter By</button>
            </div>
        </div>
        <div class="col-lg-1">
            <div class="btn-group" role="group" aria-label="Basic outlnied example">
                <button type="button" class="btn btn-outline-primary button-th-large"><i class="fa fa-th-large" aria-hidden="true"></i></button>
                <button type="button" class="btn btn-outline-primary button-th-large"><i class="fa fa-list-ul" aria-hidden="true"></i> </button>
            </div>
        </div>
    </div>
</div>

<div class="col-12 pl-30 mt-30">
    <div class="row">
        <div class="col-lg-12">
            <table id="calendar">
                <tr class="divCal">
                    <th scope="col">Sunday</th>
                    <th scope="col">Monday</th>
                    <th scope="col">Tuesday</th>
                    <th scope="col">Wednesday</th>
                    <th scope="col">Thursday</th>
                    <th scope="col">Friday</th>
                    <th scope="col">Saturday</th>
                </tr>
                <tr class="days">
                    <td class="day other-month">
                        <div class="date">28</div>
                    </td>
                    <td class="day other-month">
                        <div class="date">29</div>
                    </td>
                    <td class="day other-month">
                        <div class="date">30</div>
                    </td>
                    <td class="day other-month">
                        <div class="date">1</div>
                        <div class="event">
                            <div class="event-desc">
                                KPI Setting Phase Start
                            </div>
                            <div class="event-time">
                                8:30 AM - 9:30 AM
                            </div>
                        </div>
                    </td>
                    <td class="day other-month">
                        <div class="date">2</div>
                    </td>


                    <td class="day">
                        <div class="date">3</div>
                    </td>
                    <td class="day">
                        <div class="date">4</div>
                    </td>
                </tr>
                <tr>
                    <td class="day">
                        <div class="date">5</div>
                    </td>
                    <td class="day">
                        <div class="date">6</div>
                        <div class="event">
                            <div class="event-desc">
                                KPI Setting Phase Start
                            </div>

                            <div class="event-time">
                                5:00pm to 6:00pm
                            </div>
                        </div>
                        <div class="event Evaluation">
                            <div class="event-desc">
                                Evaluation Feedback
                                <span class="feedback">
                                    <button type="button" class="btn btn-primary mt-10 collapse-font"><i class="fa fa-clock-o" aria-hidden="true"></i> KPI/KGI </button>
                                    <button type="button" class="btn btn-primary mt-10 collapse-font"><i class="fa fa-usd" aria-hidden="true"></i> Update Amount</button>
                                    <button type="button" class="btn btn-primary mt-10 collapse-font"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Remark Explain</button>
                                    <button type="button" class="btn btn-primary mt-10 collapse-font"><i class="fa fa-file-text-o" aria-hidden="true"></i> Keep Evidence</button>
                                </span>
                            </div>
                            <div class="event-time">
                                2:45 PM - 3:15 PM
                            </div>
                        </div>
                    </td>
                    <td class="day">
                        <div class="date">7</div>
                    </td>
                    <td class="day">
                        <div class="date">8</div>
                    </td>
                    <td class="day">
                        <div class="date">9</div>
                    </td>
                    <td class="day">
                        <div class="date">10</div>
                    </td>
                    <td class="day">
                        <div class="date">11</div>
                    </td>
                </tr>
                <tr>
                    <td class="day">
                        <div class="date">12</div>
                    </td>
                    <td class="day">
                        <div class="date">13</div>
                    </td>
                    <td class="day">
                        <div class="date">14</div>
                    </td>
                    <td class="day">
                        <div class="date">15</div>
                        <div class="event">
                            <div class="event-desc">
                                KPI Setting Phase Start
                            </div>
                            <div class="event-time">
                                8:30 AM - 9:30 AM
                            </div>
                        </div>
                    </td>
                    <td class="day">
                        <div class="date">16</div>
                    </td>
                    <td class="day">
                        <div class="date">17</div>
                    </td>
                    <td class="day">
                        <div class="date">18</div>
                    </td>
                </tr>
                <tr>

                    <td class="day">
                        <div class="date">19</div>
                    </td>
                    <td class="day">
                        <div class="date">20</div>
                    </td>
                    <td class="day">
                        <div class="date">21</div>
                    </td>
                    <td class="day">
                        <div class="date">22</div>
                        <div class="event">
                            <div class="event-desc">
                                Conference Call
                            </div>
                            <div class="event-time">
                                1:00pm to 3:00pm
                            </div>
                        </div>
                        <div class="event">
                            <div class="event-desc">
                                Conference Call
                            </div>
                            <div class="event-time">
                                1:00pm to 3:00pm
                            </div>
                        </div>
                        <div class="event">
                            <div class="event-desc">
                                Conference Call
                            </div>
                            <div class="event-time">
                                1:00pm to 3:00pm
                            </div>
                        </div>
                    </td>
                    <td class="day">
                        <div class="date">23</div>
                    </td>
                    <td class="day">
                        <div class="date">24</div>
                    </td>
                    <td class="day">
                        <div class="date">25</div>
                    </td>
                </tr>
                <tr>
                    <td class="day">
                        <div class="date">26</div>
                    </td>
                    <td class="day">
                        <div class="date">27</div>
                    </td>
                    <td class="day">
                        <div class="date">28</div>
                    </td>
                    <td class="day">
                        <div class="date">29</div>
                    </td>
                    <td class="day">
                        <div class="date">30</div>
                    </td>
                    <td class="day">
                        <div class="date">31</div>
                    </td>
                    <td class="day">
                        <div class="date">1</div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>