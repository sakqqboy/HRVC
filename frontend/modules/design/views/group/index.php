<?php

$this->title = 'group profile';
?>

<div class="col-12" style="margin-top: 60px;">
    <div class="col-12">
        <img src="<?= Yii::$app->homeUrl ?>image/sadd-1.png" class="sad-1">
    </div>
    <div class="col-12 edit-update">
        <button type="button" class="btn btn-light"> <i class="fa fa-pencil" aria-hidden="true"></i> Update</button>
    </div>
    <div class="row">
        <div class="col-lg-4 col-md-6 col-12  all-avatar">
            <div class="avatar-upload">
                <div class="avatar-edit">
                    <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" />
                    <label for="imageUpload"></label>
                </div>
                <div class="avatar-preview">
                    <div id="imagePreview">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-12">
            <div class="col-12 name-tokyo">
                Tokyo Consulting Group
            </div>
            <div class="col-12 tokyo-small">
                Balanced money, balanced life
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-12 text-end mt-30">
            <span class="tcg-edit">TCG </span> <button type="button" class="btn btn-success"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</button>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 col-md-6 col-12">
            <div class="col-12 Group-Information">
                Group Information
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12 mt-10 text-end name-head">
                    Headquarter
                </div>
                <div class="col-lg-6 col-md-6 col-12 mt-10">
                    <i class="fa fa-map-marker" aria-hidden="true"></i> <span class="text-primary">Shinjuku-ku, Tokyo</span>
                </div>
                <div class="col-lg-6 col-md-6 col-12 mt-10 text-end name-head">
                    Address
                </div>
                <div class="col-lg-6 col-md-6 col-12 mt-10">
                    7F-AM building, 2-5-3 Shinjuku
                    Shinjuku-ku, Tokyo 160-0022, JP
                </div>
                <div class="col-lg-6 col-md-6 col-12 mt-10 text-end name-head">
                    Established
                </div>
                <div class="col-lg-6 col-md-6 col-12 mt-10">
                    1998
                </div>
                <div class="col-lg-6 col-md-6 col-12 mt-10 text-end name-head">
                    Company/Director
                </div>
                <div class="col-lg-6 col-md-6 col-12 mt-10">
                    <img src="<?= Yii::$app->homeUrl ?>image/Mask-group.png"> Yasunari Kuno
                </div>
                <hr class="mt-20">
            </div>
            <div class="col-12 Group-Information">
                Contact Information
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12 mt-10 text-end name-head">
                    Email
                </div>
                <div class="col-lg-6 col-md-6 col-12 mt-10">
                    <span class="text-primary">tcg@tokyoconsultinggroup.com</span>
                </div>
                <div class="col-lg-6 col-md-6 col-12 mt-10 text-end name-head">
                    Contact
                </div>
                <div class="col-lg-6 col-md-6 col-12 mt-10">
                    +813-5369-2930
                </div>
                <div class="col-lg-6 col-md-6 col-12 mt-10 text-end name-head">
                    Website
                </div>
                <div class="col-lg-6 col-md-6 col-12 mt-10">
                    <span class="text-primary">https://www.kuno-cpa.co.jp</span>
                </div>
                <hr class="mt-20">
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-6">
                    <div class="alert alert-secondary" role="alert">
                        <div class="row">
                            <div class="col-2">
                                <i class="fa fa-users" aria-hidden="true" style="font-size: 20px;padding-top: 20px;"></i>
                            </div>
                            <div class="col-2">
                                <div class="col-12 text-primary">
                                    Employees
                                </div>
                                <div class="col-2 number-bold">
                                    598
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-6">
                    <div class="alert alert-secondary-background" role="alert">
                        <div class="row">
                            <div class="col-2">
                                <i class="fa fa-users" aria-hidden="true" style="font-size: 20px;padding-top: 20px;"></i>
                            </div>
                            <div class="col-2">
                                <div class="col-12 text-primary">
                                    Branch
                                </div>
                                <div class="col-2 number-bold">
                                    44
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-12">
            <div class="col-12 ABOUT-NAME">
                ABOUT
            </div>
            <div class="col-12" style="font-size: 14px;">
                Tokyo Consulting Group's mission is to help foreign companies to set-up business in Japan, and to help Japanese companies establishing themselves abroad. Our goal is to enhance businesses through the incorporation of our services. Our main services are book keeping, accounting, audit, tax, labor & human resources (social insurance and payroll), and outsourcing.
                <p> Furthermore, Tokyo Consulting Group provides consulting and advising services in various types of businesses and industries for foreign and prospective entities setting business in Japan.</p>

                <p> Furthermore, Tokyo Consulting Group provides consulting and advising services in various types of businesses and industries for foreign and prospective entities setting business in Japan.</p>

                <p> Furthermore, Tokyo Consulting Group provides consulting and advising services in various types of businesses and industries for foreign and prospective entities setting business in Japan.</p>

                <p>Social Tag <span class="facebook"> Facebook</span> </p>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-12 home-tokyo">
            <div class="row">
                <div class="col-lg-2">
                    <i class="fa fa-building" aria-hidden="true"></i>
                </div>
                <div class="col-lg-7" style="font-weight:700;">
                    Affiliated Companies
                </div>
                <div class="col-lg-3" style="font-weight:700;">
                    27
                </div>
            </div>
            <hr>
            <div class="col-12">
                <div class="row">
                    <div class="col-lg-3">
                        <img src="<?= Yii::$app->homeUrl ?>image/TCF-BD.png" class="width-TCF-BD">
                    </div>
                    <div class="col-lg-9">
                        <div class="tokyoconsultinggroup"> Tokyo Consulting Firm Pvt. Ltd.</div>
                        <p> <i class="fa fa-map-marker" aria-hidden="true"></i> Chennai, India </p>
                        <p>100,560 Employees</p>
                    </div>
                    <div class="col-lg-3">
                        <img src="<?= Yii::$app->homeUrl ?>image/TCF-BD.png" class="width-TCF-BD">
                    </div>
                    <div class="col-lg-9">
                        <div class="tokyoconsultinggroup"> Tokyo Consulting Firm Pvt. Ltd.</div>
                        <p> <i class="fa fa-map-marker" aria-hidden="true"></i> Chennai, India </p>
                        <p>100,560 Employees</p>
                    </div>
                    <div class="col-lg-3">
                        <img src="<?= Yii::$app->homeUrl ?>image/TCF-BD.png" class="width-TCF-BD">
                    </div>
                    <div class="col-lg-9">
                        <div class="tokyoconsultinggroup"> Tokyo Consulting Firm Pvt. Ltd.</div>
                        <p> <i class="fa fa-map-marker" aria-hidden="true"></i> Chennai, India </p>
                        <p>100,560 Employees</p>
                    </div>
                    <div class="col-lg-3">
                        <img src="<?= Yii::$app->homeUrl ?>image/TCF-BD.png" class="width-TCF-BD">
                    </div>
                    <div class="col-lg-9">
                        <div class="tokyoconsultinggroup"> Tokyo Consulting Firm Pvt. Ltd.</div>
                        <p> <i class="fa fa-map-marker" aria-hidden="true"></i> Chennai, India </p>
                        <p>100,560 Employees</p>
                    </div>
                    <div class="col-lg-3">
                        <img src="<?= Yii::$app->homeUrl ?>image/TCF-BD.png" class="width-TCF-BD">
                    </div>
                    <div class="col-lg-9">
                        <div class="tokyoconsultinggroup"> Tokyo Consulting Firm Pvt. Ltd.</div>
                        <p> <i class="fa fa-map-marker" aria-hidden="true"></i> Chennai, India </p>
                        <p>100,560 Employees</p>
                    </div>
                    <div class="col-12 text-end">
                        <a href="#"> See All </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>






































<!-- <div class="col-12" style="margin-top:60px;">
    <div class="col-12 bk-mastersetting">
        <div class="row">
            <div class="col-lg-2 col-md-6 col-4">
            </div>
            <div class="col-lg-6 col-md-6 col-4">
                <img src="<?= Yii::$app->homeUrl ?>image/15.png" class="image-15">
            </div>
            <div class="col-lg-4 col-md-6 col-4 text-end">
                <img src="<?= Yii::$app->homeUrl ?>image/14.png" class="image-14">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-12">
            <div class="col-12">
                <img src="<?= Yii::$app->homeUrl ?>image/Group-21663.png" class="image-TCG-Logo">
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-12">
            <div class="col-12 mt-20">
                <p class="name-tokyo">Tokyo Consulting Group</p>
                <p class="tokyo-small">Balanced money, balanced life</p>
                <p class="tokyo-small">Shinjuku-ku, Tokyo</p>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-12 mt-20">
            <div class="col-12 text-end">
                <button type="button" class="btn btn-success">Add</button>
                <button type="button" class="btn btn-primary">Edit</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-10 col-md-6 col-6">
            <div class="row">
                <div class="col-lg-3">
                    <div class="thin-solid-color"></div>
                </div>
                <div class="col-lg-3">
                    <div class="thin-solid-color"></div>
                </div>
                <div class="col-lg-3">
                    <div class="thin-solid-color"></div>
                </div>
                <div class="col-lg-3">
                    <div class="thin-solid-color"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-6 col-6">
            <div class="col-12 title-Profile">
                Group Company Profile
            </div>
        </div>
    </div>
    <div class="col-12 text-center" style="font-size: 40px;">
        TCG
    </div>
    <div class="row mt-30">
        <div class="col-lg-2 col-md-6 col-4 pl-40">
            <div class="col-12 website-bold">
                Website
            </div>
            <div class="col-12 mt-20 website-bold">
                Location
            </div>
            <div class="col-12 mt-40 website-bold">
                Industries
            </div>
            <div class="col-12 mt-20 website-bold">
                Founded
            </div>
            <div class="col-12 mt-20 website-bold">
                Founded
            </div>
            <div class="col-12 mt-20 website-bold">
                Email
            </div>
            <div class="col-12 mt-20 website-bold">
                Contact
            </div>
            <div class="col-12 mt-20 website-bold">
                Specialties
            </div>
            <div class="col-12 website-bold" style="margin-top: 80px;">
                Social Tag
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-4">
            <div class="col-12 not-outline">
                https://www.kuno-cpa.co.jp/tcf/japan/service/overveiw.php
            </div>
            <div class="col-12 mt-20">
                7F-AM building, 2-5-3 Shinjuku Shinjuku-ku, Tokyo 160-0022, JP
            </div>
            <div class="col-12 mt-20">
                Accounting
            </div>
            <div class="col-12 mt-20">
                1998
            </div>
            <div class="col-12 mt-20">
                Yasunari Kuno
            </div>
            <div class="col-12 mt-20 not-outline">
                tokyotaro@tokyoconsultinggroup.com
            </div>
            <div class="col-12 mt-20">
                +813-5369-2930
            </div>
            <div class="col-12 mt-20">
                Accounting, Consulting, Business Setup, Financial Audit, Internal Audit, Human Resources, Mergers & Acquisitions, Payroll, Social Insurance, Staffing services, Tax, and Labor
            </div>
            <div class="col-12 mt-10 not-outline">
                Facebook
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-4">
            <div class="col-12">
                <div class="row">
                    <div class="col-2 ABOUT-NAME">
                        ABOUT
                    </div>
                    <div class="col-10">
                        Tokyo Consulting Group's mission is to help foreign companies to set-up business in Japan, and to help Japanese companies establishing themselves abroad. Our goal is to enhance businesses through the incorporation of our services. Our main services are book keeping, accounting, audit, tax, labor & human resources (social insurance and payroll), and outsourcing.  Furthermore, Tokyo Consulting Group provides consulting and advising services in various types of businesses and industries for foreign and prospective entities setting business in Japan. Our multicultural and multilingual staff is composed of more than 300 experienced and qualified professionals, many of them being Japanese Certified Public Accountants, USCPAs, Licensed Japanese Tax Accountants, and Social Insurance and Labor Specialists. We have an integrated service philosophy which allows us to provide the best service by selecting the exact expertise needed for each project from our experienced staff. Thus, we can deliver the best service possible, from accounting work to legal and cultural education. Throughout the wide range of services we provide, our commitment to our clients is absolute, and we focus on providing additional value to every engagement. It is our ultimate goal and wish that our clients become increasingly successful, and contribute to society in an effective way through our support.
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 text-center mt-50">
            <button type="button" class="btn btn-outline-dark">
                <div class="col-2 title-Companies">
                    Companies
                </div>
                <div class="col-2 companies-27 pl-20">
                    27
                </div>
            </button>
            <button type="button" class="btn btn-outline-dark">
                <div class="col-2 title-Companies">
                    Employees
                </div>
                <div class="col-2 companies-27 pl-20">
                    523
                </div>
            </button>
            <button type="button" class="btn btn-outline-dark">
                <div class="col-2 title-Companies">
                    Branches
                </div>
                <div class="col-2 companies-27 pl-20">
                    44
                </div>
            </button>
        </div>
    </div>
</div> -->