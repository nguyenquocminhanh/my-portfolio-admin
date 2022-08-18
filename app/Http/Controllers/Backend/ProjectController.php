<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectCategory;
use Image;
use Illuminate\Support\Carbon;

class ProjectController extends Controller
{
    public function ProjectAll() {
        $projects = Project::latest()->get();
        return view('admin.project.project_all', compact('projects'));
    }

    public function ProjectAdd() {
        $categories = ProjectCategory::all();
        return view('admin.project.project_add', compact('categories'));
    }

    public function ProjectStore(Request $request) {
        $request->validate([
            'title' => 'unique:projects',
            'content' => 'required'
        ],
        [
            'content.required' => 'Project Content Required'
        ]);

        $db_image_link = null;
        $design_image_link = null;
        $thumbnail_image_link = null;
        $wallpaper_image_link = null;

        if ($request->file('db_image')) {
            $file = $request->file('db_image');
            $name_gen = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $img = Image::make($file);
            $img->resize(865, 576, function ($constraint) {
                $constraint->aspectRatio();
            });
            $resource = $img->stream()->detach();
            $folder = 'images/database/';

            $path = \Storage::disk('s3')->put(
                // location and file name to save
                $folder . $name_gen,
                // file
                $resource
            );
            $path = \Storage::disk('s3')->url($path);
        
            $db_image_link = 'https://'.env('AWS_BUCKET').'.s3.'.env('AWS_DEFAULT_REGION').'.amazonaws.com/'.$folder.$name_gen;
        }

        if ($request->file('design_image')) {
            $file = $request->file('design_image');
            $name_gen = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $img = Image::make($file);
            $img->resize(865, 576, function ($constraint) {
                $constraint->aspectRatio();
            });
            $resource = $img->stream()->detach();
            $folder = 'images/design/';

            $path = \Storage::disk('s3')->put(
                // location and file name to save
                $folder . $name_gen,
                // file
                $resource
            );
            $path = \Storage::disk('s3')->url($path);
        
            $design_image_link = 'https://'.env('AWS_BUCKET').'.s3.'.env('AWS_DEFAULT_REGION').'.amazonaws.com/'.$folder.$name_gen;
        }
 
        if ($request->file('thumbnail_image')) {
            $file = $request->file('thumbnail_image');
            $name_gen = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $img = Image::make($file);
            $img->resize(865, 576, function ($constraint) {
                $constraint->aspectRatio();
            });
            $resource = $img->stream()->detach();
            $folder = 'images/project_thumbnail/';

            $path = \Storage::disk('s3')->put(
                // location and file name to save
                $folder . $name_gen,
                // file
                $resource
            );
            $path = \Storage::disk('s3')->url($path);
        
            $thumbnail_image_link = 'https://'.env('AWS_BUCKET').'.s3.'.env('AWS_DEFAULT_REGION').'.amazonaws.com/'.$folder.$name_gen;
        }

        if ($request->file('wallpaper_image')) {
            $file = $request->file('wallpaper_image');
            $name_gen = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $img = Image::make($file);
            $img->resize(960, 440, function ($constraint) {
                $constraint->aspectRatio();
            });
            $resource = $img->stream()->detach();
            $folder = 'images/project_wallpaper/';

            $path = \Storage::disk('s3')->put(
                // location and file name to save
                $folder . $name_gen,
                // file
                $resource
            );
            $path = \Storage::disk('s3')->url($path);
        
            $wallpaper_image_link = 'https://'.env('AWS_BUCKET').'.s3.'.env('AWS_DEFAULT_REGION').'.amazonaws.com/'.$folder.$name_gen;
        }

        Project::insert([
            'title' => $request->title,
            'sub_title' => $request->sub_title,
            'category_id' => $request->category_id,
            'technologies' => $request->technologies,
            'project_link' => $request->project_link,
            'frontend_link' => $request->frontend_link,
            'backend_link' => $request->backend_link,
            'content' => $request->content,
            'client' => $request->client,
            'location' => $request->location,
            'date' => $request->date,
            'thumbnail_image' => $thumbnail_image_link,
            'thumbnail_caption' => $request->thumbnail_caption,
            'wallpaper_image' => $wallpaper_image_link,
            'db_image' => $db_image_link,
            'design_image' => $design_image_link,
            'demo_video' => $request->demo_video,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Project Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('project.all')->with($notification);
    }

    public function ProjectEdit($id) {
        $project = Project::findOrFail($id);
        $categories = ProjectCategory::all();
        return view('admin.project.project_edit', compact('project', 'categories'));
    }

    public function ProjectUpdate(Request $request) {
        $request->validate([
            'title' => 'unique:projects,title,'.$request->project_id,
            'content' => 'required'
        ],
        [
            'content.required' => 'Project Content Required'
        ]);

        $project = Project::findOrFail($request->project_id);

        $db_image_link = $project->db_image;
        $design_image_link = $project->design_image;
        $thumbnail_image_link = $project->thumbnail_image;
        $wallpaper_image_link = $project->wallpaper_image;

        if ($request->file('db_image')) {
            $file = $request->file('db_image');
            $name_gen = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $img = Image::make($file);
            $img->resize(865, 576, function ($constraint) {
                $constraint->aspectRatio();
            });
            $resource = $img->stream()->detach();
            $folder = 'images/database/';

            $path = \Storage::disk('s3')->put(
                // location and file name to save
                $folder . $name_gen,
                // file
                $resource
            );
            $path = \Storage::disk('s3')->url($path);
        
            $db_image_link = 'https://'.env('AWS_BUCKET').'.s3.'.env('AWS_DEFAULT_REGION').'.amazonaws.com/'.$folder.$name_gen;
        }

        if ($request->file('design_image')) {
            $file = $request->file('design_image');
            $name_gen = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $img = Image::make($file);
            $img->resize(865, 576, function ($constraint) {
                $constraint->aspectRatio();
            });
            $resource = $img->stream()->detach();
            $folder = 'images/design/';

            $path = \Storage::disk('s3')->put(
                // location and file name to save
                $folder . $name_gen,
                // file
                $resource
            );
            $path = \Storage::disk('s3')->url($path);
        
            $design_image_link = 'https://'.env('AWS_BUCKET').'.s3.'.env('AWS_DEFAULT_REGION').'.amazonaws.com/'.$folder.$name_gen;
        }
 
        if ($request->file('thumbnail_image')) {
            $file = $request->file('thumbnail_image');
            $name_gen = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $img = Image::make($file);
            $img->resize(865, 576, function ($constraint) {
                $constraint->aspectRatio();
            });
            $resource = $img->stream()->detach();
            $folder = 'images/project_thumbnail/';

            $path = \Storage::disk('s3')->put(
                // location and file name to save
                $folder . $name_gen,
                // file
                $resource
            );
            $path = \Storage::disk('s3')->url($path);
        
            $thumbnail_image_link = 'https://'.env('AWS_BUCKET').'.s3.'.env('AWS_DEFAULT_REGION').'.amazonaws.com/'.$folder.$name_gen;
        }

        if ($request->file('wallpaper_image')) {
            $file = $request->file('wallpaper_image');
            $name_gen = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $img = Image::make($file);
            $img->resize(960, 440, function ($constraint) {
                $constraint->aspectRatio();
            });
            $resource = $img->stream()->detach();
            $folder = 'images/project_wallpaper/';

            $path = \Storage::disk('s3')->put(
                // location and file name to save
                $folder . $name_gen,
                // file
                $resource
            );
            $path = \Storage::disk('s3')->url($path);
        
            $wallpaper_image_link = 'https://'.env('AWS_BUCKET').'.s3.'.env('AWS_DEFAULT_REGION').'.amazonaws.com/'.$folder.$name_gen;
        }

        $project->update([
            'title' => $request->title,
            'sub_title' => $request->sub_title,
            'category_id' => $request->category_id,
            'technologies' => $request->technologies,
            'project_link' => $request->project_link,
            'frontend_link' => $request->frontend_link,
            'backend_link' => $request->backend_link,
            'content' => $request->content,
            'client' => $request->client,
            'location' => $request->location,
            'date' => $request->date,
            'thumbnail_image' => $thumbnail_image_link,
            'thumbnail_caption' => $request->thumbnail_caption,
            'wallpaper_image' => $wallpaper_image_link,
            'db_image' => $db_image_link,
            'design_image' => $design_image_link,
            'demo_video' => $request->demo_video,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Project Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('project.all')->with($notification);
    }

    public function ProjectDelete($id) {
        $project = Project::findOrFail($id);
        $project->delete();

        $notification = array(
            'message' => 'Project Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('project.all')->with($notification);
    }

    public function ProjectView($id) {
        $project = Project::findOrFail($id);
        return view('admin.project.project_view', compact('project'));
    }


    // API
    public function AllProject () {
        $result = Project::with('category')->get();
        return $result;
    }

    public function ProjectDetails ($id) {
        $result = Project::with('category')->findOrFail($id);
        return $result;
    }
}
