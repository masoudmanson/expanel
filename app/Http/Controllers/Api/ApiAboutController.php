<?php

namespace App\Http\Controllers\Api;

use App\About;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Response;
use Exception;
use Tymon\JWTAuth\Facades\JWTAuth;

class ApiAboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        try{
            $token = JWTAuth::getToken();
            $used_id = JWTAuth::getPayload($token)->get('app_id');

            $about = About::byId($used_id)->orderBy('created_at', 'desc')->first();;
            $statusCode = 200;
            $response = [ "about" => [
                'id' => (int) $about->id,
//                'user_id' => (int) $about->user_id,
//                'title' => $photo->title,
//                'url' => $photo->url,
                'description' => $about->description
            ]];

        }catch(Exception $e){
            $response = [
                "error" => "File doesn`t exists"
            ];
            $statusCode = 404;
        }finally{
            return Response::json($response, $statusCode);
        }
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
