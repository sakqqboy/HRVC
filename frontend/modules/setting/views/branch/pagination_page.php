<div style="width: 100%; text-align: center; display: flex; justify-content: center; align-items: center; gap: 21px;">
    <!-- ถ้ามีมากกว่า 7 แุวให้แสดง Page Numbers เริ่มจาก 1  -->
    <?php 
    // echo $countryId;
            if($numPage['totalRows'] > 7){
    ?>
    <!-- Previous Button -->
    <button type="button" class="btn-previous<?= ($numPage['nowPage'] == 1 ? '-disable' : '') ?>"
        <?= ($numPage['nowPage'] == 1 ? 'disabled' : '') ?>
        onclick="goToPageBranch(<?= $numPage['nowPage'] - 1 ?>, '<?php echo $page ?>', <?php echo $countryId; ?>)">
        <img src="<?= Yii::$app->homeUrl ?>image/btn-previous<?= ($numPage['nowPage'] == 1 ? '-disable' : '') ?>.svg"
            style="width: 4.958px; height: 8.5px; vertical-align: middle;">
        <span style="margin-left: 5px;">Previous</span>
    </button>
    <!-- Page Numbers -->
    <a href="javascript:void(0);" onclick="goToPageBranch(1, '<?php echo $page ?>', <?php echo $countryId; ?>)"
        class=" <?= ($numPage['nowPage'] == 1 ? 'btn btn-bg-blue-xs pt-7' : '') ?>"
        style=" <?= ($numPage['nowPage'] == 1 ? 'border: none; padding: 5px 10px; border-radius: 5px;' : 'text-decoration: none;') ?>">
        <!-- Page Numbers 1 และหน้าปัจจุบัน-->
        <span
            style=" <?= ($numPage['nowPage'] == 1 ? 'color: white; font-weight: 700;' : 'color: black; font-weight: 500;') ?>">1</span>
    </a>

    <?php if ($numPage['totalPages'] >= 4 && $numPage['nowPage'] ==  $numPage['totalPages'] || $numPage['nowPage'] ==  $numPage['totalPages'] - 2 || $numPage['nowPage'] == $numPage['totalPages'] - 1 && $numPage['totalPages'] >= 4) { ?>
    <span id="page-jump-ellipsis" style="cursor: pointer; font-weight: 500;">...</span>
    <div id="page-jump-form" style="display: none; align-items: center; gap: 5px;">
        <form id="gotoPage">
            <input type="text" name="pageInput" class="form-control" required pattern="[0-9]+"
                title="กรุณากรอกเฉพาะตัวเลข" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                style="width: 30px; height: 35px; padding: 4px 8px; font-size: 14px; text-align: center; border: 1px solid #ccc; border-radius: 5px;">
        </form>
    </div>
    <?php } ?>


    <?php 
            if ($numPage['nowPage'] <= 3 ) { 
                if ($numPage['totalPages'] >= 2) { 
                ?>
    <a href="javascript:void(0);" onclick="goToPageBranch(2, '<?php echo $page ?>', <?php echo $countryId; ?>)"
        class=" <?= ($numPage['nowPage'] == 2 ? 'btn btn-bg-blue-xs pt-7' : '') ?>"
        style=" <?= ($numPage['nowPage'] == 2 ? 'border: none; padding: 5px 10px; border-radius: 5px;' : 'text-decoration: none;') ?>">
        <span
            style="<?= ($numPage['nowPage'] == 2 ? 'color: white; font-weight: 700;' : 'color: black; font-weight: 500;') ?>">2</span>
    </a>
    <?php 
                } 
            if ($numPage['totalPages'] >= 3) {
            ?>
    <a href="javascript:void(0);" onclick="goToPageBranch(3, '<?php echo $page ?>', <?php echo $countryId; ?>)"
        class=" <?= ($numPage['nowPage'] == 3 ? 'btn btn-bg-blue-xs pt-7' : '') ?>"
        style=" <?= ($numPage['nowPage'] == 3 ? 'border: none; padding: 5px 10px; border-radius: 5px;' : 'text-decoration: none;') ?>">
        <span
            style="<?= ($numPage['nowPage'] == 3 ? 'color: white; font-weight: 700;' : 'color: black; font-weight: 500;') ?>">3</span>
    </a>
    <?php 
                } 
            }else if( $numPage['nowPage'] > 3 && $numPage['nowPage'] < $numPage['totalPages'] - 2) {
            ?>
    <a href="javascript:void(0);"
        onclick="goToPageBranch(<?php echo $numPage['nowPage']; ?>, '<?php echo $page ?>', <?php echo $countryId; ?>)"
        class="btn btn-bg-blue-xs pt-7" style="border: none; padding: 5px 10px; border-radius: 5px;">
        <span style="color: white; font-weight: 700;"><?php echo $numPage['nowPage']; ?></span>
    </a>
    <a href="javascript:void(0);"
        onclick="goToPageBranch(<?php echo $numPage['nowPage'] + 1 ?>, '<?php echo $page ?>', <?php echo $countryId; ?>)"
        style="text-decoration: none;">
        <span style="color: black; font-weight: 500;"><?php echo $numPage['nowPage'] + 1; ?></span>
    </a>
    <?php } ?>



    <?php if ($numPage['totalPages'] >= 4 && $numPage['nowPage'] != $numPage['totalPages'] && $numPage['nowPage'] != $numPage['totalPages'] - 2 && $numPage['nowPage'] != $numPage['totalPages'] - 1) { ?>
    <!-- <span style="color: black; font-weight: 500;">...</span> -->
    <!-- จุดที่คลิกเพื่อแสดง Textbox -->
    <span id="page-jump-ellipsis" style="cursor: pointer; font-weight: 500;">...</span>
    <div id="page-jump-form" style="display: none; align-items: center; gap: 5px;">

        <form id="gotoPage">
            <input type="text" name="pageInput" class="form-control" required pattern="[0-9]+"
                title="กรุณากรอกเฉพาะตัวเลข" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                style="width: 30px; height: 35px; padding: 4px 8px; font-size: 14px; text-align: center; border: 1px solid #ccc; border-radius: 5px;">
        </form>
    </div>
    <?php } ?>

    <!-- ถ้ามี Page Numbers มากกว่า 4 -->
    <?php if ($numPage['totalPages'] >= 4) {    
                if ($numPage['nowPage'] >= $numPage['totalPages'] - 2 ) { 
                    ?>

    <a href="javascript:void(0);"
        onclick="goToPageBranch(<?php echo $numPage['totalPages'] - 2 ?>, '<?php echo $page ?>', <?php echo $countryId; ?>)"
        class="<?= ($numPage['nowPage'] ==   $numPage['totalPages'] - 2 ? 'btn btn-bg-blue-xs pt-7' : '') ?>"
        style="<?= ($numPage['nowPage'] ==  $numPage['totalPages'] - 2 ? 'border: none; padding: 5px 10px; border-radius: 5px;' : 'text-decoration: none;') ?>">
        <span
            style="<?= ($numPage['nowPage'] == $numPage['totalPages'] - 2 ? 'color: white; font-weight: 700;' : 'color: black; font-weight: 500;') ?>">
            <?php echo $numPage['totalPages'] - 2; ?>
        </span>
    </a>

    <a href="javascript:void(0);"
        onclick="goToPageBranch(<?php echo $numPage['totalPages'] - 1 ?>, '<?php echo $page ?>', <?php echo $countryId; ?>)"
        class="<?= ($numPage['nowPage'] ==   $numPage['totalPages'] - 1 ? 'btn btn-bg-blue-xs pt-7' : '') ?>"
        style="<?= ($numPage['nowPage'] ==  $numPage['totalPages'] - 1 ? 'border: none; padding: 5px 10px; border-radius: 5px;' : 'text-decoration: none;') ?>">
        <span
            style="<?= ($numPage['nowPage'] == $numPage['totalPages'] - 1 ? 'color: white; font-weight: 700;' : 'color: black; font-weight: 500;') ?>">
            <?php echo $numPage['totalPages'] - 1; ?>
        </span>
    </a>
    <?php } ?>

    <a href="javascript:void(0);"
        onclick="goToPageBranch(<?php echo $numPage['totalPages'] ?>, '<?php echo $page ?>', <?php echo $countryId; ?>)"
        class=" <?= ($numPage['nowPage'] ==  $numPage['totalPages'] ? 'btn btn-bg-blue-xs pt-7' : '') ?>"
        style=" <?= ($numPage['nowPage'] ==  $numPage['totalPages'] ? 'border: none; padding: 5px 10px; border-radius: 5px;' : 'text-decoration: none;') ?>">
        <!-- Page Numbers สุดท้าย -->
        <span
            style="<?= ($numPage['nowPage'] == $numPage['totalPages'] ? 'color: white; font-weight: 700;' : 'color: black; font-weight: 500;') ?>">
            <?php echo $numPage['totalPages']; ?>
        </span>
    </a>
    <?php } ?>

    <!-- Next Button -->
    <button type="button" class="pt-3 btn-next<?= ($numPage['nowPage'] == $numPage['totalPages'] ? '-disable' : '') ?>"
        <?= ($numPage['nowPage'] == $numPage['totalPages'] ? 'disabled' : '') ?>
        onclick="goToPageBranch(<?php echo $numPage['nowPage'] + 1 ?>, '<?php echo $page ?>', <?php echo $countryId; ?>)"
        style="text-decoration: none; ">
        <!-- <button class="btn-next"> -->
        <span style="margin-right: 5px;">Next</span>
        <img src="<?= Yii::$app->homeUrl ?>image/btn-next<?= ($numPage['nowPage'] == $numPage['totalPages'] ? '-disable' : '') ?>.svg"
            style="width: 4.958px; height: 8.5px; vertical-align: middle;">
    </button>
    <?php }?>
    <input type="hidden" name="countryId" class="form-control"
        value="<?= isset($countryId) && !empty($countryId) ? $countryId : '' ?>">
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const ellipsis = document.getElementById("page-jump-ellipsis");
    const form = document.getElementById("page-jump-form");
    const pageInput = form.querySelector('input[name="pageInput"]');

    // แสดง input เมื่อคลิก ...
    ellipsis.addEventListener("click", function() {
        ellipsis.style.display = "none";
        form.style.display = "inline-flex";
        pageInput.focus();
    });

    // ซ่อนเมื่อคลิกข้างนอก
    document.addEventListener("click", function(event) {
        const isClickInside = form.contains(event.target) || ellipsis.contains(event.target);
        const nextPage = gotoPage.querySelector("input[name='pageInput']").value;

        if (!isClickInside) {
            form.style.display = "none";
            ellipsis.style.display = "inline";

            if (nextPage) {
                goToPageBranch(nextPage, '<?php echo $page ?>', <?php echo $countryId; ?>);
            }
        }

    });

    // กด Esc เพื่อกลับไปเป็น ...
    pageInput.addEventListener("keydown", function(e) {
        if (e.key === 'Escape') {
            form.style.display = "none";
            ellipsis.style.display = "inline";
        }
    });

    const gotoPage = document.getElementById("gotoPage");

    gotoPage.addEventListener("submit", function(event) {
        event.preventDefault(); // ป้องกันการ submit จริง
        const nextPage = gotoPage.querySelector("input[name='pageInput']").value;
        goToPageBranch(nextPage, '<?php echo $page ?>', <?php echo $countryId; ?>);
    });
});
</script>