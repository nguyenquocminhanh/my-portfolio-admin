<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\AboutMe;
use Image;

class ContactController extends Controller
{
    public function ContactEdit() {
        if (Contact::first()) {
            $contact = Contact::first(); 
        } else {
            $contact = null;
        }
        return view('admin.contact.contact_edit', compact('contact'));
    }

    public function ContactUpdate(Request $request) {
        if (Contact::first()) {             // update
            $contact = Contact::first(); 
            if ($request->file('profile_image')) {
                $file = $request->file('profile_image');
                $name_gen = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
                $img = Image::make($file);
                $img->resize(400, 400, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $resource = $img->stream()->detach();
                $folder = 'images/contact/';

                $path = \Storage::disk('s3')->put(
                    // location and file name to save
                    $folder . $name_gen,
                    // file
                    $resource
                );
                $path = \Storage::disk('s3')->url($path);
            
                $image_link = 'https://'.env('AWS_BUCKET').'.s3.'.env('AWS_DEFAULT_REGION').'.amazonaws.com/'.$folder.$name_gen;
            } else {
                $image_link = $contact->profile_image;
            }
            $contact->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'address' => $request->address,
                'profile_image' => $image_link
            ]);

            $notification = array(
                'message' => 'Contact Information Updated Successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->back()->with($notification);
        } else {                                    // add new
            $request->validate([
                'profile_image' => 'mimes:jpeg,jpg,png|required|max:10000',
            ],
            [
                'profile_image.required' => 'Profile Image Required'
            ]);

            $file = $request->file('profile_image');
            $name_gen = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $img = Image::make($file);
            $img->resize(400, 400, function ($constraint) {
                $constraint->aspectRatio();
            });
            $resource = $img->stream()->detach();
            $folder = 'images/contact/';

            $path = \Storage::disk('s3')->put(
                // location and file name to save
                $folder . $name_gen,
                // file
                $resource
            );
            $path = \Storage::disk('s3')->url($path);
        
            $image_link = 'https://'.env('AWS_BUCKET').'.s3.'.env('AWS_DEFAULT_REGION').'.amazonaws.com/'.$folder.$name_gen;

            Contact::insert([
                'name' => $request->name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'address' => $request->address,
                'profile_image' => $image_link
            ]);

            $notification = array(
                'message' => 'Profile Information Added Successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->back()->with($notification);
        }
    }




    // API
    public function AllContact() {
        $results = Contact::first();
        $about = ABoutMe::first();
        return response([
            'contact_info' => $results,
            'links' => $about
        ], 200);
    }
}
