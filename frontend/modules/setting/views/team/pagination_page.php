<div style="width: 100%; text-align: center; display: flex; justify-content: center; align-items: center; gap: 21px;">
    <!-- ถ้ามีมากกว่า 6 ให้แสดง Page Numbers เริ่มจาก 1  -->
    <?php 
    if(  $numPage['totalRows'] > 6){
    ?>
    <!-- Previous Button -->
    <button type="button" class="btn-previous<?= ($numPage['nowPage'] == 1 ? '-disable' : '') ?>"
        <?= ($numPage['nowPage'] == 1 ? 'disabled' : '') ?>
        onclick="  goToPageTeam(<?= $numPage['nowPage'] - 1 ?>, '<?php echo $page ?>',<?php echo $departmentId ?>, <?php echo $companyId ?>,  <?php echo $branchId ?>  )">
        <img src="<?= Yii::$app->homeUrl ?>image/btn-previous<?= ($numPage['nowPage'] == 1 ? '-disable' : '') ?>.svg"
            style="width: 4.958px; height: 8.5px; vertical-align: middle;">
        <span style="margin-left: 5px;"><?= Yii::t('app', 'Previous') ?></span>
    </button>
    <div>
        <!-- Page Numbers 1 หน้า-->
        <a href="javascript:void(0);"
            onclick="  goToPageTeam(1, '<?php echo $page ?>',<?php echo $departmentId ?>, <?php echo $companyId ?>,  <?php echo $branchId ?>  )"
            class=" <?= ($numPage['nowPage'] == 1 ? 'btn btn-bg-blue-xs pt-7' : '') ?>"
            style=" <?= ($numPage['nowPage'] == 1 ? 'border: none; padding: 5px 10px; border-radius: 5px;' : 'text-decoration: none;') ?>">
            <span
                style=" <?= ($numPage['nowPage'] == 1 ? 'color: white; font-weight: 700;' : 'color: black; font-weight: 500;') ?>">
                1
            </span>
        </a>
    </div>

    <!-- แสดง2 เมื่อ ปัจจุบันเป็น 1 หรือ 3 และต้องไม่เท่ากับ 2 และ ต้องน้อยกว่า 4 -->
    <?php 
    if(($numPage['nowPage'] == 1 || $numPage['nowPage'] == 3) && $numPage['totalPages'] != 2 && $numPage['totalPages'] < 4 ){
        ?>
    <a href="javascript:void(0);"
        onclick="  goToPageTeam(2, '<?php echo $page ?>',<?php echo $departmentId ?>, <?php echo $companyId ?>,  <?php echo $branchId ?>  )"
        class=" <?= ($numPage['nowPage'] == 2 ? 'btn btn-bg-blue-xs pt-7' : '') ?>"
        style=" <?= ($numPage['nowPage'] == 2 ? 'border: none; padding: 5px 10px; border-radius: 5px;' : 'text-decoration: none;') ?>">
        <span
            style=" <?= ($numPage['nowPage'] == 2 ? 'color: white; font-weight: 700;' : 'color: black; font-weight: 500;') ?>">
            2
        </span>
    </a>
    <?php 
    }
    ?>

    <!-- แสดง ... ซ้ายขวาและ แสดงเลขตรงกลาง โดย หน้าปัจจุบันไม่ใช่เริ่มหรือท้าย-->
    <?php   
                if ($numPage['nowPage'] != 1 && $numPage['nowPage'] != $numPage['totalPages']) { 
        ?>
    <div class="d-flex align-items-center">
        <?php 
        if($numPage['nowPage'] != 2){
        ?>
        <!-- . . . ซ้าย -->
        <span class="mr-15" id="page-jump-ellipsis1" style="cursor: pointer; font-weight: 500;">...</span>
        <div class="mr-15" id="page-jump-form" style="display: none; align-items: center; gap: 5px;">
            <form id="gotoPage">
                <input type="text" name="pageInput" class="form-control" required pattern="[0-9]+"
                    title="กรุณากรอกเฉพาะตัวเลข" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                    style="width: 30px; height: 35px; padding: 4px 8px; font-size: 14px; text-align: center; border: 1px solid #ccc; border-radius: 5px;">
            </form>
        </div>
        <?php 
        }
        ?>
        <!-- เลขปัจจุบันตรงกลาง -->
        <div>
            <a href="javascript:void(0);"
                onclick="  goToPageTeam(<?php echo $numPage['nowPage'] ?>, '<?php echo $page ?>',<?php echo $departmentId ?>, <?php echo $companyId ?>,  <?php echo $branchId ?> )"
                class=" <?= ($numPage['nowPage'] ==  $numPage['nowPage'] ? 'btn btn-bg-blue-xs pt-7' : '') ?>"
                style=" <?= ($numPage['nowPage'] ==  $numPage['nowPage'] ? 'border: none; padding: 5px 10px; border-radius: 5px;' : 'text-decoration: none;') ?>">
                <!-- Page Numbers สุดท้าย -->
                <span
                    style="<?= ($numPage['nowPage'] == $numPage['nowPage'] ? 'color: white; font-weight: 700;' : 'color: black; font-weight: 500;') ?>">
                    <?php echo $numPage['nowPage']; ?>
                </span>
            </a>
        </div>

        <!-- มีเงื่อนไขขวานิดหนึง ว่าต้องไม่เท่ากับ 2 และ ไม่ใช่รองท้ายถึงจะโชว -->
        <?php 
        if($numPage['nowPage'] != 2 && $numPage['nowPage'] != $numPage['totalPages']-1){
        ?>
        <!-- . . .  ขวา-->
        <span class="ml-15" id="page-jump-ellipsis2" style="cursor: pointer; font-weight: 500;">...</span>
        <div class="ml-15" id="page-jump-form2" style="display: none; align-items: center; gap: 5px;">
            <form id="gotoPage2">
                <input type="text" name="pageInput2" class="form-control" required pattern="[0-9]+"
                    title="กรุณากรอกเฉพาะตัวเลข" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                    style="width: 30px; height: 35px; padding: 4px 8px; font-size: 14px; text-align: center; border: 1px solid #ccc; border-radius: 5px;">
            </form>
        </div>
        <?php 
        }
        ?>
    </div>
    <?php
                }
    ?>

    <!-- เพิ่มเติมถ้าต้องแสดง ... -->
    <?php   
                if (($numPage['nowPage'] == 1 || $numPage['nowPage'] == $numPage['totalPages']) && $numPage['totalPages'] != 2  && $numPage['totalPages'] != 3) { 
        ?>
    <!-- . . .  แสดงเมื่อเป็นหน้าแรกหรือหน้าท้าย สำหรับใส่ตรงกลาง 1 ... 4-->
    <span id="page-jump-ellipsis1" style="cursor: pointer; font-weight: 500;">...</span>
    <div id="page-jump-form" style="display: none; align-items: center; gap: 5px;">

        <form id="gotoPage">
            <input type="text" name="pageInput" class="form-control" required pattern="[0-9]+"
                title="กรุณากรอกเฉพาะตัวเลข" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                style="width: 30px; height: 35px; padding: 4px 8px; font-size: 14px; text-align: center; border: 1px solid #ccc; border-radius: 5px;">
        </form>
    </div>
    <?php
                }  
                if ($numPage['nowPage'] == 2  && $numPage['totalPages'] != 2  && $numPage['totalPages'] != 3) { 
        ?>
    <!-- . . .  แสดงเมื่อเป็น 2 และเหน้ารวมเกิน 3 เพื่อที่จะแสดงเป็น 1 2 ... 4-->
    <span id="page-jump-ellipsis1" style="cursor: pointer; font-weight: 500;">...</span>
    <div id="page-jump-form" style="display: none; align-items: center; gap: 5px;">

        <form id="gotoPage">
            <input type="text" name="pageInput" class="form-control" required pattern="[0-9]+"
                title="กรุณากรอกเฉพาะตัวเลข" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                style="width: 30px; height: 35px; padding: 4px 8px; font-size: 14px; text-align: center; border: 1px solid #ccc; border-radius: 5px;">
        </form>
    </div>
    <?php
                }
    ?>

    <div>
        <!-- Page Numbers สุดท้าย-->
        <a href="javascript:void(0);"
            onclick="  goToPageTeam(<?php echo $numPage['totalPages'] ?>, '<?php echo $page ?>',<?php echo $departmentId ?>, <?php echo $companyId ?>, <?php echo $branchId ?>)"
            class=" <?= ($numPage['nowPage'] ==  $numPage['totalPages'] ? 'btn btn-bg-blue-xs pt-7' : '') ?>"
            style=" <?= ($numPage['nowPage'] ==  $numPage['totalPages'] ? 'border: none; padding: 5px 10px; border-radius: 5px;' : 'text-decoration: none;') ?>">
            <!-- Page Numbers สุดท้าย -->
            <span
                style="<?= ($numPage['nowPage'] == $numPage['totalPages'] ? 'color: white; font-weight: 700;' : 'color: black; font-weight: 500;') ?>">
                <?php echo $numPage['totalPages']; ?>
            </span>
        </a>
    </div>


    <!-- Next Button -->
    <button type="button" class="pt-3 btn-next<?= ($numPage['nowPage'] == $numPage['totalPages'] ? '-disable' : '') ?>"
        <?= ($numPage['nowPage'] == $numPage['totalPages'] ? 'disabled' : '') ?>
        onclick="  goToPageTeam(<?php echo $numPage['nowPage'] + 1 ?>, '<?php echo $page ?>',<?php echo $departmentId ?>, <?php echo $companyId ?>, <?php echo $branchId ?> )"
        style="text-decoration: none; ">
        <!-- <button class="btn-next"> -->
        <span style="margin-right: 5px;"><?= Yii::t('app', 'Next') ?></span>
        <img src="<?= Yii::$app->homeUrl ?>image/btn-next<?= ($numPage['nowPage'] == $numPage['totalPages'] ? '-disable' : '') ?>.svg"
            style="width: 4.958px; height: 8.5px; vertical-align: middle;">
    </button>

    <?php 
    }
    ?>

    <input type="hidden" name="countryId" class="form-control"
        value="<?= isset($countryId) && !empty($countryId) ? $countryId : '' ?>">

</div>
<script>
const ellipsis = document.getElementById("page-jump-ellipsis1");
const form = document.getElementById("page-jump-form");
const pageInput = form?.querySelector('input[name="pageInput"]');

const ellipsis2 = document.getElementById("page-jump-ellipsis2");
const form2 = document.getElementById("page-jump-form2");
const pageInput2 = form2?.querySelector('input[name="pageInput2"]');

const gotoPage = document.getElementById("gotoPage");
const gotoPage2 = document.getElementById("gotoPage2");

// แสดง input เมื่อคลิก ...
if (ellipsis) {
    // alert('1');
    ellipsis.addEventListener("click", function() {
        ellipsis.style.display = "none";
        form.style.display = "inline-flex";
        pageInput.focus();
    });
}

if (ellipsis2) {
    // alert('2');
    ellipsis2.addEventListener("click", function() {
        ellipsis2.style.display = "none";
        form2.style.display = "inline-flex";
        pageInput2.focus();
    });
}

// ซ่อนเมื่อคลิกข้างนอก
document.addEventListener("click", function(event) {
    const isClickInside = form.contains(event.target) || ellipsis.contains(event.target);
    // const nextPage = pageInput?.value;
    const nextPage = gotoPage.querySelector("input[name='pageInput']").value;


    if (!isClickInside) {
        form.style.display = "none";
        ellipsis.style.display = "inline";
        if (nextPage) {
            // goToPageTeam(nextPage, '<?= $page ?>', <?php  $departmentId ?>,
            //     <?php  $companyId ?>, <?php  $branchId ?>);
            goToPageTeam(nextPage, '<?php echo $page ?>',
                <?php echo $departmentId ?>, <?php echo $companyId ?>, <?php echo $branchId ?>);
        }
    }

    const isClickInside2 = form2.contains(event.target) || ellipsis2.contains(event.target);
    // const nextPage2 = pageInput2?.value;
    const nextPage2 = gotoPage.querySelector("input[name='pageInput2']").value;

    if (!isClickInside2) {
        form2.style.display = "none";
        ellipsis2.style.display = "inline";
        if (nextPage2) {
            // goToPageTeam(nextPage2, '<?= $page ?>', <?php  $departmentId ?>,
            //     <?php  $companyId ?>, <?php  $branchId ?>);
            goToPageTeam(nextPage2, '<?php echo $page ?>',
                <?php echo $departmentId ?>, <?php echo $companyId ?>, <?php echo $branchId ?>);
        }
    }
});

// กด Esc เพื่อซ่อน
if (pageInput) {
    pageInput.addEventListener("keydown", function(e) {
        if (e.key === 'Escape') {
            form.style.display = "none";
            ellipsis.style.display = "inline";
        }
    });
}

if (pageInput2) {
    pageInput2.addEventListener("keydown", function(e) {
        if (e.key === 'Escape') {
            form2.style.display = "none";
            ellipsis2.style.display = "inline";
        }
    });
}

if (gotoPage) {
    gotoPage.addEventListener("submit", function(event) {
        event.preventDefault();
        const nextPage = pageInput?.value;
        // goToPageTeam(nextPage, '<?= $page ?>', <?php  $departmentId ?>,
        //     <?php  $companyId ?>, <?php  $branchId ?>);
        goToPageTeam(nextPage, '<?php echo $page ?>',
            <?php echo $departmentId ?>, <?php echo $companyId ?>, <?php echo $branchId ?>);
    });
}

if (gotoPage2) {
    gotoPage2.addEventListener("submit", function(event) {
        event.preventDefault();
        const nextPage2 = pageInput2?.value;
        // goToPageTeam(nextPage2, '<?= $page ?>', <?php  $departmentId ?>,
        //     <?php  $companyId ?>, <?php  $branchId ?>);
        goToPageTeam(nextPage2, '<?php echo $page ?>',
            <?php echo $departmentId ?>, <?php echo $companyId ?>, <?php echo $branchId ?>);
    });
}
</script>