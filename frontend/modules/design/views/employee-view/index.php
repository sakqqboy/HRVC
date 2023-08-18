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
                    </div>
                </div>
                <div class="row mt-10">
                    <div class="col-lg-3 col-md-6 col-12 text-primary font-size-17">
                        <i class="fa fa-share-alt" aria-hidden="true"></i> Share Profile
                    </div>
                    <div class="col-lg-2 col-md-6 col-12 text-primary font-size-17">
                        <i class="fa fa-print" aria-hidden="true"></i> Print
                    </div>
                    <div class="col-lg-3 col-md-6 col-12 text-primary font-size-17">
                        <i class="fa fa-cloud-download" aria-hidden="true"></i> Download CV
                    </div>
                    <div class="col-lg-2 col-md-6 col-12 text-primary font-size-17">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                    </div>
                </div>
            </div>
            <div class="d-flex align-items-start">
                <div class="col-lg-3 col-md-12 col-12 crd-background mr-10 ml-10">
                    <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <div class="col-12 emplo-infor mr-40 ml-40">
                            Employee
                            Information
                        </div>
                        <div class="col-12 mt-30 mr-30 ml-30">
                            <button class="nav-link" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true"> Personal & Contact Details</button>
                        </div>
                        <div class="col-12 mt-30 mr-30 ml-30">
                            <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false"> Work Information</button>
                        </div>
                        <div class="col-12 mt-30 mr-30 ml-30">
                            <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false"> Attachments</button>
                        </div>
                        <div class="col-12 mt-30 mr-30 ml-30">
                            <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false"> Evaluation</button>
                        </div>
                    </div>
                </div>
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="col-lg-9 col-md-12 col-12 alert-personal-information">
                        <div class="tab-pane fade show" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="col-12 mt-60 pl-10 font-size-18 text-dark">
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
                                    <div class="col-12 font-size-18 text-dark">
                                        <i class="fa fa-phone" aria-hidden="true"></i> Contact Information
                                    </div>
                                    <hr>
                                    <div class="row">
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
                            <div class="col-12 pl-20 pt-40 font-size-18 text-dark">
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
                                    <div class="col-12 pl-10 font-size-18 text-dark">
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
                                            <button type="button" class="btn btn-outline-secondary font-size-12"><i class="fa fa-cloud-download" aria-hidden="true"></i> </button>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-lg-2 col-md-6 col-12 pt-20 pl-20">
                                            <!-- <img src="<?= Yii::$app->homeUrl ?>image/Doc-2.png" class="image-file-plus1"> -->
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12 pt-20">
                                            <strong class="text-dark"> Employee Agreement-DD.pdf</strong>
                                            <div class="text-secondary font-size-14" style="width: 80px;">Size 5.21 MB </div>
                                            <div class="text-secondary font-size-14">last Updated 08/14/2023</div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-12 pt-30">
                                            <button type="button" class="btn btn-outline-secondary font-size-12"><i class="fa fa-eye" aria-hidden="true"></i></button>
                                            <button type="button" class="btn btn-outline-secondary font-size-12"><i class="fa fa-cloud-download" aria-hidden="true"></i> </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12 form-pdf">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">...</div>