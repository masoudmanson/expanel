<?php

namespace App\Http\Controllers;

use File;
use App\Cover;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $covers = Cover::latest('updated_at')->byUser()->get();

        return view('cover',compact('covers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.createCover');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['user_id'] = Auth::user()->id;

        $img = $request->file('img');

        $request['image'] = $request['user_id'] . '_' . time() . '.' . $img->getClientOriginalExtension();

        $this->upload_file($img, $request,'image',true);


        Cover::create($request->all());

        return redirect('cover');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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

    /**
     * Managing all file uploads with any validated extensions.
     *
     * @param  $file
     * @param  Request $request
     * @param  string $file_type
     * @param  bool $is_image
     * @return void
     */
    private function upload_file($file, $request, $file_type ,$is_image = false )
    {
        $path = config('path.client_'.$file_type) . $request['user_id'];

        if (!File::exists($path)) {
            File::makeDirectory($path, $mode = 0777, true, true);
        }

        if ($is_image)
            Image::make($file)->fit(200, 200)->save($path . "/" . $request['image']);
        else
            $store = $file->store($path);
    }
}
