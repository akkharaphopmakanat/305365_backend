<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\UserCourseActive;
use App\Models\UserData;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function activeAdd(Request $request){
        $data = ['username'=>request()->input( 'username' ),'c_id'=>request()->input( 'course_id' ),'is_complete'=>false,'video_progress'=>1];
        $user = UserCourseActive::create( $data );
        return response()->json(
            ["status"=>"Added Already"]
            );
    }
    public function activeGet(Request $request){
        $data = UserCourseActive::where("username",request()->input( 'username' ))->get();
        return response()->json(
            $data
            );
    }
    public function activeDel($courseid = null){
        $whereArray = array('username' => request()->input( 'username' ),'course_id' => $courseid);
        $result=UserCourseActive::whereArray($whereArray)->delete();
        
        return response()->json(["status"=>"Delete Already"]);
    }
    public function activeUpdate($courseid = null,$video_progess = null){
        //$whereArray = array('username' => request()->input( 'username' ),'course_id' => $courseid);
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

        //$useractive = UserCourseActive::all();
        //$course = Course::select('course_id','c_name', 'c_teacher', 'cat_id')->get();
        $course = Course::select(
            'course_id','c_name', 'c_teacher', 'cat_name'
        )
        ->get();
        $count = count($course);
        return response()->json(
            $course
            );
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function coursedetail($courseid = null)
    {
        $response = Course::where( 'course_id', $courseid)->get()->first();
        return response()->json( $response);
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
    public function myowncourse(Request $request)
    {
        $me = UserData::where( 'username', request()->input( 'username' ))->get()->first()['fullname'];
        $mycourse = Course::where('c_teacher',$me)->get();

        return response()->json($mycourse);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
