<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;
use Image;

class TestimonialController extends Controller
{
    public function TestimonialAll() {
        $testimonials = Testimonial::latest()->get();
        return view('admin.testimonial.testimonial_all', compact('testimonials'));
    }

    public function TestimonialAdd() {
        return view('admin.testimonial.testimonial_add');
    }

    public function TestimonialStore(Request $request) {
        $file = $request->file('profile_image');
        $name_gen = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
        $img = Image::make($file);
        $img->resize(200, 200, function ($constraint) {
            $constraint->aspectRatio();
        });
        $resource = $img->stream()->detach();
        $folder = 'images/testimonial/profile_image/';

        $path = \Storage::disk('s3')->put(
            // location and file name to save
            $folder . $name_gen,
            // file
            $resource
        );
        $path = \Storage::disk('s3')->url($path);
    
        $image_link = 'https://'.env('AWS_BUCKET').'.s3.'.env('AWS_DEFAULT_REGION').'.amazonaws.com/'.$folder.$name_gen;

        Testimonial::insert([
            'name' => $request->name,
            'position' => $request->position,
            'content' => $request->content,
            'profile_image' => $image_link
        ]);

        $notification = array(
            'message' => 'Testimonial Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('testimonial.all')->with($notification);
    }

    public function TestimonialEdit($id) {
        $testimonial = Testimonial::findOrFail($id);
        return view('admin.testimonial.testimonial_edit', compact('testimonial'));
    }

    public function TestimonialUpdate(Request $request) {
        $testimonial = Testimonial::findOrFail($request->testimonial_id);
        $image_link = $testimonial->profile_image;

        if ($request->file('profile_image')) {
            $file = $request->file('profile_image');
            $name_gen = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $img = Image::make($file);
            $img->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
            });
            $resource = $img->stream()->detach();
            $folder = 'images/testimonial/profile_image/';

            $path = \Storage::disk('s3')->put(
                // location and file name to save
                $folder . $name_gen,
                // file
                $resource
            );
            $path = \Storage::disk('s3')->url($path);
        
            $image_link = 'https://'.env('AWS_BUCKET').'.s3.'.env('AWS_DEFAULT_REGION').'.amazonaws.com/'.$folder.$name_gen;
        }

        $testimonial->update([
            'name' => $request->name,
            'position' => $request->position,
            'content' => $request->content,
            'profile_image' => $image_link
        ]);
        
        $notification = array(
            'message' => 'Testimonial Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('testimonial.all')->with($notification);
    }

    public function TestimonialDelete($id) {
        $testimonial = Testimonial::findOrFail($id);
       
        $testimonial->delete();

        $notification = array(
            'message' => 'Testimonial Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('testimonial.all')->with($notification);
    }
}
