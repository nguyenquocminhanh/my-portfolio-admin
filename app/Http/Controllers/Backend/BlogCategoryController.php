<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use Image;

class BlogCategoryController extends Controller
{
    public function BlogCategoryAll() {
        $categories = BlogCategory::latest()->get();
        return view('admin.blog_category.blog_category_all', compact('categories'));
    }

    public function BlogCategoryAdd() {
        return view('admin.blog_category.blog_category_add');
    }

    public function BlogCategoryStore(Request $request) {
        $request->validate([
            'name' => 'unique:blog_categories',
            'image' => 'mimes:jpeg,jpg,png|required|max:10000'
        ]);

        $file = $request->file('image');
        $name_gen = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
        $img = Image::make($file);
        $img->resize(865, 576, function ($constraint) {
            $constraint->aspectRatio();
        });
        $resource = $img->stream()->detach();
        $folder = 'images/category_image/';

        $path = \Storage::disk('s3')->put(
            // location and file name to save
            $folder . $name_gen,
            // file
            $resource
        );
        $path = \Storage::disk('s3')->url($path);
    
        $image_link = 'https://'.env('AWS_BUCKET').'.s3.'.env('AWS_DEFAULT_REGION').'.amazonaws.com/'.$folder.$name_gen;

        BlogCategory::insert([
            'name' => $request->name,
            'image' => $image_link
        ]);

        $notification = array(
            'message' => 'Blog Category Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('blog.category.all')->with($notification);
    }

    public function BlogCategoryEdit($id) {
        $category = BlogCategory::findOrFail($id);
        return view('admin.blog_category.blog_category_edit', compact('category'));
    }

    public function BlogCategoryUpdate(Request $request) {
        $request->validate([
            'name' => 'unique:blog_categories,name,'.$request->blog_category_id,
            'image' => 'mimes:jpeg,jpg,png|max:10000'
        ],
        [
            'name.unique' => 'This blog category has already existed'
        ]);

        $category = BlogCategory::findOrFail($request->blog_category_id);
        $image_link = $category->image;

        if ($request->file('image')) {
            $file = $request->file('image');
            $name_gen = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $img = Image::make($file);
            $img->resize(865, 576, function ($constraint) {
                $constraint->aspectRatio();
            });
            $resource = $img->stream()->detach();
            $folder = 'images/category_image/';

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
            'message' => 'Blog Category Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('blog.category.all')->with($notification);
    }

    public function BlogCategoryDelete($id) {
        $category = BlogCategory::findOrFail($id);
       
        $category->delete();

        $notification = array(
            'message' => 'Blog Category Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('blog.category.all')->with($notification);
    }




    // API
    public function AllBlogCategory() {
        $results = BlogCategory::latest()->with('blog')->get();
        return $results;
    }

    public function AllBlogByCategory($id) {
        $results = BlogCategory::with('blog')->findOrFail($id);
        return $results;
    }
}
