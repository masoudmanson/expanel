<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Menu;
use App\User;
use Illuminate\Http\Request;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

//use App\Http\Requests;

class AuthController extends Controller
{
    public function authenticate(Request $request)
    {
        // grab credentials from the request
        $credentials = $request->only('email', 'password');
        $customClaim['app_id'] = $request['user_id'];
        try {
            /*
             *additional custom part
             */

            $user = User::isSuperUser()->find($customClaim['app_id']);
//            return response()->json(['user'=>$user]);

            if (!$user) {
                return response()->json(['error' => 'data_not_found'], 404);
            }
            /*
             *
             */

            // attempt to verify the credentials and create a token for the user
            if (!$token = JWTAuth::attempt($credentials, $customClaim)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }

        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

//        return response()->json(['user'=>JWTAuth::getPayload($token)->get('app_id')]);

        $used_id = JWTAuth::getPayload($token)->get('app_id');
        $user = JWTAuth::toUser($token);

        $previous_used_id = array();
        if ($user->used_id) {

            $previous_used_id = json_decode($user->used_id, true);

        }

        if (!in_array($used_id, $previous_used_id)) {

            array_push($previous_used_id, $used_id);
            //todo
            //and push it to a new table
            $user->used_id = json_encode($previous_used_id, true);

            $user->save();
        }

        // all good so return the token
        return response()->json(compact('token'));
    }

    public function getAuthenticatedUser()
    {
        try {

            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
            $id = JWTAuth::parseToken()->getPayload()->get('app_id');
            $menu = Menu::byId($id)->get();

        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }

        // the token is valid and we have found the user via the sub claim
        //todo : need to be custom json format
        return response()->json(compact('user','menu'));
    }

    /**
     * Log out
     * Invalidate the token, so user cannot use it anymore
     * They have to relogin to get a new token
     *
     * @param Request $request
     */
    public function logout(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);
        JWTAuth::invalidate($request->input('token'));
    }

    /**
     * Refresh the token
     *
     * @return mixed
     */
    public function getToken()
    {
        $token = JWTAuth::getToken();
        if (!$token) {
            return $this->response->errorMethodNotAllowed('Token not provided');
        }
        try {
            $refreshedToken = JWTAuth::refresh($token);
        } catch (JWTException $e) {
            return $this->response->errorInternal('Not able to refresh Token');
        }
        return $this->response->withArray(['token' => $refreshedToken]);
    }
}
