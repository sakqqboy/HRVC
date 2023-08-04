<?php
$this->title = 'template maker';
?>

<div class="col-12" style="margin-top: 90px;">
    <div class="col-lg-10 col-md-6 col-6 page-Questions">
        Questions Dashboard
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-12 mt-30">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label label-template1"><span class="moon-template">*</span> Template Name</label>
                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Accounts Department">
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-12 mt-30">
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label label-template1"> Description</label>
                <textarea class="form-control" id="exampleFormControlTextarea1"></textarea>
            </div>
        </div>
    </div>



    <table class="table alert alert-secondary tb-border">
        <thead class="table-secondary">
            <tr>
                <th class="text-center">SL</th>
                <th class="text-center">Survey Questioners </th>
                <th class="text-center">Sub-Sets</th>
                <th class="text-center">Type</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th class="text-center">01</th>
                <td>
                    <select class="form-select" aria-label="Default select example">
                        <option selected> 1. Communication</option>
                        <option value="1">2. Communication</option>
                        <option value="2">3. Communication</option>
                    </select>
                </td>
                <td class="text-center">10</td>
                <td class="text-center">Rating</td>
                <td class="text-center">
                    <button type="button" class="btn btn-outline-secondary"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> </button>
                    <button type="button" class="btn btn-outline-danger"> <i class="fa fa-trash" aria-hidden="true"></i> </button>
                </td>
            </tr>
            <tr>
                <th class="text-center">02</th>
                <td>
                    <select class="form-select" aria-label="Default select example">
                        <option selected> 1. Communication</option>
                        <option value="1">2. Communication</option>
                        <option value="2">3. Communication</option>
                    </select>
                </td>
                <td class="text-center">0</td>
                <td class="text-center">....</td>
                <td class="text-center">
                    <button type="button" class="btn btn-outline-secondary"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> </button>
                    <button type="button" class="btn btn-outline-danger"> <i class="fa fa-trash" aria-hidden="true"></i> </button>
                </td>

            </tr>
        </tbody>
    </table>
    <div class="row">
        <div class="col-12 text-end" style="margin-top: 120px;">
            <button type="button" class="btn btn-secondary">Cancel</button>
            <a href="<?= Yii::$app->homeUrl ?>site/preview"><button type="button" class="btn btn-primary">Preview</button></a>
            <button type="button" class="btn btn-primary">Submit</button>
        </div>
    </div>
</div>