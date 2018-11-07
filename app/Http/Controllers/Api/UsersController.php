<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Users;
use Illuminate\Http\Request;

use Log;
use Validator; 
use Response;
use DB;
use Session;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(),
            ['login_id' => 'required|unique:users|max:255',
            'password' => 'required',
            'mail' => 'required|email|max:255']
        );

        if ($validator->fails()) {
            return response()->json([
                    ['status' => 'NG'], 
                    ['errors' => $validator->errors()]
                ], 401);
        }

        $user = new Users;
        $user->login_id = $request->login_id;
        $user->password = password_hash($request->password, PASSWORD_DEFAULT);
        $user->mail = $request->mail;
        $user->save();

        return Response::json([
            'status' => 'OK'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),
            ['login_id' => 'required',
            'password' => 'required']
        );

        if ($validator->fails()) {
            return Respnose::json([
                    ['status' => 'NG'], 
                    ['errors' => $validator->errors()]
                ], 401);
        }

        $login_id = $request->input('login_id');
        $user = DB::table('users')->where('login_id', $login_id)->first();

        $result = false;
        if (!empty($user)) {
            if (password_verify($login_id, $user->password)) {
                Session::regenerate();
                Session::put('user_id', $user->id);
                $result = true;
            }
        }

        if ($result) {
            return Response::json([
                    ['status' => 'OK'],
                ]);
        } else {
            return Response::json([
                    ['status' => 'NG'], 
                    ['errors' => array("message" => array("incorrect login_id or password."))]
                ], 401);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Session::flush();

        return Response::json([
            'status' => 'OK'
        ]);
    }

//    /**
//     * Display the specified resource.
//     *
//     * @param  \App\api\Users  $users
//     * @return \Illuminate\Http\Response
//     */
//    public function forget_password()
//    {
//        //
//    }
//
//    /**
//     * Show the form for editing the specified resource.
//     *
//     * @param  \App\api\Users  $users
//     * @return \Illuminate\Http\Response
//     */
//    public function password_change(R)
//    {
//        //
//    }

    public function test(Request $request) {
        return Response::json([
            'session' => Session::all()
        ]);
    }

}
