<div class="row bg-light border-bottom page-nav" data-url="{{ route($data['url']) }}">
    <div class="col py-3 clearfix">
    	{{ $data['item'] ?? '' }}
    	<div class="float-end">
    		<i class="fas fa-angle-right"></i>
    	</div>
    </div>
</div>