<?php
$this->title = 'KFI';
?>

<div class="col-12 mt-90 pd-Performance">
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
            </ul>
        </div>

        <div class="alert alert-white-4">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12 key1">
                    <div class="row">
                        <div class="col-6 key1">
                            Key Financial Indicators
                        </div>
                        <div class="col-6">
                            <button type="button" class="btn btn-primary font-size-14" data-bs-toggle="modal" data-bs-target="#staticBackdrop1"><i class="fa fa-magic" aria-hidden="true"></i> Create New KFI</button>
                            <div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-primary" id="staticBackdropLabel"><i class="fa fa-magic" aria-hidden="true"></i> Create</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col-12">
                                                <i class="fa fa-line-chart" aria-hidden="true"></i> Key Financial Indicator
                                            </div>
                                        </div>
                                        <div class="modal-footer">
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
                                <option selected>Company</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                            <select class="form-select font-size-13" aria-label="Example select">
                                <option selected>Branch</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                            <select class="form-select font-size-13" aria-label="Example select">
                                <option selected>Month</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                            <select class="form-select font-size-13" aria-label="Example select">
                                <option selected>Type</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                            <select class="form-select font-size-13" aria-label="Example select">
                                <option selected>Status</option>
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
                                <a type="button" class="btn btn-light-3 font-size-13"><i class="fa fa-list-ul" aria-hidden="true"></i></a>
                                <a type="button" class="btn btn-light-3 font-size-13"><i class="fa fa-th-large" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <ul class="nav nav-pills mb-3 mt-20" id="pills-tab" role="tablist">
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-Financial" role="tabpanel" aria-labelledby="pills-Financial-tab">
                        <div class="col-12 tb-width5">
                            <table class="table">
                                <thead class="table-secondary">
                                    <tr id="transform-none">
                                        <th>KFI Contents </th>
                                        <th>Company Name</th>
                                        <th>Branch</th>
                                        <th colspan="1">Quant Ratio</th>
                                        <th>Target</th>
                                        <th>Code</th>
                                        <th>Result</th>
                                        <th>Ratio</th>
                                        <th>Unit</th>
                                        <th>Month</th>
                                        <th colspan="2">Next Check</th>
                                        <th colspan="2"></th>
                                    </tr>
                                </thead>
                                <tbody class="table table-striped table-hover">
                                    <tr id="visible0">
                                        <td>
                                            <span class="badge bg-info text-white">PL</span>
                                            Total Sales
                                        </td>
                                        <td>Tokyo Consulting Firm Danışmanlık</td>
                                        <td>
                                            <img src="<?= Yii::$app->homeUrl ?>image/Flag-Turkey.png" class="Flag-Turkey">
                                            Izmir, Turkey
                                        </td>
                                        <td>Quantity</td>
                                        <td>1,000,000</td>
                                        <td>
                                            < </td>
                                        <td>৳902,566</td>
                                        <td>
                                            <div id="progress1">
                                                <div data-num="35" class="progress-item1"></div>
                                            </div>
                                        </td>
                                        <td>Month</td>
                                        <td>August</td>
                                        <td>May 31, 2023</td>
                                        <td colspan="3">
                                            <span> <i class="fa fa-comments-o on-cursor" aria-hidden="true"></i></span>
                                            <div class="">
                                                <span class="dropdown" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"> <i class="fa fa-ellipsis-v on-cursor" aria-hidden="true"></i> </span>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    <li><a class="dropdown-item" href="#"><i class="fa fa-file-text-o" aria-hidden="true"></i></a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="font-size-12">
                                        <td>
                                            <span class="badge bg-info text-white">PL</span>
                                            Subscribe Sales
                                        </td>
                                        <td>Tokyo Consulting Firm Pvt. Ltd.</td>
                                        <td>
                                            <img src="<?= Yii::$app->homeUrl ?>image/Flag-Brazil.png" class="Flag-Turkey">
                                            São Paulo, Brazil
                                        </td>
                                        <td>Quantity</td>
                                        <td>856,000</td>
                                        <td>
                                            > </td>
                                        <td>৳902,566</td>
                                        <td>
                                            <div id="progress1">
                                                <div data-num="75" class="progress-item1"></div>
                                            </div>
                                        </td>
                                        <td>Month</td>
                                        <td>December</td>
                                        <td>May 31, 2023</td>
                                        <td colspan="3">
                                            <span> <i class="fa fa-comments-o on-cursor" aria-hidden="true"></i></span>
                                            <div class="">
                                                <span class="dropdown" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"> <i class="fa fa-ellipsis-v on-cursor" aria-hidden="true"></i> </span>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    <li><a class="dropdown-item" href="#"><i class="fa fa-file-text-o" aria-hidden="true"></i></a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="font-size-12">
                                        <td>
                                            <span class="badge bg-info text-white">PL</span>
                                            Decrease Variable Expene
                                        </td>
                                        <td>Tokyo Consulting Firm PLC</td>
                                        <td>
                                            <img src="<?= Yii::$app->homeUrl ?>image/is.jpg" class="Flag-Turkey">
                                            Dhaka, Bangladesh
                                        </td>
                                        <td>Quantity</td>
                                        <td>941,652</td>
                                        <td>
                                            = </td>
                                        <td>৳902,566</td>
                                        <td>
                                            <div id="progress1">
                                                <div data-num="100" class="progress-item1"></div>
                                            </div>
                                        </td>
                                        <td>Month</td>
                                        <td>August</td>
                                        <td>May 31, 2023</td>
                                        <td colspan="3">
                                            <span> <i class="fa fa-comments-o on-cursor" aria-hidden="true"></i></span>
                                            <div class="">
                                                <span class="dropdown" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"> <i class="fa fa-ellipsis-v on-cursor" aria-hidden="true"></i> </span>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    <li><a class="dropdown-item" href="#"><i class="fa fa-file-text-o" aria-hidden="true"></i></a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="font-size-12">
                                        <td>
                                            <span class="badge bg-info text-white">PL</span>
                                            Operating Profit
                                        </td>
                                        <td>Tokyo Consulting Firm Pt.</td>
                                        <td>
                                            <img src="<?= Yii::$app->homeUrl ?>image/thai.jpg" class="Flag-Turkey">
                                            Bangkok, Thailand
                                        </td>
                                        <td>Quantity</td>
                                        <td>1,000,000</td>
                                        <td>
                                            < </td>
                                        <td>৳902,566</td>
                                        <td>
                                            <div id="progress1">
                                                <div data-num="25" class="progress-item1"></div>
                                            </div>
                                        </td>
                                        <td>Month</td>
                                        <td>September</td>
                                        <td>May 31, 2023</td>
                                        <td colspan="3">
                                            <span> <i class="fa fa-comments-o on-cursor" aria-hidden="true"></i></span>
                                            <div class="">
                                                <span class="dropdown" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"> <i class="fa fa-ellipsis-v on-cursor" aria-hidden="true"></i> </span>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    <li><a class="dropdown-item" href="#"><i class="fa fa-file-text-o" aria-hidden="true"></i></a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-Group" role="tabpanel" aria-labelledby="pills-Group-tab">...</div>
                <div class="tab-pane fade" id="pills-Performance" role="tabpanel" aria-labelledby="pills-Performance-tab">...</div>
                <div class="tab-pane fade" id="pills-Action" role="tabpanel" aria-labelledby="pills-Action-tab">...</div>

                <div class="col-12 content-navitem">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="#"><i class="fa fa-chevron-left" aria-hidden="true"></i> Previous</a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next <i class="fa fa-chevron-right" aria-hidden="true"></i></a></li>
                        </ul>
                    </nav>
                </div>
            </ul>
        </div>
    </div>
</div>