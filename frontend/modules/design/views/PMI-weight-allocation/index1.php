 <div class="col-lg-10 col-md-6 col-12">
     <div class="aler-ALLDepartment">
         <div class="row">
             <div class="col-3">
                 <div class="FrameEvaluation"> PMI Weight Allocation</div>
             </div>
             <div class="col-2">
                 <div type="submit" class="PMI1"> Allocate Weight</div>
             </div>
             <div class="col-7 text-end">
                 <div type="submit" class="btn btn-info Next-1 pt-4 pb-4"> Next <i class="fa fa-angle-double-right" aria-hidden="true"></i></div>
             </div>
         </div>
         <div class="col-12 andAccounts">
             Accounts & Taxation
         </div>
         <div class="row">
             <div class="col-lg-1 col-md-6 col-12">
                 <div class="Evalua_tor1 pb-33">
                     <div class="col-12 text_PIM">
                         PIM
                     </div>
                     <div class="col-12 mt-5">
                         <div id="progress1">
                             <div data-num="85" class="progress-item1" data-value="85%" style="background: conic-gradient(rgb(41, 140, 233) calc(35%), rgb(219, 239, 247) 0deg);">85%</div>
                         </div>
                     </div>
                     <div class="white-kfi3 ml-5 mr-5">
                         <div class="col-12 pt-30">
                             <div class="form-check pl-35">
                                 <input class="form-check-input" type="checkbox" value="" id="">
                             </div>
                         </div>
                         <div class="col-12">
                             <div class="bg-chartpurple">
                                 <img src="<?= Yii::$app->homeUrl ?>images/icons/Light/Light/48px/Charts.png" class="icons-KGI">
                                 <div class="font-size-10 text-white font-b"> KFI</div>
                                 <div class="font-size-10 text-white font-b">20%</div>
                             </div>
                         </div>
                         <div class="col-12 mt-30">
                             <div class="form-check pl-35">
                                 <input class="form-check-input" type="checkbox" value="" id="">
                             </div>
                         </div>
                         <div class="col-12">
                             <div class="bg-chartwarn">
                                 <img src="<?= Yii::$app->homeUrl ?>images/icons/Light/Light/48px/KGI.png" class="icons-KGI">
                                 <div class="font-size-10 text-white font-b"> KGI</div>
                                 <div class="font-size-10 text-white font-b">20%</div>
                             </div>
                         </div>
                         <div class="col-12 mt-30">
                             <div class="form-check pl-35">
                                 <input class="form-check-input" type="checkbox" value="" id="">
                             </div>
                         </div>
                         <div class="col-12">
                             <div class="bg-cha">
                                 <img src="<?= Yii::$app->homeUrl ?>images/icons/Light/Light/48px/KPI.png" class="icons-KGI">
                                 <div class="font-size-10 text-white font-b"> KPI</div>
                                 <div class="font-size-10 text-white font-b">20%</div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="col-lg-9 col-md-6 col-12">
                 <div class="Evalua_tor2 silly_scrollbar">
                     <div class="silly_evaluator">
                         <div class="row pl-15 pr-15 pt-15 pb-15">
                             <div class="col-7 flagkey">
                                 <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/24px/KGI.png" class="icons-KGI2"> Key Goal Indicator
                             </div>
                             <div class="col-3 text-end">
                                 <div class="col-12 flagkey">
                                     Participants
                                 </div>
                             </div>
                             <div class="col-2 text-end">
                                 <span class="badge rounded-pill bg-gray pt-2 pb-2">
                                     <ul class="try-cricle">
                                         <li class="tri-li"> <img src="<?= Yii::$app->homeUrl ?>image/avatar1.png" class="image-avatar1"></li>
                                         <li class="tri-li"> <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="image-avatar2"></li>
                                         <a href="" class="">
                                             <li class="number_user"> 99 </li>
                                         </a>
                                     </ul>
                                 </span>
                             </div>
                             <hr>
                         </div>

                         <div class="row pl-15 pr-15 pb-30">

                             <?php
                                for ($i = 1; $i <= 12; $i++) {
                                ?>

                                 <div class="col-lg-2">
                                     <div class="card font-size-12" style="height: 85px;">
                                         <div class="card-header fonTotal">Total Sales</div>

                                         <div class="col-12 text-center">
                                             <span class="badge bg-lighttotal">
                                                 <?= number_format(595558) ?>k
                                             </span>
                                         </div>
                                         <div class="col-12 text-center pt-10 Blueformat">
                                             <?= number_format(23) ?>%
                                         </div>
                                     </div>
                                 </div>

                             <?php
                                }
                                ?>
                             <div class="holder"></div>
                         </div>
                     </div>
                     <div class="silly_evaluator mt-20">
                         <div class="row pl-15 pr-15 pt-15 pb-15">
                             <div class="col-7 flagkey">
                                 <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/24px/KPI.png" class="icons-KGI2"> Key Performance Indicator
                             </div>
                             <div class="col-3 text-end">
                                 <div class="col-12 flagkey">
                                     Participants
                                 </div>
                             </div>
                             <div class="col-2 text-end">
                                 <span class="badge rounded-pill bg-gray pt-2 pb-2">
                                     <ul class="try-cricle">
                                         <li class="tri-li"> <img src="<?= Yii::$app->homeUrl ?>image/avatar1.png" class="image-avatar1"></li>
                                         <li class="tri-li"> <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="image-avatar2"></li>
                                         <a href="" class="none">
                                             <li class="number_user"> 2 </li>
                                         </a>
                                     </ul>
                                 </span>
                             </div>
                             <hr>
                         </div>
                         <div class="row pl-15 pr-15 pb-30">

                             <?php
                                for ($i = 1; $i <= 12; $i++) {

                                ?>

                                 <div class="col-lg-2">
                                     <div class="card font-size-12" style="height: 85px;">
                                         <div class="card-header fonTotal">Total Sales</div>

                                         <div class="col-12 text-center">
                                             <span class="badge bg-lighttotal">
                                                 <?= number_format(595558) ?>k
                                             </span>
                                         </div>
                                         <div class="col-12 text-center pt-10 Blueformat">
                                             <?= number_format(23) ?>%
                                         </div>
                                     </div>
                                 </div>


                             <?php
                                }
                                ?>
                             <div class="holder"></div>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="col-lg-2 col-md-6 col-12">
                 <div class="col-12 txt-Weight">
                     <img src="<?= Yii::$app->homeUrl ?>image/weight.png" class="image-weight"> Weight Configurations
                 </div>
                 <div class="col-12 Evalua_tor3 mt-5">
                     <div class="col-12 background_E7F0FE pt-10 pl-4 pr-4 pb-20">
                         <?php
                            for ($i = 1; $i <= 13; $i++) {
                            ?>

                             <div class="bg-white mt-10 pr-3 pl-3" style="border-radius: 2px;">
                                 <div class="row">
                                     <div class="col-7 border-edit">
                                         Internal
                                     </div>
                                     <div class="col-5">
                                         <i class="fa fa-pencil-square-o weight-pencil" aria-hidden="true"></i> <i class="fa fa-trash weight-trash" aria-hidden="true"></i>
                                     </div>

                                 </div>
                             </div>

                         <?php
                            }
                            ?>

                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>