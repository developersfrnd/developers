@extends('layouts.admin')
@section('content')
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script type="text/javascript" src="http://malsup.github.io/jquery.form.js"></script>


<script type="text/javascript">
	tinymce.init({
        selector: '#content',
        height: 400,
        menubar: true,
        statusbar: true,
        relative_urls: false,
        remove_script_host: true,
        convert_urls: true,
        plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table contextmenu paste code'
        ],
        toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist| image',
        content_css: '//www.tinymce.com/css/codepen.min.css',
        //image upload
        automatic_uploads: true,
        file_picker_types: 'image',
        images_upload_url: '<?php echo url('/blogs/editorimageuploader'); ?>',
        images_upload_base_path: '',
        file_picker_callback: function (callback, value, meta) {
            if (meta.filetype == 'image') {
                var input = document.getElementById('my-file');
                input.onchange = function () {
                    var file = input.files[0];
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        callback(e.target.result, {
                            alt: file.name
                        });
                    };
                    reader.readAsDataURL(file);
                };

                input.click();
            }
        }
    });
</script>

<link href="{{ asset('assets/vendor/plugins') }}/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
<section class="content">
	<div class="row">
	<!-- left column -->
	<div class="col-md-10">
	  <!-- general form elements -->
	  <div class="box box-primary">
	    <div class="box-header">
	      <h3 class="box-title">Add Products</h3>
	    </div><!-- /.box-header -->
	    <!-- form start -->
	    <form method="post" action="<?php echo url($ADMIN_URL.'/blogs',$blog->id);?>" enctype="multipart/form-data">
	    <?php if($blog->id){ ?>
	    <input type="hidden" name="_method" value="PATCH">	
	    <?php } ?>
	    {{ csrf_field() }}
	      <div class="box-body">
	        <div class="form-group">
	          <label for="category_id">Category</label>
	          <select class="form-control" id="category_id" name="category_id">
	          	@foreach($categories as $key=>$category)
	          		<option value="{{ $key }}">{{ $category }}</option>
	          	@endforeach
	          </select>
	        </div>
	        <div class="form-group">
	          <label for="name">Title</label>
	          <input type="text" class="form-control" id="title" placeholder="Enter Title" name="title" value="<?php echo old('title',$blog->title); ?>">
	        </div>
	        <div class="form-group">
	          <label for="name">Meta Title</label>
	          <input type="text" class="form-control" id="meta_title" placeholder="Enter meta_title" name="meta_title" value="<?php echo old('meta_title',$blog->meta_title); ?>">
	        </div>
	        <div class="form-group">
	          <label>MetaTag Keyword</label>
	          <textarea class="form-control" rows="3" placeholder="Enter ..." name="meta_keywords"><?php echo old('meta_keywords',$blog->meta_keywords); ?></textarea>
	        </div>
	        <div class="form-group">
	          <label>MetaTag Description</label>
	          <textarea class="form-control" rows="3" placeholder="Enter ..." name="meta_description"><?php echo old('meta_description',$blog->meta_description); ?></textarea>
	        </div>
	        <div class="form-group">
	          <label>short Description</label>
	          <textarea class="form-control" rows="3" placeholder="Enter ..." name="short_desc"><?php echo old('short_desc',$blog->short_desc); ?></textarea>
	        </div>
	        <div class="form-group">
	          <label>content</label>
	          <input id="my-file" type="file" name="my-file" style="display: none;" onchange="" />
	          <textarea id="content" class="form-control" rows="3" placeholder="Enter ..." name="content"><?php echo old('content',$blog->content); ?></textarea>
	        </div>
	      </div><!-- /.box-body -->
	      <div class="box-footer">
	        <button type="submit" class="btn btn-primary">Submit</button>
	      </div>
	    </form>
	  </div><!-- /.box -->
</section>
@endsection