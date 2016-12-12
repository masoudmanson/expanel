<?php

namespace App\Http\Controllers;

use File;
use App\ImageModel;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
//        $this->middleware('roleCheck');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $posts = Post::latest('published_at')->published()->byUser()->get();

        return view('pages.post',compact('posts'));
//        dd($posts);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.createPost');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['user_id'] = Auth::user()->id;

        $img = $request->file('img');

        $request['image'] = $request['user_id'].'_'.time().'.'.$img->getClientOriginalExtension();

        $img = Image::make($img);

        $img->fit(200, 200);

//        $path = public_path().'/post_imgs/'.$request['user_id'];
        $path = config('path.post_image').$request['user_id'];

        if(!File::exists($path)) {
            File::makeDirectory($path, $mode = 0777, true, true);
        }

        $img->save($path."/".$request['image']);

        Post::create($request->all());

        return redirect('post');
    }

    /**
     * Display the specified resource.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        if ($post->user_id == Auth::user()->id)
//            dd($post);
            return view('post', compact('post'));
        else
            return redirect('post');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if ($post->user_id == Auth::user()->id)
            return view('postEdit', compact('post'));
        else
            return redirect('post');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $img = $request->file('img');

        if($img->getClientOriginalName() != $post->image){
            //update image
        }
        else{
            // $request['image'] = name+extention
        }
        $post->update($request->all());

        return redirect()->route('post.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($post)
    {
        //
    }
}
