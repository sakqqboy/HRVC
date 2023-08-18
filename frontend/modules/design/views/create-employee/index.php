<?php
$this->title = 'Create Employee';
?>
<div class="col-12 mt-90">
    <div class="alert example-2 scrollbar-ripe-malinka alert-create0" role="alert">
        <div class="col-12 create2-one">
            Create Employee
        </div>
        <div class="col-12 mt-30 font-size-20" style="font-weight: 700;">
            Personal Information
        </div>
        <hr class="col-10">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-12">
                <div class="profile-pic-div">
                    <img src="<?= Yii::$app->homeUrl ?>image/gray.png" id="photo">
                    <input type="file" id="file">
                    <label for="file" id="uploadBtn"><i class="fa fa-pencil" aria-hidden="true"></i> Upload</label>
                </div>
                <div class="col-12 acceptable">
                    <p> Acceptable file types: <strong> JPEG, PNG,</strong> </p>
                    <p class="pl-10">Maximum file Size: 1 MB</p>
                </div>
            </div>
            <div class="col-lg-1 col-md-6 col-12 show-thin"></div>
            <div class="col-lg-8 col-md-6 col-12">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-3 input-Firstname">
                        <label for="exampleFormControlInput1" class="form-label"><strong class="text-danger">*</strong> First Name</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
                    </div>
                    <div class="col-lg-3 col-md-6 col-3">
                        <label for="exampleFormControlInput1" class="form-label"><strong class="text-danger">*</strong> Last Name</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
                    </div>
                    <div class="col-lg-3 col-md-6 col-3">
                        <label for="exampleFormControlInput1" class="form-label"><strong class="text-danger">*</strong> Employee Number</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
                    </div>
                    <div class="col-lg-3 col-md-6 col-3">
                        <label for="exampleFormControlInput1" class="form-label"><strong class="text-danger">*</strong> Joining Date</label>
                        <input type="date" id="birthday" class="form-control" name="birthday" aria-label="Sizing example input" aria-describedby="">
                    </div>
                    <div class="col-lg-3 col-md-6 col-3 Select-Nationality">
                        <label for="exampleFormControlInput1" class="form-label"> Nationality </label>
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Select menu</option>
                            <option value="1">bangladresh</option>
                            <option value="2">Indonesia</option>
                            <option value="3">Japan</option>
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-6 col-3 Father-name">
                        <label for="exampleFormControlInput1" class="form-label">Father's Name</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
                    </div>
                    <div class="col-lg-3 col-md-6 col-3 Father-name">
                        <label for="exampleFormControlInput1" class="form-label">Mother's Name</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
                    </div>
                    <div class="col-lg-3 col-md-6 col-3 Father-name">
                        <label for="exampleFormControlInput1" class="form-label"><strong class="text-danger">*</strong> Date of Birth</label>
                        <input type="date" id="birthday" class="form-control" name="birthday" aria-label="Sizing example input" aria-describedby="">
                    </div>
                    <div class="col-lg-5 col-md-6 col-3 Address-line1">
                        <label for="exampleFormControlInput1" class="form-label"><strong class="text-danger">*</strong> Address Line 1</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
                    </div>
                    <div class="col-lg-5 col-md-6 col-3 Address-line2">
                        <label for="exampleFormControlInput1" class="form-label"><strong class="text-danger">*</strong> Address Line 2</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
                    </div>
                    <div class="col-lg-2 col-md-6 col-3 Address-line2">
                        <label for="exampleFormControlInput1" class="form-label"><strong class="text-danger">*</strong> Gender</label>
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Select</option>
                            <option value="1">Man</option>
                            <option value="2">Female</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 mt-20 font-size-16" style="font-weight: 700;">
            Contact Information
        </div>
        <hr class="col-10">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-3">
                <label for="exampleFormControlInput1" class="form-label"><strong class="text-danger">*</strong> Contact Number</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
            </div>
            <div class="col-lg-3 col-md-6 col-3">
                <label for="exampleFormControlInput1" class="form-label"><strong class="text-danger">*</strong> Emergency Contact Number</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="">

            </div>
            <div class="col-lg-3 col-md-6 col-3">
                <label for="exampleFormControlInput1" class="form-label"><strong class="text-danger">*</strong> Company Mail</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
            </div>
            <div class="col-lg-3 col-md-6 col-3">
                <label for="exampleFormControlInput1" class="form-label"><strong class="text-danger">*</strong> Personal Email</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
            </div>
        </div>
        <div class="col-12 mt-20 font-size-16" style="font-weight: 700;">
            Work Information
        </div>
        <hr class="col-10">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-12">
                <label for="exampleFormControlInput1" class="form-label"><strong class="text-danger">*</strong> Working Hours</label>
                <select class="form-select" aria-label="Default select example">
                    <option selected>Select</option>
                    <option value="1">Man</option>
                    <option value="2">Female</option>
                </select>
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <label for="exampleFormControlInput1" class="form-label"><strong class="text-danger">*</strong> Working Hours</label>
                <select class="form-select" aria-label="Default select example">
                    <option selected>Select</option>
                    <option value="1">Man</option>
                    <option value="2">Female</option>
                </select>
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <label for="exampleFormControlInput1" class="form-label"><strong class="text-danger">*</strong> Company</label>
                <select class="form-select" aria-label="Default select example">
                    <option selected>Select</option>
                    <option value="1">Man</option>
                    <option value="2">Female</option>
                </select>
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <label for="exampleFormControlInput1" class="form-label"><strong class="text-danger">*</strong> Branch</label>
                <select class="form-select" aria-label="Default select example">
                    <option selected>Select</option>
                    <option value="1">Man</option>
                    <option value="2">Female</option>
                </select>
            </div>
            <div class="col-lg-3 col-md-6 col-12 mt-50">
                <label for="exampleFormControlInput1" class="form-label"><strong class="text-danger">*</strong> Jop Title</label>
                <select class="form-select" aria-label="Default select example">
                    <option selected>Select</option>
                    <option value="1">Man</option>
                    <option value="2">Female</option>
                </select>
            </div>
            <div class="col-lg-3 col-md-6 col-12 mt-50">
                <label for="exampleFormControlInput1" class="form-label"><strong class="text-danger">*</strong> Employee Condition</label>
                <select class="form-select" aria-label="Default select example">
                    <option selected>Select</option>
                    <option value="1">Man</option>
                    <option value="2">Female</option>
                </select>
            </div>
            <div class="col-lg-3 col-md-6 col-12 mt-50">
                <label for="exampleFormControlInput1" class="form-label"><strong class="text-danger">*</strong> Employee Status</label>
                <select class="form-select" aria-label="Default select example">
                    <option selected>Select</option>
                    <option value="1">Man</option>
                    <option value="2">Female</option>
                </select>
            </div>
            <div class="col-lg-3 col-md-6 col-12 mt-50">
                <label for="exampleFormControlInput1" class="form-label"><strong class="text-danger">*</strong> Department Name</label>
                <select class="form-select" aria-label="Default select example">
                    <option selected>Select</option>
                    <option value="1">Man</option>
                    <option value="2">Female</option>
                </select>
            </div>
            <div class="col-lg-3 col-md-6 col-12 mt-50">
                <label for="exampleFormControlInput1" class="form-label"><strong class="text-danger">*</strong> Management</label>
                <select class="form-select" aria-label="Default select example">
                    <option selected>Select</option>
                    <option value="1">Man</option>
                    <option value="2">Female</option>
                </select>
            </div>
        </div>
        <div class="col-12 mt-20 font-size-16" style="font-weight: 700;">
            Attachments
        </div>
        <hr class="col-10">
        <div class="row">
            <div class="col-lg-5 col-md-6 col-12">
                <div class="dashed">
                    <div class="row">
                        <div class="col-lg-2 col-md-6 col-12 pt-20">
                            <!-- <img src="<?= Yii::$app->homeUrl ?>image/file-plus.png" class="image-file-plus"> -->
                            <label for="files" class="btn choosefile">File</label>
                            <input id="files" style="display:none;" type="file">
                        </div>
                        <div class="col-lg-5 col-md-6 col-12 pt-20">
                            <strong class="text-danger">*</strong>
                            <label for="name">Upload Resume</label>
                            <div class="text-secondary font-size-14">Supported Files <span class="text-dark font-size-10"> - .pdf, .doc, .docx</span></div>
                            <div class="text-secondary font-size-14">Maximum File Size 5 MB</div>
                        </div>
                        <div class="col-lg-1 col-md-6 col-12 show2"></div>
                        <div class="col-lg-4 col-md-6 col-12 pt-30">
                            <button type="button" class="btn btn-info text-white"> Upload</button>
                        </div>
                    </div>
                </div>
                <div class="mt-20"></div>
                <div class="dashed">
                    <div class="row">
                        <div class="col-lg-2 col-md-6 col-12 pt-20">
                            <!-- <img src="<?= Yii::$app->homeUrl ?>image/pdf.png" class="image-file-plus"> -->
                            <label for="files" class="btn choosefile">File</label>
                            <input id="files" style="display:none;" type="file">
                        </div>
                        <div class="col-lg-5 col-md-6 col-12 pt-20">
                            <label for="name"> Employee Agreement-DD.pdf</label>
                            <p class="text-secondary font-size-14">Size 1.21 MB
                                Uploaded On 08/14/2023
                            </p>
                        </div>
                        <div class="col-lg-1 col-md-6 col-12 show2"></div>
                        <div class="col-lg-4 col-md-6 col-12 pt-30">
                            <button type="button" class="btn btn-outline-secondary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                            <button type="button" class="btn btn-outline-secondary"><i class="fa fa-eye" aria-hidden="true"></i></button>
                            <button type="button" class="btn btn-outline-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-1 col-md-6 col-12 show3"></div>
            <div class="col-lg-6 col-md-6 col-12">
                <div class="col-12 font-size-21">
                    <i class="fa fa-briefcase" aria-hidden="true"></i> Remarks
                </div>
                <div class="col-12 solid" style="height: 90%">

                </div>
            </div>
        </div>
    </div>
</div>