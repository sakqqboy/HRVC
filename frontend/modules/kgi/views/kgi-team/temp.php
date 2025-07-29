<div class="col-12 mt-10 mb-5 pim-big-box pim-<?= $colorFormat ?> d-none" id="kgi-team-<?= $kgiTeamId ?>">
	<div class="row">
		<div class="col-lg-3 col-md-5 col-12 pim-name pr-0">
			<?= $kgi["kgiName"] ?>
		</div>
		<div class="col-lg-1 col-md-2 col-4 text-center">
			<div class="<?= $colorFormat ?>-tag text-center">
				<?php
				if ($kgi['nextCheckDate'] == "") { ?>
					<?= Yii::t('app', 'Not set') ?>
				<?php
				} else { ?>
					<?= $statusText ?>
				<?php
				}
				?>
			</div>
		</div>
		<div class=" col-lg-3 col-md-3 col-4 pl-30">
			<div class="row">
				<div class="col-4 month-<?= $colorFormat ?>">
					<?= $kgi['month'] == "" ?  Yii::t('app', 'Month') :  Yii::t('app', $kgi['month']) ?>
				</div>
				<div class="col-8 term-<?= $colorFormat ?>">
					<?= $kgi['fromDate'] == "" ?  Yii::t('app', 'Not set') : $kgi['fromDate'] ?> -
					<?= $kgi['toDate'] == "" ?  Yii::t('app', 'Not set') : $kgi['toDate'] ?>
				</div>
			</div>
		</div>
		<div class="col-lg-5 col-md-2 col-4 text-end pr-20 pt-0" style="margin-top: -7px;">
			<span class="team-wrapper <?= $colorFormat ?>-teamshow" style="margin-right: 5px;">
				<span class="team-icon pim-team-<?= $colorFormat ?>">
					<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/<?= $colorFormat == 'disable' ? 'teamblack' : 'teamwhite' ?>.svg"
						alt="Team Icon">
				</span>
				<span class="team-name"><?= $kgi["teamName"] ?></span>
			</span>
			<a href="<?= Yii::$app->homeUrl ?>kgi/kgi-team/kgi-team-history/<?= ModelMaster::encodeParams(['kgiTeamId' => $kgiTeamId, 'kgiTeamHistoryId' => $kgi['kgiTeamHistoryId'], 'kgiId' => $kgi["kgiId"], 'openTab' => 1]) ?>"
				class="btn <?= $colorFormat == 'disable' ? 'btn-bg-gray-xs' : 'btn-bg-white-xs' ?> mr-5"
				style="<?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
				<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/eye.svg" alt="History"
					class="pim-icon" style="margin-top: 1px;">
			</a>
			<a href="<?= Yii::$app->homeUrl ?>kgi/view/kgi-team-history/<?= ModelMaster::encodeParams(['kgiId' => $kgi['kgiId'], "kgiTeamId" => $kgiTeamId, "teamId" => $kgi['teamId']]) ?>"
				class="btn <?= $colorFormat == 'disable' ? 'btn-bg-gray-xs' : 'btn-bg-white-xs' ?> mr-5"
				style="<?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
				<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/history.svg" alt="History"
					class="pim-icon mr-3"><?= Yii::t('app', 'History') ?>
			</a>
			<a href="<?= Yii::$app->homeUrl ?>kgi/kgi-team/kgi-team-history/<?= ModelMaster::encodeParams(['kgiTeamId' => $kgiTeamId, 'kgiTeamHistoryId' => $kgi['kgiTeamHistoryId'], 'kgiId' => $kgi["kgiId"], 'openTab' => 3]) ?>"
				class="btn <?= $colorFormat == 'disable' ? 'btn-bg-gray-xs' : 'btn-bg-white-xs' ?> mr-5"
				style="<?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
				<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/comment.svg" alt="Chart"
					class="pim-icon mr-3"><?= Yii::t('app', 'Chats') ?>
			</a>
			<a href="<?= Yii::$app->homeUrl ?>kgi/kgi-team/kgi-team-history/<?= ModelMaster::encodeParams(['kgiTeamId' => $kgiTeamId, 'kgiTeamHistoryId' => $kgi['kgiTeamHistoryId'], 'kgiId' => $kgi["kgiId"], 'openTab' => 4]) ?>"
				class="btn <?= $colorFormat == 'disable' ? 'btn-bg-gray-xs' : 'btn-bg-white-xs' ?> mr-5"
				style="<?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
				<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/chart.svg" alt="Chart"
					class="pim-icon mr-3"><?= Yii::t('app', 'Chart') ?>
			</a>
			<?php
			if ($role >= 5) {
			?>
				<a class="btn btn-bg-red-xs" data-bs-toggle="modal" data-bs-target="#delete-kgi-team"
					onclick="javascript:prepareDeleteKgiTeam(<?= $kgiTeamId ?>)"
					onmouseover="this.querySelector('.pim-icon').src='<?= Yii::$app->homeUrl ?>images/icons/Settings/binwhite.svg'"
					onmouseout="this.querySelector('.pim-icon').src='<?= Yii::$app->homeUrl ?>images/icons/Settings/binred.svg'">
					<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/binred.svg" alt="History"
						class="pim-icon">
				</a>
			<?php
			}
			?>
		</div>
		<div class="col-lg-3 pim-subheader-font border-right-<?= $colorFormat ?> mt-10">
			<div class="row">
				<div class="col-12 text-start pl-22 fw-bold text-dark">
					<?= Yii::t('app', 'Assign on') ?>
				</div>
				<div class="col-10 pl-20 pr-0 mt-10">
					<div class="col-12 pb-1">
						<div class="row">
							<div class="col-4 pr-2 pl-13">
								<div class="row d-flex align-items-center"
									style="min-height: 24px;">
									<?php if ($kgi["countTeamEmployee"] != 0) { ?>

										<div class="col-2">
											<?php
											if (isset($kgi['kgiEmployeeSelect'][0])) {
											?>
												<img src="<?= Yii::$app->homeUrl . $kgi['kgiEmployeeSelect'][0] ?>"
													class="pim-pic-gridNew">
											<?php
											} else {
											?>
												<img src="<?= Yii::$app->homeUrl . 'image/user.svg' ?>"
													class="pim-pic-gridNew">
											<?php   } ?>
										</div>
										<div class="col-2 pic-after pt-0">
											<?php
											if (isset($kgi['kgiEmployeeSelect'][1])) {
											?>
												<img src="<?= Yii::$app->homeUrl . $kgi['kgiEmployeeSelect'][1] ?>"
													class="pim-pic-gridNew">
											<?php
											} else {
											?>
												<img src="<?= Yii::$app->homeUrl . 'image/user.svg' ?>"
													class="pim-pic-gridNew">
											<?php   } ?>
										</div>
										<div class="col-2 pic-after pt-0">
											<?php
											if (isset($kgi['kgiEmployeeSelect'][2])) {
											?>
												<img src="<?= Yii::$app->homeUrl . $kgi['kgiEmployeeSelect'][2] ?>"
													class="pim-pic-gridNew">
											<?php
											} else {
											?>
												<img src="<?= Yii::$app->homeUrl . 'image/user.svg' ?>"
													class="pim-pic-gridNew">
											<?php   } ?>
										</div>
										<div
											class="col-5 number-tagNew  <?= $kgi["countTeamEmployee"] == 0 && $colorFormat != "disable" ? 'load-yenlow' : 'load-'  . $colorFormat ?> ">
											<?= $kgi["countTeamEmployee"] ?>
										</div>
									<?php } else { ?>
										<div class="col-2 ">
											<div class="
                                                                <?= $role >= 3
											? ($kgi["countTeamEmployee"] == 0 && $colorFormat != "disable"
												? 'pim-pic-yenlow'
												: 'pim-pic-'  . $colorFormat)
											: ($kgi["countTeamEmployee"] == 0 && $colorFormat != "disable"
												? 'pim-pic-yenlow'
												: 'pim-pic-'  . $colorFormat)
										?>
                                                                ">
												<img
													src="<?= Yii::$app->homeUrl ?>images/icons/Settings/personblack.svg">
											</div>
										</div>
										<div class="col-2 pic-after pt-0">
											<div class="
                                                                <?= $role >= 3
											? ($kgi["countTeamEmployee"] == 0 && $colorFormat != "disable"
												? 'pim-pic-yenlow'
												: 'pim-pic-'  . $colorFormat)
											: ($kgi["countTeamEmployee"] == 0 && $colorFormat != "disable"
												? 'pim-pic-yenlow'
												: 'pim-pic-'  . $colorFormat)
										?>
                                                                ">
												<img
													src="<?= Yii::$app->homeUrl ?>images/icons/Settings/personblack.svg">
											</div>
										</div>
										<div class="col-2 pic-after pt-0">
											<div class="
                                                                <?= $role >= 3
											? ($kgi["countTeamEmployee"] == 0 && $colorFormat != "disable"
												? 'pim-pic-yenlow'
												: 'pim-pic-'  . $colorFormat)
											: ($kgi["countTeamEmployee"] == 0 && $colorFormat != "disable"
												? 'pim-pic-yenlow'
												: 'pim-pic-'  . $colorFormat)
										?>
                                                                ">
												<img
													src="<?= Yii::$app->homeUrl ?>images/icons/Settings/personblack.svg">
											</div>
										</div>
										<div class="col-5 number-tagNew  
                                                            <?= $role >= 3
											? ($kgi["countTeamEmployee"] == 0 && $colorFormat != "disable"
												? 'load-yenlow'
												: 'load-'  . $colorFormat)
											: ($kgi["countTeamEmployee"] == 0 && $colorFormat != "disable"
												? 'load-yenlow'
												: 'load-'  . $colorFormat)
									?> ">
											<?= $kgi["countTeamEmployee"] ?>
										</div>
									<?php } ?>
								</div>
							</div>

							<?php if ($role < 3) { ?>
								<div
									class="col-5 <?= $kgi["countTeamEmployee"] == 0 ? ($colorFormat == 'disable' ? 'disable' : 'yenlow') : $colorFormat ?>-assignNew ">

									<span class="pull-left">
										<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/view-<?= $kgi["countTeamEmployee"] == 0 ? ($colorFormat == 'disable' ? 'disable' : 'yenlow') : $colorFormat ?>.svg"
											class="assing-icon mr-2">
									</span>

									<a href="<?= ($kgi["countTeamEmployee"] > 0 && $colorFormat != 'disable') ? Yii::$app->homeUrl . 'kgi/kgi-team/kgi-team-history/' . ModelMaster::encodeParams(['kgiTeamId' => $kgiTeamId, 'kgiTeamHistoryId' => 0, 'kgiId' => $kgi["kgiId"], 'openTab' => 1]) : '#' ?>"
										class="font-<?= $kgi["countTeamEmployee"] == 0 ? ($colorFormat == 'disable' ? 'disable' : 'black') : $colorFormat ?>"
										style="<?= ($kgi["countTeamEmployee"] == 0 || $colorFormat == 'disable') ? 'pointer-events: none; color: black; text-decoration: none; top: 2px;' : 'top: 2px;' ?>">
										<?php if ($kgi["countTeamEmployee"] == 0 && $colorFormat == 'disable') { ?>
											<?= Yii::t('app', 'Not Assign') ?>
										<?php } elseif ($kgi["countTeamEmployee"] == 0) { ?>
											<?= Yii::t('app', 'Not Assign') ?>
										<?php } else { ?>
											<?= Yii::t('app', 'View Assign') ?>
										<?php } ?>
									</a>

								</div>
							<?php  } else { ?>
								<div
									class="col-5 <?= $kgi["countTeamEmployee"] == 0 ? ($colorFormat == 'disable' ? 'disable' : 'yenlow') : $colorFormat ?>-assignNew ">
									<span class="pull-left">
										<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/assign-<?= $kgi["countTeamEmployee"] == 0 ? ($colorFormat == 'disable' ? 'disable' : 'yenlow') : $colorFormat ?>.svg"
											class="assing-icon mr-2">
									</span>
									<a href="<?= Yii::$app->homeUrl ?>kgi/assign/assign/<?= ModelMaster::encodeParams(['kgiId' => $kgi["kgiId"], "companyId" => $kgi["companyId"]]) ?>"
										class="font-<?= $kgi["countTeamEmployee"] == 0 ? ($colorFormat == 'disable' ? 'disable' : 'black') : $colorFormat ?>"
										style="top: 2px;">
										<?php if ($kgi["countTeamEmployee"] == 0 && $colorFormat == 'disable') { ?>
											<?= Yii::t('app', 'Assign Person') ?>
										<?php  } else if ($kgi["countTeamEmployee"] == 0) { ?>
											<?= Yii::t('app', 'Assign Person') ?>
										<?php } else {  ?>
											<?= Yii::t('app', 'Edit Assign') ?>
										<?php } ?>
									</a>
								</div>
							<?php }  ?>

							<div class="col-1">
							</div>
						</div>
					</div>
					<div class="col-12 mt-10 pt-5 pb-1">
						<div class="row">
							<div class="col-4 pr-2">
								<div class="row d-flex align-items-center"
									style="min-height: 24px;">
									<div class="col-2">
										<div class="pim-pic-<?= $colorFormat ?>">
											<img
												src="<?= Yii::$app->homeUrl ?>images/icons/Settings/<?= $colorFormat == 'disable' ? 'teamblack' : 'teamwhite' ?>.svg">
										</div>
									</div>
									<div class="col-2 pic-after pt-0">
										<div class="pim-pic-<?= $colorFormat ?>">
											<img
												src="<?= Yii::$app->homeUrl ?>images/icons/Settings/<?= $colorFormat == 'disable' ? 'teamblack' : 'teamwhite' ?>.svg">
										</div>
									</div>
									<div class="col-2 pic-after pt-0">
										<div class="pim-pic-<?= $colorFormat ?>">
											<img
												src="<?= Yii::$app->homeUrl ?>images/icons/Settings/<?= $colorFormat == 'disable' ? 'teamblack' : 'teamwhite' ?>.svg">
										</div>
									</div>
									<div class="col-5 number-tagNew load-<?= $colorFormat ?>">
										<?= $kgi["countTeam"] ?>
									</div>
								</div>

							</div>
							<?php if ($role < 3) { ?>
								<div
									class="col-5 <?= $kgi["countTeam"] == 0 ? ($colorFormat == 'disable' ? 'disable' : 'yenlow') : $colorFormat ?>-assignNew ">

									<span class="pull-left">
										<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/view-<?= $kgi["countTeam"] == 0 ? ($colorFormat == 'disable' ? 'disable' : 'yenlow') : $colorFormat ?>.svg"
											class="assing-icon mr-2">
									</span>

									<a href="<?= ($kgi["countTeam"] > 0 || $colorFormat != 'disable') ? Yii::$app->homeUrl . 'kgi/kgi-team/kgi-team-history/' . ModelMaster::encodeParams(['kgiTeamId' => $kgiTeamId, 'kgiTeamHistoryId' => 0, 'kgiId' => $kgi["kgiId"], 'openTab' => 1]) : '#' ?>"
										class="font-<?= ($kgi["countTeam"] == 0 && $colorFormat == 'disable') ? 'black' : $colorFormat ?>"
										style="top: 2px; <?= ($kgi["countTeam"] == 0 || $colorFormat == 'disable') ? 'pointer-events: none; color: black; text-decoration: none; top: 2px;'  : '' ?>">
										<?php if ($kgi["countTeam"] == 0 && $colorFormat == 'disable') { ?>
											<?= Yii::t('app', 'Not Assign') ?>
										<?php } elseif ($kgi["countTeam"] == 0) { ?>
											<?= Yii::t('app', 'Not Team') ?>
										<?php } else { ?>
											<?= Yii::t('app', 'View Assign') ?>
										<?php } ?>
									</a>

								</div>
							<?php  } else { ?>
								<div
									class="col-5 <?= $kgi["countTeam"] == 0 ? ($colorFormat == 'disable' ? 'disable' : 'yenlow') : $colorFormat ?>-assignNew ">
									<span class="pull-left">
										<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/assign-<?= $kgi["countTeam"] == 0 ? ($colorFormat == 'disable' ? 'disable' : 'yenlow') : $colorFormat ?>.svg"
											class="assing-icon mr-2">
									</span>
									<a href="<?= Yii::$app->homeUrl ?>kgi/assign/assign/<?= ModelMaster::encodeParams(['kgiId' => $kgi["kgiId"], "companyId" => $kgi["companyId"]]) ?>"
										class="font-<?= ($kgi["countTeam"] == 0 && $colorFormat == 'disable') ? 'black' : $colorFormat ?>"
										style="top: 2px; <?= ($kgi["countTeam"] == 0 && $colorFormat == 'disable') ?: '' ?>">
										<?php if ($kgi["countTeam"] == 0 && $colorFormat == 'disable') { ?>
											<?= Yii::t('app', 'Assign Team') ?>
										<?php  } else if ($kgi["countTeam"] == 0) { ?>
											<?= Yii::t('app', 'Assign Team') ?>
										<?php } else {  ?>
											<?= Yii::t('app', 'Edit Assign') ?>
										<?php } ?>
									</a>
								</div>
							<?php }  ?>
							<div class="col-1">
							</div>
						</div>
					</div>
				</div>
				<div class="col-2 pr-0 pl-0" style="margin-top:5px;">
					<div class="col-12 text-center priority-star">
						<?php
						if ($kgi["priority"] == "A" || $kgi["priority"] == "B") {
						?>
							<i class="fa fa-star" aria-hidden="true"></i>
						<?php
						}
						if ($kgi["priority"] == "A" || $kgi["priority"] == "C") {
						?>
							<i class="fa fa-star big-star" aria-hidden="true"></i>
						<?php
						}
						if ($kgi["priority"] == "B") {
						?>
							<i class="fa fa-star ml-10" aria-hidden="true"></i>
						<?php
						}
						if ($kgi["priority"] == "A") {
						?>
							<i class="fa fa-star" aria-hidden="true"></i>
						<?php
						}
						?>
					</div>
					<?php
					if ($kgi["priority"] != '') {
					?>
						<div class="col-12 text-center priority-box">
							<div class="col-12"><?= Yii::t('app', 'Priority') ?></div>
							<div class="col-12 text-priority"><?= $kgi["priority"] ?></div>
						</div>
					<?php
					} else { ?>
						<div class="col-12 text-center priority-box-null">
							<div class="col-12"><?= Yii::t('app', 'Priority') ?></div>
							<div class="col-12 text-priority">N/A</div>
						</div>
					<?php
					}
					?>
				</div>
			</div>
		</div>
		<div class="col-lg-1 pim-small-text border-right-<?= $colorFormat ?> pl-16 pr-10 mt-20">
			<div class="col-12"><?= Yii::t('app', 'Quant Ratio') ?></div>
			<div class="col-12 border-bottom-<?= $colorFormat ?> pb-10  pim-unit-text">
				<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/<?= $kgi["quantRatio"] == 1 ? 'quantity' : 'diamon' ?>.svg"
					class="pim-iconKFI" style="margin-top: -1px; margin-left: 3px;">
				<?= $kgi["quantRatio"] == 1 ? Yii::t('app', 'Quantity') : Yii::t('app', 'Quality') ?>
			</div>
			<div class="col-12 pr-0 pt-10 pl-0"><?= Yii::t('app', 'Update Interval') ?></div>
			<div class="col-12   pim-unit-text">
				<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/monthly.svg"
					class="pim-iconKFI" style="margin-top: -1px; margin-left: 3px;">
				<?= Yii::t('app',  $kgi["unit"]) ?>
			</div>
		</div>
		<div class="col-lg-3 pim-small-text border-right-<?= $colorFormat ?> mt-20 pr-15 pl-15">
			<div class="row">
				<div class="col-5 text-start">
					<div class="col-12">
						<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/Target.svg"
							class="pim-iconKFI" style="margin-top: 1px; margin-right: 3px;">
						<?= Yii::t('app', 'Target') ?>
					</div>
					<div class="col-12 mt-3 number-pim">
						<?php
						if ($kgi["target"] != '') {
							$decimal = explode('.', $kgi["target"]);
							if (isset($decimal[1])) {
								if ($decimal[1] == '00') {
									$show = number_format($decimal[0]);
								} else {
									$show = number_format($kgi["target"], 2);
								}
							} else {
								$show = number_format($kgi["target"]);
							}
						} else {
							$show = 0.00;
						}
						?>
						<?= $show ?><?= $kgi["amountType"] == 1 ? '%' : '' ?>
					</div>
				</div>
				<div class="col-2 symbol-pim text-center">
					<div class="col-12 pt-17"><?= $kgi["code"] ?></div>
				</div>
				<div class="col-5  text-end">
					<div class="col-12">
						<?= Yii::t('app', 'Result') ?>
						<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/Result.svg"
							class="pim-iconKFI" style="margin-top: 1px; margin-left: 3px;">
					</div>
					<div class="col-12 mt-3 number-pim">
						<?php
						if ($kgi["result"] != '') {
							$decimalResult = explode('.', $kgi["result"]);
							if (isset($decimalResult[1])) {
								if ($decimalResult[1] == '00') {
									$showResult = number_format($decimalResult[0]);
								} else {
									$showResult = number_format($kgi["result"], 2);
								}
							} else {
								$showResult = number_format($kgi["result"]);
							}
						} else {
							$showResult = 0;
						}
						?>
						<?= $showResult ?><?= $kgi["amountType"] == 1 ? '%' : '' ?>
					</div>
				</div>
				<div class="col-12 pl-15 pr-10">
					<?php
					$percent = explode('.', $kgi['ratio']);
					if (isset($percent[0]) && $percent[0] == '0') {
						if (isset($percent[1])) {
							if ($percent[1] == '00') {
								$showPercent = 0;
							} else {
								$showPercent = round($kgi['ratio'], 1);
							}
						}
					} else {
						$showPercent = round($kgi['ratio']);
					}
					?>
					<div class="progress">
						<div class="progress-bar-<?= $colorFormat ?>"
							style="width:<?= $showPercent ?>%;"></div>
						<span
							class="progress-load load-<?= $colorFormat ?>"><?= $showPercent ?>%</span>
					</div>
				</div>
				<div class="col-4 pl-0 pr-5 mt-16">
					<div class="col-12 text-end"><?= Yii::t('app', 'Last Updated on') ?></div>
					<div class="col-12 text-end pim-duedate">
						<?= $kgi['lastestUpdate'] == "" ? Yii::t('app', 'Not set') : $kgi['lastestUpdate'] ?>
					</div>
				</div>
				<div class="col-4 text-center mt-16 pt-5">
					<?php
					if ($colorFormat == 'disable'  && $canEdit >= 1) {
					?>
						<a onclick="javascript:updateTeamKgi(<?= $kgiTeamId ?>)" class="pim-btn-setup"
							style="display: flex; justify-content: center; align-items: center; padding: 7px 9px;  height: 30px; gap: 6px; flex-shrink: 0;"
							href="<?= Yii::$app->homeUrl ?>kgi/kgi-team/prepare-update/<?= ModelMaster::encodeParams(['kgiTeamId' => $kgiTeamId, 'kgiHistoryId' => 0]) ?>">

							<!-- data-bs-toggle="modal" data-bs-target="#update-kgi-modal-team"> -->
							<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/setupwhite.svg"
								class="mb-2" style="width: 12px; height: 12px;">
							<?= Yii::t('app', 'Setup') ?>
						</a>
					<?php
					} else if ($colorFormat == "complete") {
						// echo Yii::t('app', "Update");
					} else if ($canEdit == 1) {
					?>
						<a onclick=" javascript:updateTeamKgi(<?= $kgiTeamId ?>)"
							class="pim-btn-<?= $colorFormat ?>"
							style="display: flex; justify-content: center; align-items: center; padding: 7px 9px;  height: 30px; gap: 6px; flex-shrink: 0;"
							href="<?= Yii::$app->homeUrl ?>kgi/kgi-team/prepare-update/<?= ModelMaster::encodeParams(['kgiTeamId' => $kgiTeamId, 'kgiHistoryId' => 0]) ?>">
							<!-- data-bs-toggle="modal"data-bs-target="#update-kgi-modal-team" -->
							<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/refresh.svg"
								class="mb-2" style="width: 12px; height: 12px;">
							<?php
							if ($colorFormat == "over") {
								echo Yii::t('app', 'Update');
							} else {
								echo Yii::t('app', 'Update');
							}
							?>
						</a>
					<?php
					} else { ?>
						<div class="pim-btn-disable" data-bs-target="#update-kgi-modal">
							<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/locked.svg"
								style="width: 12px; height: 12px;"> <?= Yii::t('app', 'Locked') ?>
						</div>
					<?php
					}
					?>
				</div>
				<div class="col-4 pl-0 pr-5 mt-16">
					<div class="col-12 text-start font-<?= $colorFormat ?> font-b">
						<?= Yii::t('app', 'Next Update Date') ?></div>
					<div class="col-12 text-start pim-duedate">
						<?= $kgi['nextCheckDate'] == "" ? 'Not set' : $kgi['nextCheckDate'] ?></div>
				</div>
			</div>
		</div>
		<div class="col-lg-5 pim-subheader-font mt-20">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-12 pr-3 pl-20">
					<div class="col-12 head-letter head-<?= $colorFormat ?>">
						<?= Yii::t('app', 'Issue') ?></div>
					<div class="col-12 body-letter body-letter-<?= $colorFormat ?>">
						<?= $kgi["issue"] ?>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-12 pl-5 pr-20">
					<div class="col-12 head-letter head-<?= $colorFormat ?>">
						<?= Yii::t('app', 'Solution') ?></div>
					<div class="col-12 body-letter body-letter-<?= $colorFormat ?>">
						<?= $kgi["solution"] ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>