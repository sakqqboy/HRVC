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
        <!-- body modal -->
        <!-- name logo -->
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
                <!-- กดENTER แล้วเชฟเลยจากนั้นเอาไปโชวทันที และนับจำนวนใหม่ -->
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Write department name">
                    <span class="input-group-text" style="background-color: #ffff; border-left: none;">
                        <div class="city-crad-company">
                            <img src="<?= Yii::$app->homeUrl . 'image/enter.svg' ?>" style="width: 24px; height: 24px;">
                            Enter to Save
                        </div>
                    </span>
                </div>
            </div>
            <div class="row d-flex align-items-center gap-2 mb-3 mt-30" style="gap: 30px;">
                <span class="mb-14 font-size-16 " style=" font-weight: 600; padding: 0;">
                    <!-- นับจำนวน -->
                    Existing Departments (0)
                    <hr class="hr-group">
                </span>
                <div class="create-crad-company " style="background-color: #F9F9F9;">
                    <!-- ถ้ามีให้แสดงผล -->

                    <!-- ถ้าไม่มี Departments ให้แสดงเป็น 0 -->
                    <span class="text-create-crad">
                        No Existing Departments Yet!
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div>
        <!-- footer modal -->
    </div>