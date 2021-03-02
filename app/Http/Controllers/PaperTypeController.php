<?php

namespace App\Http\Controllers;

use App\models\PaperType;
use Illuminate\Http\Request;

class PaperTypeController extends Controller
{

            // create new PaperType By admin
            public function create(Request $request)
            {
                $paperType=PaperType::create([
                    'paper_name'=> $request->input('paper_name'),
                    'paper_type'=> $request->input('paper_type'),
                    // 'email_id'=> $request->input('email_id'),

                ]);
                return response()->json(['message'=>'created']) ;
            }




            // update PaperType by user&admin
            public function update(Request $request, $id)
            {
                $paperType = PaperType::find($id) ;
                if(is_null($paperType))
                {
                    return response()->json(["message"=>"Not found"]);
                }
                $paperType->update($request->all());
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
                $paperType = PaperType::find($id) ;
                if(is_null($paperType))
                {
                    return response()->json(["message"=>"Not found"]);
                }
                $paperType->delete() ;
                return response()->json(['message'=>'Deleted']) ;

            }
}
