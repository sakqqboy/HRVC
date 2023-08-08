<?php
$this->title = 'template dashboard';
?>

<div class="col-12" style="margin-top: 90px;">
    <div class="row">
        <div class="col-lg-10 col-md-6 col-6 page-Questions">
            Questions Dashboard
        </div>
        <div class="col-lg-2 col-md-6 col-6">
            <div class="btn-group dropup">
                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    Select QS
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="<?= Yii::$app->homeUrl ?>site/master-dashboard">Master QS Dashboard</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="<?= Yii::$app->homeUrl ?>site/template-dashboard">Template Dashboard</a></li>
                </ul>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-5 col-md-6 col-4">
                <div class="col-12 Dashboard-Master">
                    Template Dashboard
                </div>
            </div>
            <div class="col-lg-5 col-md-6 col-4">
                <button type="button" class="btn btn-primary">
                    <a href="<?= Yii::$app->homeUrl ?>site/template-maker" class="line-text"><i class="fa fa-plus-circle" aria-hidden="true"></i> Create QT </a>
                </button>
            </div>
            <div class="col-lg-2 col-md-6 col-4">
                <div class="btn-group dropup">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        Scale Method
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Rating</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Ranking</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="alert alert1-info1 mt-30">
            <div class="row">
                <div class="col-lg-12 col-md-6 col-12">
                    <div class="alert white-bb">
                        <div class="row mt-20">
                            <div class="col-1 mt-10">
                                1
                            </div>
                            <div class="col-3 fon-bold">
                                Accounts Department
                                <p class="september-bold"> 3 September 2023</p>
                            </div>
                            <div class="col-4">
                                In this evaluation, we will analyze the individual's communication skills across various categories.
                            </div>
                            <div class="col-2">
                                Associate MQS: 2
                            </div>
                            <div class="col-2 icon-big">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-6 col-12">
                    <div class="alert white-bb">
                        <div class="row mt-20">
                            <div class="col-1 mt-10">
                                2
                            </div>
                            <div class="col-3 fon-bold">
                                DFG Team
                                <p class="september-bold"> 3 September 2023</p>
                            </div>
                            <div class="col-4">
                                In this evaluation, we will analyze the individual's communication skills across various categories.
                            </div>
                            <div class="col-2">
                                Associate MQS: 2
                            </div>
                            <div class="col-2 icon-big">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>