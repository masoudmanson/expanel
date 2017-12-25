<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Traits\ExportTrait;
use App\Authorized;
use App\Client;
use App\Identifier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Excel;
use Illuminate\Support\Facades\DB;
use PHPExcel_Settings;
use Illuminate\Support\Facades\Input;

class UsersController extends Controller
{
    use ExportTrait;

    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('checkToken');
        $this->middleware('checkUser');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexOther(Request $request)
    {
        $identifier_id = Identifier::where('name', 'other')->first()->id;
        $users = Client::where('identifier_id', $identifier_id)->where('is_authorized', false)->paginate(10);

        $users_count = Client::where('identifier_id', $identifier_id)->where('is_authorized', false)->count();
        if ($request->ajax())
            return response()->json(view('partials.otherUsersTable', compact('users'))->render());

        return view('pages.otherUsers', compact('users', 'users_count'));
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

        $users = Authorized::where('identifier_id', $identifier_id)->orderBy('created_at', 'DESC')->paginate(10);
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

            $users = Authorized::where('identifier_id', $identifier_id)
                ->where(function ($query) use ($keyword) {
                    $query->orWhereRaw("regexp_like(authorized.firstname , '$keyword', 'i')")
                        ->orWhereRaw("regexp_like(authorized.lastname, '$keyword', 'i')")
                        ->orWhereRaw("regexp_like(identity_number, '$keyword', 'i')")
                        ->orWhereRaw("regexp_like(mobile, '$keyword', 'i')");
                })->orderby("id", "desc")->paginate(10);
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

        $identifier_id = Identifier::where('name', 'other')->first()->id;

        if ($keyword == '') {
            $users = Client::where('identifier_id', $identifier_id)->where('is_authorized', false)->paginate(10);
        } else {
            $users = Client::where('identifier_id', $identifier_id)->where('is_authorized', false)
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

    public function showFanapUser(Client $client)
    {
        $identifier_id = Identifier::where('name', 'fanapium')->first()->id;
        if ($client->identifier_id == $identifier_id) {
            return response()->json(view('partials.singleUser', compact('client'))->render());
        }
    }

    public function authorizeUser(Client $client)
    {
        $client->identifier_id = Auth::user()->currencyExchange->identifier->id;
        $client->is_authorized = true;
        $client->save();

        return json_encode(array('status' => true, 'msg' => 'با موفقیت تائید شد.'));
    }

    public function importFileIntoDB(Request $request)
    {
        if (Input::hasFile('sample_file')) {
            $path = Input::file('sample_file')->getRealPath();
            PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
            $data = Excel::load($path, function ($reader) {
            })->get();
            if (!empty($data) && $data->count()) {
                foreach ($data as $key => $value) {
                    if(!empty($value->firstname) && !empty($value->lastname) && !empty($value->identity_number) && !empty($value->mobile)) {

                        $request->request->set('firstname', $value->firstname);
                        $request->request->set('lastname', $value->lastname);
                        $request->request->set('identity_number', $value->identity_number);
                        $request->request->set('mobile', $value->mobile);

                        $messages = array(
                            'unique' => ':attribute قبلا انتخاب شده است. مسعود هستم',
                        );

                        $this->validate($request, [
                            'firstname' => 'required|alpha|between:2,10',
                            'lastname' => 'required|alpha|between:2,50',
                            'mobile' => 'required|unique_with:authorized,identity_number|digits_between:8,12',
                            'identity_number' => 'required|unique:authorized,identity_number|digits_between:8,10',
                        ], $messages);

                        $insert[] = [
                            'firstname' => $value->firstname,
                            'lastname' => $value->lastname,
                            'identity_number' => $value->identity_number,
                            'mobile' => $value->mobile,
                            'identifier_id' => Auth::user()->currencyExchange->identifier->id,
                            'created_at' => Carbon::now()->toDateTimeString(),
                            'updated_at' => Carbon::now()->toDateTimeString(),
                        ];
                    }
                }
                if (!empty($insert)) {
                    DB::table('authorized')->insert($insert);
                    return back();
                }
            }
        }
        return back();//todo : with error => integrate with masoud
    }

    public function downloadExcelFile($type)
    {
        $products = Authorized::get()->toArray();
        return Excel::create('My_Users', function ($excel) use ($products) {
            $excel->sheet('sheet name', function ($sheet) use ($products) {
                $sheet->fromArray($products);
            });
        })->download($type);
    }

    public function add_auth_user(AuthRequest $request)
    {
        $request['identifier_id'] = Auth::user()->currencyExchange->identifier->id;

        Authorized::create($request->all());

        return redirect()->back();
    }

    public function show_authorized_users(Request $request)
    {
        $identifier_id = Auth::user()->currencyExchange->identifier->id;

        $users = Authorized::where('identifier_id', $identifier_id)->get();
        dd($users);
        if ($request->ajax())
            return response()->json(view('partials.singleTrans', compact('transaction'))->render());
    }

    public function fanapUsersExcel()
    {
//        if ($request['order'] != null) {
//            $order = $request['order'];
//            $option = $request ['option'];
//        } else {
        $order = 'users.firstname';
        $option = 'DESC';
//        }
        $extraInfo['order'] = $order;
        $extraInfo['option'] = $option;

        $identifier_id = Identifier::where('name', 'fanapium')->first()->id;
        $users = Client::where('identifier_id', $identifier_id)->where('is_authorized', true);
        $keysArray[] = ['firstname', 'lastname', 'identity_number', 'mobile'];
        $users = $users->arraySelect($keysArray[0])->orderBy($order,$option)->get();

        $this->excel_export($users, $keysArray, 'fanap_users', 'Exchanger', 'FANEx');
    }

    public function otherUsersExcel()
    {
//        if ($request['order'] != null) {
//            $order = $request['order'];
//            $option = $request ['option'];
//        } else {
        $order = 'users.firstname';
        $option = 'DESC';
//        }
        $extraInfo['order'] = $order;
        $extraInfo['option'] = $option;

        $identifier_id = Identifier::where('name', 'other')->first()->id;
        $users = Client::where('identifier_id', $identifier_id)->where('is_authorized', false);
        $keysArray[] = ['firstname_latin', 'lastname_latin', 'identity_number', 'mobile'];
        $users = $users->arraySelect($keysArray[0])->orderBy($order,$option)->get();

        $this->excel_export($users, $keysArray, 'other_users', 'Exchanger', 'FANEx');
    }
}
