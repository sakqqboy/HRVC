<?php
$this->title = 'view';
?>

<div class="col-12 mt-90">
    <div class="col-12 view-goback">
        <i class="fa fa-caret-left font-size-22" aria-hidden="true"></i> &nbsp;Go Back
    </div>
    <div class="alert alert-goback">
        <div class="col-12">
            <div class="alert alert-light mr-10 ml-10" style="border: none;">
                <div class="row">
                    <div class="col-lg-2 col-md-6 col-12">
                        <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="imageView">
                    </div>
                    <div class="col-lg-10 col-md-6 col-12">
                        <div class="con-12 mt-30">
                            <span class="name-Tadawoki">Tadawoki Watanabe</span><span class="badge bg-success font-size-17 ml-10">Active</span>
                        </div>
                        <div class="row">
                            <div class="col-lg-8 col-lg-6 col-12">
                                <div class="col-12 pt-10 Director-view">
                                    Director, Bangladesh
                                </div>
                                <div class="col-12 pt-20 font-size-14">
                                    <i class="fa fa-calendar-o" aria-hidden="true"></i> &nbsp;&nbsp; <span class="text-dark"> Joined on </span><strong> 02-05-2023</strong>
                                    <span class="view-solid"></span> <i class="fa fa-birthday-cake pl-10" aria-hidden="true"></i> <span class="text-dark"> Age</span><strong> 34</strong>
                                    <span class="badge bg-secondary"> Permanent</span>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 text-end">
                                <div class="col-12 pt-10">
                                    Working Place
                                </div>
                                <div class="col-12 pt-10">
                                    <img src="<?= Yii::$app->homeUrl ?>image/Round-Bangladesh.png" class="bd"> Dhaka, Bangladesh
                                </div>
                            </div>
                        </div>
                        <div class="row mt-30">
                            <div class="col-lg-12 col-md-6 col-12 box-shareprofile">
                                <div class="row">
                                    <div class="col-4 font-size-14 share-pointer">
                                        <i class="fa fa-share-alt" aria-hidden="true"></i> Share Profile
                                    </div>
                                    <div class="col-2 font-size-14 share-pointer">
                                        <i class="fa fa-print" aria-hidden="true"></i> Print
                                    </div>
                                    <div class="col-4 font-size-14 share-pointer">
                                        <i class="fa fa-cloud-download" aria-hidden="true"></i> Download CV
                                    </div>
                                    <div class="col-2 font-size-14 share-pointer">
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
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-3 col-sm-6 col-6 alert-personal-information">
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="col-12 font-size-17 pt-60 pl-20">
                                            <i class="fa fa-info-circle" aria-hidden="true"></i> Personal Information
                                        </div>
                                        <hr>
                                        <div class="row pl-20">
                                            <div class="col-5 font-size-14">
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
                                            <div class="col-7 font-size-14">
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
                                            <div class="col-6 font-size-14">
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
                                            <div class="col-6 font-size-14">
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
                                    <div class="col-2 pt-10 font-size-14">
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
                                    <div class="col-4 font-size-14">
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
                                    <div class="col-2 font-size-14">
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
                                    <div class="col-3 font-size-14">
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
                                        <div class="col-12 pl-30 font-size-17 pt-60">
                                            <i class="fa fa-briefcase" aria-hidden="true"></i> Attachments
                                        </div>
                                        <hr>
                                        <div class="row pl-20">
                                            <div class="col-lg-2 col-md-6 col-12 pt-20 pl-20">
                                                <img src="<?= Yii::$app->homeUrl ?>image/Doc-1.png" class="image-file-plus1">
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12 pt-20">
                                                <strong class="text-dark"> Employee Agreement-DD.pdf</strong>
                                                <div class="text-secondary font-size-14" style="width: 80px;">Size 5.21 MB </div>
                                                <div class="text-secondary font-size-14">last Updated 08/14/2023</div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-12 pt-30">
                                                <button type="button" class="btn btn-outline-secondary font-size-12"><i class="fa fa-eye" aria-hidden="true"></i></button>
                                                <button type="button" class="btn btn-outline-secondary font-size-12"><i class="fa fa-cloud-download" aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row pl-20">
                                            <div class="col-lg-2 col-md-6 col-12 pt-20 pl-20">
                                                <img src="<?= Yii::$app->homeUrl ?>image/Doc-2.png" class="image-file-plus1">
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12 pt-20">
                                                <strong class="text-dark"> Employee Agreement-DD.pdf</strong>
                                                <div class="text-secondary font-size-14" style="width: 80px;">Size 5.21 MB </div>
                                                <div class="text-secondary font-size-14">last Updated 08/14/2023</div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-12 pt-30">
                                                <button type="button" class="btn btn-outline-secondary font-size-12"><i class="fa fa-eye" aria-hidden="true"></i></button>
                                                <button type="button" class="btn btn-outline-secondary font-size-12"><i class="fa fa-cloud-download" aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12 form-pdf">
                                        <div class="col-12">
                                            <div class="myIframe">
                                                <iframe src="https://bandoo101.go.th/uploads/20151110121622y9OqG9U/store/20220224091733978TqLP.pdf" frameborder="0"></iframe>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                                <div class="row">
                                    <div class="col-lg-9 col-md-6 col-12 detail-salary">
                                        <i class="fa fa-database" aria-hidden="true"></i> Salary & Allowance
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-12 in-details">
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
                                        <div class="shadow p-3 bg-body rounded">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-details" role="tabpanel" aria-labelledby="v-pills-details-tab">
                                <div class="row">
                                    <div class="col-lg-9 col-md-6 col-12 pl-30 e-valution font-size-17">
                                        <i class="fa fa-tachometer" aria-hidden="true"></i> Evaluation
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-12 e-valution-view">
                                        VIEW IN DETAILS
                                    </div>
                                </div>
                                <hr>
                                <div class="col-lg-12 col-md-12 col-12 pl-20 pr-20">
                                    <div class="shadow p-3 bg-body rounded shadow-line">
                                        <script type="text/javascript">
                                            window.onload = function() {
                                                var chart = new CanvasJS.Chart("chartContainer", {

                                                    data: [{
                                                        type: "line",

                                                        dataPoints: [{
                                                                x: (0),
                                                                y: 50
                                                            },
                                                            {
                                                                x: (1),
                                                                y: 20
                                                            },
                                                            {
                                                                x: (2),
                                                                y: 90
                                                            },
                                                            {
                                                                x: (3),
                                                                y: 60
                                                            },
                                                            {
                                                                x: (4),
                                                                y: 80
                                                            },
                                                            {
                                                                x: (5),
                                                                y: 50
                                                            },
                                                            {
                                                                x: (6),
                                                                y: 89
                                                            },
                                                            {
                                                                x: (7),
                                                                y: 60
                                                            },
                                                            {
                                                                x: (8),
                                                                y: 100
                                                            },
                                                            {
                                                                x: (9),
                                                                y: 70
                                                            },
                                                            {
                                                                x: (10),
                                                                y: 102
                                                            },
                                                            {
                                                                x: (11),
                                                                y: 120
                                                            }
                                                        ]
                                                    }]
                                                });

                                                chart.render();
                                            }
                                        </script>
                                        <!-- <script type="text/javascript" src="https://cdn.canvasjs.com/canvasjs.min.js"></script> -->
                                        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/fontawesome.min.css"></script>
                                        <div id="chartContainer" style="height: 400px; width: 800px;">
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





























<!-- <div class="row">
                <div class="d-flex align-items-start">
                    <div class="col-lg-3 col-md-4 col-6 crd-background">
                        <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <div class="col-12 emplo-infor">
                                Employee
                                Information
                            </div>
                            <div class="col-12 pt-50 pr-20 pl-20">
                                <div class="a link-2" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true"> Personal & Contact Details</div>
                            </div>
                            <div class="col-12 pt-10 pr-20 pl-20">
                                <a class="link-2" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false"> Work Information</a>
                            </div>
                            <div class="col-12 pt-10 pr-20 pl-20">
                                <a class="link-2" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false"> Attachments</a>
                            </div>
                            <div class="col-12 pt-10 pr-20 pl-20">
                                <a class="link-2" id="v-pills-detail-tab" data-bs-toggle="pill" data-bs-target="#v-pills-detail" type="button" role="tab" aria-controls="v-pills-detail" aria-selected="false"> Salary & Allowance</a>
                            </div>
                            <div class="col-12 pt-10 pr-20 pl-20">
                                <a class="link-2" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false"> Evaluation</a>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="col-lg-9 col-md-4 col-4 alert-personal-information border">
                            <div class="tab-pane fade show" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="col-12 pt-60 pl-10 font-size-16">
                                            <i class="fa fa-info-circle" aria-hidden="true"></i> Personal Information
                                        </div>
                                        <hr>
                                        <div class="row pl-20">
                                            <div class="col-5 font-size-14">
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
                                            <div class="col-7 font-size-14">
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
                                        <div class="col-12 font-size-16">
                                            <i class="fa fa-phone" aria-hidden="true"></i> Contact Information
                                        </div>
                                        <hr>
                                        <div class="row pl-20">
                                            <div class="col-5 font-size-14">
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
                                            <div class="col-7 font-size-14">
                                                <div class="col-12 view-font-bold">
                                                    watanabetada@gmail.com <i class="fa fa-clipboard view-cursor" aria-hidden="true"></i>
                                                </div>
                                                <div class="col-12 pt-20 view-font-bold">
                                                    +880175089653 <i class="fa fa-clipboard view-cursor" aria-hidden="true"></i>
                                                </div>
                                                <div class="col-12 pt-20 view-font-bold">
                                                    +880175089653 <i class="fa fa-clipboard view-cursor" aria-hidden="true"></i>
                                                </div>
                                                <div class="col-12 view-font-bold1">
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
                            <div class="tab-pane fade  briefcase-work" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                <div class="col-12 pl-20 pt-40 font-size-18">
                                    <i class="fa fa-briefcase" aria-hidden="true"></i> Work information
                                </div>
                                <hr>
                                <div class="row pl-20">
                                    <div class="col-2 pt-10 font-size-14">
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
                                    <div class="col-4 font-size-14">
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
                                    <div class="col-2 font-size-14">
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
                                    <div class="col-3 font-size-14">
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
                            <div class="tab-pane fade briefcase-Attachments" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="col-12 pl-10 font-size-18">
                                            <i class="fa fa-briefcase" aria-hidden="true"></i> Attachments
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-lg-2 col-md-6 col-12 pt-20 pl-20">
                                                <img src="<?= Yii::$app->homeUrl ?>image/Doc-1.png" class="image-file-plus1">
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12 pt-20">
                                                <strong class="text-dark"> Employee Agreement-DD.pdf</strong>
                                                <div class="text-secondary font-size-14" style="width: 80px;">Size 5.21 MB </div>
                                                <div class="text-secondary font-size-14">last Updated 08/14/2023</div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-12 pt-30">
                                                <button type="button" class="btn btn-outline-secondary font-size-12"><i class="fa fa-eye" aria-hidden="true"></i></button>
                                                <button type="button" class="btn btn-outline-secondary font-size-12"><i class="fa fa-cloud-download" aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-lg-2 col-md-6 col-12 pt-20 pl-20">
                                                <img src="<?= Yii::$app->homeUrl ?>image/Doc-2.png" class="image-file-plus1">
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12 pt-20">
                                                <strong class="text-dark"> Employee Agreement-DD.pdf</strong>
                                                <div class="text-secondary font-size-14" style="width: 80px;">Size 5.21 MB </div>
                                                <div class="text-secondary font-size-14">last Updated 08/14/2023</div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-12 pt-30">
                                                <a href="#"> <button type="button" class="btn btn-outline-secondary font-size-12"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                                                <button type="button" class="btn btn-outline-secondary font-size-12"><i class="fa fa-cloud-download" aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12 form-pdf pr-20">
                                        <div class="col-12 alert example-3 scrollbar-ripe-malinka alert-create0">
                                            <div class="col-12 pl-20 pr-20">
                                                <img src="<?= Yii::$app->homeUrl ?>image/f-pdf.png" style="width: 100%">
                                            </div>
                                            <div class="row uploadBtn">
                                                <div class="col-10 pl-20">
                                                    <i class="fa fa-chevron-circle-down" aria-hidden="true"></i> &nbsp; <i class="fa fa-chevron-circle-up" aria-hidden="true"></i>
                                                    <span class="badge rounded-pill bg-secondary">Page &nbsp; 1 &nbsp; of &nbsp; 1000</span> &nbsp;
                                                    <i class="fa fa-minus-square" aria-hidden="true"></i> &nbsp; <i class="fa fa-plus-square" aria-hidden="true"></i>
                                                </div>
                                                <div class="col-2 text-end">
                                                    <i class="fa fa-arrows-alt" aria-hidden="true"></i>
                                                </div>
                                                <div class="container">
                                                    <div class="row">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-detail" role="tabpanel" aria-labelledby="v-pills-detail-tab">
                                <div class="row">
                                    <div class="col-lg-9  pl-30 font-size-18 detail-salary">
                                        <i class="fa fa-database" aria-hidden="true"></i> Salary & Allowance
                                    </div>
                                    <div class="col-lg-3  in-details text-end pr-70">
                                        VIEW IN DETAILS
                                    </div>
                                    <hr class="col-11 Allowance">
                                </div>
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
                                    <div class="col-lg-8 col-md-6 col-12 a-shadowbd pr-60">
                                        <div class="shadow p-3 bg-body rounded">


                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                                <div class="row">
                                    <div class="col-lg-9 col-md-6 col-12 pl-30 e-valution font-size-18 text-dark">
                                        <i class="fa fa-tachometer" aria-hidden="true"></i> Evaluation
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-12 e-valution-view">
                                        VIEW IN DETAILS
                                    </div>
                                    <hr class="col-11 e-valution1">
                                </div>
                                <div class="col-lg-12 col-md-12 col-12 pl-20 pr-20">
                                    <div class="shadow p-3 bg-body rounded shadow-line">

                                        <html>

                                        <head>
                                            <script type="text/javascript">
                                                window.onload = function() {
                                                    var chart = new CanvasJS.Chart("chartContainer", {

                                                        data: [{
                                                            type: "line",

                                                            dataPoints: [{
                                                                    x: (0),
                                                                    y: 50
                                                                },
                                                                {
                                                                    x: (1),
                                                                    y: 20
                                                                },
                                                                {
                                                                    x: (2),
                                                                    y: 90
                                                                },
                                                                {
                                                                    x: (3),
                                                                    y: 60
                                                                },
                                                                {
                                                                    x: (4),
                                                                    y: 80
                                                                },
                                                                {
                                                                    x: (5),
                                                                    y: 50
                                                                },
                                                                {
                                                                    x: (6),
                                                                    y: 89
                                                                },
                                                                {
                                                                    x: (7),
                                                                    y: 60
                                                                },
                                                                {
                                                                    x: (8),
                                                                    y: 100
                                                                },
                                                                {
                                                                    x: (9),
                                                                    y: 70
                                                                },
                                                                {
                                                                    x: (10),
                                                                    y: 102
                                                                },
                                                                {
                                                                    x: (11),
                                                                    y: 120
                                                                }
                                                            ]
                                                        }]
                                                    });

                                                    chart.render();
                                                }
                                            </script>
                                            <script type="text/javascript" src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
                                        </head>

                                        <body>
                                            <div id="chartContainer" style="height: 400px; width: 100%;">
                                            </div>
                                        </body>

                                        </html>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
</div>
</div>
</div>