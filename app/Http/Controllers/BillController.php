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
        //update bill and save it
        $bill = Bill::find($id) ;
        $bill->update($request->bill);
        $bill->save();

        //delete old items
        $bill_id = $bill->id;
        $items =  Item::where('bill_id',$bill_id)->get();
        foreach($items as $item)
        {
              $bill_id = $bill->id;
              $items = Item::where('bill_id',$bill_id)->delete();
        }

        //save new item
        $items = $request->items;
        foreach($items as $item)
        {
              $i = new Item($item);
              $i->bill_id = $bill_id ;
              $i->save();
        }
        return response()->json(['message'=>'updated']) ;
    }

     //get all bills for admin
     public function getAllBills()
     {
         $bills = Bill::with('client')->get() ;

         return response()->json(["bills"=> $bills ]);
     }


     // get bill By id
     public function getBillById($id)
        {
            $bill = Bill::find($id);
            $items= Item::where('bill_id',$id)->get();
            return response()->json(["bill"=> $bill, "items"=>$items]);
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

    //Calculate bills number
    public function calcNumBills(Request $request){
        $bills = Bill::all() ;
        $thisYearBill = array();
        $year = $request->year;
        foreach ($bills as $bill) {
        $date = Carbon::createFromFormat('Y-m-d H:i:s', $bill->DateFacturation);
        $billYear = $date->format('Y');
        if ($billYear == $year) {
            array_push($thisYearBill,$bill);
        }
        }
        return response()->json(["numBill"=>count($thisYearBill)]);
    }

}
