<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateGalleryRequest;
use File;
use App\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;

class GalleryController extends Controller
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
//        $gallery = Gallery::latest('updated_at')->byUser()->get();
        $gallery = $user = Auth::user()->gallery()->latest('updated_at')->get();
        return view('pages.gallery', compact('gallery'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.createGallery');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateGalleryRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateGalleryRequest $request)
    {
        $request['user_id'] = Auth::user()->id;

        if (Input::file('img')) {
            $img = $request->file('img');

            $request['image'] = $request['user_id'] . '_' . time() . '.' . $img->getClientOriginalExtension();

            $this->upload_file($img, $request,'image',true);
        } else {
            $vid = $request->file('vid');
            $request['video'] = $request['user_id'] . '_' . time() . '.' . $vid->getClientOriginalExtension();
            $this->upload_video($request, $vid,'video');
        }

        Gallery::create($request->all());

        return redirect('gallery');
    }

    /**
     * Display the specified resource.
     *
     * @param  Gallery $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        if ($gallery->user_id == Auth::user()->id)
            return view('gallery', compact('gallery'));
        else
            return redirect('gallery');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Gallery $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        if ($gallery->user_id == Auth::user()->id)
            return view('galleryEdit', compact('$gallery'));
        else
            return redirect('$gallery');
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CreateGalleryRequest $request
     * @param  Gallery $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(CreateGalleryRequest $request, Gallery $gallery)
    {
        //todo : test
        $request['user_id'] = Auth::user()->id;

        $files = $request->file();

        if ($img = array_get($files, 'img')) {
            if ($img->getBasename() != $gallery->image) {

                $request['image'] = $request['user_id'] . '_' . time() . '.' . $img->getClientOriginalExtension();
                $this->upload_file($img, $request, 'image', true);
            }
        } elseif ($vid = array_get($files, 'vid')) {
            if ($vid->getBasename() != $gallery->video) {

                $request['video'] = $request['user_id'] . '_' . time() . '.' . $img->getClientOriginalExtension();
                $this->upload_file($vid, $request, 'video');
            }
        }

        $gallery->update($request->all());

        return redirect()->route('$gallery.show', $gallery->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function upload_file($file, $request, $file_type, $is_image = false)
    {
        $path = config('path.gallery_' . $file_type) . $request['user_id'];

        if (!File::exists($path)) {
            File::makeDirectory($path, $mode = 0777, true, true);
        }

        if ($is_image)
            Image::make($file)->fit(200, 200)->save($path . "/" . $request['image']);
        else
            $store = $file->store($path);
    }

//    private function upload_video($request , $vid)
//    {
//        $path = config('path.gallery_video') . $request['user_id'];
//
//        $store = $vid->store($path);
//
////        dd($store);
//    }
}
