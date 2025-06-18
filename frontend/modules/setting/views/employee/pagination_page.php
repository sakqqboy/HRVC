<div style="width: 100%; text-align: center; display: flex; justify-content: center; align-items: center; gap: 21px;">
    <!-- ถ้ามีมากกว่า 7 แุวให้แสดง Page Numbers เริ่มจาก 1  -->
    <?php

    use yii\web\View;

    if ($totalPage > 1) {
    ?>
        <button type="button" class="btn-previous<?= ($currentPage == 1 ? '-disable' : '') ?>"
            <?= ($currentPage == 1 ? 'disabled' : '') ?>
            onclick="employeePage(<?= $currentPage - 1 ?>)">
            <img src="<?= Yii::$app->homeUrl ?>image/btn-previous<?= ($currentPage == 1 ? '-disable' : '') ?>.svg"
                style="width: 4.958px; height: 8.5px; vertical-align: middle;">
            <span style="margin-left: 5px;"><?= Yii::t('app', 'Previous') ?></span>
        </button>
        <?php
        $i = 1;
        $dot = 0;
        while ($i <= $totalPage) {
            if ($i <= 3) {
        ?>
                <a href="<?= Yii::$app->homeUrl ?>setting/employee/index/page<?= $i ?>"
                    class=" <?= ($currentPage == $i ? 'btn btn-bg-blue-xs pt-7' : '') ?>"
                    style=" <?= ($currentPage == $i ? 'border: none; padding: 5px 10px; border-radius: 5px;' : 'text-decoration: none;') ?>">
                    <span style=" <?= ($currentPage == $i ? 'color: white; font-weight: 700;' : 'color: black; font-weight: 500;') ?>"><?= $i ?></span>
                </a>
            <?php
            }
            if ($i >= 3 && $dot == 0) {
            ?>
                <span id="page-jump-ellipsis" style="cursor: pointer; font-weight: 500;" onclick="javascrip:showInputPage()">...</span>
                <div id="page-jump-form" style="display: none; align-items: center; gap: 5px;">
                    <form id="gotoPage">
                        <input type="text" name="pageInput" class="form-control" required pattern="[0-9]+" id="input-page"
                            title="only number" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                            style="width: 30px; height: 35px; padding: 4px 8px; font-size: 14px; text-align: center; border: 1px solid #ccc; border-radius: 5px;">
                    </form>
                </div>
                <a href="javascript:void(0);"
                    onclick="goToPageBranch(<?php echo $totalPage ?>)"
                    class=" <?= ($currentPage ==  $totalPage ? 'btn btn-bg-blue-xs pt-7' : '') ?>"
                    style=" <?= ($currentPage ==  $totalPage ? 'border: none; padding: 5px 10px; border-radius: 5px;' : 'text-decoration: none;') ?>">
                    <!-- Page Numbers สุดท้าย -->
                    <span
                        style="<?= ($currentPage == $totalPage ? 'color: white; font-weight: 700;' : 'color: black; font-weight: 500;') ?>">
                        <?php echo $totalPage; ?>
                    </span>
                </a>
                <button type="button" class="pt-3 btn-next<?= ($currentPage == $totalPage ? '-disable' : '') ?>"
                    <?= ($currentPage == $totalPage ? 'disabled' : '') ?>
                    onclick="goToPageBranch(<?= $currentPage + 1 ?>)"
                    style="text-decoration: none; ">
                    <!-- <button class="btn-next"> -->
                    <span style="margin-right: 5px;"><?= Yii::t('app', 'Next') ?></span>
                    <img src="<?= Yii::$app->homeUrl ?>image/btn-next<?= ($currentPage == $totalPage ? '-disable' : '') ?>.svg"
                        style="width: 4.958px; height: 8.5px; vertical-align: middle;">
                </button>
        <?php
                $dot = 1;
                break;
            }
            $i++;
        }
        ?>


    <?php } ?>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ellipsis = document.getElementById("page-jump-ellipsis");
        const form = document.getElementById("page-jump-form");
        const pageInput = form.querySelector('input[name="pageInput"]');

        // แสดง input เมื่อคลิก ...
        // ellipsis.addEventListener("click", function() {
        //     ellipsis.style.display = "none";
        //     form.style.display = "inline-flex";
        //     pageInput.focus();
        // });

        // ซ่อนเมื่อคลิกข้างนอก
        document.addEventListener("click", function(event) {
            const isClickInside = form.contains(event.target) || ellipsis.contains(event.target);
            const nextPage = gotoPage.querySelector("input[name='pageInput']").value;

            if (!isClickInside) {
                form.style.display = "none";
                ellipsis.style.display = "inline";

                if (nextPage) {
                    goToPageBranch(nextPage);
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
            goToPageBranch(nextPage);
        });
    });
</script>
<?php
$this->registerJs('
function showInputPage(){
$("#page-jump-ellipsis").css("display","none");
$("#page-jump-form").css("display","inline-flex");
            $("#input-page").focus();
}

', View::POS_END);
?>