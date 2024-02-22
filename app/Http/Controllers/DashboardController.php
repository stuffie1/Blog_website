<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Categorie;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;


class DashboardController extends Controller
{
    public function users(){
        $users=User::latest()->paginate(15);
        return view('dashboard.users',['users' => $users!=[]?$users:[]]);
    }
    public function blogs(){
        $blogs = Blog::latest()->with(['user', 'categories', 'comments'])->paginate(15);
        foreach ($blogs as $blog) {
            $blog->content = Str::limit($blog->content, 50);
        }
        $categories=Categorie::all();  
        return view('dashboard.blogs',['categories' => $categories,'blogs'=>$blogs]);
    }
    public function comments(){
        $comments=Comment::latest()->with('user','blog')->paginate(15);
        foreach ($comments as $comment) {
            $comment->content = Str::limit($comment->content, 50);
            $comment->blog->title= Str::limit($comment->blog->title, 50);
        }
        return view('dashboard.comments',['comments' => $comments!=[]?$comments:[]]);
    }
    public function destroy(Request $request,$id){
        if($request->headers->get('referer')==='http://127.0.0.1:8000/dashboard/users'){
            $user=User::findOrFail($id);
            $user->delete();
        }elseif($request->headers->get('referer')==='http://127.0.0.1:8000/dashboard/blogs'){
            $blog=Blog::findOrFail($id);
            $blog->delete();
        }elseif($request->headers->get('referer')==='http://127.0.0.1:8000/dashboard/comments'){
            $comment=Comment::findOrFail($id);
            $comment->delete();
        }
        return redirect()->back();
    }
    public function show($id){
        $user=User::findOrFail($id);
        return view('profile.profile_user',['user' => $user]);
    }



    public function export() 
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

}

