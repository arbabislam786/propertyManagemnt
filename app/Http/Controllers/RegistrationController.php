<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use App\User;

class RegistrationController  extends Controller
{
    
    public function index(Request $req){
    	return view('registration.index');
 
    }

      public function verify(Request $req){
 

       $validation = Validator::make($req->all(), [
            'username'=>'bail|required|unique:customer',
            'name'=>'required',
            'email' => 'bail|required|email|unique:customer',
            'password'=>'required',
            'confirm_password' => 'required|same:password' ,
            'number' => 'bail|required|size:11'
        ]);

        if($validation->fails()){
            return back()
                    ->with('errors', $validation->errors())
                    ->withInput();

            return redirect()->route('/registration')
                            ->with('errors', $validation->errors())
                            ->withInput();
            }

           
               else{

                if($req->hasFile('pic')){
      $file = $req->file('pic');
        $image=date('mdYHis') . uniqid() .$file->getClientOriginalName();
      if($file->move('image',$image)){


               	 $req->session()->flash('msg', 'Registration Successfully Done,Login Please');
                   DB::table('customer')->insert(
           ['username' =>$req->username, 'name'=>$req->name,'email'=>$req->email,'password'=>$req->password,  'phone'=>$req->number,'type'=>'customer','c_image'=>$image,'active_posts'=>'0','pending_posts'=>'0','sold_posts'=>'0','total_posts'=>'0' ]
            );
                   return redirect()->route('login.index');
               }
               else{
        return redirect()->route('login.index ');
      }
             
             }
             else{
      echo "File not found!";
    }


              }
          
            
     }     



}