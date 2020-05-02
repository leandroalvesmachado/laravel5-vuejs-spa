<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/cadastro', function (Request $request) {
    $data = $request->all();

    $validacao = Validator::make($data, [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6|confirmed',
        'password_confirmation' => 'required|string|min:6',
    ]);

    if ($validacao->fails()) {
        return $validacao->errors();
    }

    $user =  User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => bcrypt($data['password'])
    ]);

    // criando token com informação que não se repete
    $user->token = $user->createToken($user->email)->accessToken;

    return $user;
});

Route::post('/login', function (Request $request) {
    $data = $request->all();

    $validacao = Validator::make($data, [
        'email' => 'required|string|email',
        'password' => 'required|string'
    ]);

    if ($validacao->fails()) {
        return $validacao->errors();
    }

    // autentica no sistema
    if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
        $user = auth()->user();
        // criando token com informação que não se repete
        $user->token = $user->createToken($user->email)->accessToken;

        return $user;
    }
    
    return [
        'status' => false
    ];

});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->put('/perfil', function (Request $request) {
    // usuario logado, auth:api valida  token
    $user = $request->user();
    $data = $request->all();

    if (isset($data['password'])) {
        $validacao = Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user['id'],
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|string|min:6',
        ]);

        if ($validacao->fails()) {
            return $validacao->errors();
        }

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
    } else {
        $validacao = Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user['id']
        ]);

        if ($validacao->fails()) {
            return $validacao->errors();
        }

        $user->name = $data['name'];
        $user->email = $data['email'];
    }

    $user->save();

    $user->token = $user->createToken($user->email)->accessToken;

    return $user;
});
