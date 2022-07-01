<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogPage;
use Image;

class BlogPageController extends Controller
{
    public function BlogPageEdit() {
        if (BlogPage::first()) {
            $blog = BlogPage::first(); 
        } else {
            $blog = null;
        }
        return view('admin.blog.blog_page_edit', compact('blog'));
    }

    public function BlogPageUpdate(Request $request) {
        if (BlogPage::first()) {             // update
            $blog = BlogPage::first(); 
            if ($request->file('cover_image')) {
                $file = $request->file('cover_image');
                $name_gen = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
                $img = Image::make($file);
                $img->resize(865, 576, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $resource = $img->stream()->detach();
                $folder = 'images/blog/page/';

                $path = \Storage::disk('s3')->put(
                    // location and file name to save
                    $folder . $name_gen,
                    // file
                    $resource
                );
                $path = \Storage::disk('s3')->url($path);
            
                $image_link = 'https://'.env('AWS_BUCKET').'.s3.'.env('AWS_DEFAULT_REGION').'.amazonaws.com/'.$folder.$name_gen;
            } else {
                $image_link = $blog->cover_image;
            }
            $blog->update([
                'description' => $request->description,
                'cover_image' => $image_link
            ]);

            $notification = array(
                'message' => 'Blog Page Updated Successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->back()->with($notification);
        } else {                                    // add new
            if ($request->file('cover_image')) {
                $file = $request->file('cover_image');
                $name_gen = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
                $img = Image::make($file);
                $img->resize(865, 576, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $resource = $img->stream()->detach();
                $folder = 'images/blog/page/';

                $path = \Storage::disk('s3')->put(
                    // location and file name to save
                    $folder . $name_gen,
                    // file
                    $resource
                );
                $path = \Storage::disk('s3')->url($path);
            
                $image_link = 'https://'.env('AWS_BUCKET').'.s3.'.env('AWS_DEFAULT_REGION').'.amazonaws.com/'.$folder.$name_gen;
            } else {
                $image_link = null;
            }
            BlogPage::insert([
                'description' => $request->description,
                'cover_image' => $image_link
            ]);

            $notification = array(
                'message' => 'Blog Page Added Successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->back()->with($notification);
        }
    }

    
    // API
    public function GetBlogData() {
        $blog_page = BlogPage::first();

        return response([
            'message' => "Get Testimonial Data Successfully!",
            'blog_page' => $blog_page
        ], 200);    // Success 200 code
    }
}
