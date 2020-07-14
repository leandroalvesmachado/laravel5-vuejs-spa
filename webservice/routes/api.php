<?php

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Validator;
// use Illuminate\Validation\Rule;
// use App\User;

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
// Route::post('/cadastro', 'UsuarioController@cadastro');

Route::post('/cadastro', 'UsuarioController@store');
Route::post('/login', 'UsuarioController@login');
Route::middleware('auth:api')->get('/usuario','UsuarioController@show');
Route::middleware('auth:api')->put('/perfil','UsuarioController@update');
Route::middleware('auth:api')->post('/conteudo/adicionar','ConteudoController@adicionar');
Route::middleware('auth:api')->get('/conteudo/lista','ConteudoController@lista');

Route::get('/testes', function() {
});

// Route::get('/testes', function() {
    // $user1 = App\User::find(1);
    // $user2 = App\User::find(2);

    // add conteudo
    // $user1->conteudos()->create([
            // 'titulo' => 'Conteudo',
            // 'texto' => 'Aqui o texto',
            // 'imagem' => 'url da imagem',
            // 'link' => 'link',
            // 'data' => '2018-05-10'
    // ]);

    // add amigos
    // insere a ligacao se não existe
    // se existir ele remove
    // $user->amigos()->toggle($user2->id);
    
    // vincula os dois registros. sempre insere
    // $user1->amigos()->attach($user2->id);

    // remove todas as ligacoes
    // $user1->amigos()->detach($user2->id);

    // add curtidas
    // $user1->curtidas()->toggle($conteudo->id);

    // add comentario
    // $user1->conteudos()->create([
            // 'titulo' => 'Conteudo',
            // 'texto' => 'Aqui o texto',
            // 'imagem' => 'url da imagem',
            // 'link' => 'link',
            // 'data' => '2018-05-10'
    // ]);

    // $user1->comentarios()->create([
    //     'conteudo_id' => $conteudo->id,
    //     'texto' => 'texto teste',
    //     'data' => date('Y-m-d')
    // ]);
// });

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::middleware('auth:api')->put('/perfil', function (Request $request) {
//     // usuario logado, auth:api valida  token
//     $user = $request->user();
//     $data = $request->all();

//     if (isset($data['password'])) {
//         $validacao = Validator::make($data, [
//             'name' => 'required|string|max:255',
//             'email' => 'required|string|email|max:255|unique:users,email,'.$user['id'],
//             'password' => 'required|string|min:6|confirmed',
//             'password_confirmation' => 'required|string|min:6',
//         ]);

//         if ($validacao->fails()) {
//             return $validacao->errors();
//         }

//         $user->name = $data['name'];
//         $user->email = $data['email'];
//         $user->password = bcrypt($data['password']);
//     } else {
//         $validacao = Validator::make($data, [
//             'name' => 'required|string|max:255',
//             'email' => 'required|string|email|max:255|unique:users,email,'.$user['id']
//         ]);

//         if ($validacao->fails()) {
//             return $validacao->errors();
//         }

//         $user->name = $data['name'];
//         $user->email = $data['email'];
//     }

//     if (isset($data['imagem'])) {
//         Validator::extend('base64image', function ($attribute, $value, $parameters, $validator) {
//             $explode = explode(',', $value);
//             $allow = ['png', 'jpg', 'jpeg', 'svg'];
//             $format = str_replace(
//                 [
//                     'data:image/',
//                     ';',
//                     'base64'
//                 ],
//                 [
//                     '', '', ''
//                 ],
//                 $explode[0]
//             );

//             if (!in_array($format, $allow)) {
//                 return false;
//             }

//             if (!preg_match('%^[a-zA-Z0-9/+]*={0,2}$%', $explode[1])) {
//                 return false;
//             }

//             return true;
//         });

//         $validacao = Validator::make($data, [
//             'imagem' => 'base64image'
//         ], ['base64image' => 'Imagem inválida']);

//         if ($validacao->fails()) {
//             return $validacao->errors();
//         }

//         $time = time();
//         $diretorioPai = 'perfils';
//         $diretorioImagem = $diretorioPai.DIRECTORY_SEPARATOR.'perfil_id'.$user->id;
//         $ext = substr($data['imagem'], 11, strpos($data['imagem'], ';') - 11);
//         $urlImagem = $diretorioImagem.DIRECTORY_SEPARATOR.$time.'.'.$ext;
//         $file = str_replace('data:image/'.$ext.';base64', '', $data['imagem']);
//         $file = base64_decode($file);

//         if (!file_exists($diretorioPai)) {
//             mkdir($diretorioPai, 0700);
//         }

//         if ($user->imagem) {
//             if (file_exists($user->imagem)) {
//                 unlink($user->imagem);
//             }
//         }

//         if (!file_exists($diretorioImagem)) {
//             mkdir($diretorioImagem, 0700);
//         }

//         file_put_contents($urlImagem, $file);
//         $user->imagem = $urlImagem;
//     }

//     $user->save();

//     $user->imagem = asset($user->imagem);
//     $user->token = $user->createToken($user->email)->accessToken;

//     return $user;
// });
