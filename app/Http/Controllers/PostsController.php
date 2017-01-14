<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use File;
use App\ImageModel;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use phpDocumentor\Reflection\Types\Boolean;

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
//        $posts = Post::latest('published_at')->published()->byUser()->get();
        $posts = Auth::user()->post()->latest('updated_at')->get();
        return view('pages.post', compact('posts'));

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
     * @param  CreatePostRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        //todo : test
        $request['user_id'] = Auth::user()->id;

        $files = $request->file();

        if ($img = array_get($files, 'img')) {
            $request['image'] = $request['user_id'] . '_' . time() . '.' . $img->getClientOriginalExtension();
            $this->upload_file($img, $request, 'image', true);

        } elseif ($vid = array_get($files, 'vid')) {
            $request['video'] = $request['user_id'] . '_' . time() . '.' . $vid->getClientOriginalExtension();
            $this->upload_file($vid, $request, 'video');
        }

        if ($aud = array_get($files, 'aud')) {
            $request['audio'] = $request['user_id'] . '_' . time() . '.' . $aud->getClientOriginalExtension();
            $this->upload_file($aud, $request, 'audio');
        }
        if ($pdf = array_get($files, 'pdf')) {

            $request['pdf'] = $request['user_id'] . '_' . time() . '.' . $pdf->getClientOriginalExtension();
            $this->upload_file($pdf, $request, 'pdf');
        }

//        $store = $request->file('vid')->store($path);
//
//        var_dump($store);

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
     * @param  CreatePostRequest $request
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(CreatePostRequest $request, Post $post)
    {
        //todo : test
        $request['user_id'] = Auth::user()->id;

        $files = $request->file();

        if ($img = array_get($files, 'img')) {
            if ($img->getBasename() != $post->image) {

                $request['image'] = $request['user_id'] . '_' . time() . '.' . $img->getClientOriginalExtension();
                $this->upload_file($img, $request, 'image', true);
            }
        } elseif ($vid = array_get($files, 'vid')) {
            if ($vid->getBasename() != $post->video) {

                $request['video'] = $request['user_id'] . '_' . time() . '.' . $vid->getClientOriginalExtension();
                $this->upload_file($vid, $request, 'video');
            }
        }
        if ($aud = array_get($files, 'aud')) {
            if ($aud->getBasename() != $post->audio) {

                $request['audio'] = $request['user_id'] . '_' . time() . '.' . $aud->getClientOriginalExtension();
                $this->upload_file($aud, $request, 'audio');
            }
        }
        if ($pdf = array_get($files, 'pdf')) {
            if ($pdf->getBasename() != $post->pdf) {

                $request['pdf'] = $request['user_id'] . '_' . time() . '.' . $pdf->getClientOriginalExtension();
                $this->upload_file($pdf, $request, 'pdf');
            }
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

    /**
     * Managing all file uploads with any validated extensions.
     *
     * @param  $file
     * @param  CreatePostRequest $request
     * @param  string $file_type
     * @param  bool $is_image
     * @return void
     */
    private function upload_file($file, $request, $file_type, $is_image = false)
    {
        $path = config('path.post_' . $file_type) . $request['user_id'];

        if (!File::exists($path)) {
            File::makeDirectory($path, $mode = 0777, true, true);
        }

        if ($is_image)
            Image::make($file)->fit(200, 200)->save($path . "/" . $request['image']);
        else
            $store = $file->store($path);
    }
//
//    private function upload_video($request, $vid)
//    {
//        $path = config('path.post_video') . $request['user_id'];
//
//        $store = $vid->store($path);
//
////        dd($store);
//    }
}

