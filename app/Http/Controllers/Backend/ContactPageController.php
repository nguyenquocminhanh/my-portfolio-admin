<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactPage;
use Image;

class ContactPageController extends Controller
{
    public function ContactPageEdit() {
        if (ContactPage::first()) {
            $contact = ContactPage::first(); 
        } else {
            $contact = null;
        }
        return view('admin.contact.contact_page_edit', compact('contact'));
    }

    public function ContactPageUpdate(Request $request) {
        if (ContactPage::first()) {             // update
            $contact = ContactPage::first(); 
            if ($request->file('cover_image')) {
                $file = $request->file('cover_image');
                $name_gen = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
                $img = Image::make($file);
                $img->resize(865, 576, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $resource = $img->stream()->detach();
                $folder = 'images/contact/page/';

                $path = \Storage::disk('s3')->put(
                    // location and file name to save
                    $folder . $name_gen,
                    // file
                    $resource
                );
                $path = \Storage::disk('s3')->url($path);
            
                $image_link = 'https://'.env('AWS_BUCKET').'.s3.'.env('AWS_DEFAULT_REGION').'.amazonaws.com/'.$folder.$name_gen;
            } else {
                $image_link = $contact->cover_image;
            }
            $contact->update([
                'description' => $request->description,
                'cover_image' => $image_link
            ]);

            $notification = array(
                'message' => 'Contact Page Updated Successfully',
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
                $folder = 'images/contact/page/';

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
            ContactPage::insert([
                'description' => $request->description,
                'cover_image' => $image_link
            ]);

            $notification = array(
                'message' => 'Contact Page Added Successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->back()->with($notification);
        }
    }


    // API
    public function GetContactData() {
        $contact_page = ContactPage::first();

        return response([
            'message' => "Get Contact Data Successfully!",
            'contact_page' => $contact_page
        ], 200);    // Success 200 code
    }
}
