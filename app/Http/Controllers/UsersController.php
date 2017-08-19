<?php

namespace App\Http\Controllers;

use App\Authorized;
use App\Client;
use App\Identifier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexOther(Request $request)
    {
        $identifier_id = Identifier::where('name','other')->first()->id;
        $users = Client::where('identifier_id',$identifier_id)->where('is_authorized' , false)->paginate(10);

        $users_count = Client::where('identifier_id',$identifier_id)->where('is_authorized' , false)->count();
        if ($request->ajax())
            return response()->json(view('partials.otherUsersTable', compact('users'))->render());

        return view('pages.otherUsers',compact('users', 'users_count'));

    }

    public function indexFanap(Request $request)
    {
        $identifier_id = Identifier::where('name', 'fanapium')->first()->id;
        $users = Client::where('identifier_id', $identifier_id)->where('is_authorized', true)->paginate(10);
        $users_count = Client::where('identifier_id', $identifier_id)->count();

        if ($request->ajax())
            return response()->json(view('partials.fanapUsersTable', compact('users', 'users_count'))->render());

        return view('pages.fanapUsers', compact('users', 'users_count'));
    }

    public function indexExhouse(Request $request)
    {
        $identifier_id = Auth::user()->currencyExchange->identifier->id;

        $users = Authorized::where('identifier_id', $identifier_id)->paginate(10);
        $users_count = Authorized::where('identifier_id', $identifier_id)->count();
        if ($request->ajax())
            return response()->json(view('partials.exUsersTable', compact('users'))->render());

        return view('pages.exhouseUsers', compact('users', 'users_count'));
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword;
        $identifier_id = Auth::user()->currencyExchange->identifier->id;

        if ($keyword == '') {
            $users = Authorized::where('identifier_id', $identifier_id)->orderby("id", "desc")->paginate(10);
        } else {
//            preg_match_all('/(?:(name|code|mobile):)([^: ]+(?:\s+[^: ]+\b(?!:))*)/xi', $request->keyword, $matches, PREG_SET_ORDER);
//            $result = array();

//            foreach ($matches as $match) {
//                if (isset($result[$match[1]])) {
//                    $result[$match[1]] = $result[$match[1]] . ' ' . $match[2];
//                } else
//                    $result[$match[1]] = $match[2];
//            }
//
//            if ($result) {
//                $users = Authorized::where('identifier_id', $identifier_id)
//                    ->where(function ($query) use ($result) {
//                        foreach ($result as $k => $v) {
//                            switch (strtolower($k)) {
//                                case 'name':
//                                    $query->whereRaw("regexp_like(firstname, '$k', 'i')")
//                                        ->orWhereRaw("regexp_like(lastname, '$k', 'i')");
//
//                                case 'code':
//                                    if (ctype_digit($k)) {
//                                        $query->whereRaw("regexp_like(identity_number, '$v', 'i')");
//                                    }
//                                    break;
//
//                                case 'mobile':
//                                    if (ctype_digit($k)) {
//                                        $query->whereRaw("regexp_like(mobile, '$k', 'i')");
//                                    }
//                                    break;
//                                default:
//                                    $query->where('id', 0);
//                                    break;
//                            }
//                        }
//
//                    })->paginate(10);

//            } else {
            $users = Authorized::where('identifier_id', $identifier_id)
                ->where(function ($query) use ($keyword) {
                    $query->orWhereRaw("regexp_like(authorized.firstname , '$keyword', 'i')")
                        ->orWhereRaw("regexp_like(authorized.lastname, '$keyword', 'i')")
                        ->orWhereRaw("regexp_like(identity_number, '$keyword', 'i')")
                        ->orWhereRaw("regexp_like(mobile, '$keyword', 'i')");
                })->orderby("id", "desc")->paginate(10);
//            }
        }

        if ($request->ajax())
            return response()->json(view('partials.exUsersTable', compact('users'))->render());
    }

    public function searchFanap(Request $request)
    {
        $keyword = $request->keyword;

        $identifier_id = Identifier::where('name', 'fanapium')->first()->id;
        if ($keyword == '') {
            $users = Client::where('identifier_id', $identifier_id)->where('is_authorized', true)->paginate(10);
        } else {
            $users = Client::where('identifier_id', $identifier_id)->where('is_authorized', true)
                ->where(function ($query) use ($keyword) {
                    $query->orWhereRaw("regexp_like(firstname , '$keyword', 'i')")
                        ->orWhereRaw("regexp_like(lastname, '$keyword', 'i')")
                        ->orWhereRaw("regexp_like(identity_number, '$keyword', 'i')")
                        ->orWhereRaw("regexp_like(mobile, '$keyword', 'i')");
                })->orderby("id", "desc")->paginate(10);
        }

        if ($request->ajax())
            return response()->json(view('partials.fanapUsersTable', compact('users'))->render());
    }

    public function searchOther(Request $request)
    {
        $keyword = $request->keyword;

        $identifier_id = Identifier::where('name','other')->first()->id;

        if ($keyword == '') {
            $users = Client::where('identifier_id',$identifier_id)->where('is_authorized' , false)->paginate(10);
        } else {
            $users = Client::where('identifier_id',$identifier_id)->where('is_authorized' , false)
                ->where(function ($query) use ($keyword) {
                    $query->orWhereRaw("regexp_like(users.firstname , '$keyword', 'i')")
                        ->orWhereRaw("regexp_like(users.lastname, '$keyword', 'i')")
                        ->orWhereRaw("regexp_like(users.firstname_latin , '$keyword', 'i')")
                        ->orWhereRaw("regexp_like(users.lastname_latin, '$keyword', 'i')")
                        ->orWhereRaw("regexp_like(identity_number, '$keyword', 'i')")
                        ->orWhereRaw("regexp_like(mobile, '$keyword', 'i')");
                })->orderby("id", "desc")->paginate(10);
        }

        if ($request->ajax())
            return response()->json(view('partials.otherUsersTable', compact('users'))->render());
    }


    public function authorizeUser(Client $client)
    {
        $client->identifier_id = Auth::user()->currencyExchange->identifier->id;
        $client->is_authorized = true ;
        $client->save();

        return json_encode(array('status' => true, 'msg' => 'با موفقیت تائید شد.'));
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
}
