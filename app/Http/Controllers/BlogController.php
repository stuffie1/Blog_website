<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategorie;
use App\Models\Categorie;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;


class BlogController extends Controller
{
    private $blogs;
    public function __construct(){

           $this->blogs=[];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search=null;
        $categorie='all';
        $user=User::where('id',auth()->user()->id)->first();
        $followings=$user->followings()->latest()->paginate(15);
        $blogs=Blog::latest()->whereNotNull('published_at')->with(['user','categories','comments'])->paginate(10);
        foreach ($blogs as $blog) {
            $blog->content = Str::limit($blog->content, 200);
        }
        $categories=Categorie::all();

        return view('blogs.index',['blogs' => $blogs, 'categories' => $categories,'SelectedCategorie'=>$categorie,'search'=>$search,'followings'=>$followings===[]?null:$followings]);
    }
    public function filter(Request $request)
    {
        $search=null;
        $categorie=$request->categorie;
        if($categorie=="all"){
            $this->blogs=Blog::latest()->whereNotNull('published_at')->with(['user','categories','comments'])->paginate(10);
            
        }elseif($categorie!="all"){
            $this->blogs=Blog::latest()->whereNotNull('published_at')
            ->whereHas('categories', function ($query) use ($categorie) {
                $query->where('categories.id', $categorie);
            })
            ->with(['user','categories','comments'])->paginate(10);

        }
        foreach ($this->blogs as $blog) {
            $blog->content = Str::limit($blog->content, 200);
        }
        $categories=Categorie::all();

        return view('blogs.index',['blogs' => $this->blogs, 'categories' => $categories,'SelectedCategorie'=>$categorie,'search'=>$search]);
    }
    public function search(Request $request){
        $search=$request->search;
        if($search==""){
            return redirect()->route('blogs.index');
        }
        $blogs=Blog::latest()->where('title',"LIKE",'%'.$search.'%')->orWhere('content',"LIKE",'%'.$search.'%')->whereNotNull('published_at')->with(['user','categories','comments'])->paginate(10);
        foreach ($blogs as $blog) {
            $blog->content = Str::limit($blog->content, 200);
        }
        $categories=Categorie::all();

        return view('blogs.index',['blogs' =>count($blogs)!=0?$blogs:[], 'categories' => $categories,'search' => $search,'SelectedCategorie'=>null]);
    }

    
    public function create()
    {
        $categories=Categorie::all();
        return view('blogs.create', ['categories'=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' =>'required',
            'content' =>'required',
            'image' => 'image|nullable|mimes:jpeg,jpgsvg,png',
            'categorie' =>'required',
        ]);
        Blog::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $request->hasFile('image')?$request->file('image')->store('images','public'):null,
            'user_id' => auth()->user()->id,
            'published_at' => null
        ]);
        $lastBlog = Blog::latest()->first();
        BlogCategorie::create([
                'blog_id' => $lastBlog->id,
                'categorie_id' => $request->categorie
        ]);
        return redirect()->route('blogs.index');
    }

    /**
     * Display the specified resource.
     */
    public function show( $blog)
    {
        $blog=Blog::findorFail($blog);
            if($blog->published_at==null){
                   return redirect()->route('blogs.index');
            }
        
        return view('blogs.show',['blog' => $blog]);
    }


    public function download($id) {
        $blog=Blog::where('published_at',"!=",null)->where('id',$id)->first();
        
        $pdf = Pdf::loadView('blogs.pdf',['blog'=>$blog]);
     
        return $pdf->download();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $blog)
    {
  
        $blog=Blog::findorFail($blog);
        $categories=Categorie::all();
        return view('blogs.edit',['blog' => $blog,'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        //
    }
}
