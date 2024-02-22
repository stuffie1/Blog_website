<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function searchpage(){
        
        $suggestions = User::whereNotIn('id', function ($query)  {
            $query->select('following_id')
                  ->from('followers')
                  ->where('follower_id', auth()->user()->id);
        })
        ->where('role','!=','admin')
        ->where('id','!=', auth()->user()->id)
        ->inRandomOrder() 
        ->paginate(15); 

        return view('users.search',['msg'=>true,'suggestions'=>$suggestions!=[]?$suggestions:[]]);
    }
    public function search(Request $request){
        $request->validate([
            'search'=>'required',
        ]);
        $suggestions = User::whereNotIn('id', function ($query)  {
            $query->select('following_id')
                  ->from('followers')
                  ->where('follower_id', auth()->user()->id);
        })
        ->where('role','!=','admin')
        ->where('id','!=', auth()->user()->id)
        ->inRandomOrder() 
        ->paginate(15);
       
        $users=User::where('name','LIKE','%'.$request->search.'%')
        ->where('id','!=',auth()->user()->id)
        ->where('role','!=','admin')
        ->paginate(15);
        
        return view('users.search',['suggestions'=>$suggestions,'users'=>$users?$users:[],'msg'=>false]);
    }
    public function follow($following_id){
        
        $user=User::find($following_id);
        if(auth()->user()->followings()->where('following_id', $following_id)->exists() || $following_id==auth()->user()->id || $user->role=='admin') {
            return redirect()->back();
        }else{
        auth()->user()->followings()->attach($user);
        }
        return redirect()->back();
    }
    public function unfollow($following_id){
        $user=User::find($following_id);
        
        if(!auth()->user()->followings()->where('following_id', $following_id)->exists()  || $following_id==auth()->user()->id || $user->role=='admin'){
            return redirect()->back();
        }
        auth()->user()->followings()->detach($user);
        return redirect()->back();
    }
}
