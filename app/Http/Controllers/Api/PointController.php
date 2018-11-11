<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\PointHistories;
use Illuminate\Http\Request;

use Validator;
use Session;
use Response;

class PointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add_point(Request $request)
    {
        $validator = Validator::make($request->all(),
            ['child_id' => 'required|exists:children,id|ChildUser',
                'accrual_date' => 'required|date',
                'title' => 'required|max:255',
                'detail' => 'required|max:1000',
                'point' => 'required|integer',]
        );

        if ($validator->fails()) {
            return response()->json([
                ['status' => 'NG'],
                ['errors' => $validator->errors()]
            ], 401);
        }

        $point_histories = new PointHistories;
        $point_histories->child_id = $request->child_id;
        $point_histories->accrual_date = $request->accrual_date;
        $point_histories->title = $request->title;
        $point_histories->detail = $request->detail;
        $point_histories->point = $request->point;
        $point_histories->update_user_id = Session::get('user_id');
        $point_histories->save();

        return Response::json([
            'status' => 'OK'
        ]);
    }
}
