<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProjectPage;
use App\Models\Project;
use App\Models\ProjectCategory;
use Image;

class ProjectPageController extends Controller
{
    public function ProjectPageEdit() {
        if (ProjectPage::first()) {
            $project = ProjectPage::first(); 
        } else {
            $project = null;
        }
        return view('admin.project.project_page_edit', compact('project'));
    }

    public function ProjectPageUpdate(Request $request) {
        if (ProjectPage::first()) {             // update
            $project = ProjectPage::first(); 
            if ($request->file('cover_image')) {
                $file = $request->file('cover_image');
                $name_gen = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
                $img = Image::make($file);
                $img->resize(865, 576, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $resource = $img->stream()->detach();
                $folder = 'images/project/page/';

                $path = \Storage::disk('s3')->put(
                    // location and file name to save
                    $folder . $name_gen,
                    // file
                    $resource
                );
                $path = \Storage::disk('s3')->url($path);
            
                $image_link = 'https://'.env('AWS_BUCKET').'.s3.'.env('AWS_DEFAULT_REGION').'.amazonaws.com/'.$folder.$name_gen;
            } else {
                $image_link = $project->cover_image;
            }
            $project->update([
                'description' => $request->description,
                'cover_image' => $image_link
            ]);

            $notification = array(
                'message' => 'Project Page Updated Successfully',
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
                $folder = 'images/project/page/';

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
            ProjectPage::insert([
                'description' => $request->description,
                'cover_image' => $image_link
            ]);

            $notification = array(
                'message' => 'Project Page Added Successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->back()->with($notification);
        }
    }

    // API
    public function GetProjectData() {
        $projects = Project::latest()->with('category')->get();
        $project_categories = ProjectCategory::with('project')->get();
        $project_page = ProjectPage::first();

        return response([
            'message' => "Get Project Data Successfully!",
            'projects' => $projects,
            'project_categories' => $project_categories,
            'project_page' => $project_page
        ], 200);    // Success 200 code
    }
}
