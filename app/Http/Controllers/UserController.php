<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    
    { 
        $users = User::where('id','!=',Auth::id())->orderBy('created_at','desc')->paginate(4);
        return view('admin.users_list',[
            'users'=>$users,
        ]);
    }
    function user_delete($id){
        User::find($id)->delete();
        return back()->with('Delete','User Deleted Successfully');
    }
    function user_edit($id){
        $user = User::find($id);
        
        return view('admin.user_edit',[
            'user'=>$user,
        ]);
    }
    function user_update(Request $request,$id){
        if($request->password) {
            $request->validate([
                'password' => ['min:8'],
            ]);
            if($request->image){
                $imageName = time().'.'.$request->image->extension();

        // Public Folder
                $request->image->move(public_path('images'), $imageName);
                $user = User::where('id',$id)->update([
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'image'=>$imageName,
                    'password'=>Hash::make($request->password),
                    
                ]);
                
            }else{
                $user = User::where('id',$id)->update([
                    'name'=>$request->name,
                    'email'=>$request->email,
                    
                    'password'=>Hash::make($request->password),
                    
                ]);
                
            }
            
        }else{
            if($request->image){
                $imageName = time().'.'.$request->image->extension();

        // Public Folder
                $request->image->move(public_path('images'), $imageName);
                $user = User::where('id',$id)->update([
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'image'=>$imageName,
                    
                    
                ]);
               
            }else{
                $user = User::where('id',$id)->update([
                    'name'=>$request->name,
                    'email'=>$request->email,
                    
                    
                    
                ]);
                
            }

        }
        
        return back()->with('success','Successfully Upadted');
        
    }
    function delete_check(Request $request){
        if($request->check == Null){
            // $request->session()->put('my_name');
            // echo "Data has been added to session";
            return back()->with('Select','You Hav To Select a Checkbox');
            
        }
        else{
        foreach ($request->check as $check_user){
            User::find($check_user)->delete();
            return back()->with('Delete', 'Deleted Successfully');
        }
    }
     

    }
    function search(Request $request){
        // return gettype(User::pluck('id'));
      
        $user = User::whereDate('created_at','=',$request->name)->get();
          $ss= $user->pluck('name','email','created_at');//object
          $a=($ss->toArray());//array
           (implode(',',$a));//string
          return var_dump(json_encode($a));
        //   $as=$user->toArray();
        //   echo $as->pluck('id');
        
        
    }
}
