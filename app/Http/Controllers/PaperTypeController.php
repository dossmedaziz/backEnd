<?php

namespace App\Http\Controllers;

use App\models\PaperType;
use App\models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth ;

class PaperTypeController extends Controller
{

            // create new PaperType By admin
            public function create(Request $request)
            {
                // $paperType=PaperType::create([
                //     'paper_type'=> $request->input('paper_type'),
                //     'email_id'=> $request->input('email_id'),

                // ]);
                $id = Auth::user()->id;

                $papertype = new PaperType($request->all());
                $papertype->save();

                $activity = ActivityLog::create([
                    'user_id'=> $id,
                    'action_id'=> 1,
                    'space_id'=> 6,
                    'service_id'=> $papertype->id
                 ]);

                return response()->json(['message'=>'created']) ;
            }




            // update PaperType by user&admin
            public function update(Request $request, $id)
            {

                $user_id = Auth::user()->id;

                $paperType = PaperType::find($id) ;
                if(is_null($paperType))
                {
                    return response()->json(["message"=>"Not found"]);
                }
                $paperType->update($request->all());
                $activity = ActivityLog::create([
                    'user_id'=> $user_id,
                    'action_id'=> 3,
                    'space_id'=> 6,
                    'service_id'=> $paperType->id
                 ]);
                return response()->json('updated') ;
            }



            //get all PaperType for admin
            public function getAllpaperTypes()
            {
                $paperTypes = PaperType::all() ;
                return $paperTypes ;
            }


            // get PaperType By id
            public function getpaperTypeById($id)
            {
                $paperType = PaperType::find($id);
                if(is_null($paperType))
                {
                    return response()->json(["message"=>"Not found"]);
                }
                return $paperType ;
            }


            // delete PaperType by admin
            public function delete($id)
            {

                $user_id = Auth::user()->id;

                $paperType = PaperType::find($id) ;
                if(is_null($paperType))
                {
                    return response()->json(["message"=>"Not found"]);
                }
                $paperType->delete() ;
                $activity = ActivityLog::create([
                    'user_id'=> $user_id,
                    'action_id'=> 4,
                    'space_id'=> 6,
                    'service_id'=> $paperType->id
                 ]);
                //  PaperController::class->getProjectById()
                return response()->json(['message'=>'Deleted']) ;

            }
//get papers type
            public function getPaperofTheType($id)
    {
        $paperType = PaperType::where('id',$id)->with('paper')->get();
        return response($paperType);
    }
}
