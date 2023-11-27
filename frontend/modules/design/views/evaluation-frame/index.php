<?php
$this->title = 'Evaluation Frame';
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
                                <div class="rad-text"> PMI Weight Allocation</div>
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
                        <div class="FrameEvaluation"> Evaluation Frame</div>
                    </div>
                    <div class="col-3">
                        <button type="submit" class="btn btn-primary"> Save</button>
                    </div>
                    <div class="col-4 text-end">
                        <button type="submit" class="bg dangeredit"> Edit</button>
                    </div>
                    <div class="col-2 text-end">
                        <div class="col-12">
                            <i class="fa fa-filter fafil" aria-hidden="true"></i><i class="fa fa-plus plr-filter" aria-hidden="true"></i> &nbsp; <strong>Filter</strong> &nbsp; <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
                <div class="row mt-30">
                    <div class="col-lg-6">
                        <div class="alert alert-Evaluator">
                            <div class="mb-3 row">
                                <label for="inputTerm" class="col-sm-3 col-form-label formtermname">Term Name</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="">
                                </div>
                                <div class="col-sm-3">
                                    <div class="bg-primary formFrameE1 text-white pl-5 pt-5 pb-5 pr-5"> Frame <span class="bg-white formFrameE1 text-primary"> E1</span></div>
                                </div>
                            </div>
                        </div>
                        <div class="alert alert-Evaluator">
                            <div class="row transform">
                                <div class="col-3">
                                    Terms
                                </div>
                                <div class="col-2">
                                    Start
                                </div>
                                <div class="col-2">

                                </div>
                                <div class="col-2">
                                    Finish
                                </div>
                                <div class="col-3">
                                    Duration
                                </div>
                            </div>
                            <div class="col-12 card cc-transform">
                                <div class="row">
                                    <div class="col-3 Intermediate-solid">
                                        Intermediate Interview
                                    </div>
                                    <div class="col-3 datenumber">
                                        21/11/2023
                                    </div>
                                    <div class="col-1 datecalendar">
                                        <i class="fa fa-calendar-o" aria-hidden="true" type="date"></i>
                                    </div>
                                    <div class="col-3 Intermediate-solid">
                                        21/11/2023
                                    </div>
                                    <div class="col-2 datenumber">
                                        65 Days
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 card cc-transform">
                                <div class="row">
                                    <div class="col-3 Intermediate-solid">
                                        1st Evaluator
                                    </div>
                                    <div class="col-3 datenumber">
                                        21/11/2023
                                    </div>
                                    <div class="col-1 datecalendar">
                                        <i class="fa fa-calendar-o" aria-hidden="true" type="date"></i>
                                    </div>
                                    <div class="col-3 Intermediate-solid">
                                        21/11/2023
                                    </div>
                                    <div class="col-2 datenumber">
                                        26 Days
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 card transform2yellow">
                                <div class="row">
                                    <div class="col-3 Intermediate-solid">
                                        2st Evaluator
                                    </div>
                                    <div class="col-3 datenumber">
                                        21/11/2023
                                    </div>
                                    <div class="col-1 datecalendar">
                                        <i class="fa fa-calendar-o" aria-hidden="true" type="date"></i>
                                    </div>
                                    <div class="col-3 Intermediate-solid">
                                        21/11/2023
                                    </div>
                                    <div class="col-2 datenumber">
                                        7 Days
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 AddAnother">
                                <i class="fa fa-plus-circle ADD" aria-hidden="true"></i> ADD Another Deadline
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="alert alert-Evaluator">
                            <div class="mb-3 row">
                                <label for="inputName" class="col-sm-3 col-form-label formtermname">Input Name</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="">
                                </div>
                                <div class="col-sm-3">
                                    <div class="bg-primary formFrameE1 text-white pl-5 pt-5 pb-5 pr-5"> Frame <span class="bg-white formFrameE1 text-primary"> E2</span></div>
                                </div>
                            </div>
                        </div>
                        <div class="alert alert-Evaluator">
                            <div class="row transform">
                                <div class="col-3">
                                    Terms
                                </div>
                                <div class="col-2">
                                    Start
                                </div>
                                <div class="col-2">

                                </div>
                                <div class="col-2">
                                    Finish
                                </div>
                                <div class="col-3">
                                    Duration
                                </div>
                            </div>
                            <div class="col-12 card cc-transform">
                                <div class="row">
                                    <div class="col-3 Intermediate-solid">
                                        Intermediate Interview
                                    </div>
                                    <div class="col-3 datenumber">
                                        21/11/2023
                                    </div>
                                    <div class="col-1 datecalendar">
                                        <i class="fa fa-calendar-o" aria-hidden="true" type="date"></i>
                                    </div>
                                    <div class="col-3 Intermediate-solid">
                                        21/11/2023
                                    </div>
                                    <div class="col-2 datenumber">
                                        65 Days
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 card cc-transform">
                                <div class="row">
                                    <div class="col-3 Intermediate-solid">
                                        1st Evaluator
                                    </div>
                                    <div class="col-3 datenumber">
                                        21/11/2023
                                    </div>
                                    <div class="col-1 datecalendar">
                                        <i class="fa fa-calendar-o" aria-hidden="true" type="date"></i>
                                    </div>
                                    <div class="col-3 Intermediate-solid">
                                        21/11/2023
                                    </div>
                                    <div class="col-2 datenumber">
                                        26 Days
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 card transform2yellow">
                                <div class="row">
                                    <div class="col-3 Intermediate-solid">
                                        2st Evaluator
                                    </div>
                                    <div class="col-3 datenumber">
                                        21/11/2023
                                    </div>
                                    <div class="col-1 datecalendar">
                                        <i class="fa fa-calendar-o" aria-hidden="true" type="date"></i>
                                    </div>
                                    <div class="col-3 Intermediate-solid">
                                        21/11/2023
                                    </div>
                                    <div class="col-2 datenumber">
                                        7 Days
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 AddAnother">
                                <i class="fa fa-plus-circle ADD" aria-hidden="true"></i> ADD Another Deadline
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="alert alert-Evaluator">
                            <div class="mb-3 row">
                                <label for="inputTerm" class="col-sm-3 col-form-label formtermname">Input Name</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="">
                                </div>
                                <div class="col-sm-3">
                                    <div class="bg-primary formFrameE1 text-white pl-5 pt-5 pb-5 pr-5"> Frame <span class="bg-white formFrameE1 text-primary"> E3</span></div>
                                </div>
                            </div>
                        </div>
                        <div class="alert alert-Evaluator">
                            <div class="row transform">
                                <div class="col-3">
                                    Terms
                                </div>
                                <div class="col-2">
                                    Start
                                </div>
                                <div class="col-2">

                                </div>
                                <div class="col-2">
                                    Finish
                                </div>
                                <div class="col-3">
                                    Duration
                                </div>
                            </div>
                            <div class="col-12 card cc-transform">
                                <div class="row">
                                    <div class="col-3 Intermediate-solid">
                                        Intermediate Interview
                                    </div>
                                    <div class="col-3 datenumber">
                                        21/11/2023
                                    </div>
                                    <div class="col-1 datecalendar">
                                        <i class="fa fa-calendar-o" aria-hidden="true" type="date"></i>
                                    </div>
                                    <div class="col-3 Intermediate-solid">
                                        21/11/2023
                                    </div>
                                    <div class="col-2 datenumber">
                                        65 Days
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 card cc-transform">
                                <div class="row">
                                    <div class="col-3 Intermediate-solid">
                                        1st Evaluator
                                    </div>
                                    <div class="col-3 datenumber">
                                        21/11/2023
                                    </div>
                                    <div class="col-1 datecalendar">
                                        <i class="fa fa-calendar-o" aria-hidden="true" type="date"></i>
                                    </div>
                                    <div class="col-3 Intermediate-solid">
                                        21/11/2023
                                    </div>
                                    <div class="col-2 datenumber">
                                        26 Days
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 card transform2yellow">
                                <div class="row">
                                    <div class="col-3 Intermediate-solid">
                                        2st Evaluator
                                    </div>
                                    <div class="col-3 datenumber">
                                        21/11/2023
                                    </div>
                                    <div class="col-1 datecalendar">
                                        <i class="fa fa-calendar-o" aria-hidden="true" type="date"></i>
                                    </div>
                                    <div class="col-3 Intermediate-solid">
                                        21/11/2023
                                    </div>
                                    <div class="col-2 datenumber">
                                        7 Days
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 AddAnother">
                                <i class="fa fa-plus-circle ADD" aria-hidden="true"></i> ADD Another Deadline
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="alert alert-Evaluator">
                            <div class="mb-3 row">
                                <label for="inputTerm" class="col-sm-3 col-form-label formtermname">Input Name</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="">
                                </div>
                                <div class="col-sm-3">
                                    <div class="bg-primary formFrameE1 text-white pl-5 pt-5 pb-5 pr-5"> Frame <span class="bg-white formFrameE1 text-primary"> E4</span></div>
                                </div>
                            </div>
                        </div>
                        <div class="alert alert-Evaluator">
                            <div class="row transform">
                                <div class="col-3">
                                    Terms
                                </div>
                                <div class="col-2">
                                    Start
                                </div>
                                <div class="col-2">

                                </div>
                                <div class="col-2">
                                    Finish
                                </div>
                                <div class="col-3">
                                    Duration
                                </div>
                            </div>
                            <div class="col-12 card cc-transform">
                                <div class="row">
                                    <div class="col-3 Intermediate-solid">
                                        Intermediate Interview
                                    </div>
                                    <div class="col-3 datenumber">
                                        21/11/2023
                                    </div>
                                    <div class="col-1 datecalendar">
                                        <i class="fa fa-calendar-o" aria-hidden="true" type="date"></i>
                                    </div>
                                    <div class="col-3 Intermediate-solid">
                                        21/11/2023
                                    </div>
                                    <div class="col-2 datenumber">
                                        65 Days
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 card cc-transform">
                                <div class="row">
                                    <div class="col-3 Intermediate-solid">
                                        1st Evaluator
                                    </div>
                                    <div class="col-3 datenumber">
                                        21/11/2023
                                    </div>
                                    <div class="col-1 datecalendar">
                                        <i class="fa fa-calendar-o" aria-hidden="true" type="date"></i>
                                    </div>
                                    <div class="col-3 Intermediate-solid">
                                        21/11/2023
                                    </div>
                                    <div class="col-2 datenumber">
                                        26 Days
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 card transform2yellow">
                                <div class="row">
                                    <div class="col-3 Intermediate-solid">
                                        2st Evaluator
                                    </div>
                                    <div class="col-3 datenumber">
                                        21/11/2023
                                    </div>
                                    <div class="col-1 datecalendar">
                                        <i class="fa fa-calendar-o" aria-hidden="true" type="date"></i>
                                    </div>
                                    <div class="col-3 Intermediate-solid">
                                        21/11/2023
                                    </div>
                                    <div class="col-2 datenumber">
                                        7 Days
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 AddAnother">
                                <i class="fa fa-plus-circle ADD" aria-hidden="true"></i> ADD Another Deadline
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>