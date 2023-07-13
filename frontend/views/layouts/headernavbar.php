<div class="col-12" id="index1">
    <div class="row">
        <nav class="navbar navbar-light bg-white">
            <div class="col-lg-5 col-md-12 col-12">
                <div class="input-group">
                    <input type="search" class="form-control rounded" style="margin-left:20px;" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                    <span class="input-group-text border-0" id="search-addon"> <i class="fa fa-search" aria-hidden="true"></i> </span>
                    <div class="col-2 pl-10">
                        <button type="button" class="btn btn-outline-dark bnheader"> <i class="fa fa-filter fit" aria-hidden="true"></i></button>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-md-12 col-12 navbar-button">
                <div class="col-12 dropdown">
                    <span class="Googday"> Good Day!! &nbsp;</span>
                    <span class="name" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false"> Quazi Ehsan Hossain
                        <img src="<?= Yii::$app->homeUrl ?>image/ehsan-small.png" class="width-ehsan-small">
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu2" style="margin-left: 100px;">
                            <li> <button class="dropdown-item" type="button"><i class="fa fa-user" aria-hidden="true"></i> Profile</button></li>
                            <li><button class="dropdown-item" type="button"><i class="fa fa-cog" aria-hidden="true"></i> Setting &privacy</button></li>
                            <li><button class="dropdown-item" type="button"><i class="fa fa-info-circle" aria-hidden="true"></i> Help & Support</button></li>
                            <li><button class="dropdown-item" type="button"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</button></li>
                        </ul>
                    </span>
                    <button type="button" class="btn btn-outline-dark bnheader position-relative"> <i class="fa fa-bell" aria-hidden="true"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            12+
                        </span>
                    </button>
                </div>
            </div>
        </nav>
    </div>
</div>