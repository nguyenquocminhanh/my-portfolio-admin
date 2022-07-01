<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutPage;
use Image;

class AboutPageController extends Controller
{
    public function AboutPageEdit() {
        if (AboutPage::first()) {
            $about = AboutPage::first(); 
        } else {
            $about = null;
        }
        return view('admin.about.about_page_edit', compact('about'));
    }

    public function AboutPageUpdate(Request $request) {
        if (AboutPage::first()) {             // update
            $about = AboutPage::first(); 
            if ($request->file('cover_image')) {
                $file = $request->file('cover_image');
                $name_gen = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
                $img = Image::make($file);
                $img->resize(865, 576, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $resource = $img->stream()->detach();
                $folder = 'images/about/page/';

                $path = \Storage::disk('s3')->put(
                    // location and file name to save
                    $folder . $name_gen,
                    // file
                    $resource
                );
                $path = \Storage::disk('s3')->url($path);
            
                $image_link = 'https://'.env('AWS_BUCKET').'.s3.'.env('AWS_DEFAULT_REGION').'.amazonaws.com/'.$folder.$name_gen;
            } else {
                $image_link = $about->cover_image;
            }
            $about->update([
                'description' => $request->description,
                'cover_image' => $image_link
            ]);

            $notification = array(
                'message' => 'About Page Updated Successfully',
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
                $folder = 'images/about/page/';

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
            AboutPage::insert([
                'description' => $request->description,
                'cover_image' => $image_link
            ]);

            $notification = array(
                'message' => 'About Page Added Successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->back()->with($notification);
        }
    }

    // API
    public function GetAboutData() {
        $about_page = AboutPage::first();

        return response([
            'message' => "Get About Data Successfully!",
            'about_page' => $about_page
        ], 200);    // Success 200 code
    }
}
