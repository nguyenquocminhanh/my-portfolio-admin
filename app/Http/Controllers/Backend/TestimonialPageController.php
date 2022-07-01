<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;
use App\Models\TestimonialPage;
use Image;

class TestimonialPageController extends Controller
{
    public function TestimonialPageEdit() {
        if (TestimonialPage::first()) {
            $testimonial = TestimonialPage::first(); 
        } else {
            $testimonial = null;
        }
        return view('admin.testimonial.testimonial_page_edit', compact('testimonial'));
    }

    public function TestimonialPageUpdate(Request $request) {
        if (TestimonialPage::first()) {             // update
            $testimonial = TestimonialPage::first(); 
            if ($request->file('cover_image')) {
                $file = $request->file('cover_image');
                $name_gen = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
                $img = Image::make($file);
                $img->resize(865, 576, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $resource = $img->stream()->detach();
                $folder = 'images/testimonial/page/';

                $path = \Storage::disk('s3')->put(
                    // location and file name to save
                    $folder . $name_gen,
                    // file
                    $resource
                );
                $path = \Storage::disk('s3')->url($path);
            
                $image_link = 'https://'.env('AWS_BUCKET').'.s3.'.env('AWS_DEFAULT_REGION').'.amazonaws.com/'.$folder.$name_gen;
            } else {
                $image_link = $testimonial->cover_image;
            }
            $testimonial->update([
                'description' => $request->description,
                'cover_image' => $image_link
            ]);

            $notification = array(
                'message' => 'Testimonial Page Updated Successfully',
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
                $folder = 'images/testimonial/page/';

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
            TestimonialPage::insert([
                'description' => $request->description,
                'cover_image' => $image_link
            ]);

            $notification = array(
                'message' => 'Testimonial Page Added Successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->back()->with($notification);
        }
    }



    // API
    public function GetTesttimonialData() {
        $testimonials = Testimonial::latest()->get();
        $testimonial_page = TestimonialPage::first();

        return response([
            'message' => "Get Testimonial Data Successfully!",
            'testimonials' => $testimonials,
            'testimonial_page' => $testimonial_page
        ], 200);    // Success 200 code
    }
}
