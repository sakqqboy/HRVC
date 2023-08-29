<?php
$this->title = 'view in details';
?>


<div class="col-12 mt-90">
    <div class="col-12 view-goback">
        <i class="fa fa-caret-left font-size-22" aria-hidden="true"></i> &nbsp;Go Back
    </div>
    <div class="alert alert-goback pt-20">
        <div class="alert alert-light" role="alert">
            <div class="row">
                <div class="col-lg-5 col-md-6 col-12">
                    <div class="alert bkc-salary">
                        <div class="col-12 data">
                            Salary Increment Data
                        </div>
                        <div class="col-12 between">
                            Between Date 08-02-2016 to 08-03-2023
                        </div>
                        <div class="col-12 pt-30">
                            <table class="table">
                                <thead class="table-secondary">
                                    <tr>
                                        <th scope="col">Working Year</th>
                                        <th scope="col">Total Salary</th>
                                        <th scope="col">Increase Ratio</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>1st</th>
                                        <th>10,000,000</th>
                                        <th>0.0%</th>
                                    </tr>
                                    <tr>
                                        <th>2nd</th>
                                        <th>10,000,000</th>
                                        <th>0.0%</th>
                                    </tr>
                                    <tr>
                                        <th>3rd</th>
                                        <th>11,000,000</th>
                                        <th>0.0%</th>
                                    </tr>
                                    <tr>
                                        <th>4th</th>
                                        <th>11,000,000</th>
                                        <th>0.0%</th>
                                    </tr>
                                    <tr>
                                        <th>5th</th>
                                        <th>12,000,000</th>
                                        <th>0.0%</th>
                                    </tr>
                                    <tr>
                                        <th>6th</th>
                                        <th>12,000,000</th>
                                        <th>9.0%</th>
                                    </tr>
                                    <tr>
                                        <th>7th</th>
                                        <th>18,000,000</th>
                                        <th>9.0%</th>
                                    </tr>
                                    <tr>
                                        <th>8th</th>
                                        <th>20,000,000</th>
                                        <th>0.0%</th>
                                    </tr>
                                    <tr>
                                        <th>9th</th>
                                        <th>25,333,333</th>
                                        <th>0.0%</th>
                                    </tr>
                                    <tr>
                                        <th>10th</th>
                                        <th>29,333,333</th>
                                        <th>0.0%</th>
                                    </tr>
                                    <tr>
                                        <th>11th</th>
                                        <th>10,000,000</th>
                                        <th>0.0%</th>
                                    </tr>
                                    <tr>
                                        <th>12th</th>
                                        <th>10,000,000</th>
                                        <th>0.0%</th>
                                    </tr>
                                    <tr>
                                        <th>13th</th>
                                        <th>10,000,000</th>
                                        <th>0.0%</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-6 col-12">
                    <div class="alert">
                        <div class="row">
                            <div class="col-10 text-end box-nam">
                                Tadawoki Watanabe
                            </div>
                            <div class="col-lg-2 text-end">
                                <img src="<?= Yii::$app->homeUrl ?>image/employee1.png">
                            </div>
                        </div>
                        <div class="col-12 Generate">
                            Generate
                        </div>
                        <div class="row pt-10">
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="col-12">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text text-primary" id="">From</span>
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected>Select this</option>
                                            <option value="1">1Q 2022</option>
                                            <option value="2">2Q 2022</option>
                                            <option value="3">3Q 2022</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="col-12">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text text-primary" id="">To</span>
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected>Select this</option>
                                            <option value="1">4Q 2023</option>
                                            <option value="2">5Q 2023</option>
                                            <option value="3">6Q 2023</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 graph">
                            <div class="shadow p-3 bg-body rounded linechart0">
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
                                </script>

                                <canvas id="sampleChart" style="height: 200px;"></canvas>
                                <div id="output"> </div>
                                <script>
                                    let output = document.getElementById('output');
                                    let canvas = document.getElementById("sampleChart");
                                    let line1Data = [9, 10, 12, 11, 11, 15, 12, 12, 12, 13, 24, 25, 31, 36, 39, 40, 41, 45, 50, 55, 59, 60];
                                    let line2Data = [0, 0, 10, 0, 0, 10, 0, 00, 50, 10, 15, 10, 11, 15, 9, 19, 12, 24, 10, 10];

                                    var xValues = ['1st', '2nd', '3rd', '4th', '5th', '6th', '7th', '8th', '9th', '10th', '11th', '12th', '13th', '14th', '15th', '16th', '17th', '18th', '19th', '20th'];
                                    new Chart(canvas, {
                                        type: "line",
                                        data: {
                                            labels: xValues,
                                            datasets: [{
                                                borderColor: "red",
                                                pointBackgroundColor: "red",
                                                fill: false,
                                                data: line1Data,
                                                label: "Total Salary"


                                            }, {
                                                borderColor: "orange",
                                                pointBackgroundColor: "orange",
                                                fill: false,
                                                data: line2Data,
                                                lineTension: 0,
                                                label: "Increase Ratio"
                                            }]
                                        },
                                        options: {
                                            scales: {
                                                xAxes: [{
                                                    ticks: {
                                                        min: 0,
                                                        max: 20
                                                    }
                                                }],
                                                yAxes: [{
                                                    ticks: {
                                                        min: 0,
                                                        max: 60
                                                    }
                                                }],
                                            }
                                        }
                                    });
                                </script>
                            </div>
                        </div>
                        <div class="row pt-30">
                            <div class="col-lg-8 col-md-6 col-12 text-end">
                                <a href="" class="no"><i class="fa fa-print" aria-hidden="true"></i> Print</a>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 text-end">
                                <a href="" class="no"><i class="fa fa-cloud-download" aria-hidden="true"></i> Download Report</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>