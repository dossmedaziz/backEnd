<?php

namespace App\Http\Controllers;

use App\models\Paper;
use Illuminate\Http\Request;

class PaperController extends Controller
{
    // create new paper By admin
    public function create(Request $request)
    {
        $paper=Paper::create([
            'paper_file'=> $request->input('paper_file'),
            'description'=> $request->input('description'),
            'expiration_date'=> $request->input('expiration_date'),
            'auto_email' => $request->input('auto_email'),
            // 'project_id' => $request->input('project_id'),
            // 'paper_type' => $request->input('paper_type'),

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
        return response()->json(['message'=>'Deleted']) ;

    }
}
