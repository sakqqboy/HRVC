<?php
$this->title = 'PLF Overview';
?>

<div class="col-12 mt-90 alert background-Planning">
    <div class="col-12 planning">
        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/FinanicalPlanning.png" class="images_Dark_FinanicalPlanning"> Financial Planning
    </div>
    <div class="col-12 mt-20">
        <div class="shadow p-3 mb-5 bg-body rounded alert2-secondary3">
            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link text-dark" id="pills-Forcast-tab" data-bs-toggle="pill" data-bs-target="#pills-Forcast" type="button" role="tab" aria-controls="pills-Forcast" aria-selected="true"><img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/PL-Forecast.png" class="images_performance_PL"> PL Forcast</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link text-dark" id="pills-Golden-tab" data-bs-toggle="pill" data-bs-target="#pills-Golden" type="button" role="tab" aria-controls="pills-Golden" aria-selected="false"><img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Golden-Ratio.png" class="images_performance_PL"> Golden Ratio</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link text-dark" id="pills-Accounts-tab" data-bs-toggle="pill" data-bs-target="#pills-Accounts" type="button" role="tab" aria-controls="pills-Accounts" aria-selected="false"><img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Designation-1.png" class="images_performance_PL"> Forecast Accounts</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="col-12 mt-50">
        <div class="alert alert2-secondary3">
            <div class="row">
                <div class="col-lg-4 col-12">
                    <span class="badge bg-primary-summary">PL</span> <span class="Profit-Loss">Profit & Loss Forecast</span>
                </div>
                <div class="col-lg-8 col-12 text-end">
                    <button type="button" class="btn btn-light Data" data-bs-toggle="modal" data-bs-target="#DataDistionary"><i class="fa fa-info-circle" aria-hidden="true"></i> Data Dictionary</button>
                    <div class="btn-group" role="group" aria-label="Basic outlined example">
                        <button id="performancechart" type="button" class="btn btn-outline-secondary font-size-12"><i class="fa fa-bar-chart" aria-hidden="true"></i></button>
                        <button id="performancechart" type="button" class="btn btn-outline-secondary font-size-12">Performance Chart</button>
                        <button id="performancechart" type="button" class="btn btn-outline-secondary font-size-12">IPL Analysis</button>
                        <button id="performancechart" type="button" class="btn btn-outline-secondary font-size-12">PLF Overview</button>
                    </div>
                </div>
            </div>
            <div class="alert alert-secondary secondary-CurrentYear mt-20">
                <div class="row">
                    <div class="col-2">
                        <strong>PL Contents</strong>
                    </div>
                    <div class="col-2 text-secondary">
                        <img src="<?= Yii::$app->homeUrl ?>image/calendar.png" style="width: 13px;"> &nbsp; <span class="font-size-12"> Current Year</span>
                    </div>
                    <div class="col-2">
                        <select class="form-select text-primary font-size-12" aria-label="Default select example" style="width: 6rem;">
                            <option selected value="">Select</option>
                            <option value="1">2020</option>
                            <option value="2">2021</option>
                            <option value="3">2022</option>
                            <option value="4">2024</option>
                        </select>
                    </div>

                    <div class="col-6 text-secondary font-size-12 pt-5 text-end">
                        <strong> F.Y. 2023 (Annual)</strong>
                    </div>
                </div>
            </div>
            <div class="col-12 text-primary">
                <a href="" class="linedatatable"> <i class="fa fa-chevron-left" aria-hidden="true"></i> Data Table</a>
            </div>
            <div class="col-12 text-center">
                <div class="Annual_overview"> Annual Comparison Chart</div>
            </div>
            <div class="row">
                <div class="col-lg-1 mt-40">
                    <div class="col-6 text-center">
                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Accumulated.png" class="icons_Monthly">
                    </div>
                    <div class="col-12">
                        <span class="badge bgAAR-1">AAR</span>
                    </div>
                    <div class="col-12">
                        <span class="badge bgAAR1_green">AAR</span>
                    </div>
                    <div class="col-12">
                        <span class="badge bgART1warning">ATR</span>
                    </div>
                    <div class="col-12">
                        <span class="badge bgATRworm">ATR</span>
                    </div>
                </div>
                <div class="col-lg-3 mrl_light_shadow">
                    <div class="shadow p-2 bg-body rounded">
                        <div class="col-12 badge bg light-shadow text-dark text-start">
                            Sales
                        </div>
                        <div class="row mt-10">
                            <div class="col-lg-3 PLF_2022">
                                2022
                            </div>
                            <div class="col-lg-7 pt-4">
                                <div class="progress progress-thin" style="height: 8px;">
                                    <div class="progress-bar bg-bar-background-1" role="progressbar" style="width: 26%;" aria-valuenow="26" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 PLF_2022">
                                26%
                            </div>
                            <div class="col-lg-3 overview_width">
                                2023
                            </div>
                            <div class="col-lg-7 PLF_msr">
                                <div class="progress progress-thin" style="height: 8px;">
                                    <div class="progress-bar bg-bar-background-2" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 overview_width">
                                100%
                            </div>
                            <div class="col-lg-3 overview_width">
                                2023 <span class="badge bdg-2580D3">C</span>
                            </div>
                            <div class="col-lg-7 PLF_msr">
                                <div class="progress progress-thin" style="height: 8px;">
                                    <div class="progress-bar bg-bar-background-3" role="progressbar" style="width: 82%" aria-valuenow="82" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 overview_width">
                                82%
                            </div>
                            <div class="col-lg-3 overview_width">
                                2024
                            </div>
                            <div class="col-lg-7 PLF_msr">
                                <div class="progress progress-thin" style="height: 8px;">
                                    <div class="progress-bar bg-bar-background-4" role="progressbar" style="width: 93%" aria-valuenow="93" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 overview_width">
                                93%
                            </div>
                        </div>
                        <div class="border-bottom"></div>
                    </div>
                </div>
                <div class="col-lg-3 mrl_light_shadow">
                    <div class="shadow p-2 bg-body rounded">
                        <div class="col-12 badge bg light-shadow text-dark text-start">
                            Sales
                        </div>
                        <div class="row mt-10">
                            <div class="col-lg-3 PLF_2022">
                                2022
                            </div>
                            <div class="col-lg-7 pt-4">
                                <div class="progress progress-thin" style="height: 8px;">
                                    <div class="progress-bar bg-bar-background-1" role="progressbar" style="width: 26%;" aria-valuenow="26" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 PLF_2022">
                                26%
                            </div>
                            <div class="col-lg-3 overview_width">
                                2023
                            </div>
                            <div class="col-lg-7 PLF_msr">
                                <div class="progress progress-thin" style="height: 8px;">
                                    <div class="progress-bar bg-bar-background-2" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 overview_width">
                                100%
                            </div>
                            <div class="col-lg-3 overview_width">
                                2023 <span class="badge bdg-2580D3">C</span>
                            </div>
                            <div class="col-lg-7 PLF_msr">
                                <div class="progress progress-thin" style="height: 8px;">
                                    <div class="progress-bar bg-bar-background-3" role="progressbar" style="width: 82%" aria-valuenow="82" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 overview_width">
                                82%
                            </div>
                            <div class="col-lg-3 overview_width">
                                2024
                            </div>
                            <div class="col-lg-7 PLF_msr">
                                <div class="progress progress-thin" style="height: 8px;">
                                    <div class="progress-bar bg-bar-background-4" role="progressbar" style="width: 93%" aria-valuenow="93" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 overview_width">
                                93%
                            </div>
                        </div>
                        <div class="border-bottom"></div>
                    </div>
                </div>
                <div class="col-lg-3 mrl_light_shadow">
                    <div class="shadow p-2 bg-body rounded">
                        <div class="col-12 badge bg light-shadow text-dark text-start">
                            Sales
                        </div>
                        <div class="row mt-10">
                            <div class="col-lg-3 PLF_2022">
                                2022
                            </div>
                            <div class="col-lg-7 pt-4">
                                <div class="progress progress-thin" style="height: 8px;">
                                    <div class="progress-bar bg-bar-background-1" role="progressbar" style="width: 26%;" aria-valuenow="26" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 PLF_2022">
                                26%
                            </div>
                            <div class="col-lg-3 overview_width">
                                2023
                            </div>
                            <div class="col-lg-7 PLF_msr">
                                <div class="progress progress-thin" style="height: 8px;">
                                    <div class="progress-bar bg-bar-background-2" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 overview_width">
                                100%
                            </div>
                            <div class="col-lg-3 overview_width">
                                2023 <span class="badge bdg-2580D3">C</span>
                            </div>
                            <div class="col-lg-7 PLF_msr">
                                <div class="progress progress-thin" style="height: 8px;">
                                    <div class="progress-bar bg-bar-background-3" role="progressbar" style="width: 82%" aria-valuenow="82" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 overview_width">
                                82%
                            </div>
                            <div class="col-lg-3 overview_width">
                                2024
                            </div>
                            <div class="col-lg-7 PLF_msr">
                                <div class="progress progress-thin" style="height: 8px;">
                                    <div class="progress-bar bg-bar-background-4" role="progressbar" style="width: 93%" aria-valuenow="93" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 overview_width">
                                93%
                            </div>
                        </div>
                        <div class="border-bottom"></div>
                    </div>
                </div>
                <div class="col-lg-2 mrl_light_shadow">
                    <div class="shadow p-2 bg-body rounded">
                        <div class="col-12 badge bg light-shadow text-dark text-start">
                            Sales
                        </div>
                        <div class="row mt-10">
                            <div class="col-lg-3 PLF_2022">
                                2022
                            </div>
                            <div class="col-lg-7 pt-4">
                                <div class="progress progress-thin" style="height: 8px;">
                                    <div class="progress-bar bg-bar-background-1" role="progressbar" style="width: 26%;" aria-valuenow="26" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 PLF_2022">
                                26%
                            </div>
                            <div class="col-lg-3 overview_width">
                                2023
                            </div>
                            <div class="col-lg-7 PLF_msr">
                                <div class="progress progress-thin" style="height: 8px;">
                                    <div class="progress-bar bg-bar-background-2" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 overview_width">
                                100%
                            </div>
                            <div class="col-lg-3 overview_width">
                                2023 <span class="badge bdg-2580D3">C</span>
                            </div>
                            <div class="col-lg-7 PLF_msr">
                                <div class="progress progress-thin" style="height: 8px;">
                                    <div class="progress-bar bg-bar-background-3" role="progressbar" style="width: 82%" aria-valuenow="82" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 overview_width">
                                82%
                            </div>
                            <div class="col-lg-3 overview_width">
                                2024
                            </div>
                            <div class="col-lg-7 PLF_msr">
                                <div class="progress progress-thin" style="height: 8px;">
                                    <div class="progress-bar bg-bar-background-4" role="progressbar" style="width: 93%" aria-valuenow="93" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 overview_width">
                                93%
                            </div>
                        </div>
                        <div class="border-bottom"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-1 mt-40">
                    <div class="col-6 text-center">
                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Accumulated.png" class="icons_Monthly">
                    </div>
                    <div class="col-12">
                        <span class="badge bgAAR-1">AAR</span>
                    </div>
                    <div class="col-12">
                        <span class="badge bgAAR1_green">AAR</span>
                    </div>
                    <div class="col-12">
                        <span class="badge bgART1warning">ATR</span>
                    </div>
                    <div class="col-12">
                        <span class="badge bgATRworm">ATR</span>
                    </div>
                </div>
                <div class="col-lg-3 mrl_light_shadow">
                    <div class="shadow p-2 bg-body rounded">
                        <div class="col-12 badge bg light-shadow text-dark text-start">
                            Sales
                        </div>
                        <div class="row mt-10">
                            <div class="col-lg-3 PLF_2022">
                                2022
                            </div>
                            <div class="col-lg-7 pt-4">
                                <div class="progress progress-thin" style="height: 8px;">
                                    <div class="progress-bar bg-bar-background-1" role="progressbar" style="width: 26%;" aria-valuenow="26" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 PLF_2022">
                                26%
                            </div>
                            <div class="col-lg-3 overview_width">
                                2023
                            </div>
                            <div class="col-lg-7 PLF_msr">
                                <div class="progress progress-thin" style="height: 8px;">
                                    <div class="progress-bar bg-bar-background-2" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 overview_width">
                                100%
                            </div>
                            <div class="col-lg-3 overview_width">
                                2023 <span class="badge bdg-2580D3">C</span>
                            </div>
                            <div class="col-lg-7 PLF_msr">
                                <div class="progress progress-thin" style="height: 8px;">
                                    <div class="progress-bar bg-bar-background-3" role="progressbar" style="width: 82%" aria-valuenow="82" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 overview_width">
                                82%
                            </div>
                            <div class="col-lg-3 overview_width">
                                2024
                            </div>
                            <div class="col-lg-7 PLF_msr">
                                <div class="progress progress-thin" style="height: 8px;">
                                    <div class="progress-bar bg-bar-background-4" role="progressbar" style="width: 93%" aria-valuenow="93" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 overview_width">
                                93%
                            </div>
                        </div>
                        <div class="border-bottom"></div>
                    </div>
                </div>
                <div class="col-lg-3 mrl_light_shadow">
                    <div class="shadow p-2 bg-body rounded">
                        <div class="col-12 badge bg light-shadow text-dark text-start">
                            Sales
                        </div>
                        <div class="row mt-10">
                            <div class="col-lg-3 PLF_2022">
                                2022
                            </div>
                            <div class="col-lg-7 pt-4">
                                <div class="progress progress-thin" style="height: 8px;">
                                    <div class="progress-bar bg-bar-background-1" role="progressbar" style="width: 26%;" aria-valuenow="26" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 PLF_2022">
                                26%
                            </div>
                            <div class="col-lg-3 overview_width">
                                2023
                            </div>
                            <div class="col-lg-7 PLF_msr">
                                <div class="progress progress-thin" style="height: 8px;">
                                    <div class="progress-bar bg-bar-background-2" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 overview_width">
                                100%
                            </div>
                            <div class="col-lg-3 overview_width">
                                2023 <span class="badge bdg-2580D3">C</span>
                            </div>
                            <div class="col-lg-7 PLF_msr">
                                <div class="progress progress-thin" style="height: 8px;">
                                    <div class="progress-bar bg-bar-background-3" role="progressbar" style="width: 82%" aria-valuenow="82" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 overview_width">
                                82%
                            </div>
                            <div class="col-lg-3 overview_width">
                                2024
                            </div>
                            <div class="col-lg-7 PLF_msr">
                                <div class="progress progress-thin" style="height: 8px;">
                                    <div class="progress-bar bg-bar-background-4" role="progressbar" style="width: 93%" aria-valuenow="93" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 overview_width">
                                93%
                            </div>
                        </div>
                        <div class="border-bottom"></div>
                    </div>
                </div>
                <div class="col-lg-3 mrl_light_shadow">
                    <div class="shadow p-2 bg-body rounded">
                        <div class="col-12 badge bg light-shadow text-dark text-start">
                            Sales
                        </div>
                        <div class="row mt-10">
                            <div class="col-lg-3 PLF_2022">
                                2022
                            </div>
                            <div class="col-lg-7 pt-4">
                                <div class="progress progress-thin" style="height: 8px;">
                                    <div class="progress-bar bg-bar-background-1" role="progressbar" style="width: 26%;" aria-valuenow="26" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 PLF_2022">
                                26%
                            </div>
                            <div class="col-lg-3 overview_width">
                                2023
                            </div>
                            <div class="col-lg-7 PLF_msr">
                                <div class="progress progress-thin" style="height: 8px;">
                                    <div class="progress-bar bg-bar-background-2" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 overview_width">
                                100%
                            </div>
                            <div class="col-lg-3 overview_width">
                                2023 <span class="badge bdg-2580D3">C</span>
                            </div>
                            <div class="col-lg-7 PLF_msr">
                                <div class="progress progress-thin" style="height: 8px;">
                                    <div class="progress-bar bg-bar-background-3" role="progressbar" style="width: 82%" aria-valuenow="82" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 overview_width">
                                82%
                            </div>
                            <div class="col-lg-3 overview_width">
                                2024
                            </div>
                            <div class="col-lg-7 PLF_msr">
                                <div class="progress progress-thin" style="height: 8px;">
                                    <div class="progress-bar bg-bar-background-4" role="progressbar" style="width: 93%" aria-valuenow="93" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 overview_width">
                                93%
                            </div>
                        </div>
                        <div class="border-bottom"></div>
                    </div>
                </div>
                <div class="col-lg-2 mrl_light_shadow">
                    <div class="shadow p-2 bg-body rounded">
                        <div class="col-12 badge bg light-shadow text-dark text-start">
                            Sales
                        </div>
                        <div class="row mt-10">
                            <div class="col-lg-3 PLF_2022">
                                2022
                            </div>
                            <div class="col-lg-7 pt-4">
                                <div class="progress progress-thin" style="height: 8px;">
                                    <div class="progress-bar bg-bar-background-1" role="progressbar" style="width: 26%;" aria-valuenow="26" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 PLF_2022">
                                26%
                            </div>
                            <div class="col-lg-3 overview_width">
                                2023
                            </div>
                            <div class="col-lg-7 PLF_msr">
                                <div class="progress progress-thin" style="height: 8px;">
                                    <div class="progress-bar bg-bar-background-2" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 overview_width">
                                100%
                            </div>
                            <div class="col-lg-3 overview_width">
                                2023 <span class="badge bdg-2580D3">C</span>
                            </div>
                            <div class="col-lg-7 PLF_msr">
                                <div class="progress progress-thin" style="height: 8px;">
                                    <div class="progress-bar bg-bar-background-3" role="progressbar" style="width: 82%" aria-valuenow="82" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 overview_width">
                                82%
                            </div>
                            <div class="col-lg-3 overview_width">
                                2024
                            </div>
                            <div class="col-lg-7 PLF_msr">
                                <div class="progress progress-thin" style="height: 8px;">
                                    <div class="progress-bar bg-bar-background-4" role="progressbar" style="width: 93%" aria-valuenow="93" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 overview_width">
                                93%
                            </div>
                        </div>
                        <div class="border-bottom"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-1 mt-40">
                    <div class="col-6 text-center">
                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Accumulated.png" class="icons_Monthly">
                    </div>
                    <div class="col-12">
                        <span class="badge bgAAR-1">AAR</span>
                    </div>
                    <div class="col-12">
                        <span class="badge bgAAR1_green">AAR</span>
                    </div>
                    <div class="col-12">
                        <span class="badge bgART1warning">ATR</span>
                    </div>
                    <div class="col-12">
                        <span class="badge bgATRworm">ATR</span>
                    </div>
                </div>
                <div class="col-lg-3 mrl_light_shadow">
                    <div class="shadow p-2 bg-body rounded">
                        <div class="col-12 badge bg light-shadow text-dark text-start">
                            Sales
                        </div>
                        <div class="row mt-10">
                            <div class="col-lg-3 PLF_2022">
                                2022
                            </div>
                            <div class="col-lg-7 pt-4">
                                <div class="progress progress-thin" style="height: 8px;">
                                    <div class="progress-bar bg-bar-background-1" role="progressbar" style="width: 26%;" aria-valuenow="26" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 PLF_2022">
                                26%
                            </div>
                            <div class="col-lg-3 overview_width">
                                2023
                            </div>
                            <div class="col-lg-7 PLF_msr">
                                <div class="progress progress-thin" style="height: 8px;">
                                    <div class="progress-bar bg-bar-background-2" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 overview_width">
                                100%
                            </div>
                            <div class="col-lg-3 overview_width">
                                2023 <span class="badge bdg-2580D3">C</span>
                            </div>
                            <div class="col-lg-7 PLF_msr">
                                <div class="progress progress-thin" style="height: 8px;">
                                    <div class="progress-bar bg-bar-background-3" role="progressbar" style="width: 82%" aria-valuenow="82" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 overview_width">
                                82%
                            </div>
                            <div class="col-lg-3 overview_width">
                                2024
                            </div>
                            <div class="col-lg-7 PLF_msr">
                                <div class="progress progress-thin" style="height: 8px;">
                                    <div class="progress-bar bg-bar-background-4" role="progressbar" style="width: 93%" aria-valuenow="93" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 overview_width">
                                93%
                            </div>
                        </div>
                        <div class="border-bottom"></div>
                    </div>
                </div>
                <div class="col-lg-3 mrl_light_shadow">
                    <div class="shadow p-2 bg-body rounded">
                        <div class="col-12 badge bg light-shadow text-dark text-start">
                            Sales
                        </div>
                        <div class="row mt-10">
                            <div class="col-lg-3 PLF_2022">
                                2022
                            </div>
                            <div class="col-lg-7 pt-4">
                                <div class="progress progress-thin" style="height: 8px;">
                                    <div class="progress-bar bg-bar-background-1" role="progressbar" style="width: 26%;" aria-valuenow="26" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 PLF_2022">
                                26%
                            </div>
                            <div class="col-lg-3 overview_width">
                                2023
                            </div>
                            <div class="col-lg-7 PLF_msr">
                                <div class="progress progress-thin" style="height: 8px;">
                                    <div class="progress-bar bg-bar-background-2" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 overview_width">
                                100%
                            </div>
                            <div class="col-lg-3 overview_width">
                                2023 <span class="badge bdg-2580D3">C</span>
                            </div>
                            <div class="col-lg-7 PLF_msr">
                                <div class="progress progress-thin" style="height: 8px;">
                                    <div class="progress-bar bg-bar-background-3" role="progressbar" style="width: 82%" aria-valuenow="82" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 overview_width">
                                82%
                            </div>
                            <div class="col-lg-3 overview_width">
                                2024
                            </div>
                            <div class="col-lg-7 PLF_msr">
                                <div class="progress progress-thin" style="height: 8px;">
                                    <div class="progress-bar bg-bar-background-4" role="progressbar" style="width: 93%" aria-valuenow="93" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 overview_width">
                                93%
                            </div>
                        </div>
                        <div class="border-bottom"></div>
                    </div>
                </div>
                <div class="col-lg-3 mrl_light_shadow">
                    <div class="shadow p-2 bg-body rounded">
                        <div class="col-12 badge bg light-shadow text-dark text-start">
                            Sales
                        </div>
                        <div class="row mt-10">
                            <div class="col-lg-3 PLF_2022">
                                2022
                            </div>
                            <div class="col-lg-7 pt-4">
                                <div class="progress progress-thin" style="height: 8px;">
                                    <div class="progress-bar bg-bar-background-1" role="progressbar" style="width: 26%;" aria-valuenow="26" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 PLF_2022">
                                26%
                            </div>
                            <div class="col-lg-3 overview_width">
                                2023
                            </div>
                            <div class="col-lg-7 PLF_msr">
                                <div class="progress progress-thin" style="height: 8px;">
                                    <div class="progress-bar bg-bar-background-2" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 overview_width">
                                100%
                            </div>
                            <div class="col-lg-3 overview_width">
                                2023 <span class="badge bdg-2580D3">C</span>
                            </div>
                            <div class="col-lg-7 PLF_msr">
                                <div class="progress progress-thin" style="height: 8px;">
                                    <div class="progress-bar bg-bar-background-3" role="progressbar" style="width: 82%" aria-valuenow="82" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 overview_width">
                                82%
                            </div>
                            <div class="col-lg-3 overview_width">
                                2024
                            </div>
                            <div class="col-lg-7 PLF_msr">
                                <div class="progress progress-thin" style="height: 8px;">
                                    <div class="progress-bar bg-bar-background-4" role="progressbar" style="width: 93%" aria-valuenow="93" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 overview_width">
                                93%
                            </div>
                        </div>
                        <div class="border-bottom"></div>
                    </div>
                </div>
                <div class="col-lg-2 mrl_light_shadow">
                    <div class="shadow p-2 bg-body rounded">
                        <div class="col-12 badge bg light-shadow text-dark text-start">
                            Sales
                        </div>
                        <div class="row mt-10">
                            <div class="col-lg-3 PLF_2022">
                                2022
                            </div>
                            <div class="col-lg-7 pt-4">
                                <div class="progress progress-thin" style="height: 8px;">
                                    <div class="progress-bar bg-bar-background-1" role="progressbar" style="width: 26%;" aria-valuenow="26" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 PLF_2022">
                                26%
                            </div>
                            <div class="col-lg-3 overview_width">
                                2023
                            </div>
                            <div class="col-lg-7 PLF_msr">
                                <div class="progress progress-thin" style="height: 8px;">
                                    <div class="progress-bar bg-bar-background-2" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 overview_width">
                                100%
                            </div>
                            <div class="col-lg-3 overview_width">
                                2023 <span class="badge bdg-2580D3">C</span>
                            </div>
                            <div class="col-lg-7 PLF_msr">
                                <div class="progress progress-thin" style="height: 8px;">
                                    <div class="progress-bar bg-bar-background-3" role="progressbar" style="width: 82%" aria-valuenow="82" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 overview_width">
                                82%
                            </div>
                            <div class="col-lg-3 overview_width">
                                2024
                            </div>
                            <div class="col-lg-7 PLF_msr">
                                <div class="progress progress-thin" style="height: 8px;">
                                    <div class="progress-bar bg-bar-background-4" role="progressbar" style="width: 93%" aria-valuenow="93" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 overview_width">
                                93%
                            </div>
                        </div>
                        <div class="border-bottom"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-1 mt-40">
                    <div class="col-6 text-center">
                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Accumulated.png" class="icons_Monthly">
                    </div>
                    <div class="col-12">
                        <span class="badge bgAAR-1">AAR</span>
                    </div>
                    <div class="col-12">
                        <span class="badge bgAAR1_green">AAR</span>
                    </div>
                    <div class="col-12">
                        <span class="badge bgART1warning">ATR</span>
                    </div>
                    <div class="col-12">
                        <span class="badge bgATRworm">ATR</span>
                    </div>
                </div>
                <div class="col-lg-3 mrl_light_shadow">
                    <div class="shadow p-2 bg-body rounded">
                        <div class="col-12 badge bg light-shadow text-dark text-start">
                            Sales
                        </div>
                        <div class="row mt-10">
                            <div class="col-lg-3 PLF_2022">
                                2022
                            </div>
                            <div class="col-lg-7 pt-4">
                                <div class="progress progress-thin" style="height: 8px;">
                                    <div class="progress-bar bg-bar-background-1" role="progressbar" style="width: 26%;" aria-valuenow="26" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 PLF_2022">
                                26%
                            </div>
                            <div class="col-lg-3 overview_width">
                                2023
                            </div>
                            <div class="col-lg-7 PLF_msr">
                                <div class="progress progress-thin" style="height: 8px;">
                                    <div class="progress-bar bg-bar-background-2" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 overview_width">
                                100%
                            </div>
                            <div class="col-lg-3 overview_width">
                                2023 <span class="badge bdg-2580D3">C</span>
                            </div>
                            <div class="col-lg-7 PLF_msr">
                                <div class="progress progress-thin" style="height: 8px;">
                                    <div class="progress-bar bg-bar-background-3" role="progressbar" style="width: 82%" aria-valuenow="82" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 overview_width">
                                82%
                            </div>
                            <div class="col-lg-3 overview_width">
                                2024
                            </div>
                            <div class="col-lg-7 PLF_msr">
                                <div class="progress progress-thin" style="height: 8px;">
                                    <div class="progress-bar bg-bar-background-4" role="progressbar" style="width: 93%" aria-valuenow="93" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 overview_width">
                                93%
                            </div>
                        </div>
                        <div class="border-bottom"></div>
                    </div>
                </div>
                <div class="col-lg-3 mrl_light_shadow">
                    <div class="shadow p-2 bg-body rounded">
                        <div class="col-12 badge bg light-shadow text-dark text-start">
                            Sales
                        </div>
                        <div class="row mt-10">
                            <div class="col-lg-3 PLF_2022">
                                2022
                            </div>
                            <div class="col-lg-7 pt-4">
                                <div class="progress progress-thin" style="height: 8px;">
                                    <div class="progress-bar bg-bar-background-1" role="progressbar" style="width: 26%;" aria-valuenow="26" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 PLF_2022">
                                26%
                            </div>
                            <div class="col-lg-3 overview_width">
                                2023
                            </div>
                            <div class="col-lg-7 PLF_msr">
                                <div class="progress progress-thin" style="height: 8px;">
                                    <div class="progress-bar bg-bar-background-2" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 overview_width">
                                100%
                            </div>
                            <div class="col-lg-3 overview_width">
                                2023 <span class="badge bdg-2580D3">C</span>
                            </div>
                            <div class="col-lg-7 PLF_msr">
                                <div class="progress progress-thin" style="height: 8px;">
                                    <div class="progress-bar bg-bar-background-3" role="progressbar" style="width: 82%" aria-valuenow="82" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 overview_width">
                                82%
                            </div>
                            <div class="col-lg-3 overview_width">
                                2024
                            </div>
                            <div class="col-lg-7 PLF_msr">
                                <div class="progress progress-thin" style="height: 8px;">
                                    <div class="progress-bar bg-bar-background-4" role="progressbar" style="width: 93%" aria-valuenow="93" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 overview_width">
                                93%
                            </div>
                        </div>
                        <div class="border-bottom"></div>
                    </div>
                </div>
                <div class="col-lg-3 mrl_light_shadow">
                    <div class="shadow p-2 bg-body rounded">
                        <div class="col-12 badge bg light-shadow text-dark text-start">
                            Sales
                        </div>
                        <div class="row mt-10">
                            <div class="col-lg-3 PLF_2022">
                                2022
                            </div>
                            <div class="col-lg-7 pt-4">
                                <div class="progress progress-thin" style="height: 8px;">
                                    <div class="progress-bar bg-bar-background-1" role="progressbar" style="width: 26%;" aria-valuenow="26" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 PLF_2022">
                                26%
                            </div>
                            <div class="col-lg-3 overview_width">
                                2023
                            </div>
                            <div class="col-lg-7 PLF_msr">
                                <div class="progress progress-thin" style="height: 8px;">
                                    <div class="progress-bar bg-bar-background-2" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 overview_width">
                                100%
                            </div>
                            <div class="col-lg-3 overview_width">
                                2023 <span class="badge bdg-2580D3">C</span>
                            </div>
                            <div class="col-lg-7 PLF_msr">
                                <div class="progress progress-thin" style="height: 8px;">
                                    <div class="progress-bar bg-bar-background-3" role="progressbar" style="width: 82%" aria-valuenow="82" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 overview_width">
                                82%
                            </div>
                            <div class="col-lg-3 overview_width">
                                2024
                            </div>
                            <div class="col-lg-7 PLF_msr">
                                <div class="progress progress-thin" style="height: 8px;">
                                    <div class="progress-bar bg-bar-background-4" role="progressbar" style="width: 93%" aria-valuenow="93" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 overview_width">
                                93%
                            </div>
                        </div>
                        <div class="border-bottom"></div>
                    </div>
                </div>
                <div class="col-lg-2 mrl_light_shadow">
                    <div class="shadow p-2 bg-body rounded">
                        <div class="col-12 badge bg light-shadow text-dark text-start">
                            Sales
                        </div>
                        <div class="row mt-10">
                            <div class="col-lg-3 PLF_2022">
                                2022
                            </div>
                            <div class="col-lg-7 pt-4">
                                <div class="progress progress-thin" style="height: 8px;">
                                    <div class="progress-bar bg-bar-background-1" role="progressbar" style="width: 26%;" aria-valuenow="26" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 PLF_2022">
                                26%
                            </div>
                            <div class="col-lg-3 overview_width">
                                2023
                            </div>
                            <div class="col-lg-7 PLF_msr">
                                <div class="progress progress-thin" style="height: 8px;">
                                    <div class="progress-bar bg-bar-background-2" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 overview_width">
                                100%
                            </div>
                            <div class="col-lg-3 overview_width">
                                2023 <span class="badge bdg-2580D3">C</span>
                            </div>
                            <div class="col-lg-7 PLF_msr">
                                <div class="progress progress-thin" style="height: 8px;">
                                    <div class="progress-bar bg-bar-background-3" role="progressbar" style="width: 82%" aria-valuenow="82" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 overview_width">
                                82%
                            </div>
                            <div class="col-lg-3 overview_width">
                                2024
                            </div>
                            <div class="col-lg-7 PLF_msr">
                                <div class="progress progress-thin" style="height: 8px;">
                                    <div class="progress-bar bg-bar-background-4" role="progressbar" style="width: 93%" aria-valuenow="93" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 overview_width">
                                93%
                            </div>
                        </div>
                        <div class="border-bottom"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="DataDistionary" tabindex="-1" aria-labelledby="DataDistionaryLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content modal-DataDistionary">
            <div class="modal-header" style="border: none;">
                <div id="DataDistionaryLabel">
                    Data Dictionary
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6 Accumulate_text">
                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Accumulated.png" class="Dark_Monthly"> Accumulate
                    </div>
                    <div class="col-6 Accumulate_text">
                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Monthly.png" class="Dark_Monthly"> Monthly
                    </div>
                    <hr class="mt-5">
                </div>
                <div class="row">
                    <div class="col-4 text-end">
                        <span class="AC-Primary"> AAR </span>
                    </div>
                    <div class="col-8 AC-Accumulate">
                        Accumulate Actual Ratio
                    </div>
                    <div class="col-4 text-end">
                        <span class="AC-Success"> AAR </span>
                    </div>
                    <div class="col-8 AC-Accumulate">
                        Accumulate Actual Ratio
                    </div>
                    <div class="col-4 text-end">
                        <span class="T-Warning"> AT </span>
                    </div>
                    <div class="col-8 AC-Accumulate">
                        Accumulate Target
                    </div>
                    <div class="col-4 text-end">
                        <span class="T-Warning"> ATR </span>
                    </div>
                    <div class="col-8 AC-Accumulate">
                        Accumulate Target ratio
                    </div>
                    <div class="col-4 text-end">
                        <span class="T-bule"> ATR </span>
                    </div>
                    <div class="col-8 AC-Accumulate">
                        Accumulate Target ratio
                    </div>
                    <hr>

                    <div class="col-4 text-end">
                        <span class="AC-Success"> AC </span>
                    </div>
                    <div class="col-8 AC-Accumulate">
                        Actual
                    </div>
                    <div class="col-4 text-end">
                        <span class="T-Warning"> T </span>
                    </div>
                    <div class="col-8 AC-Accumulate">
                        Actual
                    </div>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</div>