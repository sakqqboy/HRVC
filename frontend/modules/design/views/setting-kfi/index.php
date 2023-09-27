<?php
$this->title = 'Setting KFI';
?>
<div class="col-12 mt-90">
    <div class="col-12">
        <i class="fa fa-tachometer font-size-20" aria-hidden="true"></i> <strong class="font-size-20"> Assign Management</strong>
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
        <div class="alert alert-white-5">
            <div class="row">
                <div class="col-lg-9 col-md-6 col-12">
                    <div class="col-12">
                        Key Financial Indicator
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="col-12">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-filter" aria-hidden="true"></i></span>
                            <select class="form-select font-size-13" aria-label="Default select example">
                                <option selected value="">Month</option>
                                <option value="1">January</option>
                                <option value="2">February</option>
                                <option value="3">March</option>
                                <option value="4">April</option>
                                <option value="5">May</option>
                                <option value="6">June</option>
                                <option value="7">July </option>
                                <option value="8">August</option>
                                <option value="9">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                            <select class="form-select font-size-13" aria-label="Default select example">
                                <option selected value="">Status</option>
                                <option value="1">one</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="alert alert-light mt-20" role="alert">
                <table class="table table-striped">
                    <thead class="table table-secondary">
                        <tr class="secondary-setting">
                            <th>KFI Contents</th>
                            <th>Company</th>
                            <th>Branch</th>
                            <th>Assign Employee</th>
                            <th>Target</th>
                            <th>Month</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="setting-fontsize">
                            <td>Increase sales in a way that company gains</td>
                            <td>
                                <div class="row">
                                    <div class="col-5">
                                        <span class="badge rounded-pill bg-setting">
                                            <img class="Image-Description" src="<?= Yii::$app->homeUrl ?>image/logo-tcg.png">
                                            <img class="Image-Description" src="<?= Yii::$app->homeUrl ?>image/1.png">
                                            <button id="hs-dropdown-avatar-more" class="number-rounded">
                                                <span class="font-medium leading-none">5</span>
                                            </button>
                                        </span>
                                    </div>
                                    <div class="col-5">
                                        <div class="setting-upload">
                                            <i class="fa fa-building-o building1" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col-5">
                                        <span class="badge rounded-pill bg-setting">
                                            <img class="Image-Description" src="<?= Yii::$app->homeUrl ?>image/Flag-Turkey.png">
                                            <img class="Image-Description" src="<?= Yii::$app->homeUrl ?>image/Flag-Brazil.png">
                                            <button id="hs-dropdown-avatar-more" class="number-rounded">
                                                <span class="font-medium leading-none">5</span>
                                            </button>
                                        </span>
                                    </div>
                                    <div class="col-3">
                                        <div class="dashedshare">
                                            <i class="fa fa-share-alt share-alt-setting" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col-5">
                                        <span class="badge rounded-pill bg-setting">
                                            <img class="Image-Description" src="<?= Yii::$app->homeUrl ?>image/employee1.png">
                                            <img class="Image-Description" src="<?= Yii::$app->homeUrl ?>image/employee2.png">
                                            <button id="hs-dropdown-avatar-more" class="number-rounded">
                                                <span class="font-medium leading-none">5</span>
                                            </button>
                                        </span>
                                    </div>
                                    <div class="col-3">
                                        <!-- <div class="dasheduser-upload">
                                            <i class="fa fa-user user0m" aria-hidden="true"></i>
                                            <div class="dasheduser-edit">
                                                <input type="file" id="loaddingUploaduser" accept=".png, .jpg, .jpeg">
                                                <label for="loaddingUploaduser"></label>
                                            </div>
                                            <div class="dasheduser-preview">
                                                <div id="loaddinguserPreview">
                                                </div>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                            </td>
                            <td><?= number_format(1000000) ?></td>
                            <td>January</td>
                            <td class="text-primary">Active</td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr class="setting-fontsize">
                            <td>Increase sales in a way that company gains</td>
                            <td>
                                <div class="row">
                                    <div class="col-5">
                                        <span class="badge rounded-pill bg-setting">
                                            <button id="hs-dropdown-avatar-more" class="number-rounded">
                                                <span class="font-medium leading-none">0</span>
                                            </button>
                                        </span>
                                    </div>
                                    <div class="col-3">
                                        <div class="setting-upload">
                                            <i class="fa fa-building-o building1" aria-hidden="true"></i>
                                            <!-- <div class="setting-edit">
                                                <input type="file" id="loaddingUpload" accept=".png, .jpg, .jpeg">
                                                <label for="loaddingUpload"></label>
                                            </div>
                                            <div class="setting-preview">
                                                <div id="loaddingPreview">
                                                </div>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col-5">
                                        <span class="badge rounded-pill bg-setting">
                                            <button id="hs-dropdown-avatar-more" class="number-rounded">
                                                <span class="font-medium leading-none">0</span>
                                            </button>
                                        </span>
                                    </div>
                                    <div class="col-3">
                                        <div class="dashedshare">
                                            <i class="fa fa-share-alt share-alt-setting" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col-5">
                                        <span class="badge rounded-pill bg-setting">
                                            <button id="hs-dropdown-avatar-more" class="number-rounded">
                                                <span class="font-medium leading-none">0</span>
                                            </button>
                                        </span>
                                    </div>
                                    <div class="col-3">
                                        <!-- <div class="dasheduser-upload">
                                            <i class="fa fa-user user0m" aria-hidden="true"></i>
                                            <div class="dasheduser-edit">
                                                <input type="file" id="loaddingUploaduser" accept=".png, .jpg, .jpeg">
                                                <label for="loaddingUploaduser"></label>
                                            </div>
                                            <div class="dasheduser-preview">
                                                <div id="loaddinguserPreview">
                                                </div>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                            </td>
                            <td><?= number_format(52) ?></td>
                            <td>January</td>
                            <td class="text-danger">In Active</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="form-check">
    <label class="form-check-label" for="boxradios-kfi"> Default checkbox</label>
    <input class="form-check-input" type="checkbox" value="" id="boxradios-kfi">
</div>


<!-- Button trigger modal -->
<button type="button" class="inline-block rounded bg-primary" data-bs-toggle="modal" data-bs-target="#staticBackdropcompanysetting">
    Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="staticBackdropcompanysetting" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropcompanysettingLabel" aria-hidden="true">
    <div class="">
        <div class="">
            <div class="">
                <h5 class="text-xl font-medium leading-normal text-neutral-800 dark:text-neutral-200" id="staticBackdropcompanysetting">
                    Modal title
                </h5>
                <button type="button" class="-my-2 -mr-2 ml-auto box-content h-4 w-4 rounded-none border-none p-2 hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none" data-te-modal-dismiss aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor">
                        <path d="M.293.293a1 1 0 011.414 0L8 6.586 14.293.293a1 1 0 111.414 1.414L9.414 8l6.293 6.293a1 1 0 01-1.414 1.414L8 9.414l-6.293 6.293a1 1 0 01-1.414-1.414L6.586 8 .293 1.707a1 1 0 010-1.414z" />
                    </svg>
                </button>
            </div>
            <div class="relative flex-auto p-4" data-te-modal-body-ref>
                <select data-te-select-init data-te-container="#exampleModal" data-te-select-filter="true">
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                    <option value="4">Four</option>
                    <option value="5">Five</option>
                    <option value="6">Six</option>
                    <option value="7">Seven</option>
                    <option value="8">Eight</option>
                    <option value="9">Nine</option>
                    <option value="10">Ten</option>
                </select>
            </div>
            <div class="flex flex-shrink-0 flex-wrap items-center justify-end border-t-2 border-neutral-100 border-opacity-100 p-4 dark:border-opacity-50">
                <button type="button" class="inline-block rounded bg-primary-100 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-primary-700 transition duration-150 ease-in-out hover:bg-primary-accent-100 focus:bg-primary-accent-100 focus:outline-none focus:ring-0 active:bg-primary-accent-200" data-te-modal-dismiss data-te-ripple-init data-te-ripple-color="light">
                    Close
                </button>
                <button type="button" class="ml-1 inline-block rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]" data-te-ripple-init data-te-ripple-color="light">
                    Save changes
                </button>
            </div>
        </div>
    </div>
</div>