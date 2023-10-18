<?php
$this->title = 'view';
?>

<div class="col-12 mt-90">
    <div class="col-12 view-goback">
        <i class="fa fa-caret-left font-size-22" aria-hidden="true"></i> &nbsp;Go Back
    </div>
    <div class="alert alert-goback">
        <div class="col-12">
            <div class="alert alert-light pr-10 pl-10" style="border: none;">
                <div class="row">
                    <div class="col-lg-2 col-md-4 col-3">
                        <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="imageView">
                    </div>
                    <div class="col-lg-10 col-md-8 col-9">
                        <div class="con-12 mt-30">
                            <span class="name-Tadawoki">Tadawoki Watanabe</span><span class="badge bg-success font-size-16 ml-10">Active</span>
                        </div>
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-12">
                                <div class="col-12 pt-10 Director-view">
                                    Director, Bangladesh
                                </div>
                                <div class="col-12 pt-20 font-size-14">
                                    <i class="fa fa-calendar-o" aria-hidden="true"></i> &nbsp;<span class="text-dark">Joined on </span><strong> 02-05-2023</strong>
                                    <span class="view-solid"></span> <i class="fa fa-birthday-cake pl-10" aria-hidden="true"></i> <span class="text-dark"> Age</span><strong> 34</strong>
                                    <span class="badge bg-secondary"> Permanent</span>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-12 text-end">
                                <div class="col-12 pt-10">
                                    Working Place
                                </div>
                                <div class="col-12 pt-10">
                                    <img src="<?= Yii::$app->homeUrl ?>image/Round-Bangladesh.png" class="bd"> Dhaka, Bangladesh
                                </div>
                            </div>
                        </div>
                        <div class="mt-30">
                            <div class="col-lg-12 col-md-12 col-12 box-shareprofile">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-4 font-size-14 share-pointer">
                                        <i class="fa fa-share-alt" aria-hidden="true"></i> Share Profile
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-2 font-size-14 share-pointer">
                                        <i class="fa fa-print" aria-hidden="true"></i> Print
                                    </div>
                                    <div class="col-lg-4 col-md-3 col-3 font-size-14 share-pointer">
                                        <i class="fa fa-cloud-download" aria-hidden="true"></i> Download CV
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-2 font-size-14 share-pointer">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="d-flex align-items-start">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-4 crd-background">
                        <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <div class="col-12 emplo-infor">
                                Employee
                                Information
                            </div>
                            <a class="link-2" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Personal & Contact Details</a>
                            <a class="link-2" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Work Information</a>
                            <a class="link-2" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">Attachments</a>
                            <a class="link-2" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Salary & Allowance</a>
                            <a class="link-2" id="v-pills-details-tab" data-bs-toggle="pill" data-bs-target="#v-pills-details" type="button" role="tab" aria-controls="v-pills-details" aria-selected="false">Evaluation</a>
                            <a class="link-2" id="v-pills-skill-tab" data-bs-toggle="pill" data-bs-target="#v-pills-skill" type="button" role="tab" aria-controls="v-pills-skill" aria-selected="false">Skill & License</a>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-3 col-sm-6 col-12 alert-personal-information">
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="col-12 font-size-17 pt-60 pl-20">
                                            <i class="fa fa-info-circle" aria-hidden="true"></i> Personal Information
                                        </div>
                                        <hr>
                                        <div class="row pl-20">
                                            <div class="col-5 font-size-14 personal-information-big">
                                                <div class="col-12">
                                                    First Name
                                                </div>
                                                <div class="col-12 pt-20">
                                                    Last Name
                                                </div>
                                                <div class="col-12 pt-20">
                                                    Nationality
                                                </div>
                                                <div class="col-12 pt-20">
                                                    Date of Birth
                                                </div>
                                                <div class="col-12 pt-20">
                                                    Age
                                                </div>
                                                <div class="col-12 pt-20">
                                                    Gender
                                                </div>
                                                <div class="col-12 pt-20">
                                                    Father's Name
                                                </div>
                                                <div class="col-12 pt-20">
                                                    Mother's Name
                                                </div>
                                                <div class="col-12 pt-20">
                                                    Address
                                                </div>
                                            </div>
                                            <div class="col-7 font-size-14 personal-information-big">
                                                <div class="col-12 view-font-bold">
                                                    Tadawoki
                                                </div>
                                                <div class="col-12 pt-20 view-font-bold">
                                                    Watanabe
                                                </div>
                                                <div class="col-12 pt-20 view-font-bold">
                                                    Japanease
                                                </div>
                                                <div class="col-12 pt-20 view-font-bold">
                                                    08/02/1989
                                                </div>
                                                <div class="col-12 pt-20 view-font-bold">
                                                    34 Years, 2 Months
                                                </div>
                                                <div class="col-12 pt-20 view-font-bold">
                                                    Male <i class="fa fa-mars" aria-hidden="true"></i>
                                                </div>
                                                <div class="col-12 pt-20 view-font-bold">
                                                    Sample Name San
                                                </div>
                                                <div class="col-12 pt-20 view-font-bold">
                                                    Sample Name San
                                                </div>
                                                <div class="col-12 pt-20 view-font-bold">
                                                    Flat #6A, House #54, Road, #7/A, Block H, Banani
                                                    Dhaka 2016, Bangladesh
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12 show-in-solid">
                                        <div class="col-12 font-size-17">
                                            <i class="fa fa-phone" aria-hidden="true"></i> Contact Information
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-5 font-size-14 personal-information-big">
                                                <div class="col-12">
                                                    Personal Email
                                                </div>
                                                <div class="col-12 pt-20">
                                                    Contact Number
                                                </div>
                                                <div class="col-12 pt-20">
                                                    Emergency Contact Number
                                                </div>
                                                <div class="col-12 pt-20">
                                                    Company Mail
                                                </div>
                                                <div class="col-12 pt-20">
                                                    Social Links
                                                </div>
                                            </div>
                                            <div class="col-7 font-size-14 personal-information-big">
                                                <div class="col-12 view-font-bold">
                                                    watanabetada@gmail.com <i class="fa fa-clipboard view-cursor" aria-hidden="true"></i>
                                                </div>
                                                <div class="col-12 pt-20 view-font-bold">
                                                    +880175089653 <i class="fa fa-clipboard view-cursor" aria-hidden="true"></i>
                                                </div>
                                                <div class="col-12 pt-20 view-font-bold">
                                                    +880175089653 <i class="fa fa-clipboard view-cursor" aria-hidden="true"></i>
                                                </div>
                                                <div class="col-12 pt-20 view-font-bold">
                                                    watanabe@tokyocons.com <i class="fa fa-clipboard view-cursor" aria-hidden="true"></i>
                                                </div>
                                                <div class="col-12 pt-20 view-font-bold">
                                                    <p><i class="fa fa-facebook-square social-facebook" aria-hidden="true"></i> &nbsp;/watanabe <i class="fa fa-clipboard view-cursor" aria-hidden="true"></i></p>
                                                    <p><i class="fa fa-twitter-square" aria-hidden="true"></i> &nbsp;/watanabetadawoki <i class="fa fa-clipboard view-cursor" aria-hidden="true"></i></p>
                                                    <p><i class="fa fa-linkedin-square" aria-hidden="true"></i> &nbsp;/watanab546 <i class="fa fa-clipboard view-cursor" aria-hidden="true"></i></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                <div class="col-12 padding-work font-size-17 pl-20">
                                    <i class="fa fa-briefcase" aria-hidden="true"></i> Work information
                                </div>
                                <hr>
                                <div class="row pl-20">
                                    <div class="col-lg-2 col-md-6 col-6 pt-10 font-size-14">
                                        <div class="col-12">
                                            Company
                                        </div>
                                        <div class="col-12 pt-20">
                                            Branch
                                        </div>
                                        <div class="col-12 pt-20">
                                            Department
                                        </div>
                                        <div class="col-12 pt-20">
                                            Title
                                        </div>
                                        <div class="col-12 pt-20">
                                            Working Hours
                                        </div>
                                        <div class="col-12 pt-20">
                                            Status
                                        </div>
                                        <div class="col-12 pt-20">
                                            Condition
                                        </div>
                                        <div class="col-12 pt-20">
                                            Management
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-6 font-size-14">
                                        <div class="col-12 pt-10 view-font-bold">
                                            Tokyo Consulting Firm Limited
                                        </div>
                                        <div class="col-12 pt-20 view-font-bold">
                                            Dhaka, Bangladesh
                                        </div>
                                        <div class="col-12 pt-20 view-font-bold">
                                            N/A
                                        </div>
                                        <div class="col-12 pt-20 view-font-bold">
                                            Managing Director
                                        </div>
                                        <div class="col-12 pt-20 view-font-bold">
                                            8:30 AM - 5: 30 PM (GMT +6)
                                        </div>
                                        <div class="col-12 pt-20 view-font-bold">
                                            Active
                                        </div>
                                        <div class="col-12 pt-20 view-font-bold">
                                            Permanent
                                        </div>
                                        <div class="col-12 pt-20 view-font-bold">
                                            Leader
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-6 col-6 font-size-14">
                                        <div class="col-12 pt-10">
                                            Joining Date
                                        </div>
                                        <div class="col-12 pt-20">
                                            Service Years
                                        </div>
                                        <div class="col-12 pt-20">
                                            Employee ID
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-6 font-size-14">
                                        <div class="col-12 pt-10 view-font-bold">
                                            08/02/2013
                                        </div>
                                        <div class="col-12 pt-20 view-font-bold">
                                            10 Year 2 Months
                                        </div>
                                        <div class="col-12 pt-20 view-font-bold">
                                            BDJP-01
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="col-12 pl-20 font-size-17 pt-60">
                                            <i class="fa fa-briefcase" aria-hidden="true"></i> Attachments
                                        </div>
                                        <hr>
                                        <div class="row pl-10">
                                            <div class="col-lg-2 col-md-3 col-3 pt-20 pl-20">
                                                <img src="<?= Yii::$app->homeUrl ?>image/Doc-1.png" class="image-file-plus1">
                                            </div>
                                            <div class="col-lg-6 col-md-5 col-5 pt-20">
                                                <strong class="text-dark"> Employee Agreement-DD.pdf</strong>
                                                <div class="text-secondary font-size-14" style="width: 80px;">Size 5.21 MB </div>
                                                <div class="text-secondary font-size-14">last Updated 08/14/2023</div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-4 pt-30">
                                                <button type="button" class="btn btn-outline-secondary font-size-12"><i class="fa fa-eye" aria-hidden="true"></i></button>
                                                <button type="button" class="btn btn-outline-secondary font-size-12"><i class="fa fa-cloud-download" aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row pl-10">
                                            <div class="col-lg-2 col-md-3 col-3 pt-20 pl-20">
                                                <img src="<?= Yii::$app->homeUrl ?>image/Doc-2.png" class="image-file-plus1">
                                            </div>
                                            <div class="col-lg-6 col-md-5 col-5 pt-20">
                                                <strong class="text-dark"> Employee Agreement-DD.pdf</strong>
                                                <div class="text-secondary font-size-14" style="width: 80px;">Size 5.21 MB </div>
                                                <div class="text-secondary font-size-14">last Updated 08/14/2023</div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-4 pt-30">
                                                <button type="button" class="btn btn-outline-secondary font-size-12"><i class="fa fa-eye" aria-hidden="true"></i></button>
                                                <button type="button" class="btn btn-outline-secondary font-size-12"><i class="fa fa-cloud-download" aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12 form-pdf">
                                        <div class="col-12">
                                            <div class="myIframe">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                                <div class="row">
                                    <div class="col-lg-9 col-md-6 col-6 detail-salary">
                                        <i class="fa fa-database" aria-hidden="true"></i> Salary & Allowance
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-6 in-details">
                                        VIEW IN DETAILS
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-12 danger-details">
                                        <div class="row">
                                            <div class="col-6 pl-30 font-size-14">
                                                Currency
                                            </div>
                                            <div class="col-6 salary-bold">
                                                JPY (¥)
                                            </div>
                                            <div class="col-6 pl-30 pt-20 font-size-14">
                                                Total Salary
                                            </div>
                                            <div class="col-6 pt-20 salary-bold">
                                                ¥ 49,000,000
                                            </div>
                                            <div class="col-6 pl-30 pt-20 font-size-14">
                                                Basic Salary
                                            </div>
                                            <div class="col-6 pt-20 salary-bold">
                                                ¥ 48,000,000
                                            </div>
                                            <div class="col-6 pl-30 pt-20 font-size-14">
                                                Transportation
                                            </div>
                                            <div class="col-6 pt-20 salary-bold">
                                                ¥ 500,000
                                            </div>
                                            <div class="col-6 pl-30 pt-20 font-size-14">
                                                Title Allowance
                                            </div>
                                            <div class="col-6 pt-20 salary-bold">
                                                ¥ 300,000
                                            </div>
                                            <div class="col-6 pl-30 pt-20 font-size-14">
                                                Qualification Allowance
                                            </div>
                                            <div class="col-6 pt-20 salary-bold">
                                                ¥ 200,000
                                            </div>
                                            <div class="col-6 pl-30 pt-20 font-size-14">
                                                Food Allowance
                                            </div>
                                            <div class="col-6 pt-20 salary-bold">
                                                N/A
                                            </div>
                                            <div class="col-6 pl-30 pt-20 font-size-14">
                                                Other Allowance
                                            </div>
                                            <div class="col-6 pt-20 salary-bold">
                                                N/A
                                            </div>
                                            <div class="col-6 pl-30 pt-20 font-size-14">
                                                Other Allowance
                                            </div>
                                            <div class="col-6 pt-20 salary-bold">
                                                N/A
                                            </div>
                                            <div class="col-6 pl-30 pt-20 font-size-14">
                                                Other Allowance
                                            </div>
                                            <div class="col-6 pt-20 salary-bold">
                                                N/A
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8 col-md-6 col-12 a-shadowbd">
                                        <div class="shadow p-3 bg-body rounded linechart0 mr-10">
                                            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"> </script>
                                            <canvas id="sampleChart" style="height: 200px;"></canvas>
                                            <div id="output"></div>
                                            <script>
                                                let output = document.getElementById('output');
                                                let canvas = document.getElementById("sampleChart");
                                                let line1Data = [9, 10, 12, 11, 11, 15, 12, 12, 12, 13, 19, 22, 31, 36, 39, 40, 41, 45, 50, 55, 59, 60];
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
                                                    },

                                                });
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-details" role="tabpanel" aria-labelledby="v-pills-details-tab">
                                <div class="row">
                                    <div class="col-lg-6 col-md-4 col-4 pl-30 e-valution font-size-17">
                                        <i class="fa fa-tachometer" aria-hidden="true"></i> Evaluation
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-4 e-valution-view text-end">
                                        <i class="fa fa-external-link" aria-hidden="true"></i> Evaluation Dashboard
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-4 e-valution-view">
                                        Detailed Summary
                                    </div>
                                </div>
                                <hr>
                                <div class="col-lg-12 col-md-12 col-12 pl-20 pr-20">
                                    <div class="shadow p-3 bg-body rounded">
                                        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
                                        <canvas id="myChart" style="width: 100%;height:390px;"></canvas>
                                        <script>
                                            const xValue = ['1Q', '2Q', '3Q', '4Q', '1Q', '2Q', '3Q', '4Q', '1Q', '2Q', '3Q', '4Q', '1Q', '2Q', '3Q', '4Q', '1Q', '2Q', '3Q', '4Q'];
                                            const yValue = ['0', '20', '30', '40', '50', '60', '70', '80', '90', '100']

                                            new Chart("myChart", {
                                                type: "line",
                                                data: {
                                                    labels: xValue,
                                                    datasets: [{
                                                            data: [60, 70, 60, 50, 50, 60, 60, 40, 50, 70, 60, 50, 50, 40, 50, 60, 30, 40, 40, 50],
                                                            borderColor: "red",
                                                            lineTension: 0,
                                                            fill: false

                                                        }, {
                                                            data: [40, 50, 70, 60, 70, 60, 50, 60, 70, 80, 60, 50, 60, 60, 70, 60, 70, 50, 70, 50],
                                                            borderColor: "orange",
                                                            lineTension: 0,
                                                            fill: false

                                                        },
                                                        {
                                                            data: [50, 40, 50, 40, 60, 40, 50, 40, 40, 50, 60, 70, 50, 40, 60, 60, 50, 60, 60, 50],
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
                            </div>
                            <div class="tab-pane fade" id="v-pills-skill" role="tabpanel" aria-labelledby="v-pills-skill-tab">
                                <!-- <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12 padding-work font-size-17 pl-20">
                                        <img src="<?= Yii::$app->homeUrl ?>image/certificate.png" class="img-ertificate"> Licenses & certifications
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12 padding-work font-size-17">
                                        <img src="<?= Yii::$app->homeUrl ?>image/certificate.png" class="img-ertificate"> Skills
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-6 col-12 mt-30 pl-20">
                                            <img src="<?= Yii::$app->homeUrl ?>image/cia.png" class="image-cia">
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-12">
                                            <div class="col-12 mt-30">
                                                <p><strong class="font-size-13"> Certified Internal Auditor</strong></p>
                                                <p class="textweight"> The Institute of Internal Auditor</p>
                                                <p class="textweight">Issued Nov 2023 . Expires Nov 2025
                                                <div class="alert alert-light Show-Credentials"> Show Credentials &nbsp; <i class="fa fa-external-link" aria-hidden="true"></i></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-6 col-12">
                                            <img src="<?= Yii::$app->homeUrl ?>image/Sample.png" class="image-Sample">
                                        </div>
                                    </div>
                                </div> -->
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="col-12 pl-20 font-size-17 pt-20">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="col-12">
                                                        <img src="<?= Yii::$app->homeUrl ?>image/certificate.png" class="img-ertificate"><span class="font-size-13"> Licenses & certifications</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 pt-5">
                                                    <div class="col-12 font-size-13 text-end Remove">
                                                        <i class="fa fa-plus-square-o" aria-hidden="true"></i> Remove
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 pt-5">
                                                    <div class="col-12 font-size-13 text-end Add">
                                                        <i class="fa fa-plus-square-o" aria-hidden="true"></i> Add
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row pl-10">
                                                <div class="col-lg-4 col-md-3 col-3 pt-20 pl-20">
                                                    <img src="<?= Yii::$app->homeUrl ?>image/pngaaa.png" class="img-thumbnail">
                                                </div>
                                                <div class="col-lg-5 col-md-5 col-5 pt-20">
                                                    <strong class="font-size-12"> Certified Internal Auditor</strong>
                                                    <div class="textweight"> The Institute of Internal Auditor</div>
                                                    <div class="textweight">Issued Nov 2023 . Expires Nov 2025 </div>
                                                    <div class="alert alert-light Show-Credentials"> Show Credentials &nbsp; <i class="fa fa-external-link" aria-hidden="true"></i></div>
                                                </div>
                                                <div class="col-lg-3 col-md-4 col-4">
                                                    <img src="<?= Yii::$app->homeUrl ?>image/Sample.png" class="image-Sample">
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row pl-10">
                                                <div class="col-lg-4 col-md-3 col-3 pt-20 pl-20">
                                                    <img src="<?= Yii::$app->homeUrl ?>image/google.png" class="img-thumbnail">
                                                </div>
                                                <div class=" col-lg-5 col-md-5 col-5 pt-20">
                                                    <strong class="font-size-12"> Python Specialist </strong>
                                                    <div class="textweight"> Google</div>
                                                    <div class="textweight">Issued Nov 2023 . No Expire </div>
                                                    <div class="alert alert-light Show-Credentials"> Show Credentials &nbsp; <i class="fa fa-external-link" aria-hidden="true"></i></div>
                                                </div>
                                                <div class="col-lg-3 col-md-4 col-4">
                                                    <img src="<?= Yii::$app->homeUrl ?>image/search-google.png" class="image-Sample">
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row pl-10">
                                                <div class="col-lg-4 col-md-3 col-3 pt-20 pl-20">
                                                    <img src="<?= Yii::$app->homeUrl ?>image/lghrvc1.png" class="img-thumbnail">
                                                </div>
                                                <div class=" col-lg-5 col-md-5 col-5 pt-20">
                                                    <strong class="font-size-12"> 延喜式掃除名人</strong>
                                                    <div class="textweight"> The Institute of Internal Auditor</div>
                                                    <div class="textweight">Issued Nov 2023 . Expires Nov 2025 </div>
                                                    <div class="alert alert-light Show-Credentials"> Show Credentials &nbsp; <i class="fa fa-external-link" aria-hidden="true"></i></div>
                                                </div>
                                                <div class="col-lg-3 col-md-4 col-4">
                                                    <img src="<?= Yii::$app->homeUrl ?>image/食品衛生者養成講習会.png" class="image-Sample">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12 pt-22">
                                        <div class="row">
                                            <div class="col-lg-7">
                                                <div class="col-12 font-size-13">
                                                    <img src="<?= Yii::$app->homeUrl ?>image/certificate.png" class="img-ertificate"> Skills
                                                </div>
                                            </div>
                                            <div class="col-lg-5">
                                                <div class="col-12">
                                                    <span class="dropdown font-size-13 Add pl-80" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"> Add <i class="fa fa-plus-square-o" aria-hidden="true"></i> </span>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                        <li>
                                                            <a class="dropdown-item" type="button"> Add</a>
                                                        </li>
                                                        <li>
                                                            <hr class="dropdown-divider">
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" type="button"> Create New</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="col-12 font-size-13 pt-15">
                                            <strong> Verbal Communication</strong>
                                        </div>
                                        <div class="row pl-10">
                                            <div class="col-lg-4 pt-20">
                                                <div class="col-12">
                                                    <span class="badge rounded-pill bg verb-background">Verbal Communication</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 pt-20 text-center">
                                                <div class="col-12">
                                                    <span class="badge rounded-pill bg verb-background">Active Listening</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 pt-20">
                                                <div class="col-12">
                                                    <span class="badge rounded-pill bg verb-background">Active Listening</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 pt-20">
                                                <div class="col-12">
                                                    <span class="badge rounded-pill bg verb-background">Public Speaking</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 font-size-13 pt-15">
                                            <strong>Interpersonal Communication</strong>
                                        </div>
                                        <div class="row pl-10">
                                            <div class="col-lg-4 pt-20">
                                                <div class="col-12">
                                                    <span class="badge rounded-pill bg verb-background">Relationship Building</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 pt-20 text-center">
                                                <div class="col-12">
                                                    <span class="badge rounded-pill bg verb-background">Conflict Resolution</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 pt-20">
                                                <div class="col-12">
                                                    <span class="badge rounded-pill bg verb-background">Networking</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 font-size-13 pt-15">
                                            <strong> Strategic Leadership</strong>
                                        </div>
                                        <div class="row pl-10">
                                            <div class="col-lg-4 pt-20">
                                                <div class="col-12">
                                                    <span class="badge rounded-pill bg verb-background">Visionary Thinking</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-5 pt-20 text-center">
                                                <div class="col-12">
                                                    <span class="badge rounded-pill bg verb-background">Decision Making</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 pt-20">
                                                <div class="col-12">
                                                    <span class="badge rounded-pill bg verb-background">Change Management</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 font-size-13 pt-15">
                                            <strong> Team Leadership</strong>
                                        </div>
                                        <div class="row pl-10">
                                            <div class="col-lg-3 pt-20">
                                                <div class="col-12">
                                                    <span class="badge rounded-pill bg verb-background">Team Building</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 pt-20 text-center">
                                                <div class="col-12">
                                                    <span class="badge rounded-pill bg verb-background">Delegation</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 pt-20">
                                                <div class="col-12">
                                                    <span class="badge rounded-pill bg verb-background">Motivation</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>