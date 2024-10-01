<?php

use common\models\ModelMaster;
use frontend\models\hrvc\User;
?>
div.
<div class="col-12 bg-white text-end header-top">
    <!-- <div class="col-lg-6 col-md-6 col-12 mt-5">
        <div class="input-group">
            <input type="search" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
            <button type="button" class="btn btn-outline-dark"><i class="fa fa-filter" aria-hidden="true"></i></button>
        </div>
    </div> -->
    <div class="row">
        <div class="col-10"> </div>
        <div class="col-2">
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="<?= Yii::$app->homeUrl ?><?= isset(Yii::$app->user->id) ? User::userHeaderImage() : 'image/user.png' ?>" class="width-ehsan-small mr-10">
                    <strong class="font-size-12"> <?= isset(Yii::$app->user->id) ? User::userHeaderName() : 'Login' ?></strong>
                </a>
                <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                    <?php
                    if (isset(Yii::$app->user->id)) {
                        $employeeId = User::employeeIdFromUserId(); ?>
                        <li><a href="<?= Yii::$app->homeUrl ?>setting/employee/employee-profile/<?= ModelMaster::encodeParams(["employeeId" => $employeeId]) ?>" class="dropdown-item">
                                <i class="fa fa-user" aria-hidden="true"></i> My Profile</a></li>
                    <?php
                    }
                    ?>

                    <li><a class="dropdown-item" href="#"><i class="fa fa-cog" aria-hidden="true"></i> Settings</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fa fa-info-circle" aria-hidden="true"></i> Help & Support</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="<?= Yii::$app->homeUrl ?>site/logout"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- <div class="col-lg-2 col-2 text-end">
        <div class="dropdown">
            <button type="button" class="btn btn-outline-dark  position-relative font-size-12 mt-10" id="dropdownUser3" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-bell" aria-hidden="true"></i>
                <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                    <ul class="dropdown-menu text-small shadow box-list-group" aria-labelledby="dropdownUser3">
                        <div class="list-group">
                            <a href="#" class="list-group-item list-group-item-action">A simple primary list group item
                                <span class="badge bg-danger rounded-pill">1</span>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">A simple primary list group item
                                <span class="badge bg-danger rounded-pill">1</span>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">A simple primary list group item
                                <span class="badge bg-danger rounded-pill">1</span>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">A simple primary list group item
                                <span class="badge bg-danger rounded-pill">1</span>
                            </a>
                        </div>
                    </ul>
                </span>
            </button>
        </div>
    </div> -->
</div>