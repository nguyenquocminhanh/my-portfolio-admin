<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Skill;
use App\Models\ProgrammingLanguage;
use App\Models\Education;
use App\Models\Award;
use App\Models\Experience;
use App\Models\AboutMe;
use App\Models\Highlight;
use Image;

class SkillController extends Controller
{
    public function SkillAll() {
        $skills = Skill::latest()->get();
        return view('admin.skill.skill_all', compact('skills'));
    }

    public function SkillAdd() {
        return view('admin.skill.skill_add');
    }

    public function SkillStore(Request $request) {
        Skill::insert([
            'name' => $request->name,
            'percentage' => $request->percentage
        ]);

        $notification = array(
            'message' => 'Skill Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('skill.all')->with($notification);
    }

    public function SkillEdit($id) {
        $skill = Skill::findOrFail($id);
        return view('admin.skill.skill_edit', compact('skill'));
    }

    public function SkillUpdate(Request $request) {
        $skill = Skill::findOrFail($request->skill_id);

        $skill->update([
            'name' => $request->name,
            'percentage' => $request->percentage
        ]);

        $notification = array(
            'message' => 'Skill Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('skill.all')->with($notification);
    }

    public function SkillDelete($id) {
        $skill = Skill::findOrFail($id);

        $skill->delete();
        $notification = array(
            'message' => 'Skill Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('skill.all')->with($notification);
    }



    public function ProgrammingLanguageAll() {
        $languages = ProgrammingLanguage::latest()->get();
        return view('admin.skill.programming_language_all', compact('languages'));
    }

    public function ProgrammingLanguageAdd() {
        return view('admin.skill.programming_language_add');
    }

    public function ProgrammingLanguageStore(Request $request) {
        ProgrammingLanguage::insert([
            'name' => $request->name,
        ]);

        $notification = array(
            'message' => 'Programming Language Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('programming_language.all')->with($notification);
    }

    public function ProgrammingLanguageEdit($id) {
        $language = ProgrammingLanguage::findOrFail($id);
        return view('admin.skill.programming_language_edit', compact('language'));
    }

    public function ProgrammingLanguageUpdate(Request $request) {
        $language = ProgrammingLanguage::findOrFail($request->programming_language_id);

        $language->update([
            'name' => $request->name,
        ]);

        $notification = array(
            'message' => 'Programming Language Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('programming_language.all')->with($notification);
    }

    public function ProgrammingLanguageDelete($id) {
        $language = ProgrammingLanguage::findOrFail($id);

        $language->delete();
        $notification = array(
            'message' => 'Programming Language Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('programming_language.all')->with($notification);
    }




    public function EducationAll() {
        $educations = Education::latest()->get();
        return view('admin.skill.education_all', compact('educations'));
    }

    public function EducationAdd() {
        return view('admin.skill.education_add');
    }

    public function EducationStore(Request $request) {
        Education::insert([
            'school' => $request->school,
            'description' => $request->description
        ]);

        $notification = array(
            'message' => 'Education Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('education.all')->with($notification);
    }

    public function EducationEdit($id) {
        $education = Education::findOrFail($id);
        return view('admin.skill.education_edit', compact('education'));
    }

    public function EducationUpdate(Request $request) {
        $education = Education::findOrFail($request->education_id);

        $education->update([
            'school' => $request->school,
            'description' => $request->description
        ]);

        $notification = array(
            'message' => 'Education Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('education.all')->with($notification);
    }

    public function EducationDelete($id) {
        $education = Education::findOrFail($id);

        $education->delete();
        $notification = array(
            'message' => 'Education Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('education.all')->with($notification);
    }




    public function AwardAll() {
        $awards = Award::latest()->get();
        return view('admin.skill.award_all', compact('awards'));
    }

    public function AwardAdd() {
        return view('admin.skill.award_add');
    }

    public function AwardStore(Request $request) {
        Award::insert([
            'name' => $request->name,
            'description' => $request->description
        ]);

        $notification = array(
            'message' => 'Award Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('award.all')->with($notification);
    }

    public function AwardEdit($id) {
        $award = Award::findOrFail($id);
        return view('admin.skill.award_edit', compact('award'));
    }

    public function AwardUpdate(Request $request) {
        $award = Award::findOrFail($request->award_id);

        $award->update([
            'name' => $request->name,
            'description' => $request->description
        ]);

        $notification = array(
            'message' => 'Award Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('award.all')->with($notification);
    }

    public function AwardDelete($id) {
        $award = Award::findOrFail($id);

        $award->delete();
        $notification = array(
            'message' => 'Award Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('award.all')->with($notification);
    }




    public function ExperienceAll() {
        $experiences = Experience::latest()->get();
        return view('admin.skill.experience_all', compact('experiences'));
    }

    public function ExperienceAdd() {
        return view('admin.skill.experience_add');
    }

    public function ExperienceStore(Request $request) {
        Experience::insert([
            'position' => $request->position,
            'duration' => $request->duration,
            'description' => $request->description
        ]);

        $notification = array(
            'message' => 'Experience Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('experience.all')->with($notification);
    }

    public function ExperienceEdit($id) {
        $experience = Experience::findOrFail($id);
        return view('admin.skill.experience_edit', compact('experience'));
    }

    public function ExperienceUpdate(Request $request) {
        $experience = Experience::findOrFail($request->experience_id);

        $experience->update([
            'position' => $request->position,
            'duration' => $request->duration,
            'description' => $request->description
        ]);

        $notification = array(
            'message' => 'Experience Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('experience.all')->with($notification);
    }

    public function ExperienceDelete($id) {
        $experience = Experience::findOrFail($id);

        $experience->delete();
        $notification = array(
            'message' => 'Experience Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('experience.all')->with($notification);
    }



    public function AboutEdit() {
        if (AboutMe::first()) {
            $about = AboutMe::first(); 
        } else {
            $about = null;
        }
        return view('admin.skill.about_edit', compact('about'));
    }

    public function AboutUpdate(Request $request) {
        if (AboutMe::first()) {             // update
            $about = AboutMe::first(); 
            if ($request->file('image')) {
                $file = $request->file('image');
                $name_gen = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
                $img = Image::make($file);
                $img->resize(700, 1050, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $resource = $img->stream()->detach();
                $folder = 'images/about_me/';

                $path = \Storage::disk('s3')->put(
                    // location and file name to save
                    $folder . $name_gen,
                    // file
                    $resource
                );
                $path = \Storage::disk('s3')->url($path);
            
                $image_link = 'https://'.env('AWS_BUCKET').'.s3.'.env('AWS_DEFAULT_REGION').'.amazonaws.com/'.$folder.$name_gen;
            } else {
                $image_link = $about->image;
            }

            // resume
            if ($request->file('resume')) {
                \Storage::disk('s3')->delete('pdfs/resume/'. 'MinhNguyen_Resume.pdf');

                $file_resume = $request->file('resume');
                $name_gen_resume = 'MinhNguyen_Resume'.'.'.$file_resume->getClientOriginalExtension();
                // dd($file_resume);
                $folder_resume = 'pdfs/resume/';
    
                $path_resume = \Storage::disk('s3')->put(
                    // location and file name to save
                    $folder_resume . $name_gen_resume,
                    // file
                    file_get_contents($file_resume),
                );
                $path_resume = \Storage::disk('s3')->url($path_resume);
                $resume_link = 'https://'.env('AWS_BUCKET').'.s3.'.env('AWS_DEFAULT_REGION').'.amazonaws.com/'.$folder_resume.$name_gen_resume;
            } else {
                $resume_link = $about->resume;
            }

            $about->update([
                'image' => $image_link,
                'main_intro' => $request->main_intro,
                'sub_intro' => $request->sub_intro,
                'github_link' => $request->github_link,
                'linkedin_link' => $request->linkedin_link,
                'resume' => $resume_link
            ]);

            $notification = array(
                'message' => 'About Me Information Updated Successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->back()->with($notification);
        } else {                                    // add new
            $request->validate([
                'image' => 'required|mimes:jpeg,jpg,png|max:10000',
                'resume' => 'required|mimes:pdf'
            ],
            [
                'image.required' => 'Profile Image Required',
                'resume.required' => 'Resume Required.'
            ]);

            $file = $request->file('image');
            $name_gen = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $img = Image::make($file);
            $img->resize(700, 1050, function ($constraint) {
                $constraint->aspectRatio();
            });
            $resource = $img->stream()->detach();
            $folder = 'images/about_me/';

            $path = \Storage::disk('s3')->put(
                // location and file name to save
                $folder . $name_gen,
                // file
                $resource
            );
            $path = \Storage::disk('s3')->url($path);
        
            $image_link = 'https://'.env('AWS_BUCKET').'.s3.'.env('AWS_DEFAULT_REGION').'.amazonaws.com/'.$folder.$name_gen;

            // resume

            $file_resume = $request->file('resume');
            $name_gen_resume = 'MinhNguyen_Resume'.'.'.$file_resume->getClientOriginalExtension();
            $folder_resume = 'pdfs/resume/';

            $path_resume = \Storage::disk('s3')->put(
                // location and file name to save
                $folder_resume . $name_gen_resume,
                // file
                file_get_contents($file_resume),
            );
            $path_resume = \Storage::disk('s3')->url($path_resume);
            $resume_link = 'https://'.env('AWS_BUCKET').'.s3.'.env('AWS_DEFAULT_REGION').'.amazonaws.com/'.$folder_resume.$name_gen_resume;

            AboutMe::insert([
                'image' => $image_link,
                'main_intro' => $request->main_intro,
                'sub_intro' => $request->sub_intro,
                'github_link' => $request->github_link,
                'linkedin_link' => $request->linkedin_link,
                'resume' => $resume_link
            ]);

            $notification = array(
                'message' => 'About Me Information Added Successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->back()->with($notification);
        }
    }




    public function HighlightAll() {
        $highlights = Highlight::latest()->get();
        return view('admin.skill.highlight_all', compact('highlights'));
    }

    public function HighlightAdd() {
        return view('admin.skill.highlight_add');
    }

    public function HighlightStore(Request $request) {
        Highlight::insert([
            'name' => $request->name,
            'amount' => $request->amount
        ]);

        $notification = array(
            'message' => 'Highlight Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('highlight.all')->with($notification);
    }

    public function HighlightEdit($id) {
        $highlight = Highlight::findOrFail($id);
        return view('admin.skill.highlight_edit', compact('highlight'));
    }

    public function HighlightUpdate(Request $request) {
        $highlight = Highlight::findOrFail($request->highlight_id);

        $highlight->update([
            'name' => $request->name,
            'amount' => $request->amount
        ]);

        $notification = array(
            'message' => 'Highlight Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('highlight.all')->with($notification);
    }

    public function HighlightDelete($id) {
        $highlight = Highlight::findOrFail($id);

        $highlight->delete();
        $notification = array(
            'message' => 'Highlight Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('highlight.all')->with($notification);
    }



    // API
    public function AllSkill() {
        $skills = Skill::latest()->get();
        $languages = ProgrammingLanguage::latest()->get();
        $edus = Education::latest()->get();
        $awards = Award::latest()->get();
        $experiences = Experience::latest()->get();
        return response([
            'message' => 'Get Skills Data Successfully!',
            'skills' => $skills,
            'programming_languages' => $languages,
            'educations' => $edus,
            'awards' => $awards,
            'experiences' => $experiences
        ], 200);
    }


    public function AllAbout() {
        $about = AboutMe::first();
        $highlights = Highlight::latest()->get();
        return response([
            'message' => 'Get About Data Successfully!',
            'about_me' => $about,
            'highlights' => $highlights,
        ], 200);
    }
}
