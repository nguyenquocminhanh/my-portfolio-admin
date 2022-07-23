<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use App\Models\Blog;
use Image;
use Illuminate\Support\Carbon;

class BlogController extends Controller
{
    public function BlogAll() {
        $blogs = Blog::latest()->get();
        return view('admin.blog.blog_all', compact('blogs'));
    }

    public function BlogAdd() {
        $categories = BlogCategory::all();
        return view('admin.blog.blog_add', compact('categories'));
    }

    public function BlogStore(Request $request) {
        $request->validate([
            'title' => 'unique:blogs',
            'content' => 'required'
        ],
        [
            'content.required' => 'Blog Content Required'
        ]);

        $author_image_link = null;
        $thumbnail_image_link = null;
        $wallpaper_image_link = null;

        if ($request->file('author_image')) {
            $file = $request->file('author_image');
            $name_gen = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $img = Image::make($file);
            $img->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
            });
            $resource = $img->stream()->detach();
            $folder = 'images/author/';

            $path = \Storage::disk('s3')->put(
                // location and file name to save
                $folder . $name_gen,
                // file
                $resource
            );
            $path = \Storage::disk('s3')->url($path);
        
            $author_image_link = 'https://'.env('AWS_BUCKET').'.s3.'.env('AWS_DEFAULT_REGION').'.amazonaws.com/'.$folder.$name_gen;
        }
 
        if ($request->file('thumbnail_image')) {
            $file = $request->file('thumbnail_image');
            $name_gen = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $img = Image::make($file);
            $img->resize(865, 576, function ($constraint) {
                $constraint->aspectRatio();
            });
            $resource = $img->stream()->detach();
            $folder = 'images/blog_thumbnail/';

            $path = \Storage::disk('s3')->put(
                // location and file name to save
                $folder . $name_gen,
                // file
                $resource
            );
            $path = \Storage::disk('s3')->url($path);
        
            $thumbnail_image_link = 'https://'.env('AWS_BUCKET').'.s3.'.env('AWS_DEFAULT_REGION').'.amazonaws.com/'.$folder.$name_gen;
        }

        if ($request->file('wallpaper_image')) {
            $file = $request->file('wallpaper_image');
            $name_gen = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $img = Image::make($file);
            $img->resize(960, 440, function ($constraint) {
                $constraint->aspectRatio();
            });
            $resource = $img->stream()->detach();
            $folder = 'images/blog_wallpaper/';

            $path = \Storage::disk('s3')->put(
                // location and file name to save
                $folder . $name_gen,
                // file
                $resource
            );
            $path = \Storage::disk('s3')->url($path);
        
            $wallpaper_image_link = 'https://'.env('AWS_BUCKET').'.s3.'.env('AWS_DEFAULT_REGION').'.amazonaws.com/'.$folder.$name_gen;
        }

        Blog::insert([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'tags' => $request->tags,
            'author_name' => $request->author_name,
            'author_image' => $author_image_link,
            'thumbnail_image' => $thumbnail_image_link,
            'thumbnail_caption' => $request->thumbnail_caption,
            'wallpaper_image' => $wallpaper_image_link,
            'content' => $request->content,
            'description' => $request->description,
            'duration' => $request->duration,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Blog Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('blog.all')->with($notification);
    }

    public function BlogEdit($id) {
        $blog = Blog::findOrFail($id);
        $categories = BlogCategory::all();
        return view('admin.blog.blog_edit', compact('blog', 'categories'));
    }

    public function BlogUpdate(Request $request) {
        $request->validate([
            'title' => 'unique:blogs,title,'.$request->blog_id,
            'content' => 'required'
        ],
        [
            'content.required' => 'Blog Content Required'
        ]);

        $blog = Blog::findOrFail($request->blog_id);

        $author_image_link = $blog->author_image;
        $thumbnail_image_link = $blog->thumbnail_image;
        $wallpaper_image_link = $blog->wallpaper_image;

        if ($request->file('author_image')) {
            $file = $request->file('author_image');
            $name_gen = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $img = Image::make($file);
            $img->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
            });
            $resource = $img->stream()->detach();
            $folder = 'images/author/';

            $path = \Storage::disk('s3')->put(
                // location and file name to save
                $folder . $name_gen,
                // file
                $resource
            );
            $path = \Storage::disk('s3')->url($path);
        
            $author_image_link = 'https://'.env('AWS_BUCKET').'.s3.'.env('AWS_DEFAULT_REGION').'.amazonaws.com/'.$folder.$name_gen;
        }
 
        if ($request->file('thumbnail_image')) {
            $file = $request->file('thumbnail_image');
            $name_gen = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $img = Image::make($file);
            $img->resize(865, 576, function ($constraint) {
                $constraint->aspectRatio();
            });
            $resource = $img->stream()->detach();
            $folder = 'images/blog_thumbnail/';

            $path = \Storage::disk('s3')->put(
                // location and file name to save
                $folder . $name_gen,
                // file
                $resource
            );
            $path = \Storage::disk('s3')->url($path);
        
            $thumbnail_image_link = 'https://'.env('AWS_BUCKET').'.s3.'.env('AWS_DEFAULT_REGION').'.amazonaws.com/'.$folder.$name_gen;
        }

        if ($request->file('wallpaper_image')) {
            $file = $request->file('wallpaper_image');
            $name_gen = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $img = Image::make($file);
            $img->resize(960, 440, function ($constraint) {
                $constraint->aspectRatio();
            });
            $resource = $img->stream()->detach();
            $folder = 'images/blog_wallpaper/';

            $path = \Storage::disk('s3')->put(
                // location and file name to save
                $folder . $name_gen,
                // file
                $resource
            );
            $path = \Storage::disk('s3')->url($path);
        
            $wallpaper_image_link = 'https://'.env('AWS_BUCKET').'.s3.'.env('AWS_DEFAULT_REGION').'.amazonaws.com/'.$folder.$name_gen;
        }

        $blog->update([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'tags' => $request->tags,
            'author_name' => $request->author_name,
            'author_image' => $author_image_link,
            'thumbnail_image' => $thumbnail_image_link,
            'thumbnail_caption' => $request->thumbnail_caption,
            'wallpaper_image' => $wallpaper_image_link,
            'content' => $request->content,
            'description' => $request->description,
            'duration' => $request->duration,
            'updated_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Blog Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('blog.all')->with($notification);
    }

    public function BlogDelete($id) {
        $blog = Blog::findOrFail($id);
        $blog->delete();

        $notification = array(
            'message' => 'Blog Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('blog.all')->with($notification);
    }


    public function BlogView($id) {
        $blog = Blog::findOrFail($id);
        return view('admin.blog.blog_view', compact('blog'));
    }



    // API
    public function AllBlog () {
        $result = Blog::with('category', 'comments.replies.replies')->orderBy('id', 'DESC')->get();
        return $result;
    }

    public function BlogDetails ($id) {
        $result = Blog::with('category', 'comments.replies.replies')->findOrFail($id);
        return $result;
    }
}
