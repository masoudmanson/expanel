<?php
/**
 * Created by PhpStorm.
 * User: pooria
 * Date: 7/29/17
 * Time: 12:38 PM
 */

namespace App\Traits;

use App\Backlog;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Morilog\Jalali\jDate;

trait PlatformTrait
{

    public function registerWithSSO(Request $request)
    {
        $token = $request->bearerToken();

        $nick = $request->nickname;

//        $client = new Client();
        $client = new Client(['verify' => false]);
        $res = $client->request('GET', config('urls.platform') . 'aut/registerWithSSO/', [
            'query' => ['nickname' => $nick],
            'headers' => [
                '_token_' => $token,
                '_token_issuer_' => 1
            ]
        ]);

        return $res;
    }

    public function getCurrentPlatformUser($token)
    {
//        $client = new Client();
        $client = new Client(['verify' => false]);
        $res = $client->get(config('urls.platform').'nzh/getUserProfile/', [
            'headers' => [
                '_token_' => $token,
                '_token_issuer_' => 1
            ]
        ]);
        return $res;
    }

//    public function getCurrentPlatformUser($token)
//    {
//        $client = new Client();
//        $res = $client->get(config('urls.sso').'users/', [
//            'headers' => [
////                '_token_' => $token,
////                '_token_issuer_' => 1
//            'authorization' =>'Bearer '. $token
//            ]
//        ]);
//        return $res;
//    }

    public function getOtt()
    {
        $token = config('services.sso.api');
//        $client = new Client();
        $client = new Client(['verify' => false]);
        //businessId should receive from getBusiness.however it's static in platform db.
        $res = $client->get(config('urls.platform') . 'nzh/ott/', [
            'headers' => [
                '_token_' => $token,
                '_token_issuer_' => 1
            ]
        ]);
        return $res;
    }

    public function followBusiness($token)
    {
//        $client = new Client();
        $client = new Client(['verify' => false]);
        //businessId should receive from getBusiness.however it's static in platform db.
        $res = $client->get(config('urls.platform') . 'nzh/follow/?businessId=42&follow=true', [
            'headers' => [
                '_token_' => $token,
                '_token_issuer_' => 1
            ]
        ]);
        return $res;
    }

    public function getBusiness($token)
    {
//        $client = new Client();
        $client = new Client(['verify' => false]);
        //business token must taken from sso
        $res = $client->get(config('urls.platform') . 'nzh/getUserBusiness/', [
            'headers' => [
                '_token_' => $token,// get business token and put in here
                '_token_issuer_' => 1
            ]
        ]);
        return $res;
    }

    public function getBusinessCredit()
    {
        $token = config('services.sso.api');
//        $client = new Client();
        $client = new Client(['verify' => false]);
        //business token must taken from sso
        $res = $client->get(config('urls.platform') . 'nzh/biz/getCredit', [
            'headers' => [
                '_token_' => $token,// get business token and put in here
                '_token_issuer_' => 1
            ],
            'query' => [
                'guildCode' => 'FINANCIAL_GUILD'
            ],
        ]);
        return $res;
    }

    public function createProduct()
    {
        //nzh/biz/addProduct

    }

    public function updateProduct($attributes)
    {
        $attributes = (array)$attributes;
        $token = config('exchanger.token');
        $client = new Client();
        $res = $client->post(config('urls.platform') . 'nzh/biz/updateProduct', [
            'headers' => [
                '_token_' => $token,// get business token and put in here
                '_token_issuer_' => 1
            ],
            'form_params' => [
                'entityId' => $attributes['entityId'],
                'name' => $attributes['name'],
                'description' => $attributes['description'],
                'canComment' => 'false',
                'canLike' => 'false',
                'cahangePreview' => false,
                'enable' => 'true',
                'metadata' => null,
                'businessId' => config('exchanger.businessId'),
                'availableCount' => $attributes['availableCount'],
                'price' => $attributes['price'],
                'discount' => '0'
            ],
            'verify' => false
        ]);

        return $res;
    }

    public function listProduct($attributes=array())
    {
//        $token = config('services.sso.api');
        $token = config('exchanger.token');
        $client = new Client();
        $data = [
            'size' => 100,
            'offset' => 0,
            'businessId' => config('exchanger.businessId'),
        ];
        if (!empty($attributes['entityId'])) {
            $data = $data + ['id' => $attributes['entityId']];
        }

        if (!empty($attributes['tag'])) {
            $data = $data + ['tags' => $attributes['tag']];
        }

        if (!empty($attributes['attributeCode'])) {
            $data = $data + ['attributeCode[]' => $attributes['attributeCode']];
            $data = $data + ['attributeValue[]' => $attributes['attributeValue']];
        }
        //business token must taken from sso
        $res = $client->post(config('urls.platform') . 'nzh/productList', [
            'headers' => [
                '_token_' => $token,
                '_token_issuer_' => 1
            ],
            'form_params' => $data,
            'verify' => false
        ]);
        return $res;
    }

    public function loadProduct($entityId)
    {
        $token = config('exchanger.token');
        $client = new Client();
        $data = [
            'id' => $entityId
        ];
        $res = $client->post(config('urls.platform') . 'nzh/biz/loadProduct/', [
            'headers' => [
                '_token_' => $token,
                '_token_issuer_' => 1
            ],
            'form_params' => $data,
            'verify' => false
        ]);
        return $res;
    }

    public function userInvoice(Request $request, Backlog $backlog)
    {
//        $client = new Client();
        $client = new Client(['verify' => false]);

        $token = config('services.sso.api');
//dd($token);
        $user_object = $this->getCurrentPlatformUser($request->cookie('token')['access']);
        $json_input = $user_object->getBody()->getContents();
        $userId = json_decode($json_input)->result->userId;
        $result = $this->getOtt();
        $json = $result->getBody()->getContents();
        $ott = json_decode($json)->ott;
        //redirect to login? or refresh the user token ,,,
        // *hint: if refresh token was needed, get the user refresh token from its db row
        //todo how can I know user object on db, if his token expired and I don't have his userId??

        $res = $client->get(config('urls.platform') . 'nzh/biz/issueInvoice/', [
            'query' => [
                'redirectURL' => $request->root() . '/invoice/show',
                'userId' => $userId,// get userId from his token: gholi = 204
                'billNumber' => generateUniqueReferenceNumber(),
                'description' => 'for now we have no description',
                'deadline' => jDate::forge('now')->format('Y/m/d'), //persian date in format yyyy/mm/dd
                'productId[]' => 0, //I've no idea
                'price[]' => $backlog->payment_amount, //give the price from saved transaction
                'productDescription[]' => 'for now we have no description', //I've no idea
                'quantity[]' => 1, //I'm not sure
                'pay' => false, // for now false is enough. later, depend on method of pay, it can change dynamically.
                'block' => false, // I think so
                'guildCode' => 'FINANCIAL_GUILD',
                'state' => 'tehran', //right up to the address maybe
                'city' => 'tehran',
                'postalCode' => '1654777158',// maybe will taken from user
                'address' => 'somewhere new',
                'addressId' => 0,
                'phoneNumber' => '09387181694',//maybe user's phone number
                'preferredTaxRate' => 0
            ],
            'headers' => [
                '_token_' => $token,
                '_ott_' => $ott,
                '_token_issuer_' => 1
            ]
        ]);

        return $res;
    }

    public function trackingInvoiceByBillNumber($billNumber) //the form parameters can be taken from arguments, according to needs
    {
//        $client = new Client();
        $client = new Client(['verify' => false]);
        $token = config('services.sso.api'); //biz static token

        $res = $client->post(config('urls.platform') . 'nzh/biz/getInvoiceList/', [
                'form_params' => [
                    'billNumber' => $billNumber,
                    'size' => 1,
                    'firstId' => 0,
//                    'isPayed' => true,
//                    'isCanceled' => false,
                ],
                'headers' => [
                    '_token_' => $token,
                    '_token_issuer_' => 1
                ],
                'verify' => false
            ]
        );
        return $res;
    }

    public function cancelInvoice($invoice_id, $token = 'd35b0c351acd47cc87a76b1c4b07239a') //todo: get api_token from config or .env file
    {
//        $client = new Client();
        $client = new Client(['verify' => false]);
        $res = $client->get(config('urls.platform') . 'nzh/biz/cancelInvoice/', [
            'query' =>
                [
                    'invoiceId' => $invoice_id
                ],
            'headers' => [
                '_token_' => $token,
                '_token_issuer_' => 1
            ]
        ]);
        return $res;
    }

    public function chargeUserWallet($user, $charge_amount)
    {
        $token = config('services.sso.api');
//        $client = new Client();
        $client = new Client(['verify' => false]);
        //business token must taken from sso
        $res = $client->get(config('urls.platform') . 'nzh/biz/transferToFollower', [
            'headers' => [
                '_token_' => $token,// get business token and put in here
                '_token_issuer_' => 1
            ],
            'query' => [
                'guildCode' => 'FINANCIAL_GUILD',
                'amount' => $charge_amount,
                'userId' => $user->userid, //todo : ???
                'description' => 'بازگشت مبلغ واریز شده به حساب کاربری، به دلیل برگشت حواله',
//                'currencyCode' => '',

            ],
        ]);
        return $res;
    }
}