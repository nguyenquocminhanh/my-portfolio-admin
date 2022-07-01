<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Image;

class AdminController extends Controller
{
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();


        $notification = array(
            'message' => 'Logout Successfully',
            'alert-type' => 'success'
        );

        return redirect('/login')->with($notification);
    }

    public function profile() {
        $id = Auth::user()->id;
        // find theo id
        $adminData = User::find($id);

        return view('admin.admin_profile_view', compact('adminData'));
    }

    public function editProfile() {
        $id = Auth::user()->id;
        // find theo id
        $adminData = User::find($id);

        return view('admin.admin_profile_edit', compact('adminData'));
    }

    public function storeProfile(Request $request) {
        $id = Auth::user()->id;

        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->username = $request->username;

        // if ($request->file('profile_image')) {
        //     $file = $request->file('profile_image');
        //     $fileName = date('YmdHi').$file->getClientOriginalName();
        //     $file->move(public_path('upload/admin'), $fileName);
            
        // }

        if ($request->file('profile_image')) {
            $file = $request->file('profile_image');
            $name_gen = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $img = Image::make($file);
            $img->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
            });
            $resource = $img->stream()->detach();
            $folder = 'images/admin_image/';

            $path = \Storage::disk('s3')->put(
                // location and file name to save
                $folder . $name_gen,
                // file
                $resource
            );
            $path = \Storage::disk('s3')->url($path);
        
            $author_image_link = 'https://'.env('AWS_BUCKET').'.s3.'.env('AWS_DEFAULT_REGION').'.amazonaws.com/'.$folder.$name_gen;
            $data->profile_image = $author_image_link;
        }

        // save data to DB
        $data->save();
        // toaster notification
        $notification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.profile')->with($notification);
    }

    public function changePassword() {
        return view('admin.admin_change_password');
    }

    public function updatePassword(Request $request) {
        // validate method -> tra ve errors neu gap loi
        $validateData = $request->validate([
            'oldpassword' => 'required',
            'newpassword' => 'required',
            'password_confirmation' => 'required|same:newpassword',
        ]);

        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->oldpassword, $hashedPassword)) {
            $users = User::find(Auth::user()->id);
            $users->password = bcrypt($request->newpassword);
            $users->save();

            session()->flash('message', 'Password Updated Successfully');
            return redirect()->back();
        } else {
            session()->flash('message', 'Invalid Old Password');
            return redirect()->back();
        }


    }
}
