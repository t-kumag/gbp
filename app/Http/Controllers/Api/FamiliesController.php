<?php

namespace App\Http\Controllers\Api;

use App\Children;
use App\Families;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;

use Log;
use Validator;
use DB;
use Session;

class FamiliesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function add_child(Request $request)
    {
        $validator = Validator::make($request->all(),
            ['name' => 'required|max:255',
                'name_kana' => 'required|kana|max:255',
                'birthday' => 'required|date']
        );

        if ($validator->fails()) {
            return response()->json([
                ['status' => 'NG'],
                ['errors' => $validator->errors()]
            ], 401);
        }

        $child = new Children;
        $child->name = $request->name;
        $child->name_kana = $request->name_kana;
        $child->birthday = $request->birthday;
        $child->save();

        $family = new Families;
        $family->user_id = Session::get('user_id');
        $family->child_id = $child['id'];
        $family->save();

        return Response::json([
            'status' => 'OK'
        ]);
    }
}