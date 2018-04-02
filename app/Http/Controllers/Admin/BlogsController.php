<?php

namespace App\Http\Controllers\Admin;

use App\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.blogs.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $categories = \App\Category::pluck('name','id');
        $blog = new Blog();
        return view('admin.blogs.create',compact('blog','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $blog = new Blog;
       //dd($request->all());
       $blog->category_id = $request->category_id;
       $blog->title = $request->title;
       $blog->short_desc = $request->short_desc;
       $blog->meta_title = $request->meta_title;
       $blog->meta_keywords = $request->meta_keywords;
       $blog->meta_description = $request->meta_description;
       $blog->status = '1';

       $blog->save();
       return back()->with('status','Record Saved Successfully.'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
       $blog = Blog::find($blog->id);
       //dd($request->all());
       $blog->category_id = $request->category_id;
       $blog->title = $request->title;
       $blog->short_desc = $request->short_desc;
       $blog->meta_title = $request->meta_title;
       $blog->meta_keywords = $request->meta_keywords;
       $blog->meta_description = $request->meta_description;
       
       $blog->save();
       return back()->with('status','Record Updated Successfully.'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        //
    }

    public function postEditorimageuploader(){
        
        //pr($this->request->data);
        if (isset($this->request->data['file']['name']) && !empty($this->request->data['file']['name'])) {
            $filename = $this->Upload->upload($this->request->data['file']);
            echo json_encode(array('location' => $this->UPLOADS.$filename));
        }
    }

    public function getBlogTags($blog_id){

      $tags = \App\Tag::where(['status'=>'1'])->get();
      $blog = Blog::find($blog_id);

      $blog_tags = [];
      foreach ($blog->tag as $tag) {
          $blog_tags[] = $tag->pivot->tag_id;
      }
      
      return view('admin.blogs.tags',compact('tags','blog'));
    }

    public function postBlogTags(Request $request,$blog_id){
        $blog = Blog::find($blog_id);
        $blog->tags()->detach();
        $blog->tags()->attach($request->all(););
        return redirect($this->ADMIN_URL.'/blogs/blog-tags/'.$blog->id)->with('status','Added Successfully!'); 
    }
}
