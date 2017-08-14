<?php

namespace App\Http\Controllers\Api;

use App\Cover;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use JWTAuth;
use Response;

class ApiPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $statusCode = 200;
            $response = [
                'posts' => []
            ];

            $token = JWTAuth::getToken();
            $used_id = JWTAuth::getPayload($token)->get('app_id');

            $posts = Post::latest('updated_at')->byId($used_id)->get();

            foreach ($posts as $post) {

                $response['posts'][] = [
                    'id' => $post->id,
//                    'user_id' => $photo->user()->get(),
                    'image_url' => config('path.post_image') . $used_id . "/" . $post->image,
                    'video_url' => config('path.post_video') . $used_id . "/" . $post->video,
                    'audio_url' => config('path.post_audio') . $used_id . "/" . $post->audio,
                    'pdf_url' => config('path.post_pdf') . $used_id . "/" . $post->pdf,
                    'link' => $post->link,
                    'title' => $post->title,
                    'description' => $post->description,
                    'publish_time' => $post->published_at,
                    'update_time' => $post->updated_at,
                ];
            }
            $cover = Cover::post()->byId($used_id)->latest()->first();
            $response['cover'] = config('path.post_cover') . $used_id . "/" .$cover->image;

        } catch (Exception $e) {
            $response = [
                "error" => "something went wrong."
            ];
            $statusCode = 400;
        } finally {
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
}
