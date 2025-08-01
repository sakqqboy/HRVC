<?php

use common\models\ModelMaster;
?>
<div class="row" style="--bs-gutter-x:0px;">
    <!-- head modal -->
    <div class="col-10 text-start">
        <span class=" font-blue font-size-20" style="font-weight: 600;">Edit Department</span>
    </div>
    <div class="col-2 text-end">
        <a href="javascript:void(0);" onclick="$('#departmentModal').modal('hide');">
            <img src="<?= Yii::$app->homeUrl . 'image/modal-exit.svg' ?>" style="width: 24px; height: 24px;">
        </a>
    </div>
</div>

<div class="row" style="--bs-gutter-x:0px;">
    <div class="d-flex justify-content-between">
        <div class="d-flex justify-content-center align-items-center ">
            <?php if (!empty($branches["branchImage"])) { ?>
            <img src="<?= Yii::$app->homeUrl . 'image/no-company.svg' ?>" class="cycle-big-image"
                style="max-width: 100px; max-height: 100px;">
            <?php } else { ?>
            <img src="<?= Yii::$app->homeUrl . $branches['picture'] ?>" class="cycle-big-image"
                style="max-width: 70px; max-height: 70px;">
            <?php } ?>
        </div>
        <div class="flex-grow-1  ms-2">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="font-size-18 pt-0 pb-0 " style="font-weight: 600;line-height:14px;margin-top:-1px;">
                        <?= $branches['companyName'] ?>
                    </div>
                    <div class="city-crad-company  mt-12  justify-content-start pt-0 pb-0 align-content-center d-inline-flex font-size-14"
                        style="height: 27px;font-weight:400;line-height: 20px;">
                        <img src="<?= Yii::$app->homeUrl ?><?= $branches['branchImage'] ?>" alt="icon"
                            class="bangladresh-hrvc">
                        <?= Yii::t('app', $branches['branchName']) ?>
                    </div>
                    <div class="mt-12 pt-0 pb-0" style="height: 27px;">
                        <div class="city-crad-company  justify-content-start pt-0 pb-0 align-content-center d-inline-flex font-size-14"
                            style="height: 27px;font-weight:400;line-height: 20px;">
                            <img src="
                                <?= Yii::$app->homeUrl  ?><?= !empty($branches['flag']) ? $branches['flag'] : 'image/e-world.svg' ?>"
                                class="bangladresh-hrvc">
                            <?= $branches['city'] ?>, <?= Yii::t('app', $branches['countryName']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-30" style=" height: 765.946px; ">
        <!-- content -->

        <!-- <div class="d-flex align-items-center mb-3 border"> -->
        <div class="row" style="--bs-gutter-x:0px;">
            <div class="col-12 mb-14 font-size-16" style="font-weight: 600; padding: 0;">
                Add Another Department
            </div>
            <div class="col-12">
                <div class="input-group">
                    <input type="text" name="departmentName" id="departmentName" class="form-control"
                        placeholder="Write department name">
                    <span class="input-group-text" id="enterHint" style="background-color: #ffff; border-left: none;">
                        <div class="city-crad-company" id="hintText">
                            <img src="<?= Yii::$app->homeUrl . 'image/enter-black.svg' ?>"
                                style="width: 24px; height: 24px;">
                            Enter to Save
                        </div>
                    </span>
                </div>
            </div>
        </div>
        <!-- </div> -->
        <!-- <div class="row d-flex align-items-center gap-2 mb-3 mt-30" style="gap: 30px;"> -->
        <div class="col-12 pb-14 font-size-16 border-bottom mt-30 pt-0" style=" font-weight: 600;">
            <!-- นับจำนวน -->
            Existing Departments (<?= count($departments) ?>)
            <!-- <hr class="hr-group"> -->
        </div>
        <!-- ถ้ามีให้แสดงผล -->
        <?php
        // echo $departmentId;

        if (isset($departments) && count($departments) > 0) {
            $countrow = 0;
            $i = 1;
        ?>
        <!-- เสริจ -->
        <div class="input-group mt-30" style="border: 1px solid #ccc; border-radius: 50px; overflow: hidden;">
            <span class="input-group-text" style="background-color: white; border: none;">
                <img src="<?= Yii::$app->homeUrl ?>image/search.svg" alt="Search" style="width: 20px; height: 20px;">
            </span>
            <input class="form-control" type="text" name="Search" id="Search" placeholder="Search Departments"
                style="border: none; box-shadow: none;">
        </div>
        <div class="tab-pane fade show active" id="upcoming-schedule" role="tabpanel"
            aria-labelledby="upcoming-schedule-tab" style="height: 300px;">
            <ul id="schedule-list" class="list-unstyled small  m-0 p-0">
                <!-- วนลูป -->
                <?php
                    foreach ($departments as $department) :
                    ?>



                <?php
                        $i++;
                    endforeach;
                    ?>
            </ul>
        </div>
        <?php
        } else {
        ?>
        <!-- ถ้าไม่มี Departments ให้แสดงเป็น 0 -->
        <div class="create-crad-company " id="no-existing" style="background-color: #F9F9F9;">
            <span class="text-create-crad">
                No Existing Departments Yet!
            </span>
        </div>
        <input type="hidden" name="Search" id="Search">
        <ul id="schedule-list" type="hidden">
        </ul>
        <?php
        }
        ?>
    </div>
</div>

<div>
    <!-- footer modal -->
    <input type="hidden" name="departmentId" id="departmentId" value="<?= $departmentId ?>">
    <input type="hidden" name="url" id="url"
        value="<?= Yii::$app->homeUrl ?>setting/department/modal-department/<?= ModelMaster::encodeParams(['branchId' => $branches['branchId']]) ?>">
</div>

<script>
var $baseUrl = window.location.protocol + "//" + window.location.host;
if (window.location.host == 'localhost') {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/HRVC/frontend/web/';
} else {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/';
}
var url = $baseUrl;

var currentEditingId = null;
var originalLi = null;

// รีเซ็ตค่าทุกครั้งที่โหลดหน้าใหม่
var branchId = <?= $branches['branchId'] ?>; // ใช้ค่าจาก PHP ที่ส่งมา
var departments = <?= json_encode($departments) ?>; // ใช้ค่าจาก PHP ที่ส่งมา

var disableLinks = () => {
    document.querySelectorAll('.icon-delete, .icon-edit').forEach(link => {
        link.style.pointerEvents = 'none'; // ปิดคลิก
        link.style.opacity = '0.5'; // จางลง
    });
};

var enableLinks = () => {
    document.querySelectorAll('.icon-delete, .icon-edit').forEach(link => {
        link.style.pointerEvents = 'auto'; // เปิดคลิก
        link.style.opacity = '1'; // กลับมาปกติ
    });
};


document.getElementById('departmentName').addEventListener('keydown', function(event) {
    if (event.key === 'Enter') {
        // alert('Save');
        event.preventDefault(); // ป้องกันการ submit ฟอร์มโดยไม่ตั้งใจ
        let deptName = this.value.trim();
        if (deptName !== '') {
            // ส่งค่าใหม่ไปบันทึก
            actionSaveDepartment(branchId, deptName);
            $("#no-existing").hide();
        }
    }
});


document.getElementById('departmentName').addEventListener('focus', function() {
    const hint = document.getElementById('hintText');
    hint.style.backgroundColor = '#2580D3';
    hint.style.color = 'white';
    hint.innerHTML =
        `<img src="${url}image/enter-white.svg" style="width: 24px; height: 24px;"> Enter to Save`;

    document.querySelectorAll('.bin-icon').forEach(icon => {
        icon.src = url + 'images/icons/Settings/bingray.svg';
    });

    document.querySelectorAll('.edit-icon').forEach(icon => {
        icon.src = url + 'image/edit-gray.svg';
    });

    document.querySelectorAll('.edit-label').forEach(label => {
        label.style.color = 'gray';
    });

    disableLinks(); // ⛔ ทำให้ <a> กดไม่ได้
});

document.getElementById('departmentName').addEventListener('blur', function() {
    const hint = document.getElementById('hintText');
    hint.style.backgroundColor = '';
    hint.style.color = '';
    hint.innerHTML =
        `<img src="${url}image/enter-black.svg" style="width: 24px; height: 24px;"> Enter to Save`;

    document.querySelectorAll('.bin-icon').forEach(icon => {
        icon.src = url + 'images/icons/Settings/binred.svg';
    });

    document.querySelectorAll('.edit-icon').forEach(icon => {
        icon.src = url + 'image/edit-blue.svg';
    });

    document.querySelectorAll('.edit-label').forEach(label => {
        label.style.color = '#2580D3';
    });

    enableLinks(); // ✅ ทำให้ <a> กดได้
});

initDepartmentSearch();

renderDepartmentList(departments);
</script>