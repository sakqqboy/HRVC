<div style="width: 100%; text-align: center; display: flex; justify-content: center; align-items: center; gap: 21px;">
    <?php if ($numPage['totalRows'] > 7): ?>
    <!-- Previous Button -->
    <button type="button" class="btn-previous<?= ($numPage['nowPage'] == 1 ? '-disable' : '') ?>"
        <?= ($numPage['nowPage'] == 1 ? 'disabled' : '') ?> onclick="goToPage(<?= $numPage['nowPage'] - 1 ?>)">
        <img src="<?= Yii::$app->homeUrl ?>image/btn-previous<?= ($numPage['nowPage'] == 1 ? '-disable' : '') ?>.svg"
            style="width: 4.958px; height: 8.5px; vertical-align: middle;">
        <span style="margin-left: 5px;">Previous</span>
    </button>

    <!-- Always Show Page 1 -->
    <a href="javascript:void(0);" onclick="goToPage(1)"
        class="<?= ($numPage['nowPage'] == 1 ? 'btn btn-bg-blue-xs pt-7' : '') ?>"
        style="<?= ($numPage['nowPage'] == 1 ? 'border: none; padding: 5px 10px; border-radius: 5px;' : 'text-decoration: none;') ?>">
        <span
            style="<?= ($numPage['nowPage'] == 1 ? 'color: white; font-weight: 700;' : 'color: black; font-weight: 500;') ?>">1</span>
    </a>

    <?php
        $startPage = max(2, $numPage['nowPage'] - 1);
        $endPage = min($numPage['totalPages'] - 1, $numPage['nowPage'] + 1);

        if ($startPage > 2) {
            echo '<span id="page-jump-ellipsis" style="cursor: pointer; font-weight: 500;">...</span>';
            echo '<div id="page-jump-form" style="display: none; align-items: center; gap: 5px;">
                <form id="gotoPage">
                    <input type="text" name="pageInput" class="form-control" required pattern="[0-9]+"
                        title="กรุณากรอกเฉพาะตัวเลข" oninput="this.value = this.value.replace(/[^0-9]/g, \'\')"
                        style="width: 30px; height: 35px; padding: 4px 8px; font-size: 14px; text-align: center; border: 1px solid #ccc; border-radius: 5px;">
                </form>
            </div>';
        }

        for ($i = $startPage; $i <= $endPage; $i++) {
            echo '<a href="javascript:void(0);" onclick="goToPage(' . $i . ')" 
                class="' . ($numPage['nowPage'] == $i ? 'btn btn-bg-blue-xs pt-7' : '') . '"
                style="' . ($numPage['nowPage'] == $i ? 'border: none; padding: 5px 10px; border-radius: 5px;' : 'text-decoration: none;') . '">
                <span style="' . ($numPage['nowPage'] == $i ? 'color: white; font-weight: 700;' : 'color: black; font-weight: 500;') . '">' . $i . '</span>
            </a>';
        }

        if ($endPage < $numPage['totalPages'] - 1) {
            echo '<span id="page-jump-ellipsis" style="cursor: pointer; font-weight: 500;">...</span>';
            echo '<div id="page-jump-form" style="display: none; align-items: center; gap: 5px;">
                <form id="gotoPage">
                    <input type="text" name="pageInput" class="form-control" required pattern="[0-9]+"
                        title="กรุณากรอกเฉพาะตัวเลข" oninput="this.value = this.value.replace(/[^0-9]/g, \'\')"
                        style="width: 30px; height: 35px; padding: 4px 8px; font-size: 14px; text-align: center; border: 1px solid #ccc; border-radius: 5px;">
                </form>
            </div>';
        }

        // Last Page
        if ($numPage['totalPages'] > 1) {
            echo '<a href="javascript:void(0);" onclick="goToPage(' . $numPage['totalPages'] . ')" 
                class="' . ($numPage['nowPage'] == $numPage['totalPages'] ? 'btn btn-bg-blue-xs pt-7' : '') . '"
                style="' . ($numPage['nowPage'] == $numPage['totalPages'] ? 'border: none; padding: 5px 10px; border-radius: 5px;' : 'text-decoration: none;') . '">
                <span style="' . ($numPage['nowPage'] == $numPage['totalPages'] ? 'color: white; font-weight: 700;' : 'color: black; font-weight: 500;') . '">' . $numPage['totalPages'] . '</span>
            </a>';
        }
        ?>

    <!-- Next Button -->
    <button type="button" class="pt-3 btn-next<?= ($numPage['nowPage'] == $numPage['totalPages'] ? '-disable' : '') ?>"
        <?= ($numPage['nowPage'] == $numPage['totalPages'] ? 'disabled' : '') ?>
        onclick="goToPage(<?= $numPage['nowPage'] + 1 ?>)">
        <span style="margin-right: 5px;">Next</span>
        <img src="<?= Yii::$app->homeUrl ?>image/btn-next<?= ($numPage['nowPage'] == $numPage['totalPages'] ? '-disable' : '') ?>.svg"
            style="width: 4.958px; height: 8.5px; vertical-align: middle;">
    </button>
    <?php endif; ?>

    <!-- Hidden input for AJAX -->
    <input type="hidden" name="countryId" class="form-control"
        value="<?= isset($countryId) && !empty($countryId) ? $countryId : '' ?>">
</div>

</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll("#page-jump-ellipsis").forEach(ellipsis => {
        ellipsis.addEventListener("click", function() {
            const form = this.nextElementSibling;
            ellipsis.style.display = "none";
            form.style.display = "inline-flex";
            form.querySelector("input").focus();
        });
    });

    document.addEventListener("click", function(event) {
        document.querySelectorAll("#page-jump-form").forEach(form => {
            const ellipsis = form.previousElementSibling;
            if (!form.contains(event.target) && !ellipsis.contains(event.target)) {
                form.style.display = "none";
                ellipsis.style.display = "inline";

                const input = form.querySelector("input");
                const value = input.value.trim();
                if (value !== '' && !isNaN(value)) {
                    goToPage(Number(value));
                    input.value = '';
                }
            }
        });
    });
});

function goToPage(nextPage) {
    event.preventDefault();
    // alert(nextPage);
    const countryId = document.querySelector('input[name="countryId"]').value;
    // alert(countryId);
    const page = '<?php echo $page ?>';
    // alert(page);

    var url = $url + 'setting/company/encode-params-page';
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: {
            countryId: countryId,
            page: page,
            nextPage: nextPage
        },
        success: function(data) {
            // window.location.href = "company-grid-filter/" + data.url;
            alert(data);
        },
        error: function(xhr, status, error) {
            console.error("AJAX request failed: " + error);
        }
    });
}
</script>