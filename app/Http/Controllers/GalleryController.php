<?php

namespace App\Http\Controllers;

use App\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $gallery = Gallery::latest('updated_at')->byUser()->get();

        return view('pages.gallery',compact('gallery'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['user_id'] = Auth::user()->id;

        $img = $request->file('img');

        $request['image'] = $request['user_id'].'_'.time().'.'.$img->getClientOriginalExtension();

        $this->upload_pic($img , $request);

        $path = config('path.gallery_image').$request['user_id'];

        Gallery::create($request->all());

        return redirect('gallery');
    }

    /**
     * Display the specified resource.
     *
     * @param  Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        if ($gallery->user_id == Auth::user()->id)
//            dd($gallery);
            return view('gallery', compact('gallery'));
        else
            return redirect('gallery');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        if ($gallery->user_id == Auth::user()->id)
            return view('$galleryEdit', compact('$gallery'));
        else
            return redirect('$gallery');
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $gallery)
    {
        $img = $request->file('img');

        $request['user_id'] = Auth::user()->id;

        if($img->getBasename() != $gallery->image){

            $request['image'] = $request['user_id'].'_'.time().'.'.$img->getClientOriginalExtension();
            $this->upload_pic($img , $request);
        }
        $gallery->update($request->all());

        return redirect()->route('$gallery.show', $gallery->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function upload_pic($img , $request)
    {
        $path = config('path.gallery_image').$request['user_id'];

        if(!File::exists($path)) {
            File::makeDirectory($path, $mode = 0777, true, true);
        }

        Image::make($img)->fit(200, 200)->save($path."/".$request['image']);
    }
}
