<?php

namespace App\Http\Controllers;

use App\models\Bill;
use App\models\User;
use App\models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth ;


class BillController extends Controller
{
    // create new bill By admin
    public function create(Request $request)
    {

                    $bill = new Bill($request->all());
                    $bill->save();
                    
                    return response()->json(['message'=>'created','bill'=>$bill]) ;


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



// get items of the bills 
    public function test1($id)
    {
        $bill = Bill::where('id',$id)->with('item')->get();


        return response($bill);

    }

}
