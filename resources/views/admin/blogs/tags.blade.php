@extends('layouts.admin')
@section('content')
<section class="content">
	<div class="row">
		<div class="col-md-10">
		  <!-- general form elements -->
		  <div class="box box-primary">
		    <div class="box-header">
		      <h3 class="box-title">Add Tags</h3>
		    </div><!-- /.box-header -->
		    <!-- form start -->
		    @if (session('status'))
			    <div class="alert alert-success">
			        {{ session('status') }}
			    </div>
			@endif
		    <form method="post" action="<?php echo url($ADMIN_URL.'/blogs/blog-tags',$blog->id);?>">
		    {{ csrf_field() }}
		    	<div class="box-body">
			    	<?php $i=0;
			    	foreach($tags as $tag){ ?>
			    		<div class="col-lg-3" style="margin-bottom:2px;">
					    	<label><?php echo $tag->name; ?></label>
							<div class="input-group">
								<span class="input-group-addon">
								  <input type="checkbox" name="tag_id[]" value="<?php echo $tag->id; ?>" <?php echo (in_array($tag->id,$blog_tags)) ? 'checked' : ''  ?>>
								</span>
							</div><!-- /input-group -->
				        </div>
			        <?php $i++; } ?>
			    </div>    
	          <div class="box-footer">
		        <button type="submit" class="btn btn-primary">Submit</button>
		      </div>
		    </form>
		  </div><!-- /.box -->
		</div>
	</div>	  
</section>
@endsection