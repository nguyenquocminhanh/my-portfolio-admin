<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProjectCategory;
use Image;

class ProjectCategoryController extends Controller
{
    public function ProjectCategoryAll() {
        $categories = ProjectCategory::latest()->get();
        return view('admin.project_category.project_category_all', compact('categories'));
    }

    public function ProjectCategoryAdd() {
        return view('admin.project_category.project_category_add');
    }

    public function ProjectCategoryStore(Request $request) {
        $request->validate([
            'name' => 'unique:project_categories',
            'image' => 'mimes:jpeg,jpg,png|required|max:10000'
        ]);

        $file = $request->file('image');
        $name_gen = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
        $img = Image::make($file);
        $img->resize(865, 576, function ($constraint) {
            $constraint->aspectRatio();
        });
        $resource = $img->stream()->detach();
        $folder = 'images/project_category_image/';

        $path = \Storage::disk('s3')->put(
            // location and file name to save
            $folder . $name_gen,
            // file
            $resource
        );
        $path = \Storage::disk('s3')->url($path);
    
        $image_link = 'https://'.env('AWS_BUCKET').'.s3.'.env('AWS_DEFAULT_REGION').'.amazonaws.com/'.$folder.$name_gen;

        ProjectCategory::insert([
            'name' => $request->name,
            'image' => $image_link
        ]);

        $notification = array(
            'message' => 'Project Category Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('project.category.all')->with($notification);
    }

    public function ProjectCategoryEdit($id) {
        $category = ProjectCategory::findOrFail($id);
        return view('admin.project_category.project_category_edit', compact('category'));
    }

    public function ProjectCategoryUpdate(Request $request) {
        $request->validate([
            'name' => 'unique:project_categories,name,'.$request->project_category_id,
            'image' => 'mimes:jpeg,jpg,png|max:10000'
        ],
        [
            'name.unique' => 'This project category has already existed'
        ]);

        $category = ProjectCategory::findOrFail($request->project_category_id);
        $image_link = $category->image;

        if ($request->file('image')) {
            $file = $request->file('image');
            $name_gen = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $img = Image::make($file);
            $img->resize(865, 576, function ($constraint) {
                $constraint->aspectRatio();
            });
            $resource = $img->stream()->detach();
            $folder = 'images/project_category_image/';

            $path = \Storage::disk('s3')->put(
                // location and file name to save
                $folder . $name_gen,
                // file
                $resource
            );
            $path = \Storage::disk('s3')->url($path);
        
            $image_link = 'https://'.env('AWS_BUCKET').'.s3.'.env('AWS_DEFAULT_REGION').'.amazonaws.com/'.$folder.$name_gen;
        }

        $category->update([
            'name' => $request->name,
            'image' => $image_link
        ]);
        
        $notification = array(
            'message' => 'Project Category Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('project.category.all')->with($notification);
    }

    public function ProjectCategoryDelete($id) {
        $category = ProjectCategory::findOrFail($id);
       
        $category->delete();

        $notification = array(
            'message' => 'Project Category Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('project.category.all')->with($notification);
    }




    // API
    public function AllProjectCategory() {
        $results = ProjectCategory::latest()->with('project')->get();
        return $results;
    }

    public function AllProjectByCategory($id) {
        $results = ProjectCategory::with('project')->findOrFail($id);
        return $results;
    }
}
