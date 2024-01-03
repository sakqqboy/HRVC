<?php
$this->title = 'Evaluation Settings';
?>

<div class="col-12 mt-90 alert alert-Evaluator">
    <div class="row">
        <div class="col-lg-3 col-md-6 col-12">
            <div class="row">
                <div class="col-5">
                    <img src="<?= Yii::$app->homeUrl ?>image/BD.jpg" class="imagealertEvaluator">
                </div>
                <div class="col-7 setEvaluator">
                    Tokyo Consulting Firm Pvt. Ltd
                </div>
            </div>
            <div class="col-12 Evaluator-country">
                &nbsp;&nbsp; <img src="<?= Yii::$app->homeUrl ?>image/Thailand.png" class="imageEvaluatorcountry"> Bangkok, Thailand
            </div>
            <div class="col-12">
                <div class="shadow-sm p-3 mb-5 bg-body rounded mt-30">
                    <div class="Mid-Term"> Mid Term Evaluation Phase</div>
                    <div class="E3"> E3 </div>
                </div>
            </div>
            <div class="card" style="border:none;">
                <div class="col-12">
                    <div class="col-12 EvaluatorConfiguration">
                        <i class="fa fa-cog" aria-hidden="true"></i> &nbsp; Set Configuration
                    </div>
                    <hr>
                    <div class="col-12">
                        <div>
                            <label class="rad-label">
                                <input type="radio" class="rad-input" name="rad">
                                <div class="rad-design"></div>
                                <div class="rad-text"> Evaluation Frame</div>
                            </label>
                            <div class="Evaluationdeshed"></div>

                            <label class="rad-label">
                                <input type="radio" class="rad-input" name="rad">
                                <div class="rad-design"></div>
                                <div class="rad-text"> Weight Allocation</div>
                            </label>

                            <label class="rad-label">
                                <input type="radio" class="rad-input" name="rad">
                                <div class="rad-design"></div>
                                <div class="rad-text"> Evaluator Settings</div>
                            </label>

                            <label class="rad-label">
                                <input type="radio" class="rad-input" name="rad">
                                <div class="rad-design"></div>
                                <div class="rad-text">Rank & Increasement</div>
                            </label>

                            <label class="rad-label">
                                <input type="radio" class="rad-input" name="rad">
                                <div class="rad-design"></div>
                                <div class="rad-text"> Salary & Allowance Range</div>
                            </label>

                            <label class="rad-label">
                                <input type="radio" class="rad-input" name="rad">
                                <div class="rad-design"></div>
                                <div class="rad-text"> Bonus calculation</div>
                            </label>

                            <label class="rad-label">
                                <input type="radio" class="rad-input" name="rad">
                                <div class="rad-design"></div>
                                <div class="rad-text"> Promotion</div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9 col-md-6 col-12">
            <div class="alert aler-ALLDepartment">
                <div class="row">
                    <div class="col-3">
                        <div class="Evaluator-Settings"> Evaluator Settings</div>
                    </div>
                    <div class="col-2 text-Participating">
                        Participating Employees
                    </div>
                    <div class="col-1 viewlog">
                        <span class="badge rounded-pill bg-gray">
                            <ul class="try-cricle">
                                <li class="tri-li"> <img src="/HRVC/frontend/web/image/avatar1.png" class="image-avatar1"></li>
                                <li class="tri-li"> <img src="/HRVC/frontend/web/image/Watanabe.png" class="image-avatar2"></li>
                                <li class="tri-li"> <img src="/HRVC/frontend/web/image/avatar3.png" class="image-avatar3"></li>
                                <a href="" class="none">
                                    <li class="tri-li-number1"> 5 </li>
                                </a>
                            </ul>
                        </span>
                    </div>
                    <div class="col-2 text-end Term1Employees">
                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Team-1.png" class="imagessettingsTerm1"> Employees
                    </div>
                    <div class="col-3">
                        <form class="d-flex">
                            <input class="form-control me-2 settingssearch-radius" type="search" placeholder="Search" aria-label="Search">
                            <i class="fa fa-search settingssearch" aria-hidden="true" type="submit"></i>
                        </form>
                    </div>
                    <div class="col-1">
                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/FilterPlus.png" class="imagessettingsFillerPlus">
                    </div>
                </div>
                <div class="col-12">
                    <div class="card bgcradlightgray">
                        <div class="row Row-bgcradlightgray">
                            <div class="col-lg-2 col-md-6 col-2">
                                <div class="col-12">
                                    employee
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-6 col-2">
                                <div class="col-12">
                                    key Financial Indicator
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-6 col-2">
                                <div class="col-12">
                                    key Group Indicator
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-6 col-2">
                                <div class="col-12">
                                    key Performance Indicator
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-6 col-2">
                                <div class="col-12">
                                    Primary Evaluator
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-6 col-2">
                                <div class="col-12">
                                    FINAL Evaluator
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-2 col-md-6 col-2">
                        <div class="card crdEmployeeslight1">
                            <div class="col-12">
                                <img src="<?= Yii::$app->homeUrl ?>image/lghrvc1.png" class="images1"> <span class="nameimages1"> Charles Bhattacharjya</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-2">
                        <div class="card crdEmployeeslight2">
                            <div class="text-group">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Light/Light/48px/SelectFromCheckboxs-3.png" class="check-circle-Employees1">
                                <!-- <input class="form-check-input form-check-input-checkEmployees1" type="checkbox" value="InputEmployees" id=""> -->
                                <label class="form-check-label LabelEmployees" for="defaultCheck1">6 Assigned &nbsp;</label>
                                <span>
                                    <div role="progressbarprimary" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="--value:20"></div>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-2">
                        <div class="card crdEmployeeslight3">
                            <div class="text-group">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Light/Light/48px/SelectFromCheckboxs-3.png" class="check-circle-Employees2">
                                <!-- <input class="form-check-input form-check-input-checkEmployees2" type="checkbox" value="InputEmployees2" id=""> -->
                                <label class="form-check-label LabelEmployees2" for="defaultCheck2">2 Assigned &nbsp;</label>
                                <span>
                                    <div role="progressbaryellow" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="--value:80"></div>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-2">
                        <div class="card crdEmployeeslight4">
                            <div class="text-group">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Light/Light/48px/SelectFromCheckboxs-3.png" class="check-circle-Employees3">
                                <!-- <input class="form-check-input form-check-input-checkEmployees3" type="checkbox" value="InputEmployees3" id=""> -->
                                <label class="form-check-label LabelEmployees3" for="defaultCheck2">12 Assigned &nbsp;</label>
                                <span>
                                    <div role="progressbarred" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="--value:40"></div>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-2 mt-10">
                        <div class="col-12">
                            <div class="input-group mb-3">
                                <span class="input-group-text group-btnprimary">1st</span>
                                <span class="form-control group-controltext">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-1">
                                                    <img src="<?= Yii::$app->homeUrl ?>image/thai.jpg" class="images2">
                                                </div>
                                                <div class="col-5">
                                                    <span class="nameimages2">
                                                        <div class="Directorfontsmall1"> Guru</div>
                                                        <div class="Directorfontsmall1"> Director</div>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-5">
                                                    <span class="nameimages2">
                                                        <div class="Directorfontsmall2"> Vikrant</div>
                                                        <div class="Directorfontsmall2"> Title</div>
                                                    </span>
                                                </div>
                                                <div class="col-1">
                                                    <img src="<?= Yii::$app->homeUrl ?>image/thai.jpg" class="images3">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </span>
                                <span class="input-group-text group-btnprimary">2nd</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1 col-md-6 col-12 mt-10">
                        <span class="btn btn-light" type="submit" data-bs-toggle="modal" data-bs-target="#exampleModalAssign"> <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Assign.png" class="imagesAssingLight"></span>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalAssign" tabindex="-1" aria-labelledby="exampleModalLabelAssign" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="countheader">
                                    <div class="row mt-10 pl-20">
                                        <div class="col-1" id="exampleModalLabelAssign">
                                            <img src="<?= Yii::$app->homeUrl ?>image/groupProfile.jpg" class="Profiles">
                                        </div>
                                        <div class="col-9">
                                            <div> AMI FARUQ </div>
                                            <div> Director, Gihu</div>
                                        </div>
                                        <div class="col-2 text-center mt-10 pl-50">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="col-12">
                                                Primary Evaluator
                                            </div>
                                            <div class="col-7 ml-30">
                                                <select class="form-select selectDefaultPrimary" aria-label="Default select example">
                                                    <option selected value="">Select this</option>
                                                    <option value="1">Tokyo Consulting Firm co.th</option>
                                                    <option value="2">Tokyo Consulting Firm group</option>
                                                    <option value="3">Tokyo Consulting Firm Limited</option>
                                                </select>
                                            </div>
                                            <div class="col-4 ml-30">
                                                <select class="form-select selectDefaultPrimary" aria-label="Default select example">
                                                    <option selected value="">Select this</option>
                                                    <option value="1">Branch</option>
                                                    <option value="2">Title</option>
                                                    <option value="3"> Employees</option>
                                                </select>
                                            </div>
                                            <div class="col-12 card cardPrimaryEvaluator">
                                                <div class="col-12">
                                                    <div class="form-check">
                                                        <input class="form-check-input Accountsborderdark" type="checkbox" value="" id="flexCheckDefault">
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/24px/Department.png" class="DepartmentAccounts"> Accounts
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-check  evaluatorIT">
                                                        <input class="form-check-input Accountsborderdark" type="checkbox" value="" id="flexCheckDefault">
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="imageDepartmentIT"> Charles Bhattacharjya
                                                        </label>
                                                    </div>
                                                    <div class="form-check  evaluatorIT">
                                                        <input class="form-check-input Accountsborderdark" type="checkbox" value="" id="flexCheckDefault">
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            <img src="<?= Yii::$app->homeUrl ?>image/employee3.png" class="imageDepartmentIT"> Biki Das
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-12 mt-10">
                                                    <div class="form-check">
                                                        <input class="form-check-input Accountsborderdark" type="checkbox" value="" id="flexCheckDefault">
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/24px/Department.png" class="DepartmentAccounts"> IT
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-check  evaluatorIT">
                                                        <input class="form-check-input Accountsborderdark" type="checkbox" value="" id="flexCheckDefault">
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="imageDepartmentIT"> Charles Bhattacharjya
                                                        </label>
                                                    </div>
                                                    <div class="form-check  evaluatorIT">
                                                        <input class="form-check-input Accountsborderdark" type="checkbox" value="" id="flexCheckDefault">
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            <img src="<?= Yii::$app->homeUrl ?>image/employee3.png" class="imageDepartmentIT"> Biki Das
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-12 mt-10">
                                                    <div class="form-check">
                                                        <input class="form-check-input Accountsborderdark" type="checkbox" value="" id="flexCheckDefault">
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/24px/Department.png" class="DepartmentAccounts"> MKT
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-check  evaluatorIT">
                                                        <input class="form-check-input Accountsborderdark" type="checkbox" value="" id="flexCheckDefault">
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="imageDepartmentIT"> Charles Bhattacharjya
                                                        </label>
                                                    </div>
                                                    <div class="form-check  evaluatorIT">
                                                        <input class="form-check-input Accountsborderdark" type="checkbox" value="" id="flexCheckDefault">
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            <img src="<?= Yii::$app->homeUrl ?>image/employee3.png" class="imageDepartmentIT"> Biki Das
                                                        </label>
                                                    </div>
                                                    <div class="form-check  evaluatorIT">
                                                        <input class="form-check-input Accountsborderdark" type="checkbox" value="" id="flexCheckDefault">
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="imageDepartmentIT"> Charles Bhattacharjya
                                                        </label>
                                                    </div>
                                                    <div class="form-check  evaluatorIT">
                                                        <input class="form-check-input Accountsborderdark" type="checkbox" value="" id="flexCheckDefault">
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            <img src="<?= Yii::$app->homeUrl ?>image/employee3.png" class="imageDepartmentIT"> Biki Das
                                                        </label>
                                                    </div>
                                                    <div class="form-check  evaluatorIT">
                                                        <input class="form-check-input Accountsborderdark" type="checkbox" value="" id="flexCheckDefault">
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="imageDepartmentIT"> Charles Bhattacharjya
                                                        </label>
                                                    </div>
                                                    <div class="form-check  evaluatorIT">
                                                        <input class="form-check-input Accountsborderdark" type="checkbox" value="" id="flexCheckDefault">
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            <img src="<?= Yii::$app->homeUrl ?>image/employee3.png" class="imageDepartmentIT"> Biki Das
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="col-12">
                                                Final Evaluator
                                            </div>
                                            <div class="col-7 ml-30">
                                                <select class="form-select selectDefaultPrimary" aria-label="Default select example">
                                                    <option selected value="">Select this</option>
                                                    <option value="1">Tokyo Consulting Firm co.th</option>
                                                    <option value="2">Tokyo Consulting Firm group</option>
                                                    <option value="3">Tokyo Consulting Firm Limited</option>
                                                </select>
                                            </div>
                                            <div class="col-4 ml-30">
                                                <select class="form-select selectDefaultPrimary" aria-label="Default select example">
                                                    <option selected value="">Select this</option>
                                                    <option value="1">Branch</option>
                                                    <option value="2">Title</option>
                                                    <option value="3"> Employees</option>
                                                </select>
                                            </div>
                                            <div class="col-12 card cardPrimaryEvaluator">
                                                <div class="col-12">
                                                    <div class="form-check">
                                                        <input class="form-check-input Accountsborderdark" type="checkbox" value="" id="flexCheckDefault">
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/24px/Department.png" class="DepartmentAccounts"> Accounts
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-check  evaluatorIT">
                                                        <input class="form-check-input Accountsborderdark" type="checkbox" value="" id="flexCheckDefault">
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="imageDepartmentIT"> Charles Bhattacharjya
                                                        </label>
                                                    </div>
                                                    <div class="form-check  evaluatorIT">
                                                        <input class="form-check-input Accountsborderdark" type="checkbox" value="" id="flexCheckDefault">
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            <img src="<?= Yii::$app->homeUrl ?>image/employee3.png" class="imageDepartmentIT"> Biki Das
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-12 mt-10">
                                                    <div class="form-check">
                                                        <input class="form-check-input Accountsborderdark" type="checkbox" value="" id="flexCheckDefault">
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/24px/Department.png" class="DepartmentAccounts"> IT
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-check  evaluatorIT">
                                                        <input class="form-check-input Accountsborderdark" type="checkbox" value="" id="flexCheckDefault">
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="imageDepartmentIT"> Charles Bhattacharjya
                                                        </label>
                                                    </div>
                                                    <div class="form-check  evaluatorIT">
                                                        <input class="form-check-input Accountsborderdark" type="checkbox" value="" id="flexCheckDefault">
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            <img src="<?= Yii::$app->homeUrl ?>image/employee3.png" class="imageDepartmentIT"> Biki Das
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-12 mt-10">
                                                    <div class="form-check">
                                                        <input class="form-check-input Accountsborderdark" type="checkbox" value="" id="flexCheckDefault">
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/24px/Department.png" class="DepartmentAccounts"> MKT
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-check  evaluatorIT">
                                                        <input class="form-check-input Accountsborderdark" type="checkbox" value="" id="flexCheckDefault">
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="imageDepartmentIT"> Charles Bhattacharjya
                                                        </label>
                                                    </div>
                                                    <div class="form-check  evaluatorIT">
                                                        <input class="form-check-input Accountsborderdark" type="checkbox" value="" id="flexCheckDefault">
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            <img src="<?= Yii::$app->homeUrl ?>image/employee3.png" class="imageDepartmentIT"> Biki Das
                                                        </label>
                                                    </div>
                                                    <div class="form-check  evaluatorIT">
                                                        <input class="form-check-input Accountsborderdark" type="checkbox" value="" id="flexCheckDefault">
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="imageDepartmentIT"> Charles Bhattacharjya
                                                        </label>
                                                    </div>
                                                    <div class="form-check  evaluatorIT">
                                                        <input class="form-check-input Accountsborderdark" type="checkbox" value="" id="flexCheckDefault">
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            <img src="<?= Yii::$app->homeUrl ?>image/employee3.png" class="imageDepartmentIT"> Biki Das
                                                        </label>
                                                    </div>
                                                    <div class="form-check  evaluatorIT">
                                                        <input class="form-check-input Accountsborderdark" type="checkbox" value="" id="flexCheckDefault">
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="imageDepartmentIT"> Charles Bhattacharjya
                                                        </label>
                                                    </div>
                                                    <div class="form-check  evaluatorIT">
                                                        <input class="form-check-input Accountsborderdark" type="checkbox" value="" id="flexCheckDefault">
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            <img src="<?= Yii::$app->homeUrl ?>image/employee3.png" class="imageDepartmentIT"> Biki Das
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 text-end pr-10 pb-10">
                                    <button class="btn btn-primary SET">SET</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End -->
                </div>
                <div class="row">
                    <div class="col-lg-2 col-md-6 col-2">
                        <div class="card crdEmployeeslight1">
                            <div class="col-12">
                                <img src="<?= Yii::$app->homeUrl ?>image/lghrvc1.png" class="images1"> <span class="nameimages1"> Tomas Shutradhar</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-2">
                        <div class="card crdEmployeeslight2">
                            <div class="text-group">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Light/Light/48px/SelectFromCheckboxs-3.png" class="check-circle-Employees1">
                                <label class="form-check-label LabelEmployees" for="defaultCheck1">6 Assigned &nbsp;</label>
                                <span>
                                    <div role="progressbarprimary" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="--value:20"></div>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-2">
                        <div class="card crdEmployeeslight3">
                            <div class="text-group">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Light/Light/48px/SelectFromCheckboxs-3.png" class="check-circle-Employees2">
                                <label class="form-check-label LabelEmployees2" for="defaultCheck2">2 Assigned &nbsp;</label>
                                <span>
                                    <div role="progressbaryellow" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="--value:80"></div>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-2">
                        <div class="card crdEmployeeslight4">
                            <div class="text-group">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Light/Light/48px/SelectFromCheckboxs-3.png" class="check-circle-Employees3">
                                <label class="form-check-label LabelEmployees3" for="defaultCheck2">12 Assigned &nbsp;</label>
                                <span>
                                    <div role="progressbarred" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="--value:40"></div>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-2 mt-10">
                        <div class="col-12">
                            <div class="input-group mb-3">
                                <span class="input-group-text group-btnprimary">1st</span>
                                <span class="form-control group-controltext">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-1">
                                                    <img src="<?= Yii::$app->homeUrl ?>image/thai.jpg" class="images2">
                                                </div>
                                                <div class="col-5">
                                                    <span class="nameimages2">
                                                        <div class="Directorfontsmall1"> Guru</div>
                                                        <div class="Directorfontsmall1"> Director</div>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-5">
                                                    <span class="nameimages2">
                                                        <div class="Directorfontsmall2"> Vikrant</div>
                                                        <div class="Directorfontsmall2"> Title</div>
                                                    </span>
                                                </div>
                                                <div class="col-1">
                                                    <img src="<?= Yii::$app->homeUrl ?>image/thai.jpg" class="images3">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </span>
                                <span class="input-group-text group-btnprimary">2nd</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1 col-md-6 col-12 mt-10">
                        <span class="btn btn-light" type="submit"><img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Assign.png" class="imagesAssingLight"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-2 col-md-6 col-2">
                        <div class="card crdEmployeeslight1">
                            <div class="col-12">
                                <img src="<?= Yii::$app->homeUrl ?>image/lghrvc1.png" class="images1"> <span class="nameimages1"> Charles Bhattacharjya</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-2">
                        <div class="card crdEmployeeslight2">
                            <div class="text-group">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Light/Light/48px/SelectFromCheckboxs-4.png" class="check-circle-close">
                                <label class="form-check-label LabelEmployees" for="defaultCheck1"> <span class="Not-Set "> Not set &nbsp;</span></label>
                                <span>
                                    <div role="progressbarprimary" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="--value:0"></div>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-2">
                        <div class="card crdEmployeeslight3">
                            <div class="text-group">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Light/Light/48px/SelectFromCheckboxs-4.png" class="check-circle-close">
                                <label class="form-check-label LabelEmployees2" for="defaultCheck1"> <span class="Not-Set "> Not set &nbsp;</span></label>
                                <span>
                                    <div role="progressbaryellow" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="--value:0"></div>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-2">
                        <div class="card crdEmployeeslight4">
                            <div class="text-group">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Light/Light/48px/SelectFromCheckboxs-4.png" class="check-circle-close">
                                <label class="form-check-label LabelEmployees3" for="defaultCheck1"> <span class="Not-Set "> Not set &nbsp;</span></label>
                                <span>
                                    <div role="progressbarred" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="--value:0"></div>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-2 mt-10">
                        <div class="col-12">
                            <div class="input-group mb-3">
                                <span class="input-group-text group-btnprimary">1st</span>
                                <span class="form-control group-controltext">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-1" style="display: none;">
                                                    <img src="<?= Yii::$app->homeUrl ?>image/thai.jpg" class="images2">
                                                </div>
                                                <div class="col-5">
                                                    <span class="nameimages2">
                                                        <div class="Directorfontsmall1"></div>
                                                        <div class="Directorfontsmall1"> </div>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-3">
                                                    <span class="nameimages2">
                                                        <div class="Directorfontsmall2"> </div>
                                                        <div class="Directorfontsmall2"> </div>
                                                    </span>
                                                </div>
                                                <div class="col-1" style="display: none;">
                                                    <img src="<?= Yii::$app->homeUrl ?>image/thai.jpg" class="images3">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </span>
                                <span class="input-group-text group-btnprimary">2nd</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1 col-md-6 col-12 mt-10">
                        <span class="btn btn-light" type="submit"><img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Assign.png" class="imagesAssingLight"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>