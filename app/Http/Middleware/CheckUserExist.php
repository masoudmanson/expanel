<?php

namespace App\Http\Middleware;

use App\Exchanger;
use App\Traits\PlatformTrait;
use App\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class CheckUserExist
{
    use PlatformTrait;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->hasCookie('token'))
            $access_token = $request->cookie('token')['access'];
        elseif ($access_token = $request->bearerToken()) ;

        $result = $this->getCurrentPlatformUser($access_token);
        $platform_user = json_decode($result->getBody()->getContents());
        $id = $platform_user->result->userId;

//        if (Exchanger::findByUserId($id)->first()) {
//            $user = Exchanger::findByUserId($id)->first();
        $user = Exchanger::firstOrNew(array('userId' => $id));
        $user->userId = $id;
        $user->save();
        //todo : this is only for test, to find out if csrf-token problem is related to user session or not.
        if (Auth::check())
            return $next($request);

        Auth::login($user);

        return $next($request);
//        } else {
//
//                $redirect_uri =  $request->getRequestUri();
//
//            return redirect('/additional-info')->with(compact('redirect_uri'));
//
//        }

    }
}
