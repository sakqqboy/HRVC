<?php

$this->title = 'Add';
?>

<div class="col-12" style="margin-top: 60px;">
    <div class="col-12">
        <img src="<?= Yii::$app->homeUrl ?>image/gray.jpg" class="sad-1">
    </div>
    <div class="col-12 edit-update">
        <button type="button" class="btn btn-light"> <i class="fa fa-upload" aria-hidden="true"></i> Update</button>
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
            <div class="form-companyname">
                <div class="row">
                    <div class="col-5 Groupname1">
                        Group Company Name <span class="profile-moon">*</span>
                    </div>
                    <div class="col-7">
                        <input type="text" class="form-control" id="colFormLabel" placeholder="Tokyo Consulting Group">
                    </div>
                    <div class="mt-20"></div>
                    <div class="col-5">
                        Tag line
                    </div>
                    <div class="col-7">
                        <input type="text" class="form-control" id="colFormLabel" placeholder="Balanced money, balanced life">
                    </div>
                    <div class="mt-20"></div>
                    <div class="col-5">
                        Headquarter <span class="profile-moon">*</span>
                    </div>
                    <div class="col-7">
                        <input type="text" class="form-control" id="colFormLabel" placeholder="Shinjuku-ku, Tokyo">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-12">
            <div class="col-12 form-companyname">
                <button type="button" class="btn btn-secondary"> Tokyo Consulting Group</button>
            </div>
            <div class="col-12 eye-view-profile">
                <button type="button" class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i> View Profile</button>
            </div>
        </div>
    </div>
    <div class="col-12 mt-50">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-12">
                <hr>
            </div>
            <div class="col-lg-5 col-md-6 col-12 text-end Groupname2">
                Group Company Profile
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-12">
                <div class="form-companyname">
                    <div class="row">
                        <div class="col-3">
                            Display <span class="profile-moon">*</span>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control" id="colFormLabel" placeholder="TCG">
                        </div>
                        <div class="mt-20"></div>
                        <div class="col-3">
                            Website </div>
                        <div class="col-9">
                            <input type="text" class="form-control" id="colFormLabel" placeholder="https://www.kuno-cpa.co.jp/tcf/japan/service/overveiw.php">
                        </div>
                        <div class="mt-20"></div>
                        <div class="col-3">
                            Address <span class="profile-moon">*</span>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control" id="colFormLabel" placeholder="7F-AM building, 2-5-3 Shinjuku Shinjuku-ku, Tokyo 160-0022, JP">
                        </div>
                        <div class="mt-20"></div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-3">
                                    Country
                                </div>
                                <div class="col-4">
                                    <input type="text" class="form-control" id="colFormLabel" placeholder="Japan">
                                </div>
                                <div class="col-1">
                                    City
                                </div>
                                <div class="col-4">
                                    <input type="text" class="form-control" id="colFormLabel" placeholder="Tokyo">
                                </div>
                                <div class="mt-20"></div>
                                <div class="col-3">
                                    Postal Code
                                </div>
                                <div class="col-4">
                                    <input type="text" class="form-control" id="colFormLabel" placeholder=" 160-0022">
                                </div>
                                <div class="mt-20"></div>
                                <div class="col-3">
                                    Industries <span class="profile-moon">*</span>
                                </div>
                                <div class="col-4">
                                    <input type="text" class="form-control" id="colFormLabel" placeholder="Accounting">
                                </div>
                                <div class="col-2">
                                    Email <span class="profile-moon">*</span>
                                </div>
                                <div class="col-3">
                                    <input type="email" class="form-control" id="colFormLabel" placeholder="tokyotaro@tokyoconsultinggroup.com">
                                </div>
                                <div class="mt-20"></div>
                                <div class="col-3">
                                    Founded
                                </div>
                                <div class="col-4">
                                    <input type="text" class="form-control" id="colFormLabel" placeholder="1998">
                                </div>
                                <div class="col-2">
                                    Contact <span class="profile-moon">*</span>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" id="colFormLabel" placeholder="+813-5369-2930">
                                </div>
                                <div class="mt-20"></div>
                                <div class="col-3">
                                    Director <span class="profile-moon">*</span>
                                </div>
                                <div class="col-4">
                                    <input type="text" class="form-control" id="colFormLabel" placeholder="Yasunari Kuno">
                                </div>
                                <div class="col-2">
                                    Social Tag
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" id="colFormLabel" placeholder="Facebook">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12 mt-50">
                <div class="row">

                    <div class="col-12">
                        <div class="col-12" style="font-weight:700;">
                            ABOUT <span class="profile-moon">*</span>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                Tokyo Consulting Group's mission is to help foreign companies to set-up business in Japan, and to help Japanese companies establishing themselves abroad. Our goal is to enhance businesses through the incorporation of our services. Our main services are book keeping, accounting, audit, tax, labor & human resources (social insurance and payroll), and outsourcing.
                                <p> Furthermore, Tokyo Consulting Group provides consulting and advising services in various types of businesses and industries for foreign and prospective entities setting business in Japan. Our multicultural and multilingual staff is composed of more than 300 experienced and qualified professionals, many of them being Japanese Certified Public Accountants, USCPAs, Licensed Japanese Tax Accountants, and Social Insurance and Labor Specialists. We have an integrated service philosophy which allows us to provide the best service by selecting the exact expertise needed for each project from our experienced staff. Thus, we can deliver the best service possible, from accounting work to legal and cultural education. Throughout the wide range of services we provide, our commitment to our clients is absolute, and we focus on providing additional value to every engagement. It is our ultimate goal and wish that our clients become increasingly successful, and contribute to society in an effective way through our support.</p>
                            </div>
                        </div>
                        <div class="row mt-10">
                            <div class="col-3">
                                <div class="alert alert-secondary text-center" role="alert">
                                    <div class="text-primary"> Employees</div>
                                    <i class="fa fa-plus mt-10" aria-hidden="true"></i>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="alert alert-secondary text-center" role="alert">
                                    <div class="text-primary"> Branches</div>
                                    <i class="fa fa-plus mt-10" aria-hidden="true"></i>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="alert alert-secondary text-center" role="alert">
                                    <div class="text-primary"> Departments</div>
                                    <i class="fa fa-plus mt-10" aria-hidden="true"></i>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="alert alert-secondary text-center" role="alert">
                                    <div class="text-primary"> Tearm</div>
                                    <i class="fa fa-plus mt-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 text-end mt-10">
                            <button type="button" class="btn btn-primary">Apply</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>