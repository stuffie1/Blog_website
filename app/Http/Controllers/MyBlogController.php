<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Str;



class MyBlogController extends Controller
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
        $filter=null;
        $search=null;
        $categorie=null;
        $blogs=Blog::where('user_id',auth()->user()->id)->with(['user','categories','comments'])->paginate(10);
        foreach ($blogs as $blog) {
            $blog->content = Str::limit($blog->content, 200);
        }
        $categories=Categorie::all();
        return view('blogs.myblogs',['blogs' => $blogs, 'categories' => $categories,'filter' => $filter,'SelectedCategorie'=>$categorie,'search'=>$search]);
    }
    public function filter(Request $request)
    {
        $filter=$request->filter;
        $categorie=$request->categorie;
        // dd($filter.$categorie);
        if($categorie=='all'){
            if($filter=='all'){

                $this->blogs=Blog::where('user_id',auth()->user()->id)->with(['user','categories','comments'])->paginate(10);

            }elseif($filter =='published'){
                $this->blogs=Blog::where('user_id',auth()->user()->id)->whereNotNull('published_at')->with(['user','categories','comments'])->paginate(10);


            }elseif($filter=='notyet'){
                $this->blogs=Blog::where('user_id',auth()->user()->id)->whereNull('published_at')->with(['user','categories','comments'])->paginate(10);
                
                
            }
        }
        elseif($categorie!="all"){
            if($filter=='all'){

                $this->blogs=Blog::where('user_id',auth()->user()->id)
                ->whereHas('categories', function ($query) use ($categorie) {
                    $query->where('categories.id', $categorie);
                })
                ->with(['user','categories','comments'])->paginate(10);

            }elseif($filter=='published'){
                $this->blogs=Blog::where('user_id',auth()->user()->id)->whereNotNull('published_at')
                ->whereHas('categories', function ($query) use ($categorie) {
                    $query->where('categories.id', $categorie);
                })
                ->with(['user','categories','comments'])->paginate(10);


            }elseif($filter=='notyet'){
                $this->blogs=Blog::where('user_id',auth()->user()->id)->where('published_at',null)
                ->whereHas('categories', function ($query) use ($categorie) {
                    $query->where('categories.id', $categorie);
                })
                ->with(['user','categories','comments'])->paginate(10);
                
                
            }
        }
        foreach ($this->blogs as $blog) {
            $blog->content = Str::limit($blog->content, 200);
        }
        $categories=Categorie::all();
        return view('blogs.myblogs',['blogs' => $this->blogs, 'categories' => $categories,'SelectedCategorie'=>$categorie,'filter' => $filter,'search' => null]);
    }
    public function search(Request $request){
        $search=$request->search;
        if($search==""){
            return redirect()->route('myblogs.index');
        }
        $blogs=Blog::latest()->where('title',"LIKE",'%'.$search.'%')
        ->orWhere('content',"LIKE",'%'.$search.'%')
        ->where('user_id',auth()->user()->id)->with(['user','categories','comments'])->paginate(10);
        foreach ($blogs as $blog) {
            $blog->content = Str::limit($blog->content, 200);
        }
        $categories=Categorie::all();

        return view('blogs.myblogs',['blogs' =>count($blogs)!=0?$blogs:[], 'categories' => $categories,'search' => $search,'SelectedCategorie'=>null,'filter'=>null]);
    }


    public function publish($id)
    {
        $blog=Blog::findOrFail($id);
        $blog->update(['published_at'=>now()]);
        return redirect()->route('myblogs.index');
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $blog=Blog::where('user_id',auth()->user()->id)->where('id',$id)->with(['user','categories','comments'])->first();
    
    return view('blogs.show',['blog' => $blog]);
    }

 


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $blog)
    {
        $request->validate([
            'title' =>'required',
            'content' =>'required',
            'image' => 'image|nullable|mimes:jpeg,jpgsvg,png',
            'oldimage'=>'required',
            'categorie' =>'required',
        ]);
        $blog=Blog::findorFail($blog);
        $blog->update([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $request->hasFile('image')?$request->file('image')->store('images','public'):$request->oldimage,

                ]);
                return redirect()->route('myblogs.show',['myblog'=>$blog]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($myblog )
    {
        $blog=Blog::findorFail($myblog);
        $blog->delete();

                return redirect()->route('myblogs.index');

        
    }
}
