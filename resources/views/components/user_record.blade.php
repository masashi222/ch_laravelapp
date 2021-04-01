<div class="row py-2 border-bottom text-center d-flex align-items-center">
	<div class="col-6">
	{{ $user_record['name'] }}
	</div>
	<div class="col-3">
		<a href="{{ $user_record['change'] }}" class="btn btn-link btn-sm">変更</a>
	</div>
	<div class="col-3">
		<button type="button" class="btn btn-link btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop">削除</button>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title" id="staticBackdropLabel"><i class="fas fa-exclamation-triangle">&ensp;Heads Up</i></h5>
        		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      		</div>
      		<div class="modal-body">
        		Do you really want to delete the user information?
      		</div>
  			<div class="modal-footer">
        		<a href="{{ $user_record['delete'] }}" class="btn btn-secondary">Run</a>
        		<button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
      		</div>
    	</div>
  	</div>
</div>
