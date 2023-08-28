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
                <div class="col-lg-5 col-md-6 col-12 bkc-salary">
                    <div class="col-12 data1">
                        Evaluation Data
                    </div>
                    <div class="col-12 between1">
                        Between Date 08-02-2016 to 08-03-2023
                    </div>
                    <div class="col-12 pt-30">
                        <table class="table table-secondary">
                            <thead>
                                <tr>
                                    <th scope="col">Team</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Rank</th>
                                    <th scope="col">KFI</th>
                                    <th scope="col">KGI</th>
                                    <th scope="col">KPI</th>
                                    <th scope="col">KAI</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="col-12">
                        <div class="alert alert-light">
                            <table class="table table-outline-dark">
                                <thead>
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col">50</th>
                                        <th scope="col">B</th>
                                        <th scope="col">40</th>
                                        <th scope="col">50</th>
                                        <th scope="col">50</th>
                                        <th scope="col">50</th>
                                    </tr>
                                </thead>
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
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="">
                                            <label class="form-check-label font-size-14" style="font-weight: 700;" for="defaultCheck1">
                                                KFI
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="">
                                            <label class="form-check-label font-size-14" style="font-weight: 700;" for="defaultCheck1">
                                                KGI
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="">
                                            <label class="form-check-label font-size-14" style="font-weight: 700;" for="defaultCheck1">
                                                KPI
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="">
                                            <label class="form-check-label font-size-14" style="font-weight: 700;" for="defaultCheck1">
                                                KAI
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 graph">

                            <div class="shadow p-3 bg-body rounded">
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
                                <canvas id="myChart" style="width: 100%;max-width:900px;"></canvas>
                                <script>
                                    const xValues = ['1Q', '2Q', '3Q', '4Q', '1Q', '2Q', '3Q', '4Q', '1Q', '2Q', '3Q', '4Q', '1Q', '2Q', '3Q', '4Q', '1Q', '2Q', '3Q', '4Q'];
                                    const yValues = ['0', '20', '30', '40', '50', '60', '70', '80', '90', '100']

                                    new Chart("myChart", {
                                        type: "line",
                                        data: {
                                            labels: xValues,
                                            datasets: [{
                                                    data: [60, 70, 60, 80, 70, 59, 50, 60, 70, 80, 70, 80, 70, 60, 70, 59, 70, 50, 70, 48],
                                                    borderColor: "red",
                                                    lineTension: 0,
                                                    fill: false


                                                }, {
                                                    data: [70, 60, 75, 65, 80, 60, 90, 60, 75, 57, 95, 50, 40, 30, 60, 85, 60, 60, 60, 50],
                                                    borderColor: "orange",
                                                    lineTension: 0,
                                                    fill: false

                                                },
                                                {
                                                    data: [50, 45, 70, 40, 60, 55, 65, 70, 60, 70, 40, 45, 60, 50, 39, 70, 78, 75, 90, 93],
                                                    borderColor: "blue",
                                                    lineTension: 0,
                                                    fill: false

                                                }
                                            ]
                                        },
                                        options: {
                                            legend: {
                                                display: false
                                            },
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