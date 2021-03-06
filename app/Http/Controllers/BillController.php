<?php

namespace App\Http\Controllers;

use App\models\Bill;
use App\models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth ;


class BillController extends Controller
{
    // create new bill By admin
    public function create(Request $request)
    {
        $role_id = Auth::user()->role_id ;
        if($role_id == 2)
                {
                    $bill = Bill::create([
                    'file'=> $request->input('file'),
                        //     // 'email'=> $request->input('email'),
                        //     // 'role_id'=> $request->input('role_id'),
                         ]);
                    return response()->json(['message'=>'created','bill'=>$bill]) ;
                }else{
                    return response()->json(["message"=>"unauthorized"]);
                }
    }

    // update bill by user&admin
    public function update(Request $request, $id)
    {
        $role_id = Auth::user()->role_id ;
        if($role_id == 2)
    {
        $bill = Bill::find($id) ;
        if(is_null($bill))
        {
            return response()->json(["message"=>"Not found"]);
        }
        $bill->update($request->all());
        return response()->json('updated') ;
    }else{
        return response()->json(["message"=>"unauthorized"]);
    }

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
        $role_id = Auth::user()->role_id ;
        if($role_id == 2)
    {
         $bill = Bill::find($id) ;
         if(is_null($bill))
         {
             return response()->json(["message"=>"Not found"]);
         }
         $bill->delete() ;
         return response()->json(['message'=>'Deleted']) ;
        }else{
            return response()->json(["message"=>"unauthorized"]);
        }

     }
}
