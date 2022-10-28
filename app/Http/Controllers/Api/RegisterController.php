<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserData;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller {
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function login( Request $request){
       if (UserData::where( 'username', request()->input( 'username' ) )->exists())
       {
            $user = UserData::where( 'username', request()->input( 'username' ))->get()->first();
            if($user['password'] == request()->input( 'password' )){
                return response()->json(['loginStatus'=>'Success','message'=>'Login Success']);
            }
            else{
                return response()->json(['loginStatus'=>'Failed','message'=>'Password incorrect']);
            }
            
       }
       else{
        return response()->json(['loginStatus'=>'Failed','message'=>'Username not found.']);
       }
    }

    public function index( Request $request ) {

        $validator = Validator::make( $request->all(), [
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
            'fullname' => 'required',
            'birthdate' => 'required' ] );

            if ( $validator->fails() ) {
                return response()->json( [ 'registerStatus'=>'Failed', 'message'=>'Please input all field' ] );
            }

            if ( UserData::where( 'username', request()->input( 'username' ) )->exists() ) {
                return response()->json( [ 'registerStatus'=>'Failed', 'message'=>'Username already exist' ] );
            } else {
                $user = UserData::create( request( [ 'username', 'email', 'password', 'fullname','birthdate' ] ) );
                return response()->json( [ 'registerStatus'=>'Success', 'message'=>'Registered' ] );
            }

        }

        /**
        * Store a newly created resource in storage.
        *
        * @param  \Illuminate\Http\Request  $request
        * @return \Illuminate\Http\Response
        */

        public function store( Request $request ) {
            //
        }

        /**
        * Display the specified resource.
        *
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */

        public function show( $id ) {
            //
        }

        /**
        * Update the specified resource in storage.
        *
        * @param  \Illuminate\Http\Request  $request
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */

        public function update( Request $request, $id ) {
            //
        }

        /**
        * Remove the specified resource from storage.
        *
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */

        public function destroy( $id ) {
            //
        }
    }
