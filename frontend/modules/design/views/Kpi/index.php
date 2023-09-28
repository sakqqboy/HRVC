<?php
$this->title = 'KPI';
?>

<div class="col-12 mt-90">
    <div class="col-12">
        <i class="fa fa-tachometer font-size-20" aria-hidden="true"></i> <strong class="font-size-20"> Performance Indicator Matrices (PIM)</strong>
    </div>
    <div class="col-12 mt-20">
        <div class="alert alert2-secondary2">
            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link text-dark" id="pills-Financial-tab" data-bs-toggle="pill" data-bs-target="#pills-Financial" type="button" role="tab" aria-controls="pills-Financial" aria-selected="true"><i class="fa fa-line-chart" aria-hidden="true"></i> Key Financial Indicator</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link text-dark" id="pills-Group-tab" data-bs-toggle="pill" data-bs-target="#pills-Group" type="button" role="tab" aria-controls="pills-Group" aria-selected="false"><i class="fa fa-flag-o" aria-hidden="true"></i> Key Group Indicator</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link text-dark" id="pills-Performance-tab" data-bs-toggle="pill" data-bs-target="#pills-Performance" type="button" role="tab" aria-controls="pills-Performance" aria-selected="false"><i class="fa fa-clock-o" aria-hidden="true"></i> Key Performance Indicator</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link text-dark" id="pills-Action-tab" data-bs-toggle="pill" data-bs-target="#pills-Action" type="button" role="tab" aria-controls="pills-Action" aria-selected="false"><i class="fa fa-list-ul" aria-hidden="true"></i> Key Action Indicator</a>
                </li>
                <li class="nav-item presentation-end" role="presentation">
                    <a class="nav-link text-dark" id="pills-Setting-tab" data-bs-toggle="pill" data-bs-target="#pills-Setting" type="button" role="tab" aria-controls="pills-Action" aria-selected="false"><i class="fa fa-cog" aria-hidden="true"></i> Assign</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="alert alert-white-4">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-12 key1">
                <div class="row">
                    <div class="col-6 key2">
                        Key Performance Indicator
                    </div>
                    <div class="col-6">
                        <button type="button" class="btn btn-primary font-size-14" data-bs-toggle="modal" data-bs-target="#staticBackdrop6"><i class="fa fa-magic" aria-hidden="true"></i> Create New KPI</button>
                        <div class="modal fade" id="staticBackdrop6" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdrop6Label" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-primary" id="staticBackdrop6Label"><i class="fa fa-magic" aria-hidden="true"></i> Create KPI</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="col-12" style="margin-top: -20px; padding-left:20px; font-size: 13px;">
                                        <i class="fa fa-tachometer" aria-hidden="true"></i> Key Performance Indicator
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-6">
                                                <div class="col-12">
                                                    <label for="exampleFormControlInput1" class="form-label"><strong class="red">*</strong> Company KPI Contents</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="col-12 pt-5">
                                                    <label for="input" class="form-label"><strong class="red">*</strong> Company (Single)</label>
                                                    <select class="form-select" aria-label="Default select example">
                                                        <option selected value="">Select Company</option>
                                                        <option value="1">Tokyo Consulting Firm Danışmanlık</option>
                                                        <option value="2">Tokyo Consulting Firm Pvt. Ltd.</option>
                                                        <option value="3">Tokyo Consulting Firm PLC</option>
                                                        <option value="4">Tokyo Consulting Firm Pt.</option>
                                                        <option value="5">Tokyo Consulting Firm</option>
                                                    </select>
                                                </div>
                                                <div class="col-12 pt-5">
                                                    <label for="input" class="form-label"><strong class="red">*</strong> Branch (Single)</label>
                                                    <select class="form-select" aria-label="Default select example">
                                                        <option selected value="">Select Branch</option>
                                                        <option value="1">Branch 1</option>
                                                        <option value="2">Branch 2</option>
                                                        <option value="3">Branch 3</option>
                                                        <option value="4">Branch 4</option>
                                                        <option value="5">Branch 5</option>
                                                    </select>
                                                </div>
                                                <div class="col-12 pt-10">
                                                    <label for="input" class="form-label"><strong class="red">*</strong> Check Unit</label>
                                                    <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                        <button type="button" class="btn btn-outline-secondary font-size-15">Monthly</button>
                                                        <button type="button" class="btn btn-outline-secondary font-size-15">Weekly</button>
                                                        <button type="button" class="btn btn-outline-secondary font-size-15">Quaterly</button>
                                                        <button type="button" class="btn btn-outline-secondary font-size-15">Daily</button>
                                                    </div>
                                                </div>
                                                <div class="col-12 pt-5">
                                                    <div class="input-group">
                                                        <label for="input" class="form-label"><strong class="red">*</strong> Select Period</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text font-size-12"><i class="fa fa-calendar-o" aria-hidden="true"></i> &nbsp;&nbsp; Date</span>
                                                            <input type="date" class="form-control font-size-12">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 pt-5">
                                                    <label for="exampleFormControl" class="form-label font-size-13"><strong class="red">*</strong> Target Amount</label>
                                                    <input type="number" class="form-control font-size-13 text-end">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-6">
                                                <div class="col-12">
                                                    <label for="exampleFormControlTextarea1" class="form-label"> KGI Details</label>
                                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="4"></textarea>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-6 col-6 pt-10">
                                                        <label for="exampleFormControl" class="form-label font-size-13"><strong class="red">*</strong> Quant Ratio</label>
                                                        <select class="form-select font-size-13" aria-label="Default select example">
                                                            <option selected value="">Quantity or Quality</option>
                                                            <option value="1">January</option>
                                                            <option value="2">June</option>
                                                            <option value="3">July</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-6 pt-10">
                                                        <label for="exampleFormControl" class="form-label font-size-13"><strong class="red">*</strong> Priority</label>
                                                        <select class="form-select font-size-13" aria-label="Default select example">
                                                            <option selected value="">A/B/C</option>
                                                            <option value="1"></option>
                                                            <option value="2"></option>
                                                            <option value="3"></option>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-6 pt-10">
                                                        <label for="exampleFormControl" class="form-label font-size-13"><strong class="red">*</strong> Amount Type</label>
                                                        <select class="form-select font-size-13" aria-label="Default select example">
                                                            <option selected value="">% or Number</option>
                                                            <option value="1"></option>
                                                            <option value="2"></option>
                                                            <option value="3"></option>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-6 pt-10">
                                                        <label for="exampleFormControl" class="form-label font-size-13"><strong class="red">*</strong> Code</label>
                                                        <select class="form-select font-size-13" aria-label="Default select example">
                                                            <option selected value="">
                                                                <=>
                                                            </option>
                                                            <option value="1"></option>
                                                            <option value="2"></option>
                                                            <option value="3"></option>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-6 pt-10">
                                                        <label for="exampleFormControl" class="form-label font-size-13"><strong class="red">*</strong> Status</label>
                                                        <select class="form-select font-size-13" aria-label="Default select example">
                                                            <option selected value="">Active/Finished</option>
                                                            <option value="1"></option>
                                                            <option value="2"></option>
                                                            <option value="3"></option>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-6 pt-10">
                                                        <label for="exampleFormControl" class="form-label font-size-13"><strong class="red">*</strong> Month</label>
                                                        <select class="form-select font-size-13" aria-label="Default select example">
                                                            <option selected value="">Select Month</option>
                                                            <option value="1">January</option>
                                                            <option value="2"></option>
                                                            <option value="3"></option>
                                                        </select>
                                                    </div>
                                                    <div class="col-12 pt-5">
                                                        <label for="exampleFormControl" class="form-label font-size-13"><strong class="red">*</strong> Result</label>
                                                        <input type="number" class="form-control font-size-13 text-end">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 pt-10">
                                            Set Ratio Formula
                                        </div>
                                        <div class="col-12 pt-10">
                                            <select class="form-select font-size-12 alert-primary-12 text-dark" aria-label="Default select example">
                                                <option selected value="">Use Custom Formula</option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                            </select>
                                        </div>
                                        <div class="alert alert-primary-12 mt-10" role="alert">
                                            <div class="alert alert-light">
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-6 col-12">
                                                        <a href="#"> <span class="badge bg-secondary text-white font-size-14"> <i class="fa fa-bullseye" aria-hidden="true"></i> Target</span></a>

                                                        <a href="#"> <span class="badge bg-secondary text-white font-size-14"> <i class="fa fa-trophy" aria-hidden="true"></i> Result </span></a>
                                                    </div>
                                                    <div class="col-lg-8 col-md-6 col-12 targrt-small">
                                                        <a href="#"><span class="badge bg-primary text-white pl-10 pr-10"> +</span></a>

                                                        <a href="#"> <span class="badge bg-primary text-white pl-10 pr-10"> - </button></a>

                                                        <a href="#"> <span class="badge bg-primary text-white pl-10 pr-10"> / </span></a>

                                                        <a href="#"> <span class="badge bg-primary text-white pl-10 pr-10"> x </span></a>

                                                        <a href="#"> <span class="badge bg-secondary text-white pl-10 pr-10"> ( </span></a>

                                                        <a href="#"> <span class="badge bg-secondary text-white  pl-10 pr-10"> ) </span></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="alert alert-light">
                                                <div class="col-12">
                                                    <input type="text" class="form-control" style="border: none;" placeholder="( [ Target ] + [ Result ] - [ Target ] )">
                                                </div>
                                                <div class="mt-50"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer" style="border: none;">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-primary">Create</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-12 col-12 New-KFI">
                <div class="col-12">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-filter" aria-hidden="true"></i></span>
                        <select class="form-select font-size-13" aria-label="Example select">
                            <option selected value="">Company</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                        <select class="form-select font-size-13" aria-label="Example select">
                            <option selected value="">Branch</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                        <select class="form-select font-size-13" aria-label="Example select">
                            <option selected value="">Month</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                        <select class="form-select font-size-13" aria-label="Example select">
                            <option selected value="">Type</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                        <select class="form-select font-size-13" aria-label="Example select">
                            <option selected value="">Status</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12 New-date">
                <div class="row">
                    <div class="col-8">
                        <div class="input-group">
                            <label class="input-group-text font-size-13" for="">Date</label>
                            <input type="date" class="form-control font-size-13" name="birthday" id="">
                        </div>
                    </div>
                    <div class="col-4 new-light-4">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-outline-primary font-size-13"><i class="fa fa-list-ul" aria-hidden="true"></i></button>
                            <button type="button" class="btn btn-outline-primary font-size-13"><i class="fa fa-th-large" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <table class="table table-striped">
            <thead class="table-secondary">
                <tr class="transform-none">
                    <th>KPI Contents</th>
                    <th>Company</th>
                    <th>Branch</th>
                    <th>Team KPI Contents</th>
                    <th>Priority</th>
                    <th>Employees</th>
                    <th>Team</th>
                    <th>QR</th>
                    <th>target</th>
                    <th>Code</th>
                    <th>result</th>
                    <th>ratio</th>
                    <th>month</th>
                    <th>Unit</th>
                    <th>Last</th>
                    <th>next</th>
                    <th colspan="row"></th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-bottom-white2">
                    <td class="over-blue">Increase Something</td>
                    <td>TCF</td>
                    <td><img src="<?= Yii::$app->homeUrl ?>image/Flag-Turkey.png" class="Flag-Turkey"> Izmir, Turkey</td>
                    <td>The number of clients per employee by team</td>
                    <td class="text-center">A</td>
                    <td>
                        <span class="badge rounded-pill bg-gray">
                            <ul class="try-cricle">
                                <li class="tri-li"> <img src="<?= Yii::$app->homeUrl ?>image/avatar1.png" class="image-avatar1"></li>
                                <li class="tri-li"> <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="image-avatar2"></li>
                                <li class="tri-li"> <img src="<?= Yii::$app->homeUrl ?>image/avatar3.png" class="image-avatar3"></li>
                                <a href="" class="none">
                                    <li class="tri-li-number"> 5 </li>
                                </a>
                            </ul>
                        </span>
                    </td>
                    <td>
                        <span class="badge rounded-pill bg-secondary-bsc1"><i class="fa fa-users" aria-hidden="true"></i> 12</span>
                    </td>
                    <td>Quality</td>
                    <td>2.5</td>
                    <td>
                        >
                    </td>
                    <td>2.1</td>
                    <td>
                        <div id="progress1">
                            <div data-num="35" class="progress-item1"></div>
                        </div>
                    </td>
                    <td>January</td>
                    <td>Monthly</td>
                    <td>2nd Feb, 2023</td>
                    <td>23rd Feb, 2023</td>
                    <td colspan="row">
                        <span data-bs-toggle="modal" data-bs-target="#exampleModalcomment2"> <img src="<?= Yii::$app->homeUrl ?>image/comment.png" class="comment-td-dropdown"></span>
                        <span class="dropdown menulink" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"> <i class="fa fa-ellipsis-v on-cursor" aria-hidden="true"></i> </span>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li data-bs-toggle="modal" data-bs-target="#exampleModalEditkpi1">
                                <a class="dropdown-item"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            </li>
                            <li data-bs-toggle="modal" data-bs-target="#exampleModalViewkpi2">
                                <a class="dropdown-item"><i class="fa fa-eye" aria-hidden="true"></i></a>
                            </li>
                            <li data-bs-toggle="modal" data-bs-target="#staticBackdropdelete1">
                                <a class="dropdown-item"><i class="fa fa-trash-o text-danger" aria-hidden="true"></i></a>
                            </li>
                        </ul>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-12 navigation-next">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item"><a class="page-link page-navigation" href="#"><i class="fa fa-chevron-left" aria-hidden="true"></i> Previous</a></li>
                <li class="page-item"><a class="page-link page-navigation" href="#">1</a></li>
                <li class="page-item"><a class="page-link page-navigation" href="#">2</a></li>
                <li class="page-item"><a class="page-link page-navigation" href="#">3</a></li>
                <li class="page-item"><a class="page-link page-navigation" href="#">Next <i class="fa fa-chevron-right" aria-hidden="true"></i></a></li>
            </ul>
        </nav>
    </div>
</div>

<!-- modal kpi comment -->
<div class="modal fade" id="exampleModalcomment2" tabindex="-1" aria-labelledby="exampleModalcomment2Label" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom:none;">
                <div class="modal-title Modalfirstone" id="exampleModalcomment2Label"><i class="fa fa-clock-o" aria-hidden="true"></i> Work More and More</div>
                <div class="modal-title Modalfirstone">Tokyo Consulting Firm Limited</div>
            </div>
            <div class="fsm">Dhaka, Bangladesh <img src="<?= Yii::$app->homeUrl ?>image/is.jpg" class="Round1"></div>
            <div class="modal-body">
                <ul class="nav nav-pills mb-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12">
                            <a class="link-3" id="v-pills-Issues-tab" data-bs-toggle="pill" data-bs-target="#v-pills-Issues" type="button" role="tab" aria-controls="v-pills-Issues" aria-selected="true">Issues</a>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <a class="link-3" id="v-pills-History-tab" data-bs-toggle="pill" data-bs-target="#v-pills-History" type="button" role="tab" aria-controls="v-pills-History" aria-selected="false">History</a>
                        </div>
                    </div>
                </ul>
                <hr>
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-Issues" role="tabpanel" aria-labelledby="v-pills-Issues-tab">
                        <ul>
                            <li class="li-circle">
                                <img src="<?= Yii::$app->homeUrl ?>image/ehsan-small.png" class="image-circle1"><span class="li-name">Quazi Ehsan Hossain
                                    <span class="Report-Issue"> May 31, 2023 <i class="fa fa-exclamation-triangle text-warning" aria-hidden="true"></i> </span>
                            </li>
                            <div class="style-circle-li">
                                <span> Hi Tani! Could you take quick look at these Landing Page designs? when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries
                                    <p class="mt-20">Thanks so much!</p>
                                </span>
                            </div>
                            <div class="alert alert-secondary" style="border: none;margin-top: -30px;margin-left:20px;">
                                <div class="row">
                                    <div class="col-lg-7 col-md-6 col-12">
                                        <span class="badge bg-white"> <img src="<?= Yii::$app->homeUrl ?>image/pdf.png" class="pdf-down"></span> <span class="text-dark"> 115 IHI July Invoice(Gunman) 30.July.2021.pdf <span class="text-secondary font-size-12"> 2.3mb</span></span>
                                    </div>
                                    <div class="col-lg-5 col-md-6 col-12 text-end">
                                        <button class="btn btn-outline-secondary"> <i class="fa fa-eye" aria-hidden="true"></i></button>
                                        <button class="btn btn-outline-secondary"> <i class="fa fa-cloud-download" aria-hidden="true"></i></button>
                                    </div>
                                </div>
                            </div>
                            </li>
                            <li class="li-circle1">
                                <div class="col-12 card-hashed">
                                    <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="image-hashed">&nbsp; <span class="font-size-12">Tadawoki Watanabe</span>
                                    <div class="col-12 problemm">
                                        <span> Hi Tani! Could you take quick look at these Landing Page designs? when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries
                                            <p class="mt-20">Thanks so much!</p>
                                        </span>
                                    </div>
                                    <div class="col-12 mt-20">
                                        <div class="input-group pr-20">
                                            <input for class="form-control">
                                            <a><i class="fa fa-paperclip clip-file" aria-hidden="true" type="file"></i></a>
                                            <button class="btn btn-primary form-submitbotton" type="button"><i class="fa fa-paper-plane-o" aria-hidden="true"></i> Submit</button>
                                        </div>
                                        <div class="mt-20"></div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="v-pills-History" role="tabpanel" aria-labelledby="v-pills-History-tab">
                        <ul>
                            <li class="li-circle">
                                <img src="<?= Yii::$app->homeUrl ?>image/ehsan-small.png" class="image-circle1"><span class="li-name">Quazi Ehsan Hossain
                                    <span class="Report-Issue">2:56 PM, May 31, 2023</span>
                            </li>
                            <div class="style-circle-li">
                                <span> Hi Tani! Could you take quick look at these Landing Page designs? when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries
                                    <p class="mt-20">Thanks so much!</p>
                                </span>
                            </div>
                            <div class="col-12 badge-pdf0">
                                <span class="badge bg-light"> <img src="<?= Yii::$app->homeUrl ?>image/pdf.png" class="pdf-down"></span> <span class="text-dark"> 115 IHI July Invoice(Gunman) 30.July.2021.pdf 2.3mb</span>
                            </div>
                            <li class="li-circle">
                                <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="image-hashed">&nbsp; <strong class="font-size-14 text-dark">Tadawoki Watanabe </strong>&nbsp; <span class="Report-Issue"> 2:56 PM, May 31, 2023</span>
                                <div class="col-12 problemm">
                                    <span> Hi Tani! Could you take quick look at these Landing Page designs? when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries
                                        <p class="mt-20">Thanks so much!</p>
                                    </span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end -->

<!-- modal edit kpi -->
<div class="modal fade" id="exampleModalEditkpi1" tabindex="-1" aria-labelledby="exampleModalEditkpi1Label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="exampleModalEditkpi1Label"><i class="fa fa-magic" aria-hidden="true"></i> Edit KPI</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="col-12" style="margin-top: -20px; padding-left:20px; font-size: 13px;">
                <i class="fa fa-tachometer" aria-hidden="true"></i> Key Performance Indicator
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-6">
                        <div class="col-12">
                            <label for="exampleFormControlInput1" class="form-label"><strong class="red">*</strong> Company KPI Contents</label>
                            <input type="text" class="form-control" placeholder="">
                        </div>
                        <div class="col-12 pt-5">
                            <label for="input" class="form-label"><strong class="red">*</strong> Company (Single)</label>
                            <select class="form-select" aria-label="Default select example">
                                <option selected value="">Select Company</option>
                                <option value="1">Tokyo Consulting Firm Danışmanlık</option>
                                <option value="2">Tokyo Consulting Firm Pvt. Ltd.</option>
                                <option value="3">Tokyo Consulting Firm PLC</option>
                                <option value="4">Tokyo Consulting Firm Pt.</option>
                                <option value="5">Tokyo Consulting Firm</option>
                            </select>
                        </div>
                        <div class="col-12 pt-5">
                            <label for="input" class="form-label"><strong class="red">*</strong> Branch (Single)</label>
                            <select class="form-select" aria-label="Default select example">
                                <option selected value="">Select Branch</option>
                                <option value="1">Branch 1</option>
                                <option value="2">Branch 2</option>
                                <option value="3">Branch 3</option>
                                <option value="4">Branch 4</option>
                                <option value="5">Branch 5</option>
                            </select>
                        </div>
                        <div class="col-12 pt-10">
                            <label for="input" class="form-label"><strong class="red">*</strong> Check Unit</label>
                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                <button type="button" class="btn btn-outline-secondary">Monthly</button>
                                <button type="button" class="btn btn-outline-secondary">Weekly</button>
                                <button type="button" class="btn btn-outline-secondary">Quaterly</button>
                                <button type="button" class="btn btn-outline-secondary">Daily</button>
                            </div>
                        </div>
                        <div class="col-12 pt-5">
                            <div class="row">
                                <div class="col-md-6 mt-10">
                                    <div class="input-group">
                                        <label for="input" class="form-label font-size-13"><strong class="red">*</strong> Select Period</label>
                                        <div class="input-group">
                                            <span class="input-group-text font-size-12"><i class="fa fa-calendar-o" aria-hidden="true"></i> &nbsp;&nbsp; Date</span>
                                            <input type="date" aria-label="" class="form-control font-size-12">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mt-10">
                                    <div class="input-group">
                                        <label for="input" class="form-label font-size-13"><strong class="red">*</strong> Next Check Date</label>
                                        <div class="input-group">
                                            <span class="input-group-text font-size-12"><i class="fa fa-calendar-o" aria-hidden="true"></i> &nbsp;&nbsp; Date</span>
                                            <input type="date" aria-label="" class="form-control font-size-12">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 pt-5">
                            <label for="exampleFormControl" class="form-label font-size-13"><strong class="red">*</strong> Target Amount</label>
                            <input type="number" class="form-control font-size-13 text-end">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-6">
                        <div class="col-12">
                            <label for="exampleFormControlTextarea1" class="form-label"> KPI Details</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="4"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-6 pt-10">
                                <label for="exampleFormControl" class="form-label font-size-13"><strong class="red">*</strong> Quant Ratio</label>
                                <select class="form-select font-size-13" aria-label="Default select example">
                                    <option selected value="">Quantity or Quality</option>
                                    <option value="1">January</option>
                                    <option value="2">June</option>
                                    <option value="3">July</option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 col-6 pt-10">
                                <label for="exampleFormControl" class="form-label font-size-13"><strong class="red">*</strong> Priority</label>
                                <select class="form-select font-size-13" aria-label="Default select example">
                                    <option selected value="">A/B/C</option>
                                    <option value="1"></option>
                                    <option value="2"></option>
                                    <option value="3"></option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 col-6 pt-10">
                                <label for="exampleFormControl" class="form-label font-size-13"><strong class="red">*</strong> Amount Type</label>
                                <select class="form-select font-size-13" aria-label="Default select example">
                                    <option selected value="">% or Number</option>
                                    <option value="1"></option>
                                    <option value="2"></option>
                                    <option value="3"></option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 col-6 pt-10">
                                <label for="exampleFormControl" class="form-label font-size-13"><strong class="red">*</strong> Code</label>
                                <select class="form-select font-size-13" aria-label="Default select example">
                                    <option selected value="">
                                        <=>
                                    </option>
                                    <option value="1"></option>
                                    <option value="2"></option>
                                    <option value="3"></option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 col-6 pt-10">
                                <label for="exampleFormControl" class="form-label font-size-13"><strong class="red">*</strong> Status</label>
                                <select class="form-select font-size-13" aria-label="Default select example">
                                    <option selected value="">Active/Finished</option>
                                    <option value="1"></option>
                                    <option value="2"></option>
                                    <option value="3"></option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 col-6 pt-10">
                                <label for="exampleFormControl" class="form-label font-size-13"><strong class="red">*</strong> Month</label>
                                <select class="form-select font-size-13" aria-label="Default select example">
                                    <option selected value="">Select Month</option>
                                    <option value="1">January</option>
                                    <option value="2"></option>
                                    <option value="3"></option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="exampleFormControl" class="form-label font-size-13"><strong class="red">*</strong> Result</label>
                                <input type="number" class="form-control font-size-13 text-end">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 pt-10">
                    Set Ratio Formula
                </div>
                <div class="col-12 pt-10">
                    <select class="form-select font-size-12 alert-primary-12 text-dark" aria-label="Default select example">
                        <option selected>Use Custom Formula</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div class="alert alert-primary-12 mt-10" role="alert">
                    <div class="alert alert-light">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-12">
                                <a href="#"> <span class="badge bg-secondary text-white font-size-14"> <i class="fa fa-bullseye" aria-hidden="true"></i> Target</span></a>

                                <a href="#"> <span class="badge bg-secondary text-white font-size-14"> <i class="fa fa-trophy" aria-hidden="true"></i> Result </span></a>
                            </div>
                            <div class="col-lg-8 col-md-6 col-12 targrt-small">
                                <a href="#"><span class="badge bg-primary text-white pl-10 pr-10"> +</span></a>

                                <a href="#"> <span class="badge bg-primary text-white pl-10 pr-10"> - </button></a>

                                <a href="#"> <span class="badge bg-primary text-white pl-10 pr-10"> / </span></a>

                                <a href="#"> <span class="badge bg-primary text-white pl-10 pr-10"> x </span></a>

                                <a href="#"> <span class="badge bg-secondary text-white pl-10 pr-10"> ( </span></a>

                                <a href="#"> <span class="badge bg-secondary text-white  pl-10 pr-10"> ) </span></a>
                            </div>
                        </div>
                    </div>
                    <div class="alert alert-light">
                        <div class="col-12 ">
                            <input type="text" class="form-control" style="border: none;" placeholder="( [ Target ] + [ Result ] - [ Target ] )">
                        </div>
                        <div class="mt-50"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="border: none;">
                <button type=" button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Create</button>
            </div>
        </div>
    </div>
</div>
<!-- end -->

<!-- modal view kpi -->
<div class="modal fade" id="exampleModalViewkpi2" tabindex="-1" aria-labelledby="exampleModalViewkpi2Label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="border: none;">
                <div class="modal-title flag-Backdrop7" id="exampleModalViewkpi2Label"><i class="fa fa-tachometer" aria-hidden="true"></i> Increase Something</div>
                <div class="modal-title Completed-Backdrop7 badge rounded-pill bg-warning text-dark">Completed</div>
                <span class="border border-1 border-deadline-Backdrop7">Deadline <span class="font-size-10 text-dark pr-10"> : Mon, Feb 12, 2023</span></span>
            </div>
            <div class="text-end mr-15">
                <span class="border border-1 border-next-Backdrop7">Next Update <span class="font-size-10 text-dark pr-10"> Tue, Mar 12, 2023</span></span>
            </div>
            <div class="tk">Tokyo Consulting Firm Limited</div>
            <div class="col-12 font-size-12 pl-20 pt-5">
                <img src="<?= Yii::$app->homeUrl ?>image/is.jpg" class="Round1"> Dhaka, Bangladesh
            </div>

            <div class="modal-body">
                <div class="col-12 dashed-Backdrop7">
                    <div class="row mt-20">
                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="col-12 content-KGI">
                                Team KPI Contents
                            </div>
                            <div class="col-12 KGI-Clients">
                                Ten Clients employee
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-3">
                            <div class="col-12 Quant-ratio-Backdrop3">
                                Quant Ratio
                            </div>
                            <div class="col-12 diamond-con-Backdrop3">
                                <i class="fa fa-diamond" aria-hidden="true"></i> Quality
                            </div>
                        </div>
                        <div class="col-lg-1 col-md-6 col-2">
                            <div class="col-12 padding-FEB-Backdrop7">
                                FEB
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-3">
                            <div class="col-12 bullseye-con-Backdrop3">
                                <i class="fa fa-bullseye" aria-hidden="true"></i> Target
                            </div>
                            <div class="col-12 million-number-Backdrop3">
                                <?= number_format(1000000) ?>
                            </div>
                        </div>
                        <div class="col-lg-1 col-md-6 col-3">
                            <div class="col-12 padding-mark-Backdrop3">
                                >
                            </div>
                        </div>
                        <div class="col-lg-2 cl-md-6 col-3">
                            <div class="col-12 trophy-con-Backdrop3">
                                <i class="fa fa-trophy" aria-hidden="true"></i> Result
                            </div>
                            <div class="col-12 million-number-Backdrop3">
                                <?= number_format(902566) ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-6 col-12">
                                <div class="col-12">
                                    <p class="Priority1">Priority</p>
                                    <div class="circle-Priority">A</div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-6">
                                <div class="col-12 padding-update-Backdrop3">
                                    Update Interval
                                </div>
                                <div class="col-12 update-mouth-Backdrop3">
                                    Monthly
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-6 col-6 mt-10">
                                <div class="col-12">
                                    <div class="progress">
                                        <div class="progress-bar" style="width:85%; background:#2F80ED;margin-left:-50px;height:13px;"></div>
                                        <span class="badge rounded-pill  pro-load-Backdrop7">85%</span>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-5"></div>
                        </div>
                    </div>
                </div>
                <div class="col-12 Description-Backdrop7 pl-10">
                    Description
                </div>
                <div class="col-12 detailsDescription-Backdrop3 pl-20">
                    The more people who have access to your point of sales system or place of business means more people have the possibility of buying from you and increasing your profits. The more people who have access to your point of sales system or place of business means more people have the possibility of buying from you and increasing your profits.
                </div>
                <div class="row mt-20">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-6 pl-20">
                                <div class="team1"> Team</div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-6">
                                <div class="team1"> Assign Members</div>
                            </div>
                            <hr style="margin-top: -5px;">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12 pl-40">
                        <div class="row mt-30 Assign-solid">
                            <div class="col-lg-3 col-md-6 col-12">
                                <div class="col-12">
                                    <div class="alert team-user"><i class="fa fa-users" aria-hidden="true"></i></div>
                                </div>
                                <div class="col-12" style="margin-top: -15px;margin-left:-10px;">
                                    <strong class="font-size-10"> Team SGO</strong>
                                    <div class="font-size-10"> IT Department</div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-12">
                                <div class="col-12">
                                    <div class="alert team-user"><i class="fa fa-users" aria-hidden="true"></i></div>
                                </div>
                                <div class="col-12" style="margin-top: -15px;margin-left:-10px;">
                                    <strong class="font-size-10"> Team SGO</strong>
                                    <div class="font-size-10"> IT Department</div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-12">
                                <div class="col-12">
                                    <div class="alert team-user"><i class="fa fa-users" aria-hidden="true"></i></div>
                                </div>
                                <div class="col-12" style="margin-top: -15px;margin-left:-10px;">
                                    <strong class="font-size-10"> Team SGO</strong>
                                    <div class="font-size-10"> IT Department</div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-12">
                                <div class="col-12">
                                    <div class="alert team-user"><i class="fa fa-users" aria-hidden="true"></i></div>
                                </div>
                                <div class="col-12" style="margin-top: -15px;margin-left:-10px;">
                                    <strong class="font-size-10"> Team SGO</strong>
                                    <div class="font-size-10"> IT Department</div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-12 mt-10">
                                <div class="col-12">
                                    <div class="alert team-user"><i class="fa fa-users" aria-hidden="true"></i></div>
                                </div>
                                <div class="col-12" style="margin-top: -15px;margin-left:-10px;">
                                    <strong class="font-size-10"> Team SGO</strong>
                                    <div class="font-size-10"> IT Department</div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-12 mt-10">
                                <div class="col-12">
                                    <div class="alert team-user"><i class="fa fa-users" aria-hidden="true"></i></div>
                                </div>
                                <div class="col-12" style="margin-top: -15px;margin-left:-10px;">
                                    <strong class="font-size-10"> Team SGO</strong>
                                    <div class="font-size-10"> IT Department</div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-12 mt-10">
                                <div class="col-12">
                                    <div class="alert team-user"><i class="fa fa-users" aria-hidden="true"></i></div>
                                </div>
                                <div class="col-12" style="margin-top: -15px;margin-left:-10px;">
                                    <strong class="font-size-10"> Team SGO</strong>
                                    <div class="font-size-10"> IT Department</div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-12 mt-10">
                                <div class="col-12">
                                    <div class="alert team-user"><i class="fa fa-users" aria-hidden="true"></i></div>
                                </div>
                                <div class="col-12" style="margin-top: -15px;margin-left:-10px;">
                                    <strong class="font-size-10"> Team SGO</strong>
                                    <div class="font-size-10"> IT Department</div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-12 mt-10">
                                <div class="col-12">
                                    <div class="alert team-user"><i class="fa fa-users" aria-hidden="true"></i></div>
                                </div>
                                <div class="col-12" style="margin-top: -15px;margin-left:-10px;">
                                    <strong class="font-size-10"> Team SGO</strong>
                                    <div class="font-size-10"> IT Department</div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-12 mt-10">
                                <div class="col-12">
                                    <div class="alert team-user"><i class="fa fa-users" aria-hidden="true"></i></div>
                                </div>
                                <div class="col-12" style="margin-top: -15px;margin-left:-10px;">
                                    <strong class="font-size-10"> Team SGO</strong>
                                    <div class="font-size-10"> IT Department</div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-12 mt-10">
                                <div class="col-12">
                                    <div class="alert team-user"><i class="fa fa-users" aria-hidden="true"></i></div>
                                </div>
                                <div class="col-12" style="margin-top: -15px;margin-left:-10px;">
                                    <strong class="font-size-10"> Team SGO</strong>
                                    <div class="font-size-10"> IT Department</div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-12 mt-10">
                                <div class="col-12">
                                    <div class="alert team-user"><i class="fa fa-users" aria-hidden="true"></i></div>
                                </div>
                                <div class="col-12" style="margin-top: -15px;margin-left:-10px;">
                                    <strong class="font-size-10"> Team SGO</strong>
                                    <div class="font-size-10"> IT Department</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="row mt-30">
                            <div class="col-lg-3 col-md-6 col-12">
                                <div class="col-12">
                                    <img src="<?= Yii::$app->homeUrl ?>image/Assign-1.png" class="image-AssignMembers">
                                </div>
                                <div class="col-12">
                                    <strong class="font-size-10"> Faruk Khan</strong>
                                    <div class="font-size-10"> Old Product Manager</div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-12">
                                <div class="col-12">
                                    <img src="<?= Yii::$app->homeUrl ?>image/Assign-3.png" class="image-AssignMembers">
                                </div>
                                <div class="col-12">
                                    <strong class="font-size-10"> Amir Khan </strong>
                                    <div class="font-size-10"> Software Engineer</div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-12">
                                <div class="col-12">
                                    <img src="<?= Yii::$app->homeUrl ?>image/Assign-2.png" class="image-AssignMembers">
                                </div>
                                <div class="col-12">
                                    <strong class="font-size-10"> Shahrukh Khan</strong>
                                    <div class="font-size-10"> Business Development</div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-12">
                                <div class="col-12">
                                    <img src="<?= Yii::$app->homeUrl ?>image/Assign-1.png" class="image-AssignMembers">
                                </div>
                                <div class="col-12">
                                    <strong class="font-size-10"> Faruk Khan</strong>
                                    <div class="font-size-10"> Old Product Manager</div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-12 mt-10">
                                <div class="col-12">
                                    <img src="<?= Yii::$app->homeUrl ?>image/Assign-3.png" class="image-AssignMembers">
                                </div>
                                <div class="col-12">
                                    <strong class="font-size-10"> Amir Khan </strong>
                                    <div class="font-size-10"> Software Engineer</div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-12 mt-10">
                                <div class="col-12">
                                    <img src="<?= Yii::$app->homeUrl ?>image/Assign-2.png" class="image-AssignMembers">
                                </div>
                                <div class="col-12">
                                    <strong class="font-size-10"> Shahrukh Khan</strong>
                                    <div class="font-size-10"> Business Development</div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-12 mt-10">
                                <div class="col-12">
                                    <img src="<?= Yii::$app->homeUrl ?>image/Assign-1.png" class="image-AssignMembers">
                                </div>
                                <div class="col-12">
                                    <strong class="font-size-10"> Faruk Khan</strong>
                                    <div class="font-size-10"> Old Product Manager</div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-12 mt-10">
                                <div class="col-12">
                                    <img src="<?= Yii::$app->homeUrl ?>image/Assign-3.png" class="image-AssignMembers">
                                </div>
                                <div class="col-12">
                                    <strong class="font-size-10"> Amir Khan </strong>
                                    <div class="font-size-10"> Software Engineer</div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-12 mt-10">
                                <div class="col-12">
                                    <img src="<?= Yii::$app->homeUrl ?>image/Assign-3.png" class="image-AssignMembers">
                                </div>
                                <div class="col-12">
                                    <strong class="font-size-10"> Amir Khan </strong>
                                    <div class="font-size-10"> Software Engineer</div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-12 mt-10">
                                <div class="col-12">
                                    <img src="<?= Yii::$app->homeUrl ?>image/Assign-2.png" class="image-AssignMembers">
                                </div>
                                <div class="col-12">
                                    <strong class="font-size-10"> Shahrukh Khan</strong>
                                    <div class="font-size-10"> Business Development</div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-12 mt-10">
                                <div class="col-12">
                                    <img src="<?= Yii::$app->homeUrl ?>image/Assign-1.png" class="image-AssignMembers">
                                </div>
                                <div class="col-12">
                                    <strong class="font-size-10"> Faruk Khan</strong>
                                    <div class="font-size-10"> Old Product Manager</div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-12 mt-10">
                                <div class="col-12">
                                    <img src="<?= Yii::$app->homeUrl ?>image/Assign-3.png" class="image-AssignMembers">
                                </div>
                                <div class="col-12">
                                    <strong class="font-size-10"> Amir Khan </strong>
                                    <div class="font-size-10"> Software Engineer</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 History-Backdrop3">
                    History
                </div>
                <hr>
                <div class="alert alert-light alertlight-Backdrop3">
                    <div class="row">
                        <div class="col-lg-5 col-md-6 col-12">
                            <div class="row">
                                <div class="col-2">
                                    <div class="bg-success on-right"> ✓</div>
                                </div>
                                <div class="col-10">
                                    Stripe risk evaluation: normal
                                </div>
                                <div class="col-12 pl-60">
                                    <img src="<?= Yii::$app->homeUrl ?>image/Faruque.png" class="name-Backdrop3">
                                    <a href="#" class="font-size-12"> Mohammed Sharukh</a> <span class="font-size-12 text-secondary"> Title : Admin</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="col-12 text-secondary font-size-12">
                                <i class="fa fa-bullseye" aria-hidden="true"></i> Updated the information
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="row">
                                <div class="col-2">
                                    <img src="<?= Yii::$app->homeUrl ?>image/pdf.png" class="image-pdf-Backdrop3">
                                </div>
                                <div class="col-10 PM">
                                    August 22, 2018, 6:14 PM
                                    <div class="col-12 New">
                                        New Amount <strong> 200255</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="successbackdrop4"></div>
                </div>
                <div class="alert alert-light alertlight-Backdrop3">
                    <div class="row">
                        <div class="col-lg-5 col-md-6 col-12">
                            <div class="row">
                                <div class="col-2">
                                    <div class="bg-primary on-right"> ✓</div>
                                </div>
                                <div class="col-10">
                                    Stripe risk evaluation: normal
                                </div>
                                <div class="col-12 pl-60">
                                    <img src="<?= Yii::$app->homeUrl ?>image/Faruque.png" class="name-Backdrop3">
                                    <a href="#" class="font-size-12"> Mohammed Sharukh</a> <span class="font-size-12 text-secondary"> Title : Admin</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="col-12 text-secondary font-size-12">
                                <i class="fa fa-bullseye" aria-hidden="true"></i> Updated the information
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="row">
                                <div class="col-2">
                                    <img src="<?= Yii::$app->homeUrl ?>image/pdf.png" class="image-pdf-Backdrop3">
                                </div>
                                <div class="col-10 PM">
                                    August 22, 2018, 6:14 PM
                                    <div class="col-12 New">
                                        New Amount <strong> 200255</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="successbackdrop4"></div>
                </div>
                <div class="alert alert-light alertlight-Backdrop3">
                    <div class="row">
                        <div class="col-lg-5 col-md-6 col-12">
                            <div class="row">
                                <div class="col-2">
                                    <div class="bg-primary on-right"> ✓</div>
                                </div>
                                <div class="col-10">
                                    Stripe risk evaluation: normal
                                </div>
                                <div class="col-12 pl-60">
                                    <img src="<?= Yii::$app->homeUrl ?>image/Faruque.png" class="name-Backdrop3">
                                    <a href="#" class="font-size-12"> Mohammed Sharukh</a> <span class="font-size-12 text-secondary"> Title : Admin</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="col-12 text-secondary font-size-12">
                                <i class="fa fa-bullseye" aria-hidden="true"></i> Updated the information
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="row">
                                <div class="col-2">
                                    <img src="<?= Yii::$app->homeUrl ?>image/pdf.png" class="image-pdf-Backdrop3">
                                </div>
                                <div class="col-10 PM">
                                    August 22, 2018, 6:14 PM
                                    <div class="col-12 New">
                                        New Amount <strong> 200255</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="border: none;">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- end -->

<!-- modal delete kpi -->
<div class="modal fade" id="staticBackdropdelete1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropdelete1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom:none;">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-12 delete-Backdrop4">
                    Are you sure you want to do this?
                </div>
            </div>
            <div class="row text-center mt-20" style="border-bottom:none;">
                <div class="col-6 text-end">
                    <button type="button" class="btn btn-primary" style="width: 100px;" data-bs-dismiss="modal">Cancel</button>
                </div>
                <div class="col-6 text-start">
                    <button type="button" class="btn btn-danger" style="width: 100px;">Delete</button>
                    <div class="mt-40"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end -->