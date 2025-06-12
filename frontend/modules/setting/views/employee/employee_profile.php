<?php

use common\models\ModelMaster;

$this->title = 'view';
?>
<style>
.menu-item {
    padding: 10px 15px;
    transition: background-color 0.2s;
}

.menu-item:hover {
    background-color: #e0f0ff;
}

.active-menu {
    color: var(--Primary-Blue---HRVC, #2580D3);
    font-weight: bold;
    border-right: 5px solid var(--Primary-Blue---HRVC, #2580D3);
    border-radius: 0;
    background-color: transparent;
    /* ไม่ต้องเปลี่ยนพื้นหลัง */
}
</style>

<div class="contrainer-body mt-10">

    <div class="between-center mt-20" style="width: 100%;">
        <div class="col-8">
            <div class=" d-flex align-items-center gap-2">
                <a href="javascript:history.back()" style="text-decoration: none; width:66px; height:26px;"
                    class="btn-create-branch">
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/back-white.svg"
                        style="width:18px; height:18px; margin-top:-3px;">
                    Back
                </a>
                <div class="pim-name-title ml-10">
                    <?= Yii::t('app', 'Employee in Details') ?>
                </div>
            </div>
        </div>
        <div class="col-3" style="text-align: right;">

        </div>
        <div class="col-1 pr-0 text-end">
            <a href="<?= Yii::$app->homeUrl ?>setting/employee/update/<?= ModelMaster::encodeParams(['employeeId' => $employeeId]) ?>"
                class="btn-create no-underline " style="padding: 3px 9px; display: inline-block;">
                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/edit.svg"
                    style="width:18px; height:18px; margin-top:-3px;">
                Edit
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-3 company-group-edit mt-10" style="border-radius: 9.17px 0px 0px 9.17px;
		border: 0.5px solid var(--Stroke-Bluish-Gray, #BBCDDE);
		background: #F9FCFF;">
            <div class="mid-center mt-53" style="gap: 35px;">
                <div class="text-center position-relative ">
                    <img src="/HRVC/frontend/web/images/employee/profile/AE5oEMwTio.jpg"
                        class="profile-picture rounded-circle mb-3" alt="User Avatar"
                        style="width: 150px; height: 150px;">
                    <span class="condition-name badge position-absolute bottom-0 start-50 translate-middle-x">
                        Full-Time
                    </span>
                </div>

                <div class="row text-center">
                    <span class="font-size-22 font-weight-600">
                        Mr. Dibbo Dutta
                    </span>
                    <span class="font-size-16 font-weight-400">
                        Marketing Manager
                    </span>
                </div>
            </div>
            <!-- //ปุ่มกดเมนู -->
            <div id="menu-profile" class="text-end mt-70">
                <div class="menu-item font-size-16 font-weight-400" data-target="contact">Contact & Personal Details
                </div>
                <div class="menu-item font-size-16 font-weight-400" data-target="work">Work Details</div>
                <div class="menu-item font-size-16 font-weight-400" data-target="attachments">Attachments & Remarks
                </div>
                <div class="menu-item font-size-16 font-weight-400" data-target="certificates">Certificates and Skill
                    Tags</div>
                <div class="menu-item font-size-16 font-weight-400" data-target="performance">Performance</div>
                <div class="menu-item font-size-16 font-weight-400" data-target="evaluation">Evaluation</div>
                <div class="menu-item font-size-16 font-weight-400" data-target="salary">Salary & Allowance</div>
                <div class="menu-item font-size-16 font-weight-400" data-target="role">Role & Permission</div>
            </div>

        </div>
        <div class="col-9 company-group-edit mt-10" style="border-radius: 0px 10px 10px 0px;
		border: 0.5px solid var(--Stroke-Bluish-Gray, #BBCDDE);
		background: #FFF;" id="menu-profile-detail">
            <!-- //แสดงผลข้อมูล ตามเมนูที่กด -->
        </div>
    </div>
</div>

<script>
const menuItems = document.querySelectorAll('.menu-item');
const detailBox = document.getElementById('menu-profile-detail');

const contentMap = {
    contact: '<h4>Contact & Personal Details</h4><p>ข้อมูลติดต่อและส่วนตัว</p>',
    work: '<h4>Work Details</h4><p>รายละเอียดการทำงาน</p>',
    attachments: '<h4>Attachments & Remarks</h4><p>ไฟล์แนบและหมายเหตุ</p>',
    certificates: '<h4>Certificates and Skill Tags</h4><p>ใบรับรองและทักษะ</p>',
    performance: '<h4>Performance</h4><p>ผลการปฏิบัติงาน</p>',
    evaluation: '<h4>Evaluation</h4><p>การประเมิน</p>',
    salary: '<h4>Salary & Allowance</h4><p>เงินเดือนและเบี้ยเลี้ยง</p>',
    role: '<h4>Role & Permission</h4><p>สิทธิ์และบทบาท</p>',
};

menuItems.forEach(item => {
    item.style.cursor = 'pointer';
    item.addEventListener('click', () => {
        const target = item.getAttribute('data-target');
        detailBox.innerHTML = contentMap[target] || '<p>ไม่พบเนื้อหา</p>';

        // highlight เมนูที่เลือก
        menuItems.forEach(i => i.classList.remove('active-menu'));
        item.classList.add('active-menu');
    });
});
</script>