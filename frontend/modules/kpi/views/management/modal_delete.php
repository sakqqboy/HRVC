<div class="modal fade" id="delete-kpi" tabindex="-1" aria-labelledby="staticBackdrop5" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="border-bottom:none;">
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="col-12 delete-Backdrop4">
					Are you sure you want to do this?
				</div>
			</div>
			<div class="row text-center mt-20" style="border-bottom:none;">
				<div class="col-6 text-end">
					<button type="button" class="btn btn-primary" style="width: 100px;" data-bs-dismiss="modal">Cancel</button>
				</div>
				<div class="col-6 text-start">
					<input type="hidden" id="kpiId-modal" value="">
					<a href="javascript:deleteKpi()" class="btn btn-danger" style="width: 100px;">Delete</a>
					<div class="mt-40"></div>
				</div>
			</div>
		</div>
	</div>
</div>