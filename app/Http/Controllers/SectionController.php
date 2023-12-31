<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Section;
use App\Models\Student;
use App\Models\Schoolyear;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class SectionController extends Controller
{
    // Show list of grade levels according to the selected school year (default is current sy)
    public function index(Request $request) {
        $currentSchoolyear = Schoolyear::where('start_date', '<=', Carbon::today())
            ->where('end_date', '>=', Carbon::today())
            ->first();

        if (!$currentSchoolyear){
            $schoolyears = Schoolyear::where('id','!=',$request->input('sy'))->get();
            if (!$request->input('sy')){
                $selectedSchoolyear = $schoolyears->first();
                $schoolyears = Schoolyear::where('id','!=',$selectedSchoolyear->id)->get();
            } else {
                $schoolyears = Schoolyear::where('id','!=',$request->input('sy'))->get();
                $selectedSchoolyear = Schoolyear::where('id',$request->input('sy'))->first();
            }

        } else {
            $schoolyears = Schoolyear::where('id','!=',$request->input('sy', $currentSchoolyear->id))->get();
            $selectedSchoolyear = Schoolyear::where('id',$request->input('sy', $currentSchoolyear->id))->first();
        }

        $total_schoolyears = Schoolyear::all()->count();
        $sections = Section::where('schoolyear_id', $selectedSchoolyear->id)->get();

        return view('sections.index', compact('currentSchoolyear','schoolyears','selectedSchoolyear', 'sections', 'total_schoolyears'));
    }

    // Show a section
    public function show($grade_level, Section $section) {
        $students = Student::where('section_id','=',$section->id)->get();
        $schoolyears = Schoolyear::all();
        $unenrolled_students = User::where('role','=','student')->where('is_enrolled','=',0)->get();
        $unenrolled_advisers = User::where('role','=','adviser')->where('is_enrolled','=',0)->get();
        // $unenrolled_students = User::where(['role','=','student'],
        //     ['is_enrolled','=','0'],['is_deleted','=','0'])->get();
        return view('sections.show',
            compact('schoolyears','students','section','unenrolled_students','unenrolled_advisers'));
    }

    function store(Request $request){
        $formFields = $request->validate([
            'adviser_id' => ['required','exists:user,id'],
            'allStudentID' => ['required','array'],
            'allStudentID.*'  => ['required','distinct','exists:user,id'],
            'name' => ['required','max:50'],
            'grade_level' => ['required','integer','between:7,10'],
            'schoolyear_id' => ['required','exists:schoolyear,id'],
        ]);

        // this is for the section table
        $addRow = new Section;
        $addRow->name = $formFields['name'];
        $addRow->grade_level = $formFields['grade_level'];
        $addRow->adviser_id = $formFields['adviser_id'];
        $addRow->schoolyear_id = $formFields['schoolyear_id'];
        $addRow->save();

        $studentIds = $formFields['allStudentID'];

        // this is for the students
        foreach($studentIds as $studentID){
            User::where('id', $studentID)->update(['is_enrolled' => 1]);
            Student::where('user_id', $studentID)->update(['section_id' => $addRow->id]);
        }

        User::where('id', $request->adviser_id)->update(['is_enrolled' => 1]);
    }

    public function update(Request $request, Section $section) {
        $formFields = $request->validate([
            'adviser_id' => ['required','exists:user,id'],
            'name' => ['required','max:50'],
            'grade_level' => ['required','integer','between:7,10'],
            'schoolyear_id' => ['required','exists:schoolyear,id'],
        ]);

        $studentIDs = $request->validate([
            'allStudentID' => ['required','array'],
            'allStudentID.*'  => ['required','distinct','exists:user,id'],
        ]);

        $studentIDArray = $studentIDs['allStudentID'];

        $current_students = Student::where('section_id',$section->id)->get();
        foreach($current_students as $student){
            if (($key = array_search($student->user_id, $studentIDArray)) !== false) {
                unset($studentIDArray[$key]);
            } else {
                $student->section_id = null;
                User::where('id', $student->user_id)->update(['is_enrolled' => 0]);
                $student->save();
            }
        }

        // this is for the student table
        foreach($studentIDArray as $student_id){
            User::where('id', $student_id)->update(['is_enrolled' => 1]);
            Student::where('user_id', $student_id)->update(['section_id' => $section->id]);
        }

        if ($request->adviser_id != $section->adviser_id){
            User::where('id', $section->adviser_id)->update(['is_enrolled' => 0]);
            User::where('id', $request->adviser_id)->update(['is_enrolled' => 1]);
        }

        $section->update($formFields);
    }

    public function destroy(Section $section){
        // User::find($request->id)->update(['is_deleted' => 1]);
        $students = Student::where('section_id',$section->id)->get();
        foreach($students as $student){
            User::where('id', $student->user_id)->update(['is_enrolled' => 0]);
        }
        $section->delete();
        return redirect('/admin');
    }
}
