<?php

/** @var yii\web\View $this */

$this->title = 'Dashboard';
?>


<div class="col-12">
    <div class="col-6 table-KPI">
        <p>KPI & KGI Management</p>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-1">
                    <button class="form-control" type="button"><i class="fa fa-list-ol" aria-hidden="true"></i> All</button>
                </div>
                <div class="col-1">
                    <select class="form-select" aria-label="Default select example">
                        <option selected>branch</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div class="col-2">
                    <select class="form-select" aria-label="Default select example">
                        <option selected>departments</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div class="col-1">
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Team</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div class="col-1">
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Title</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div class="col-2">
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Employee</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div class="col-lg-2">
                    <div class="input-group mb-3 group-date-from-1" action="/action_page.php">
                        <span class="input-group-text group-text-from-1" id="inputGroup-sizing-default">From</span>
                        <input type="date" class="form-control control-day-1" name="birthday" aria-label="Sizing example input" aria-describedby="">
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="input-group mb-3 group-date-to-1" action="/action_page.php">
                        <span class="input-group-text group-text-to-1" id="inputGroup-sizing-default">To</span>
                        <input type="date" class="form-control control-day-1" name="birthday" aria-label="Sizing example input" aria-describedby="">
                    </div>
                </div>
            </div>


            <div class="col-12">
                <div class="row">
                    <div class="col-lg-2 col-md-6 col-12">
                        <div class="show-fade-one">KGI1 Group Dashboard</div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-12">
                        <button type="submit" class="btn btn-success title-Update"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Create KGI 1 Group</button>
                    </div>
                    <div class="col-lg-2 col-md-6 col-12 title-Respiratory">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> KGI 1 Respiratory</button>
                    </div>

                    <div class="col-lg-6 col-md-6 col-12 title-calendar2">
                        <div class="row">
                            <div class="col-2  text-end">
                                12 <i class="fa fa-eye" aria-hidden="true"></i>
                            </div>
                            <div class="col-2 text-end">
                                Export
                            </div>
                            <div class="col-1 title-refresh  text-end">
                                <i class="fa fa-refresh" aria-hidden="true"></i>
                            </div>
                            <div class="col-7 text-end">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-outline-primary font-size-12"><i class="fa fa-list-ul" aria-hidden="true"></i> List</button>
                                    <button type="button" class="btn btn-outline-primary font-size-12"><i class="fa fa-th-large" aria-hidden="true"></i> Calendrer</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-bordered mt-30">
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
                        <td><i class="fa fa-eye" aria-hidden="true"></i>
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            <i class="fa fa-plus-square" aria-hidden="true"></i>
                            <i class="fa fa-trash" aria-hidden="true"></i>
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
                        <td><i class="fa fa-eye" aria-hidden="true"></i>
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            <i class="fa fa-plus-square" aria-hidden="true"></i>
                            <i class="fa fa-trash" aria-hidden="true"></i>
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
                        <td><i class="fa fa-eye" aria-hidden="true"></i>
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            <i class="fa fa-plus-square" aria-hidden="true"></i>
                            <i class="fa fa-trash" aria-hidden="true"></i>
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
                        <td><i class="fa fa-eye" aria-hidden="true"></i>
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            <i class="fa fa-plus-square" aria-hidden="true"></i>
                            <i class="fa fa-trash" aria-hidden="true"></i>
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
                        <td><i class="fa fa-eye" aria-hidden="true"></i>
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            <i class="fa fa-plus-square" aria-hidden="true"></i>
                            <i class="fa fa-trash" aria-hidden="true"></i>
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
                        <td><i class="fa fa-eye " aria-hidden="true"></i>
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            <i class="fa fa-plus-square" aria-hidden="true"></i>
                            <i class="fa fa-trash" aria-hidden="true"></i>
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
                        <td><i class="fa fa-eye" aria-hidden="true"></i>
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            <i class="fa fa-plus-square" aria-hidden="true"></i>
                            <i class="fa fa-trash" aria-hidden="true"></i>
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
                        <td><i class="fa fa-eye" aria-hidden="true"></i>
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            <i class="fa fa-plus-square" aria-hidden="true"></i>
                            <i class="fa fa-trash" aria-hidden="true"></i>
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
                        <td><i class="fa fa-eye" aria-hidden="true"></i>
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            <i class="fa fa-plus-square" aria-hidden="true"></i>
                            <i class="fa fa-trash" aria-hidden="true"></i>
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
                        <td><i class="fa fa-eye" aria-hidden="true"></i>
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            <i class="fa fa-plus-square" aria-hidden="true"></i>
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>