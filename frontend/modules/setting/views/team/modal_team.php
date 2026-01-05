<?php
use common\models\ModelMaster;
?>
<div class="between-start">
    <!-- head modal -->
    <div>
        <span class=" font-blue font-size-20" style="font-weight: 600;"><?= Yii::t('app', 'Add Team') ?></span>
    </div>
    <div>
        <a href="javascript:void(0);" onclick="$('#teamModal').modal('hide');">
            <img src="<?= Yii::$app->homeUrl . 'image/modal-exit.svg' ?>" style="width: 24px; height: 24px;">
        </a>
    </div>
</div>

<div class="row" style=" gap: 30px; ">
    <div style="display: flex; align-items: center; gap: 17px;">
        <div class="mid-center" style="">
            <?php
            if ($teams["picture"] != null) { ?>
            <img src="<?= Yii::$app->homeUrl . $teams['picture'] ?>" class="cycle-big-image">
            <?php } else { ?>
            <img src="<?= Yii::$app->homeUrl . 'image/userProfile.png' ?>" class="cycle-big-image">
            <?php } ?>
        </div>
        <div class="header-crad-company">
            <div class="name-crad-company text-truncate">
                <?= $teams['companyName'] ?>
            </div>
            <div class="city-crad-company text-truncate">
                <div class="cycle-current-yellow" style="width: 20px; height: 20px;">
                    <img src="<?= Yii::$app->homeUrl ?>image/branches-black.svg" alt="icon"
                        style="width: 10px; height: 10px;">
                </div>
                <?= Yii::t('app', $teams['branchName']) ?>
            </div>
            <div style="display: flex; gap: 20px; align-items: center;">
                <div class="city-crad-company text-truncate" style="display: flex; align-items: center; gap: 5px;">
                    <div class="cycle-current-red" style="width: 20px; height: 20px;">
                        <img src="<?= Yii::$app->homeUrl ?>image/departments.svg" alt="icon"
                            style="width: 10px; height: 10px;">
                    </div>
                    <?= $teams['departmentName'] ?>,
                </div>

                <div class="city-crad-company text-truncate" style="display: flex; align-items: center; gap: 5px;">
                    <img src="<?= Yii::$app->homeUrl ?><?= $teams['flag'] ?>" class="bangladresh-hrvc">
                    <?= $teams['city'] ?>,
                    <?= Yii::t('app', $teams['countryName']) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-30" style=" height: 765.946px; ">
        <!-- content -->
        <div class="row d-flex align-items-center gap-2 mb-3">
            <span class="mb-14 font-size-16 " style=" font-weight: 600; padding: 0;">
                <?= Yii::t('app', 'Add Another Team') ?>
            </span>

            <div class="input-group">
                <input type="text" name="teamName" id="teamName" class="form-control" placeholder="<?= Yii::t('app', 'Write team name') ?>">
                <span class="input-group-text" id="enterHint" style="background-color: #ffff; border-left: none;">
                    <div class="city-crad-company" id="hintText">
                        <img src="<?= Yii::$app->homeUrl . 'image/enter-black.svg' ?>"
                            style="width: 24px; height: 24px;">
                        <?= Yii::t('app', 'Enter to Save') ?>
                    </div>
                </span>
            </div>

        </div>
        <div class="row d-flex align-items-center gap-2 mb-3 mt-30" style="gap: 30px;">
            <span class="mb-14 font-size-16 " style=" font-weight: 600; padding: 0;">
                <!-- นับจำนวน -->
                <?= Yii::t('app', 'Existing Teams') ?> (<?= $countTeam ?>)
                <hr class="hr-group">
            </span>
            <!-- ถ้ามีให้แสดงผล -->
            <?php
                // echo $TeamId;

                            if (isset($teams['teams']) && count($teams['teams']) > 0) {
                                $countrow = 0;
                                $i = 1;
                ?>
            <!-- เสริจ -->
            <div class="input-group" style="border: 1px solid #ccc; border-radius: 50px; overflow: hidden;">
                <span class="input-group-text" style="background-color: white; border: none;">
                    <img src="<?= Yii::$app->homeUrl ?>image/search.svg" alt="Search"
                        style="width: 20px; height: 20px;">
                </span>
                <input class="form-control" type="text" name="Search" id="Search" placeholder="<?= Yii::t('app', 'Search Teams') ?>"
                    style="border: none; box-shadow: none;">
            </div>

            <!-- วนลูป -->
            <?php
                    foreach ($teams as $team) :
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
            <!-- ถ้าไม่มี Teams ให้แสดงเป็น 0 -->
            <div class="create-crad-company " id="no-existing" style="background-color: #F9F9F9;">
                <span class="text-create-crad">
                    <?= Yii::t('app', 'No Existing Teams Yet!') ?>
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
    <input type="hidden" name="teamId" id="teamId" value="<?php echo $teamId ?>">
    <input type="hidden" name="url" id="url"
        value="<?= Yii::$app->homeUrl ?>setting/team/modal-team/<?= ModelMaster::encodeParams(['branchId' => '' ]) ?>">
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
var departmentId = <?=$teams['departmentId'] ?>; // ใช้ค่าจาก PHP ที่ส่งมา
var teams = <?= json_encode($teams['teams']) ?>; // ใช้ค่าจาก PHP ที่ส่งมา

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


document.getElementById('teamName').addEventListener('keydown', function(event) {
    if (event.key === 'Enter') {
        event.preventDefault(); // ป้องกันการ submit ฟอร์มโดยไม่ตั้งใจ
        let teamName = this.value.trim();
        if (teamName !== '') {
            // ส่งค่าใหม่ไปบันทึก
            // alert('Save');
            actionSaveTeam(departmentId, teamName);
            this.value = "";
            $("#no-existing").hide();
        }
    }
});


document.getElementById('teamName').addEventListener('focus', function() {
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

document.getElementById('teamName').addEventListener('blur', function() {
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

initTeamSearch();

renderTeamList(teams);
</script>