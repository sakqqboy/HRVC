<div class="gap-4" style="width: 100%; text-align: center; display: flex; justify-content: center; align-items: center;">
    <!-- ถ้ามีมากกว่า 7 แุวให้แสดง Page Numbers เริ่มจาก 1  -->
    <?php

    use common\models\ModelMaster;
    use yii\web\View;

    $urlArr = ModelMaster::urlArr();

    $url = Yii::$app->homeUrl . $urlArr["module"] . '/' . $urlArr["controller"] . '/' . $urlArr["action"];

    if ($totalPage > 1) {
        if (isset($filter) && !empty($filter)) {
            $PreviousPage = ModelMaster::encodeParams([
                "companyId" => $filter["companyId"],
                "branchId" => $filter["branchId"],
                "departmentId" => $filter["departmentId"],
                "teamId" => $filter["teamId"],
                "currentPage" => $currentPage - 1,
                "status" => $filter["status"],
                "pageType" => $pageType
            ]);
            $nextPage = ModelMaster::encodeParams([
                "companyId" => $filter["companyId"],
                "branchId" => $filter["branchId"],
                "departmentId" => $filter["departmentId"],
                "teamId" => $filter["teamId"],
                "currentPage" => $currentPage + 1,
                "status" => $filter["status"],
                "pageType" => $pageType
            ]);
        } else {
            $PreviousPage = "page" . ($currentPage - 1);
            $nextPage = "page" . ($currentPage + 1);
        }
    ?>
        <a href="<?= $url ?>/<?= $PreviousPage ?>"
            class="btn-previous<?= ($currentPage == 1 ? '-disable' : '') ?> text-center align-content-center"
            onclick="<?= $currentPage == 1 ? 'return false;' : '' ?>" style="text-decoration: none;<?= $currentPage == 1 ? 'pointer-events:none;' : '' ?>">
            <img src="<?= Yii::$app->homeUrl ?>image/btn-previous<?= ($currentPage == 1 ? '-disable' : '') ?>.svg" style="width: 4.958px; height: 8.5px;">
            <span style="margin-left: 5px;"><?= Yii::t('app', 'Previous') ?></span>
        </a>
        <?php

        $i = 1;
        $dot = 0;
        foreach ($pagination as $page) {
            if (isset($filter) && !empty($filter)) {
                $directPage = ModelMaster::encodeParams([
                    "companyId" => $filter["companyId"],
                    "branchId" => $filter["branchId"],
                    "departmentId" => $filter["departmentId"],
                    "teamId" => $filter["teamId"],
                    "currentPage" => $page,
                    "status" => $filter["status"],
                    "pageType" => $pageType
                ]);
            } else {
                $directPage = "page" . $page;
            }
            if ($page === '...') {

        ?>
                <span id="page-jump-ellipsis" style="cursor: pointer; font-weight: 500;" onclick="javascrip:showInputPage()">...</span>
                <div id="page-jump-form" style="display: none; align-items: center; gap: 5px;">
                    <form id="gotoPage">
                        <input type="text" name="pageInput" class="form-control" required pattern="[0-9]+" id="input-page"
                            title="only number" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                            style="width: 30px; height: 35px; padding: 4px 8px; font-size: 14px; text-align: center; border: 1px solid #ccc; border-radius: 5px;">
                    </form>
                </div>
            <?php
            } else { ?>
                <a href="<?= ($currentPage == $page ? 'javascript:void(0);' : $url . '/' . $directPage) ?>"
                    class="<?= ($currentPage == $page ? 'btn btn-bg-blue-xs' : '') ?> font-size-12 pt-0 pb-0 align-content-center"
                    style=" <?= ($currentPage == $page ? 'border: none; border-radius: 4px;width:26px;height:26px;' : 'text-decoration: none;') ?>">
                    <span style=" <?= ($currentPage == $page ? 'color: white; font-weight: 700;' : 'color: black; font-weight: 400;') ?>"><?= $page ?></span>
                </a>
        <?php
            }
        }

        ?>
        <a href="<?= $url ?>/<?= $nextPage ?>"
            class="btn-previous<?= ($currentPage == $totalPage ? '-disable' : '') ?>  text-center align-content-center"
            <?= ($currentPage == $totalPage ? 'disabled' : '') ?>
            onclick="<?= $currentPage == $totalPage ? 'return false;' : '' ?>"
            style="text-decoration: none;<?= $currentPage == $totalPage ? 'pointer-events:none;' : '' ?>">
            <!-- <button class="btn-next"> -->
            <span style="margin-right: 5px;"><?= Yii::t('app', 'Next') ?></span>
            <img src="<?= Yii::$app->homeUrl ?>image/btn-next<?= ($currentPage == $totalPage ? '-disable' : '') ?>.svg"
                style="width: 4.958px; height: 8.5px;">
        </a>

    <?php } ?>
    <input type="hidden" id="totalPages" value="<?= $totalPage ?>">
    <input type="hidden" id="targetPage" value="<?= $url ?>/page">
    <input type="hidden" id="filter" value="<?= empty($filter) ? 0 : "1" ?>">
    <?php
    if (isset($filter) && !empty($filter)) {
    ?>
        <input type="hidden" id="companyId" value="<?= $filter["companyId"] ?>">
        <input type="hidden" id="branchId" value="<?= $filter["branchId"] ?>">
        <input type="hidden" id="departmentId" value="<?= $filter["departmentId"] ?>">
        <input type="hidden" id="teamId" value="<?= $filter["teamId"] ?>">
        <input type="hidden" id="status" value="<?= $filter["status"] ?>">
    <?php
    }
    ?>
    <input type="hidden" id="currentPage" value="<?= $currentPage ?>">
    <input type="hidden" id="pageType" value="<?= $pageType ?>">
    <input type="hidden" id="thisModule" value="<?= $urlArr["module"] ?>">
    <input type="hidden" id="thisController" value="<?= $urlArr["controller"] ?>">
    <input type="hidden" id="thisAction" value="<?= $urlArr["action"] ?>">
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

        //const gotoPage = document.getElementById("gotoPage");

        // gotoPage.addEventListener("submit", function(event) {
        //     event.preventDefault(); // ป้องกันการ submit จริง
        //     const nextPage = gotoPage.querySelector("input[name='pageInput']").value;
        //     goToPageBranch(nextPage);
        // });
    });
</script>
<?php
$this->registerJs('
function showInputPage(){
$("#page-jump-ellipsis").css("display","none");
$("#page-jump-form").css("display","inline-flex");
            $("#input-page").focus();
}
            

$("#gotoPage").on("submit", function(e) {
        e.preventDefault(); //  ป้องกันไม่ให้ฟอร์ม submit จริง (ถ้าต้องการ)
        var totalPage = $("#totalPage").val();
        var inputPage = $("#input-page").val();

        if (inputPage > totalPage) {
            alert("Entered the wrong number");
            e.preventDefault();
        } else {
            var hasFilter = $("#filter").val();
            if (hasFilter == 0) {
                var targetPage = $("#targetPage").val() + inputPage;
                window.location.href = targetPage;
            } else {

                var $baseUrl = window.location.protocol + "/ / " + window.location.host;
                if (window.location.host == "localhost") {
                    $baseUrl = window.location.protocol + "//" + window.location.host + "/HRVC/frontend/web/";
                } else {
                    $baseUrl = window.location.protocol + "//" + window.location.host + "/";
                }
                $url = $baseUrl;
                var url = $url + "setting/employee/encode-filter";
                var companyId = $("#companyId").val();
                var branchId = $("#branchId").val();
                var departmentId = $("#departmentId").val();
                var teamId = $("#teamId").val();
                var status = $("#status").val();
                var currentPage = $("#currentPage").val();
                var pageType = $("#pageType").val();
                var thisModule = $("#thisModule").val();
                var thisController = $("#thisController").val();
                var thisAction = $("#thisAction").val();
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: url,
                    data: {
                        companyId: companyId,
                        branchId: branchId,
                        departmentId: departmentId,
                        teamId: teamId,
                        status: status,
                        currentPage: inputPage,
                        pageType: pageType,
                        module: thisModule,
                        controller: thisController,
                        action: thisAction
                    },
                    success: function(data) {
                        window.location.href = data.newUrl;
                    },
                });
            }
        }
    });
', View::POS_END);
?>