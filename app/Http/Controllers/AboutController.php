<?php

namespace App\Http\Controllers;

use App\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $about = About::byUser()->orderBy('created_at', 'desc')->first();

        return view('pages.about',compact('about'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.createAbout');
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

//        $img = $request->file('img');
//
//        $request['image'] = $request['user_id'].'_'.time().'.'.$img->getClientOriginalExtension();
//
//        $this->upload_pic($img , $request);
//
//        $path = config('path.gallery_image').$request['user_id'];

        About::create($request->all());

        return redirect('about');
    }

    /**
     * Display the specified resource.
     *
     * @param  About  $about
     * @return \Illuminate\Http\Response
     */
    public function show(About $about)
    {
        if ($about->user_id == Auth::user()->id)
//            dd($gallery);
            return view('about', compact('$about'));
        else
            return redirect('about');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  About  $about
     * @return \Illuminate\Http\Response
     */
    public function edit(About  $about)
    {
        if ( $about->user_id == Auth::user()->id)
            return view('aboutEdit', compact('$about'));
        else
            return redirect('$about');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  About  $about
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, About $about)
    {
//        $img = $request->file('img');

        $request['user_id'] = Auth::user()->id;

//        if($img->getBasename() != $about->image){
//
//            $request['image'] = $request['user_id'].'_'.time().'.'.$img->getClientOriginalExtension();
//            $this->upload_pic($img , $request);
//        }
        $about->update($request->all());

        return redirect()->route('about.show', $about->id);
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
}
