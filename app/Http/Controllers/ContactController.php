<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ContactController extends Controller
{
    // //contact page
    public function contact(){
        return view('user.main.contact');
    }

    //contact
    public function contactData(Request $request){
        $data=$this->getContactData($request);

        Contact::create($data);
         return back()->with(['createSuccess'=>'Your message sent successfully...']);

    }

    //contact page
    public function contactListPage(){
        $data=Contact::get();
        return view('admin.user.contactList',compact('data'));
    }

    //delete contact
    public function delete($id){
        Contact::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Contact list deleted..']);
    }

    //user list edit page
    public function userListEditPage(Request $request){
        $user=User::where('id',$request->id)->first();
    //    dd($user->toArray());
        return view('admin.user.userListEdit',compact('user'));
    }

    //user list delete
    public function userListDelete($id){
        User::where('id',$id)->delete();
        return back();

    }


     //user list edit
     public function userListEdit(Request $request,$id){

         $data=$this->getUserData($request);


         User::where('id',$id)->update($data);
         return redirect()->route('admin#userList')->with(['updateSuccess'=>'Account updated successfully...']);

     }
     //get user data
    private function getUserData($request){
        return[
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'gender'=>$request->gender,
            'updated_at'=>Carbon::now()

        ];
    }


    //get user data
    private function getContactData($request){
        return[
            'name'=>$request->name,
            'email'=>$request->email,
            'message'=>$request->message,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()

        ];
    }

}
