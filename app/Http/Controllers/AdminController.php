<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //admin password change page
    public function changePasswordPage(){
        return view('admin.account.changePass');
    }

    public function changePassword(Request $request){
         $this->passwordValidationCheck($request);
        $user=User::select('password')->where('id',Auth::user()->id)->first();
        $dbPassword=$user->password;
        if(Hash::check($request->oldPassword,$dbPassword)){
            $data=[
                'password'=>Hash::make($request->newPassword)
            ];
            User::where('id',Auth::user()->id)->update($data);
            // Auth::logout();

            return back()->with(['changed'=>'your password changed successfully!!']);
        }
        return back()->with(['notmatch'=>'The old is not correct please try again']);
    }

    //detail account
    public function accountDetail(){
        return view('admin.account.accountDetail');
    }

    //edit account profile
    public function edit(){
        return view('admin.account.accountEdit');
    }

    //adminListPage
    Public function list(){
        $admin=User::when(request('key'),function($query){
                    $query->orWhere('name','like','%'.request('key').'%')
                          ->orWhere('email','like','%'.request('key').'%')
                          ->orWhere('phone','like','%'.request('key').'%')
                           ->orWhere('address','like','%'.request('key').'%')
                           ->orWhere('gender','like','%'.request('key').'%');
        })
        ->where('role','admin')->paginate(3);
        $admin->appends(request()->all());
        return view('admin.account.adminList',compact('admin'));
    }

    //adminDelete
    public function delete($id){
        User::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Admin account deleted..']);
    }

    //change Role
    public function changeRole($id){
      $account= User::where('id',$id)->first();
        return view('admin.account.changeRole',compact('account'));
    }

    //ajax admin change role
    public function ajaxChangeRole(Request $request){
        User::where('id',$request->adminId)->update([
             'role'=>$request->role
        ]);
    }

    //change role function
    public function changeRoleFun($id,Request $request){
        $data=$this->getUpdateRole($request);
     User::where('id',$id)->update($data);
      return redirect()->route('admin#list');
    }

    private function getUpdateRole($request){
        return[
           'role'=>$request->role,
        ];
    }


    //update account profile
    public function update(Request $request,$id){
       $this->checkUserData($request);
        $data=$this->getUserData($request);

        //for image upload
        if($request->hasFile('image')){
            $dbImage=User::where('id',$id)->first();
            $dbImage=$dbImage->image;

            //image delete from database for duplicate
             if($dbImage !=null){
                Storage::delete('public/'.$dbImage);
             }


            // image store in database
            $fileName=uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data['image']=$fileName;

        }
        User::where('id',$id)->update($data);
        return redirect()->route('admin#accountDetail')->with(['updateSuccess'=>'Account updated successfully...']);

    }

    //user data validation
    private function checkUserData($request){
        validator::make($request->all(),[
             'name'=>'required',
             'email'=>'required',
            'phone'=>'required',
            'address'=>'required',
            'gender'=>'required',
            'image'=>'mimes:png,jpg|file',

        ])->validate();
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

    //password validation check
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
          'oldPassword'=>'required|min:6',
          'newPassword'=>'required|min:6',
          'comfirmPassword'=>'required|min:6|same:newPassword',
        ])->validate();
    }
}
