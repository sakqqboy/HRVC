    <div class="between-start">
        <!-- head modal -->
        <div>
            <span class=" font-blue font-size-20" style="font-weight: 600;">Edit Department</span>
        </div>
        <div>
            <a href="javascript:void(0);" onclick="$('#departmentModal').modal('hide');">
                <img src="<?= Yii::$app->homeUrl . 'image/modal-exit.svg' ?>" style="width: 24px; height: 24px;">
            </a>
        </div>
    </div>

    <div class="row" style=" gap: 30px; ">
        <div style="display: flex; align-items: center; gap: 17px;">
            <div class="mid-center" style="height: 60px; padding: 20.944px 4.189px; gap: 10px;">
                <?php if ($branches["branchImage"] != null) { ?>
                <img src="<?= Yii::$app->homeUrl . $branches['branchImage'] ?>" class="cycle-big-image">
                <?php } else { ?>
                <img src="<?= Yii::$app->homeUrl . 'image/userProfile.png' ?>" class="cycle-big-image">
                <?php } ?>
            </div>
            <div class="header-crad-company">
                <div class="name-crad-company">
                    <!-- Tokyo consulting Firm Co.,Ltd. -->
                    <?= $branches['companyName'] ?>
                </div>
                <div class="city-crad-company">
                    <img src="<?= Yii::$app->homeUrl ?><?= $branches['picture'] ?>" class="bangladresh-hrvc">
                    <?= $branches['companyName'] ?>
                </div>
                <span class=" font-size-16 text-gray-back"
                    style="font-weight: 500; display: flex; align-items: center; gap: 12px;">
                    <div class="city-crad-company">
                        <img src="<?= Yii::$app->homeUrl ?>" class="bangladresh-hrvc">
                        <?= $branches['city'] ?>,<?= $branches['countryName'] ?>
                    </div>
                </span>
            </div>
        </div>
        <div class="mt-30">
            <!-- content -->
            <div class="row d-flex align-items-center gap-2 mb-3">
                <span class="mb-14 font-size-16 " style=" font-weight: 600; padding: 0;">
                    Add Another Department
                </span>

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
            <div class="row d-flex align-items-center gap-2 mb-3 mt-30" style="gap: 30px;">
                <span class="mb-14 font-size-16 " style=" font-weight: 600; padding: 0;">
                    <!-- นับจำนวน -->
                    Existing Departments (<?=count($departments) ?>)
                    <hr class="hr-group">
                </span>
                <!-- ถ้ามีให้แสดงผล -->
                <?php
                            if (isset($departments) && count($departments) > 0) {
                                $countrow = 0;
                                $i = 1;
                ?>
                <!-- เสริจ -->
                <div class="input-group" style="border: 1px solid #ccc; border-radius: 50px; overflow: hidden;">
                    <span class="input-group-text" style="background-color: white; border: none;">
                        <img src="<?= Yii::$app->homeUrl ?>image/search.svg" alt="Search"
                            style="width: 20px; height: 20px;">
                    </span>
                    <input class="form-control" type="text" name="Search" id="Search" placeholder="Search Departments"
                        style="border: none; box-shadow: none;">
                </div>

                <!-- วนลูป -->
                <?php
                    foreach ($departments as $department) :
                ?>
                <div class="tab-pane fade show active" id="upcoming-schedule" role="tabpanel"
                    aria-labelledby="upcoming-schedule-tab">
                    <ul id="schedule-list" class="list-unstyled small  m-0 p-0">

                    </ul>
                </div>
                <?php
                        $i++;
                    endforeach;
                }else{
                ?>
                <!-- ถ้าไม่มี Departments ให้แสดงเป็น 0 -->
                <div class="create-crad-company " style="background-color: #F9F9F9;">
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
    </div>

    <div>
        <!-- footer modal -->
    </div>

    <div class="modal fade" id="departmentDeleteModal" tabindex="-1" aria-labelledby="departmentDeleteModal"
        aria-hidden="true">
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
        }
    }
});


document.getElementById('departmentName').addEventListener('focus', function() {
    // alert('Search');
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

// alert('1');

document.getElementById('Search').addEventListener('input', function() {
    // alert('1');
    const keyword = this.value.toLowerCase();
    const items = document.querySelectorAll('#schedule-list .schedule-item');

    items.forEach(item => {
        const name = item.querySelector('.col-10').textContent.toLowerCase();
        if (name.includes(keyword)) {
            item.style.display = 'block';
        } else {
            item.style.display = 'none';
        }
    });
});

document.getElementById('schedule-list').addEventListener('click', function(e) {

    const editBtn = e.target.closest('.icon-edit');
    if (editBtn) {
        e.preventDefault();

        const li = editBtn.closest('li');
        const deptId = li.getAttribute('data-id');
        const deptName = li.querySelector('.dept-label').textContent.trim();

        // ถ้ามีอันที่กำลังแก้อยู่ ให้ลบก่อน
        // cancelEdit();

        // ซ่อน li เดิม
        li.style.display = 'none';
        originalLi = li;
        currentEditingId = deptId;

        // เพิ่ม input ชั่วคราวต่อท้าย li
        const inputHTML = `
            <li class="edit-temp-item mt-30" data-id="${deptId}">
                <div class="input-group">
                    <input type="text" name="departmentNameList" id="editDeptInputlist" value="${deptName}" class="form-control"
                        placeholder="Write department name">
                    <span class="input-group-text" id="enterHintlist" style="background-color: #ffff; border-left: none;">
                        <div class="city-crad-company" id="hintTextlist" style="color: #ffffff; background-color: #2580D3;">
                            <img src="<?= Yii::$app->homeUrl . 'image/enter-white.svg' ?>"
                                style="width: 24px; height: 24px;">
                            Enter to Save
                        </div>
                    </span>
                </div>
            </li>`;
        li.insertAdjacentHTML('afterend', inputHTML);

        // focus และใส่ event
        const input = document.getElementById('editDeptInputlist');
        input.focus();

        input.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                saveEdit(input.value.trim());
            }
        });

        input.addEventListener('blur', function() {
            cancelEdit(input.value.trim());
            // const label = originalLi.querySelector('.dept-label');
            // label.textContent = newValue || label.textContent;
        });
    }
});

requestAnimationFrame(() => {
    const input = document.getElementById('editDeptInputlist');
    if (input) {
        input.focus();
        input.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                alert('Save');
                e.preventDefault();
                saveEdit(input.value.trim());
            }
        });

        input.addEventListener('blur', function() {
            saveEdit(input.value.trim());
            // ลบ input และคืน li
            alert('d');
            const inputLi = document.querySelector('.edit-temp-item');
            if (inputLi) inputLi.remove();
        });
    }
});

renderDepartmentList(departments);
    </script>