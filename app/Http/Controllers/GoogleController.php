<?php


// ATTENTION!!! THIS CONTROLLER IS DEPRECATED, IF YOU INTEND TO USE IT IN THE
// FUTURE YOU NEED TO MAKE MODIFICATIONS TO DETURN THE NECESSARY DATABASE DATA
// IN THE NECESSARY VARIABLES TO THE INDEX PAGE. YOU'VE BEEN WARNED, IMPLEMENTING
// GOOGLE LOGIN AGAIN MIGHT CAUSE SOME PROBLEMS IF NOT ALL VARIABLES ARE RETURNED
// WITH THE DEFAULT RETURN VIEW

// namespace App\Http\Controllers;

// use App\Models\ListaDoUsuario;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Cookie;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Log;
// use Illuminate\Support\Str;
// use Laravel\Socialite\Facades\Socialite;
// use Exception;
// use App\Models\User;
// use Illuminate\Cookie\CookieJar;
// use App\Models\MiniLista;
// use App\Models\Artigo;
// use App\Models\Destaques;
// use Illuminate\Support\Facades\DB;
// use App\Models\Noticia;


// use function App\HelperFunctions\handleException;


// class GoogleController extends Controller
// {
//     public function signInwithGoogle()
//     {
//         try {
//             return Socialite::driver('google')->redirect();
//         } catch (Exception $e) {
//             $resposta = handleException($e);
//             return back()->withErrors($resposta);
//         }
//     }
//     public function callbackToGoogle(CookieJar $cookieJar)
//     {
//         try {

//             $user = Socialite::driver('google')->user();


//             $cadastradoComEmail = DB::table('users')->where(['email' => $user->email, 'gauth_id' => null])->first();


//             if ($cadastradoComEmail) {

//                 return back()->withErrors('Não é possível logar com o google pois o cadastro foi feito com email e senha');
//             }

//             $finduser = User::where('gauth_id', $user->id)->first();

//             if ($finduser) {

//                 Auth::login($finduser);
//                 $fotoPerfil = $user->getAvatar();
//                 $user = Auth::user();
//                 $user->tokens()->delete();
//                 $token = $user->createToken('tap')->plainTextToken;
//                 $cookieJar->queue(cookie('tap', $token));

//                 $listasDoUsuario = ListaDoUsuario::where('id_usuario', $user->id)->get();
//                 $idListaUsuario = $listasDoUsuario[0]->id;

//                 session(['fotoPerfil' => $fotoPerfil, 'nomeUsuario' => $finduser->name, 'idListaUsuario' => $idListaUsuario]);
//                 $destaques = Destaques::get();
//                 $minilistas = MiniLista::orderBy('created_at', 'desc')->limit(4)->get();

//                 return view('home.index')->with(['destaques' => $destaques, 'minilistas' => $minilistas]);
//             } else {
//                 $fotoPerfil = $user->getAvatar();

//                 $newUser = User::create([
//                     'name' => $user->name,
//                     'email' => $user->email,
//                     'profile_photo_path' => $fotoPerfil,
//                     'gauth_id' => $user->id,
//                     'gauth_type' => 'google',
//                     'password' => Hash::make(Str::random(16))
//                 ]);

//                 $newUser->markEmailAsVerified();

//                 $novaLista = ListaDoUsuario::create([
//                     'id_usuario' => $newUser->id,
//                     'nome_da_lista' => 'O que assistir'
//                 ]);

//                 $idListaUsuario = $novaLista->id;

//                 Auth::login($newUser);

//                 $token = $newUser->createToken('tap')->plainTextToken;
//                 $cookieJar->queue(cookie('tap', $token));

//                 session(['fotoPerfil' => $fotoPerfil, 'nomeUsuario' => $newUser->name, 'idListaUsuario' => $idListaUsuario]);
//                 $destaques = Destaques::get();
//                 $minilistas = MiniLista::orderBy('created_at', 'desc')->limit(4)->get();

//                 return view('home.index')->with(['destaques' => $destaques, 'minilistas' => $minilistas]);
//             }
//         } catch (Exception $e) {
//             $resposta = handleException($e);
//             return back()->withErrors($resposta);
//         }
//     }
// }
