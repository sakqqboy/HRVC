<?php

/** @var yii\web\View $this */

use Codeception\Lib\Connector\Yii2;
use yii\bootstrap5\Carousel;

$this->title = 'Update-kpi';
?>

<div class="col-12">
    <div class="alert alert-light" role="alert" style="margin-top:90px;">
        <div class="col-12 update-KGIKPI">
            KGI/KPI Management Update Page
        </div>
        <div class="col-12 mt-20">
            <div class="list-group">
                <div class="list-group-item list-group-item-action active" aria-current="true">
                    <div class="col-12 kpi-branch">
                        <select class="col-lg-2 col-md-2 col-sm-2 col-2">
                            <option>Branch</option>
                            <option>Ketchup</option>
                            <option>Relish</option>
                        </select>
                        <select class="col-lg-2 col-md-2 col-sm-2 col-2">
                            <option>Department</option>
                            <option>Ketchup</option>
                            <option>Relish</option>
                        </select>
                        <select class="col-lg-1 col-md-1 col-sm-1 col-1">
                            <option>Team</option>
                            <option>Ketchup</option>
                            <option>Relish</option>
                        </select>
                        <select class="col-lg-1 col-md-1 col-sm-1 col-1">
                            <option>Title</option>
                            <option>Ketchup</option>
                            <option>Relish</option>
                        </select>
                        <select class="col-lg-2 col-md-2 col-sm-2 col-2">
                            <option>Employee</option>
                            <option>Ketchup</option>
                            <option>Relish</option>
                        </select>
                        <select class="col-lg-1 col-md-1 col-sm-1 col-1">
                            <option>Year</option>
                            <option>Ketchup</option>
                            <option>Relish</option>
                        </select>
                        <select class="col-lg-2 col-md-2 col-sm-2 col-2">
                            <option>Month</option>
                            <option>Ketchup</option>
                            <option>Relish</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="alert alert-light mt-20" role="alert">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12">
                    <table class="tb" style="width:540px;font-size:17px;">
                        <div class="col-12 text-center yearcalendar">
                            May 2023
                        </div>

                        <tr>
                            <th>Sun</th>
                            <th>Mon</th>
                            <th>Tue</th>
                            <th>Wed</th>
                            <th>Thu</th>
                            <th>Fri</th>
                            <th>Sat</th>
                        </tr>
                        <tr>
                            <td>30</td>
                            <td>1</td>
                            <td>2</td>
                            <td>3</td>
                            <td>4</td>
                            <td>5</td>
                            <td>6</td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td>8</td>
                            <td>9</td>
                            <td>10</td>
                            <td>11</td>
                            <td>12</td>
                            <td>13</td>
                        </tr>
                        <tr>
                            <td>14</td>
                            <td>15</td>
                            <td>16</td>
                            <td>17</td>
                            <td>18</td>
                            <td>19</td>
                            <td>20</td>
                        </tr>
                        <tr>
                            <td>21</td>
                            <td>22</td>
                            <td>23</td>
                            <td>24</td>
                            <td>25</td>
                            <td>26</td>
                            <td>27</td>
                        </tr>
                        <tr>
                            <td>28</td>
                            <td>29</td>
                            <td>30</td>
                            <td>1</td>
                            <td>2</td>
                            <td>3</td>
                            <td>4</td>
                        </tr>
                    </table>

                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="row">
                        <div class="col-6 mt-30">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    List/Calendar
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-6">
                            <a href="#" class="border-line">
                                <div class="circle">See HR</div>
                            </a>
                        </div>
                        <div class="col-6 mt-20">
                            <a href="#" class="border-line">
                                <div class="KGI1">KGI1</div>
                            </a>
                        </div>
                        <div class="col-6 mt-20">
                            <a href="#" class="border-line">
                                <div class="KGI2">KGI2</div>
                            </a>
                        </div>
                        <div class="col-6 mt-20">
                            <a href="#" class="border-line">
                                <div class="KPI1">KPI1</div>
                            </a>
                        </div>
                        <div class="col-6 mt-20">
                            <a href="#" class="border-line">
                                <div class="KPI2">KPI2(from 360 evaluation)</div>
                            </a>
                        </div>
                        <div class="col-12 text-end">
                            <button type="button" class="btn btn-danger"> Exit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>