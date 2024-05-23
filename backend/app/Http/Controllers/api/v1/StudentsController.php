<?php

namespace App\Http\Controllers\api\v1;

use App\Models\sports;
use App\Models\Students;
// use App\Http\Requests\v1\sportsRequest;
use App\Http\Requests\v1\UpdateStudentsRequest;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\sportsRequest;

class StudentsController extends Controller
{

    public function index()
    {
        return sports::paginate(10);
    }
    public function store(sportsRequest $request)
    {
        sports::create($request->all());

        return [
            'message'=>'Game created successfully'
        ];
    }
    public function show(Request $sports,$id)
    {
        return sports::find($id);
    }
    public function update(sports $request, sports $sports,$id)
    {
        $student= sports::find($id);
        if ($sports){
            $sports->update($request->all());
            return response()->json(['message'=>'Student update successfully!'],200);
        }else{
            return response()->json(['message'=>'Student not found'],404);
        }
    }
    public function destroy(sports $sports,$id)
    {
        $sports = sports::find($id);

        if($sports){
            $sports->delete();

            return response()->json(['message' => 'Student successfully deleted!'], 200);
        }else{
            return response()->json(['message' => 'Student not found.'], 404);
        }
    }
}
