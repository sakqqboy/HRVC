<?php

$this->title = 'company profile';
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

        <div class="col-lg-4 col-md-6 col-12 text-end mt-40">
            <span class="tcg-edit">TCF </span>
            <button type="button" class="btn btn-success"><i class="fa fa-th-large" aria-hidden="true"></i> Create</button>
            <button type="button" class="btn btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</button>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-12">
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
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-12">
            <div class="col-12 ABOUT-NAME">
                ABOUT
            </div>
            <div class="col-12" style="font-size: 14px; padding-top:20px;">
                Tokyo Consulting Group's mission is to help foreign companies to set-up business in Japan, and to help Japanese companies establishing themselves abroad. Our goal is to enhance businesses through the incorporation of our services. Our main services are book keeping, accounting, audit, tax, labor & human resources (social insurance and payroll), and outsourcing.
                <p> Furthermore, Tokyo Consulting Group provides consulting and advising services in various types of businesses and industries for foreign and prospective entities setting business in Japan.</p>

                <p> Furthermore, Tokyo Consulting Group provides consulting and advising services in various types of businesses and industries for foreign and prospective entities setting business in Japan.</p>

                <p> Furthermore, Tokyo Consulting Group provides consulting and advising services in various types of businesses and industries for foreign and prospective entities setting business in Japan.</p>

                <p>Social Tag <span class="facebook"> Facebook</span> </p>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-6">
            <div class="alert alert-secondary-background" role="alert">
                <div class="row">
                    <div class="col-4">
                        <i class="fa fa-users" aria-hidden="true" style="font-size: 32px;padding-top: 15px;"></i>
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
        <div class="col-lg-3 col-md-6 col-6">
            <div class="alert alert-secondary-background" role="alert">
                <div class="row">
                    <div class="col-4">
                        <i class="fa fa-users" aria-hidden="true" style="font-size: 32px;padding-top: 15px;"></i>
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
        <div class="col-lg-3 col-md-6 col-6">
            <div class="alert alert-secondary-background" role="alert">
                <div class="row">
                    <div class="col-4">
                        <i class="fa fa-users" aria-hidden="true" style="font-size: 32px;padding-top: 15px;"></i>
                    </div>
                    <div class="col-2">
                        <div class="col-12 text-primary">
                            Departments
                        </div>
                        <div class="col-2 number-bold">
                            598
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-6">
            <div class="alert alert-secondary-background" role="alert">
                <div class="row">
                    <div class="col-4">
                        <i class="fa fa-users" aria-hidden="true" style="font-size: 32px;padding-top: 15px;"></i>
                    </div>
                    <div class="col-2">
                        <div class="col-12 text-primary">
                            Teams
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