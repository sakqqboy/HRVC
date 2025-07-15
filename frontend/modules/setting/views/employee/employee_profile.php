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

.action-employee-btn {
    background-color: white;
    color: #2580D3;
    min-height: 30px;
    border-radius: 66px;
    padding-left: 9px;
    padding-right: 9px;
    font-size: 14px;
    font-weight: 600;
    border: 0.5px #2580D3 solid;
    text-decoration: none;
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
                    <?= Yii::t('app', 'Back') ?>
                </a>
                <div class="pim-name-title ml-10">
                    <?= Yii::t('app', 'Employee in Details') ?>
                </div>
            </div>
        </div>
        <div class="col-3" style="text-align: right;">
            <div class="d-flex align-items-center justify-content-end gap-2">
                <a class="d-flex align-items-center action-employee-btn justify-content-center"
                    onclick="javascript:copyToClipboard(window.location.href)">
                    <img src="<?= Yii::$app->homeUrl ?>image/share-blue.svg" class="me-2"
                        style="width: 18px;height:18px;">
                    Share
                </a>
                <a href="<?= Yii::$app->homeUrl ?>setting/employee/export-employee/<?= ModelMaster::encodeParams(['employeeId' => $employeeId, 'export' => 1]) ?>"
                    class="d-flex align-items-center action-employee-btn justify-content-center" id="normal-action">
                    <img src="<?= Yii::$app->homeUrl ?>image/download-blue.svg" class="me-2"
                        style="width: 18px;height:18px;">
                    Download
                </a>
                <a href="<?= Yii::$app->homeUrl ?>setting/employee/export-employee/<?= ModelMaster::encodeParams(['employeeId' => $employeeId]) ?>"
                    class="d-flex align-items-center action-employee-btn justify-content-center">
                    <img src="<?= Yii::$app->homeUrl ?>image/print-blue.svg" class="me-2"
                        style="width: 18px;height:18px;">
                    Print Profile
                </a>
            </div>
        </div>
        <div class="col-1 pr-0 text-end">
            <a href="<?= Yii::$app->homeUrl ?>setting/employee/update/<?= ModelMaster::encodeParams(['employeeId' => $employeeId]) ?>"
                class="btn-create no-underline " style="padding: 3px 9px; display: inline-block;">
                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/edit.svg"
                    style="width:18px; height:18px; margin-top:-3px;">
                <?= Yii::t('app', 'Edit') ?>
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-3 company-group-edit mt-10" style="border-radius: 9.17px 0px 0px 9.17px;
		border: 0.5px solid var(--Stroke-Bluish-Gray, #BBCDDE);
		background: #F9FCFF;">
            <div class="mid-center mt-53" style="gap: 35px;">
                <div class="text-center position-relative ">
                    <?php
                    if (isset($employee) && $employee["picture"] != null) { ?>
                    <img src="<?= Yii::$app->homeUrl . $employee['picture'] ?>"
                        class="profile-picture rounded-circle mb-3" alt="User Avatar"
                        style="width: 150px; height: 150px;">
                    <?php
                    } else { ?>
                    <img src="<?= Yii::$app->homeUrl ?>images/employee/status/employee-nopic.svg"
                        class="profile-picture rounded-circle mb-3" alt="User Avatar"
                        style="width: 150px; height: 150px;">
                    <?php
                    }
                    ?>
                    <?php
						// $statusClass = "status-badge-full-time";
                        $statusClass = "status-badge-full-time";
						if ($employee["status"] == "Full-Time") {
							$statusClass = "status-badge-full-time";
                            $statusClass = "background: #2580D3;";
						}
						if ($employee["status"] == "Probationary") {
							$statusClass = "status-badge-probationary";
                            $statusClass = "background: #20598D;";
						}
						if ($employee["status"] == "Part-Time") {
							$statusClass = "status-badge-part-Time";
                            $statusClass = "background: #20598D;";
						}
						if ($employee["status"] == "Intern") {
							$statusClass = "status-badge-intern";
                            $statusClass = "background: #FFE100;";
						}
						if ($employee["status"] == "Temporary") {
							$statusClass = "status-badge-temporarye";
                            $statusClass = "background: #FF9D00;";
						}
						if ($employee["status"] == "Freelance") {
							$statusClass = "status-badge-freelance";
                            $statusClass = "background: #FF9D00;";
						}
						if ($employee["status"] == "Suspended") {
							$statusClass = "status-badge-sspended";
                            $statusClass = "background: #E05757;";
						}
						if ($employee["status"] == "Resigned") {
							$statusClass = "status-badge-resigned";
                            $statusClass = "background: #EC1D42;";
						}
						if ($employee["status"] == "Lay off") {
							$statusClass = "status-badge-layoff";
                            $statusClass = "background: #FF9D00;";
						}
						if ($employee["status"] == "not set") {
							$statusClass = "status-badge-notset";
                            $statusClass = "background: #2580D3;";
						}
						//throw new exception(print_r($employees, true));
				?>
                    <!-- <span class="<?=$statusClass?>">
                        <?= $employee['status'] ?>
                    </span> -->
                    <span class="condition-name badge position-absolute bottom-0 start-50 translate-middle-x"
                        style="<?= $statusClass ?>">
                        <?= $employee['status'] ?>
                    </span>
                </div>

                <div class="row text-center">
                    <span class="font-size-22 font-weight-600">
                        <?= $employee['employeeFirstname'] ?> <?= $employee['employeeSurename'] ?>
                    </span>
                    <span class="font-size-16 font-weight-400">
                        <?= $employee['titleName'] ?>
                    </span>
                </div>
            </div>
            <!-- //ปุ่มกดเมนู -->
            <div id="menu-profile" class="text-end mt-70">
                <div class="menu-item font-size-16 font-weight-400" data-target="contact">
                    <?= Yii::t('app', 'Contact & Personal Details') ?>
                </div>
                <div class="menu-item font-size-16 font-weight-400" data-target="work">
                    <?= Yii::t('app', 'Work Details') ?>
                </div>
                <div class="menu-item font-size-16 font-weight-400" data-target="attachments">
                    <?= Yii::t('app', 'Attachments & Remarks') ?>
                </div>
                <div class="menu-item font-size-16 font-weight-400" data-target="certificates">
                    <?= Yii::t('app', 'Certificates and Skill Tags') ?>
                </div>
                <div class="menu-item font-size-16 font-weight-400" data-target="performance">
                    <?= Yii::t('app', 'Performance') ?>
                </div>
                <div class="menu-item font-size-16 font-weight-400" data-target="evaluation">
                    <?= Yii::t('app', 'Evaluation') ?>
                </div>
                <div class="menu-item font-size-16 font-weight-400" data-target="salary">
                    <?= Yii::t('app', 'Salary & Allowance') ?>
                </div>
                <div class="menu-item font-size-16 font-weight-400" data-target="role">
                    <?= Yii::t('app', 'Role & Permission') ?>
                </div>
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
const employeeId = <?= $employeeId ?>;

const urlMap = {
    contact: '<?= Yii::$app->homeUrl ?>setting/employee/contact-detail/<?= ModelMaster::encodeParams(['employeeId' => $employeeId]) ?>',
    work: '<?= Yii::$app->homeUrl ?>setting/employee/work-detail/<?= ModelMaster::encodeParams(['employeeId' => $employeeId]) ?>',
    attachments: '<?= Yii::$app->homeUrl ?>setting/employee/attachments/<?= ModelMaster::encodeParams(['employeeId' => $employeeId]) ?>',
    certificates: '<?= Yii::$app->homeUrl ?>setting/employee/certificates/<?= ModelMaster::encodeParams(['employeeId' => $employeeId]) ?>',
    performance: '<?= Yii::$app->homeUrl ?>setting/employee/performance/<?= ModelMaster::encodeParams(['employeeId' => $employeeId]) ?>',
    evaluation: '<?= Yii::$app->homeUrl ?>setting/employee/evaluation/<?= ModelMaster::encodeParams(['employeeId' => $employeeId]) ?>',
    salary: '<?= Yii::$app->homeUrl ?>setting/employee/salary/<?= ModelMaster::encodeParams(['employeeId' => $employeeId]) ?>',
    role: '<?= Yii::$app->homeUrl ?>setting/employee/role/<?= ModelMaster::encodeParams(['employeeId' => $employeeId]) ?>',
};

const menuItems = document.querySelectorAll('.menu-item');
const detailBox = document.getElementById('menu-profile-detail');

function loadMenu(targetKey) {
    const url = urlMap[targetKey];

    if (!url) {
        detailBox.innerHTML = '<p>ไม่พบเนื้อหา</p>';
        return;
    }

    menuItems.forEach(i => i.classList.remove('active-menu'));

    const activeItem = document.querySelector(`.menu-item[data-target="${targetKey}"]`);
    if (activeItem) {
        activeItem.classList.add('active-menu');
    }

    fetch(url)
        .then(response => response.text())
        .then(html => {
            detailBox.innerHTML = html;
        })
        .catch(error => {
            detailBox.innerHTML = '<p>เกิดข้อผิดพลาดในการโหลดข้อมูล</p>';
            console.error(error);
        });
}

menuItems.forEach(item => {
    item.style.cursor = 'pointer';
    item.addEventListener('click', () => {
        const target = item.getAttribute('data-target');
        loadMenu(target);
    });
});

// 🟦 โหลดเมนูแรกเมื่อหน้าโหลดเสร็จ
document.addEventListener('DOMContentLoaded', function() {
    loadMenu('contact'); // หรือเปลี่ยนเป็นเมนูอื่นที่คุณต้องการให้เริ่มแสดง
});
</script>