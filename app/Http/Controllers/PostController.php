<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Post;
use App\PostCategories;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    private $postCategories = [];

    private function getAllCategories()
    {
        $arr = PostCategories::all();
        
        foreach ($arr as $item) {
            $id = $item['id'];
            $this->postCategories[$id] = $item['category'];
        } 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->getAllCategories();
        $posts = Post::has('category')->get();
        return view('home')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->getAllCategories();
        return view('admin.create')->with('categories', $this->postCategories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->getAllCategories();
        $this->validate($request, [
            'text'      => 'required|min:5|max:255',
            'slug'      => 'required|alpha_dash|unique:posts,slug',
            'category'  => 'required|in:'.implode(',', array_keys($this->postCategories)),
        ]);

        $post = new Post();

        $post->text = $request->text;
        $post->slug = $request->slug;
        $post->category_id = $request->category;   

        $post->save();

        $request->session()->flash('success', 'Post is successfully add!');

        return redirect()->route('admin.index'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->getAllCategories();
        $post = Post::has('category')->where('id', $id)->first();
        return view('admin.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->getAllCategories();
        $post = Post::has('category')->where('id', $id)->first();
        Session::put('slug', $post->slug);
        return view('admin.edit')->with('post', $post)->with('categories', $this->postCategories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->getAllCategories();

        if (!($request->slug == $request->session()->get('slug'))){
            $this->validate($request, [
                'slug' => 'required|alpha_dash|unique:posts,slug',
            ]);
        }

        $this->validate($request, [
            'text'      => 'required|min:5|max:255',
            'category_id'  => 'required|in:'.implode(',', array_keys($this->postCategories)),
        ]);

        $post = Post::find($id);

        $post->text = $request->text;
        $post->slug = $request->slug;
        $post->category_id = $request->category_id;   

        $post->save();

        $request->session()->flash('success', 'Post is successfully updated!');

        return redirect()->route('admin.index'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        $post->delete();

        Session::flash('success', 'Post has deleted successfully!');

        return redirect()->route('admin.index'); 
    }
}
