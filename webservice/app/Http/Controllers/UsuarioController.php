<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\User;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $data = $request->all();

        $validacao = Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|string|min:6',
        ]);

        if ($validacao->fails()) {
            return [
                'status' => false,
                'validacao' => true,
                'erros' => $validacao->errors()
            ];
        }

        $imagem = "/img/usuario.jpg";

        $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'imagem' => $imagem
        ]);

        // criando token com informação que não se repete
        $user->token = $user->createToken($user->email)->accessToken;
        // $user->imagem = asset($user->imagem);

        return [
            'status' => true,
            'usuario' => $user
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return $request->user();
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
    public function update(Request $request)
    {
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
                return [
                    'status' => false,
                    'validacao' => true,
                    'erros' => $validacao->errors()
                ];
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
                return [
                    'status' => false,
                    'validacao' => true,
                    'erros' => $validacao->errors()
                ];
            }

            $user->name = $data['name'];
            $user->email = $data['email'];
        }

        if (isset($data['imagem'])) {
            Validator::extend('base64image', function ($attribute, $value, $parameters, $validator) {
                $explode = explode(',', $value);
                $allow = ['png', 'jpg', 'jpeg', 'svg'];
                $format = str_replace(
                    [
                        'data:image/',
                        ';',
                        'base64'
                    ],
                    [
                        '', '', ''
                    ],
                    $explode[0]
                );

                if (!in_array($format, $allow)) {
                    return false;
                }

                if (!preg_match('%^[a-zA-Z0-9/+]*={0,2}$%', $explode[1])) {
                    return false;
                }

                return true;
            });

            $validacao = Validator::make($data, [
                'imagem' => 'base64image'
            ], ['base64image' => 'Imagem inválida']);

            if ($validacao->fails()) {
                return [
                    'status' => false,
                    'validacao' => true,
                    'erros' => $validacao->errors()
                ];
            }

            $time = time();
            $diretorioPai = 'perfils';
            $diretorioImagem = $diretorioPai.DIRECTORY_SEPARATOR.'perfil_id'.$user->id;
            $ext = substr($data['imagem'], 11, strpos($data['imagem'], ';') - 11);
            $urlImagem = $diretorioImagem.DIRECTORY_SEPARATOR.$time.'.'.$ext;
            $file = str_replace('data:image/'.$ext.';base64', '', $data['imagem']);
            $file = base64_decode($file);

            if (!file_exists($diretorioPai)) {
                mkdir($diretorioPai, 0700);
            }

            if ($user->imagem) {
                $imgUser = str_replace(asset('/'), '', $user->imagem);
                if (file_exists($imgUser)) {
                    unlink($imgUser);
                }
            }

            if (!file_exists($diretorioImagem)) {
                mkdir($diretorioImagem, 0700);
            }

            file_put_contents($urlImagem, $file);
            $user->imagem = $urlImagem;
        }

        $user->save();

        // $user->imagem = asset($user->imagem);
        $user->token = $user->createToken($user->email)->accessToken;

        return [
            'status' => true,
            'usuario' => $user
        ];
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

    public function login(Request $request) 
    {
        $data = $request->all();

        $validacao = Validator::make($data, [
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        if ($validacao->fails()) {
            return [
                'status' => false,
                'validacao' => true,
                'erros' => $validacao->errors()
            ];
        }

        // autentica no sistema
        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            $user = auth()->user();
            // criando token com informação que não se repete
            $user->token = $user->createToken($user->email)->accessToken;
            // $user->imagem = asset($user->imagem);

            return [
                'status' => true,
                'usuario' => $user
            ];
        }
        
        return [
            'status' => false
        ];
    }
}
