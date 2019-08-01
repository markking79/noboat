<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function oauth(Request $request)
    {
        $http = new \GuzzleHttp\Client;


        $response = $http->post('http://noboat.test/oauth/token', [
            'form_params' => [
                'grant_type' => 'authorization_code',
                'client_id' => '3',
                'client_secret' => 'md4MSWT83n7UrrHQXp9ehp4VNICYdCQchXdFW7Id',
                'redirect_uri' => 'http://noboat.test/auth/callback',
                'code' => 'def502002bce08f93780f628c1e545e7424a56c5a861c6cfec5039fae85d2a99e017daca5a2de74a481630a73ea342d88dcc7b49961b7b2f535c17c3b66c3af2dc9accaa43d42ac78a05ec07a0b813413b662855b7fd7061f40950073e34343755814d24b04d9f09fcb109fdc9f4596d3f5718e31145d768129226701e08bb27de0ba401ba8f0aed0ea5c8c7f2df85a344daf48990d0798c009f8d83bb94aeb3da810dd5ad5425f4488aa9fb950872f7eb5ec73920250ae5fc25119b1f7b01e107bb2eb6181a31bd062410c1f810caea6232e570dfd0147dd12c0c78bfb0f7c1441b38f3868d5ebad5a091f5d33ec3e6af36184921151e5f028f4db2e90ec6718d37bca4a3fc263d359fa18de5a04791bde3c8536da983c9aa9566329c18b8f39db8b7abd60a0c9162ad183b93f161871c9f0049245b425b374288e98c7394f4c605d94c4f0d40a32ac22acead57ebd20603319dbcaff0177857fdcde9cd6bfcfa7c40',
            ],
        ]);



        //dd ($response->getBody());

        return json_decode((string) $response->getBody(), true);
    }
}
