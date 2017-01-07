<?php

namespace App\Http\Controllers\Api;

use App\Gallery;
use App\Http\Controllers\Controller;
use Response;
use Exception;
use JWTAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Tymon\JWTAuth\Exceptions\JWTException;

class ApiGalleryController extends Controller
{

    public function index()
    {

        try {
            $statusCode = 200;
            $response = [
                'photos'  => []
            ];

            $token = JWTAuth::getToken();
            $used_id = JWTAuth::getPayload($token)->get('app_id');

            $gallery = Gallery::latest('updated_at')->byId($used_id)->get();

            foreach($gallery as $photo){

                if($photo->image)
                    $url = config('path.gallery_image').$used_id."/".$photo->image;
                else
                    $url = config('path.gallery_image').$used_id."/".$photo->video;
                $response['photos'][] = [
                    'id' => $photo->id,
//                    'user_id' => $photo->user()->get(),
                    'url' => $url,
//                    'title' => $photo->title,
                    'description' => $photo->description,
//                    'category' => $photo->category,
                ];
            }

//            return Response::json(compact('gallery'));
        } catch (Exception $e) {
//            var_dump($e->getCode());
//            $statusCode = $e->getCode();
            $response = [
                "error" => "something went wrong."
            ];
            $statusCode = 400;
            // something went wrong whilst attempting to encode the token
//            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        finally{
            return Response::json($response, $statusCode);
        }
//        return response()->json([$gallery, 200]);
    }


    /**
     * Display the specified resource.
     *
     * @param  Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        try{
            $photo = $gallery;
            $statusCode = 200;
            $response = [ "photo" => [
                'id' => (int) $photo->id,
                'user_id' => (int) $photo->user_id,
//                'title' => $photo->title,
//                'url' => $photo->url,
                'description' => $photo->description
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
//
//    /**
//     * Store a newly created resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @return \Illuminate\Http\Response
//     */
//    public function store(Request $request)
//    {
//        $request['user_id'] = Auth::user()->id;
//
//        $img = $request->file('img');
//
//        $request['image'] = $request['user_id'].'_'.time().'.'.$img->getClientOriginalExtension();
//
//        $this->upload_pic($img , $request);
//
//        $path = config('path.gallery_image').$request['user_id'];
//
//        Gallery::create($request->all());
//
//        return redirect('gallery');
//    }
//
//    /**
//     * Display the specified resource.
//     *
//     * @param  Gallery  $gallery
//     * @return \Illuminate\Http\Response
//     */
//    public function show(Gallery $gallery)
//    {
//        if ($gallery->user_id == Auth::user()->id)
////            dd($gallery);
//            return view('gallery', compact('gallery'));
//        else
//            return redirect('gallery');
//    }
//
//    /**
//     * Show the form for editing the specified resource.
//     *
//     * @param  Gallery  $gallery
//     * @return \Illuminate\Http\Response
//     */
//    public function edit(Gallery $gallery)
//    {
//        if ($gallery->user_id == Auth::user()->id)
//            return view('$galleryEdit', compact('$gallery'));
//        else
//            return redirect('$gallery');
//        //
//    }
//
//    /**
//     * Update the specified resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @param  Gallery  $gallery
//     * @return \Illuminate\Http\Response
//     */
//    public function update(Request $request, Gallery $gallery)
//    {
//        $img = $request->file('img');
//
//        $request['user_id'] = Auth::user()->id;
//
//        if($img->getBasename() != $gallery->image){
//
//            $request['image'] = $request['user_id'].'_'.time().'.'.$img->getClientOriginalExtension();
//            $this->upload_pic($img , $request);
//        }
//        $gallery->update($request->all());
//
//        return redirect()->route('$gallery.show', $gallery->id);
//    }
//
//    /**
//     * Remove the specified resource from storage.
//     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function destroy($id)
//    {
//        //
//    }
//
//    private function upload_pic($img , $request)
//    {
//        $path = config('path.gallery_image').$request['user_id'];
//
//        if(!File::exists($path)) {
//            File::makeDirectory($path, $mode = 0777, true, true);
//        }
//
//        Image::make($img)->fit(200, 200)->save($path."/".$request['image']);
//    }
}
