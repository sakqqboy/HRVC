<div class="modal fade" id="evaluator-score" tabindex="-1" aria-labelledby="staticBackdrop5" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="border-bottom:none;">
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="col-10 text-start font-size-14 pl-10 font-weight-500" id="kfiName" style="margin-top:-40px;">

			</div>
			<div class="modal-body pt-0">

				<div class="row mt-20 border-bottom pb-10">
					<div class="col-12 font-weight-500 font-size-12">
						Primary Evaluator
					</div>
					<div class="col-4 pt-0">
						<label for="firstScore" class="font-size-10">Score</label>
						<input type="text" class="form-control text-end" id="firstScore" disabled>
					</div>
					<div class="col-8 pt-0">
						<label for="firstComment" class="font-size-10">Comment</label>
						<Textarea class="form-control font-size-12" id="firstComment" disabled></Textarea>
					</div>
				</div>
				<div class="row mt-10">
					<div class="col-12 font-weight-500 font-size-12">
						Final Evaluator
					</div>
					<div class="col-4 pt-0">
						<label for="firstScore" class="font-size-10">Score</label>
						<input type="text" class="form-control text-end" id="finalScore" disabled>
					</div>
					<div class="col-8 pt-0">
						<label for="firstComment" class="font-size-10">Comment</label>
						<Textarea class="form-control font-size-12" id="finalComment" disabled></Textarea>
					</div>
				</div>
			</div>
			<div class="row text-center mt-20" style="border-bottom:none;">
				<input type="hidden" id="kfiWeightId" value="">
				<div class="col-6 text-end">
					<a href="javascript:saveKfiWeight()" class="btn btn-primary" style="width: 100px;">Save</a>
				</div>
				<div class="col-6 text-start">

					<a href="" class="btn btn-danger" style="width: 100px;" data-bs-dismiss="modal">Cancel</a>
					<div class="mt-40"></div>
				</div>
			</div>
		</div>
	</div>
</div>