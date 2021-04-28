<tr>
	<td class="align-middle">
	{{ $data['name'] }}
	</td>
	<td>
		<a href="{{ route('user.edit') }}/{{ $data['userid'] }}" class="btn btn-link btn-sm ">変更</a>
	</td>
	<td>
		<button type="button" class="btn btn-link btn-sm" data-bs-toggle="modal" data-bs-target="#modal{{ $data['userid'] }}">削除</button>
	</td>
</tr>
<!-- Modal -->
<div class="modal fade" id="modal{{ $data['userid'] }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title" id="staticBackdropLabel"><i class="fas fa-exclamation-triangle">&ensp;注意喚起</i></h5>
        		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      		</div>
      		<div class="modal-body">
        		{{ $data['name'] }}さんのユーザー情報を削除しますか?
      		</div>
  			<div class="modal-footer">
        		<a href="{{ route('user.destroy') }}/{{ $data['userid'] }}" class="btn btn-secondary">実行</a>
        		<button type="button" class="btn btn-success" data-bs-dismiss="modal">中止</button>
      		</div>
    	</div>
  	</div>
</div>
