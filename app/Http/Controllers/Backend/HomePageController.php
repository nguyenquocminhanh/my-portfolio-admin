<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomePage;
use App\Models\Testimonial;
use App\Models\Blog;
use App\Models\Project;
use App\Models\BlogCategory;
use Image;

class HomePageController extends Controller
{
    public function HomePageEdit() {
        if (HomePage::first()) {
            $home = HomePage::first(); 
        } else {
            $home = null;
        }
        return view('admin.home.home_page_edit', compact('home'));
    }

    public function HomePageUpdate(Request $request) {
        if (HomePage::first()) {             // update
            $home = HomePage::first(); 
            if ($request->file('cover_image')) {
                $file = $request->file('cover_image');
                $name_gen = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
                $img = Image::make($file);
                $img->resize(1000, 667, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $resource = $img->stream()->detach();
                $folder = 'images/home/page/';

                $path = \Storage::disk('s3')->put(
                    // location and file name to save
                    $folder . $name_gen,
                    // file
                    $resource
                );
                $path = \Storage::disk('s3')->url($path);
            
                $image_link = 'https://'.env('AWS_BUCKET').'.s3.'.env('AWS_DEFAULT_REGION').'.amazonaws.com/'.$folder.$name_gen;
            } else {
                $image_link = $home->cover_image;
            }

            if ($request->file('avatar_image')) {
                $file = $request->file('avatar_image');
                $name_gen = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
                $img = Image::make($file);
                $img->resize(150, 150, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $resource = $img->stream()->detach();
                $folder = 'images/home/page/';

                $path = \Storage::disk('s3')->put(
                    // location and file name to save
                    $folder . $name_gen,
                    // file
                    $resource
                );
                $path = \Storage::disk('s3')->url($path);
            
                $avatar_link = 'https://'.env('AWS_BUCKET').'.s3.'.env('AWS_DEFAULT_REGION').'.amazonaws.com/'.$folder.$name_gen;
            } else {
                $avatar_link = $home->avatarimage;
            }

            $home->update([
                'cover_image' => $image_link,
                'avatar_image' => $avatar_link
            ]);

            $notification = array(
                'message' => 'Home Page Updated Successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->back()->with($notification);
        } else {                                    // add new
            if ($request->file('cover_image')) {
                $file = $request->file('cover_image');
                $name_gen = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
                $img = Image::make($file);
                $img->resize(1000, 667, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $resource = $img->stream()->detach();
                $folder = 'images/home/page/';

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
            if ($request->file('avatar_image')) {
                $file = $request->file('avatar_image');
                $name_gen = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
                $img = Image::make($file);
                $img->resize(200, 200, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $resource = $img->stream()->detach();
                $folder = 'images/home/page/';

                $path = \Storage::disk('s3')->put(
                    // location and file name to save
                    $folder . $name_gen,
                    // file
                    $resource
                );
                $path = \Storage::disk('s3')->url($path);
            
                $avatar_link = 'https://'.env('AWS_BUCKET').'.s3.'.env('AWS_DEFAULT_REGION').'.amazonaws.com/'.$folder.$name_gen;
            } else {
                $avatar_link = null;
            }

            HomePage::insert([
                'cover_image' => $image_link,
                'avatar_image' => $avatar_link
            ]);

            $notification = array(
                'message' => 'Home Page Added Successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->back()->with($notification);
        }
    }


    // API
    public function GetHomeData() {
        $home_page = HomePage::first();
        $testimonials = Testimonial::latest()->get();
        $blogs = Blog::orderBy('id', 'DESC')->with('category')->get();
        $blog_categories = BlogCategory::with('blog')->get();
        $projects = Project::with('category')->get();

        return response([
            'message' => "Get Home Data Successfully!",
            'home_page' => $home_page,
            'testimonials' => $testimonials,
            'blogs' => $blogs,
            'blog_categories' => $blog_categories,
            'projects' => $projects
        ], 200);    // Success 200 code
    }
}
