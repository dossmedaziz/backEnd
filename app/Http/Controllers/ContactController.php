<?php

namespace App\Http\Controllers;

use App\models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth ;
use App\models\ActivityLog;
class ContactController extends Controller
{

            // create new Contact By admin
            public function create(Request $request)
            {
                $user_id = Auth::user()->id;
                $contact = new Contact($request->contact);
                $contact->client_id = $request->client_id;
                $contact->save();
                $activity = new ActivityLog();
                $activity->logSaver($user_id,'create','contact',$contact->id);
                return response()->json(['message'=>'created']) ;

            }




            // update Contact by user&admin
            public function update(Request $request)
            {

                $user_id = Auth::user()->id;
                $newContact = $request->newContact;
                $contact_id = $request->contact_id ;
                $contact = Contact::find($contact_id);
              $contact->update([
                    'contact_name'=> $newContact['contact_name'],
                    'contact_email'=> $newContact['contact_email'],
                    'contact_phone' => $newContact['contact_phone'],
                    'position' => $newContact['position'],
                    'description' => $newContact['description'],
            ]);
                $contact->save();
                $activity = new ActivityLog();
                $activity->logSaver($user_id,'update','contact',$contact->id);

                return response()->json('updated');
            }



            //get all Contact for admin
            public function getAllContact()
            {
                $contacts = Contact::all() ;
                return $contacts ;
            }


            // get Contact By id
            public function getContactById($id)
            {
                $contact = Contact::find($id);
                if(is_null($contact))
                {
                    return response()->json(["message"=>"Not found"]);
                }
                return $contact ;
            }


            // delete Contact by admin
            public function delete(Request $request)
            {

                $id = $request->bill_id;
                $contact = Bill::find($id) ;

                $bill->delete() ;


                return response()->json(['message'=>'Deleted']) ;

            }


}
