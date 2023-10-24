<div class="col-lg-3 col-md-5 col-sm-3 col-12" id="title-<?= $titleId ?>">
	<div class="card" style="border: none;border-radius:10px;">
		<div class="card-body">
			<div class="col-12 txt-bold ">
				<?= $titleName ?><?= $tShort != null ? '&nbsp;&nbsp;&nbsp;(' . $tShort . ')' : '' ?>
				<span class="ml-10 font-size-16 text-warning">
					<i class="fa fa-star" aria-hidden="true"></i>
				</span>
				<span class="font-size-12 text-primary">
					new
				</span>
			</div>
			<div class="col-12  mt-10 font-size-13">
				<b>Layer</b> :<?= $layerName ?><?= $lShort != null ? '&nbsp;&nbsp;&nbsp;(' . $lShort . ')' : '' ?>
			</div>
			<div class="col-12  mt-10 font-size-13">
				<b>Branch</b> : <?= $branchName ?>
			</div>
			<div class="col-12  mt-10 font-size-13">
				<b>Department</b> : <?= $departmentName ?>
			</div>
			<div class="row">
				<div class="col-12 text-end pr-0 mt-15" style="margin-bottom: -10px;">
					<a href="javascript:updateTitle(<?= $titleId ?>)" class="btn btn-sm btn-outline-dark mr-5 font-size-12">
						<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
					</a>
					<a href="javascript:deleteTitle(<?= $titleId ?>)" class="btn btn-sm btn-outline-danger font-size-12">
						<i class="fa fa-trash" aria-hidden="true"></i>
					</a>
				</div>
			</div>

		</div>
	</div>
</div>