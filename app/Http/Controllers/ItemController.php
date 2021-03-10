<?php

namespace App\Http\Controllers;

use App\models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
      // create new item By admin
      public function create(Request $request)
      {
          $item = new Item($request->all());
          $item->save();
          return response()->json(['message'=>'created']) ;
      }




      // update item by user&admin
      public function update(Request $request, $id)
      {
          $item = Item::find($id) ;
          if(is_null($item))
          {
              return response()->json(["message"=>"Not found"]);
          }
          $item->update($request->all());
          return response()->json('updated') ;
      }



      //get all Contact for admin
      public function getAllItems()
      {
          $items = Item::all() ;
          return $items ;
      }


      // get Contact By id
      public function getItemById($id)
      {
          $item = Item::find($id);
          if(is_null($item))
          {
              return response()->json(["message"=>"Not found"]);
          }
          return $item ;
      }


      // delete Contact by admin
      public function delete($id)
      {
          $item =Item::find($id) ;
          if(is_null($item))
          {
              return response()->json(["message"=>"Not found"]);
          }
          $item->delete() ;
          return response()->json(['message'=>'Deleted']) ;

      }
}
