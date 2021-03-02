<?php

namespace App\Http\Controllers;

use App\models\Bill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class BillController extends Controller
{
    // create new bill By admin
    public function create(Request $request)
    {
        $bill = Bill::create([
            'file'=> $request->input('file'),
            // 'email'=> $request->input('email'),
            // 'role_id'=> $request->input('role_id'),
        ]);
        return response()->json(['message'=>'created']) ;
    }

    // update bill by user&admin
    public function update(Request $request, $id)
    {
        $bill = Bill::find($id) ;
        if(is_null($bill))
        {
            return response()->json(["message"=>"Not found"]);
        }
        $bill->update($request->all());
        return response()->json('updated') ;
    }

     //get all bills for admin
     public function getAllBills()
     {
         $bills = Bill::all() ;
         return $bills ;
     }


     // get bill By id
     public function getBillById($id)
     {
         $bill = Bill::find($id);
         if(is_null($bill))
         {
             return response()->json(["message"=>"Not found"]);
         }
         return $bill ;
     }


     // delete Bill by admin
     public function delete($id)
     {
         $bill = Bill::find($id) ;
         if(is_null($bill))
         {
             return response()->json(["message"=>"Not found"]);
         }
         $bill->delete() ;
         return response()->json(['message'=>'Deleted']) ;

     }
}
