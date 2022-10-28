<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\UserCourseActive;
use App\Models\UserData;

class CourseController extends Controller
{

    public function activeAdd(Request $request){
        $data = ['username'=>request()->input( 'username' ),'c_id'=>request()->input( 'course_id' ),'is_complete'=>false,'video_progress'=>1];
        $user = UserCourseActive::create( $data );
        return response()->json(
            ["status"=>"Added Already"]
            );
    }
    public function activeGet(Request $request){
        $data = UserCourseActive::distinct()->where("username",request()->input( 'username' ))->get();
        $retdata = array();
        foreach($data as $a){
            $getdata = json_decode(Course::where("course_id",$a['c_id'])->get()->first());
            if($getdata != null){
                array_push($retdata ,$getdata);}
        }
        return response()->json(
            $retdata
            );
    }
    public function activeDel($courseid = null){
        $whereArray = array('username' => request()->input( 'username' ),'course_id' => $courseid);
        $result=UserCourseActive::whereArray($whereArray)->delete();
        
        return response()->json(["status"=>"Delete Already"]);
    }
    public function activeUpdate($courseid = null,$video_progess = null){
        $result=UserCourseActive::where('username' , request()->input( 'username' ))->where('c_id' , $courseid) ->update([
            'video_progess' => $video_progess
         ]);
        $result=UserCourseActive::where('username' , request()->input( 'username' ))->where('c_id' , $courseid)->get()->first()['video_progess'];
        
        return response()->json($result);
    }
    public function videoprog($courseid = null){
        $result=UserCourseActive::where('username' , request()->input( 'username' ))->where('c_id' , $courseid)->get()->first()['video_progess'];
        
        return response()->json($result);
    }


    public function index()
    {
        $course = Course::select('course_id','c_name', 'c_teacher', 'cat_name')->get();
        $count = count($course);
        return response()->json(
            $course
            );
    }

    public function coursedetail($courseid = null)
    {
        $response = Course::where( 'course_id', $courseid)->get()->first();
        return response()->json( $response);
    }
    public function myowncourse(Request $request)
    {
        $me = UserData::where( 'username', request()->input( 'username' ))->get()->first()['fullname'];
        $mycourse = Course::where('c_teacher',$me)->get();

        return response()->json($mycourse);
    }

    public function addcourse(Request $request)
    {
        $teacher = UserData::where( 'username', request()->input( 'username' ))->get()->first()['fullname'];
        $inputs = ['c_name' => request()->input( 'c_name' ),'cat_name' => request()->input( 'cat_name' ),'c_description' => request()->input( 'c_description' ),'c_teacher' => $teacher ,'c_video' => request()->input( 'c_video' )];
        $user = Course::create( $inputs );
        return response()->json( "OK");
    }

    public function delcourse($courseid = null)
    {
        $result=Course::where('course_id',$courseid)->delete();
        return response()->json(["status"=>"deleteAlready"]);
    }

}
