<?php

/** @var yii\web\View $this */

use Codeception\Lib\Connector\Yii2;
use yii\bootstrap5\Carousel;

$this->title = 'Summary';
?>

<div class="col-12 pl-30" style="margin-top: 90px;">
    <div class="row">
        <div class="col-lg-2">
            <button id="btnPrev" type="button" class="btn btn-primary"><i class="fa fa-chevron-left chevron-left1" aria-hidden="true"></i></button>
            <button id="btnNext" type="button" class="btn btn-primary"><i class="fa fa-chevron-right chevron-left1" aria-hidden="true"></i></button>
        </div>
        <div class="col-lg-2">
            <div class="col-12 size-font-june">
                June 2023
            </div>
        </div>
        <div class="col-lg-8 text-end">
            <div class="btn-group" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-primary">Month</button>
                <button type="button" class="btn btn-primary">Week</button>
                <button type="button" class="btn btn-primary">day</button>
                <button type="button" class="btn btn-primary">Filter By</button>
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
                        <div class="event Evaluation" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample2" aria-expanded="false" aria-controls="multiCollapseExample2">
                            <div class="event-desc">
                                Evaluation Feedback
                            </div>
                            <div class="event-time">
                                2:45 PM - 3:15 PM
                            </div>
                        </div>
                        <div class="collapse multi-collapse" id="multiCollapseExample2">
                            <div class="event">
                                <div class="btn-group dropend">
                                    <button type="button" class="btn btn-outline-secondary dropdown-toggle collapse-font" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-clock-o" aria-hidden="true"></i> KPI/KGI
                                    </button>
                                    <ul class="dropdown-menu droup1">
                                        <li><a class="dropdown-item text-dark" href="">Action</a></li>
                                        <li><a class="dropdown-item text-dark" href="">Another action</a></li>
                                        <li><a class="dropdown-item text-dark" href="">Something else here</a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item text-dark" href="">Separated link</a></li>
                                    </ul>
                                </div>
                                <button type="button" class="btn btn-outline-secondary mt-10 collapse-font"><i class="fa fa-usd" aria-hidden="true"></i> Update Amount</button>
                                <button type="button" class="btn btn-outline-secondary mt-10 collapse-font"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Remark Explain</button>
                                <button type="button" class="btn btn-outline-secondary mt-10 collapse-font"><i class="fa fa-file-text-o" aria-hidden="true"></i> Keep Evidence</button>
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