<?php

namespace App\Http\Controllers;

use App\models\Bill;
use App\models\Item;
use App\models\User;
use App\models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth ;
use App\models\ActivityLog;
use Carbon\Carbon;


class BillController extends Controller
{
    // create new bill By admin
    public function create(Request $request)
    {
        $bill = new Bill($request->bill);
        $bill->billNum = $request->config['billNum'] ;
        $bill->client_id = $request->config['clientId'] ;
        $bill->fiscal_timber = $request->config['tax'] ;
        $bill->rate_tva = $request->config['tva'] ;
        $bill->save();
        $bill_id = $bill->id  ;
        $items = $request->items;
      foreach($items as $item)
      {
            $i = new Item($item);
            $i->bill_id = $bill_id ;
            $i->save();
      }

      return $bill ;
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
         $bills = Bill::with('client')->get() ;
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

     public function delete(Request $request)

     {
         $table = $request->bills_id;
         foreach ($table as $t)
         {
             $id= ($t['bill_id']);
             $bill = Bill::find($id);
             $bill->delete();

         }


         return response()->json(['message'=>'Deleted']) ;


     }

// get items of the bills
    public function test1($id)
    {
        $bill = Bill::where('id',$id)->with('item')->get();


        return response($bill);

    }


    public function selectedYear($selectedYear)
    {
        $bills = Bill::all();
        $selectedBills = array();
        foreach($bills as $bill) {
            $date = $bill->DateFacturation ;
            $myDate =Carbon::createFromFormat('Y-m-d H:i:s', $date)->year;
          if($selectedYear == $myDate)
        {
          array_push( $selectedBills,$bill);
        }
      }
return $selectedBills;
    }
}
