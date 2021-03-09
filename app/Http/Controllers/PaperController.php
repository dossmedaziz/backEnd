<?php

namespace App\Http\Controllers;

use App\models\PaperType;
use App\models\Paper;
use App\models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth ;

class PaperController extends Controller
{
    // create new paper By admin
    public function create(Request $request)
    {
        $id = Auth::user()->id;

        $paper = new Paper($request->all());
        $paper->save();

        $activity = ActivityLog::create([
            'user_id'=> $id,
            'action_id'=> 1,
            'space_id'=> 4,
            'service_id'=> $paper->id
         ]);
        return response()->json(['message'=>'created']) ;
    }




    // update paper by user&admin
    public function update(Request $request, $id)
    {
        $paper = Paper::find($id) ;
        if(is_null($paper))
        {
            return response()->json(["message"=>"Not found"]);
        }
        $paper->update($request->all());
        $activity = ActivityLog::create([
            'user_id'=> $id,
            'action_id'=> 3,
            'space_id'=> 4,
            'service_id'=> $paper->id
         ]);
        return response()->json('updated') ;
    }



    //get all papers for admin
    public function getAllPapers()
    {
        $papers = Paper::all() ;
        return $papers ;
    }


    // get Paper By id
    public function getPaperById($id)
    {
        $paper = Paper::find($id);
        if(is_null($paper))
        {
            return response()->json(["message"=>"Not found"]);
        }
        return $paper ;
    }


    // delete paper by admin
    public function delete($id)
    {
        $paper = Paper::find($id) ;
        if(is_null($paper))
        {
            return response()->json(["message"=>"Not found"]);
        }
        $paper->delete() ;
        $activity = ActivityLog::create([
            'user_id'=> $id,
            'action_id'=> 4,
            'space_id'=> 4,
            'service_id'=> $paper->id
         ]);
        return response()->json(['message'=>'Deleted']) ;

    }

//get type of the paper
    public function getTypeofThePaper($id)
    {
        $paper = Paper::where('id',$id)->with('paperType')->get();
        return response($paper);
    }
}
