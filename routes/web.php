<?php


use App\Http\Controllers\AtorController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\FilmeController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\QuizController;

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\PasswordResetLinkController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [SiteController::class, 'index'])->name('home');
Route::get('/noticias', [SiteController::class, 'showNoticias'])->name('noticias');
Route::get('/artigos', [SiteController::class, 'showArtigos'])->name('artigos');
Route::get('/generos', [SiteController::class, 'showGeneros'])->name('generos');
Route::get('/quemSomos', [SiteController::class, 'showQuemSomos'])->name('quemSomos');
Route::get('/contato', [SiteController::class, 'showContato'])->name('contato');
Route::get('/perguntas-frequentes', [SiteController::class, 'showPerguntasFrequentes'])->name('perguntasFrequentes');

Route::get('/artigo/{slug}', [SiteController::class, 'showArtigo'])->name('artigo');

Route::get('/noticia/{slug}', [SiteController::class, 'showNoticia'])->name('noticia');

Route::get('/lista/{slug}', [SiteController::class, 'showMiniLista'])->name('minilista');
Route::get('/listas', [SiteController::class, 'showListas'])->name('todasListas');


Route::get('/buscar', [SiteController::class, 'showSearchResults'])->name('busca');

Route::get('/quizes', [QuizController::class, 'mostrarQuizes'])->name('mostrarQuizes');
Route::get('/quiz/{slug}', [QuizController::class, 'quiz'])->name('mostrarQuiz');


Route::get('/top100{genre}', [FilmeController::class, 'showTop100'])
    ->where(
        'genre',
        'geral|acao|comedia|romance|aventura|fantasia|crime|suspense|terror|animacao|drama|familia|faroeste|ficcaocientifica|filmesclassicos|guerra|misterio|musical'
    )
    ->name('top100');

Route::get('/filme/{id}', [FilmeController::class, 'oldRouteRedirect'])
    ->where('id', '[0-9]+')
    ->name('oldRouteRedirect');
Route::get('/filme/{slug}', [FilmeController::class, 'showDetalhesFilme'])->name('detalhesFilme');

Route::get('/melhores-filmes-2023', [FilmeController::class, 'showMelhoresDoAno2023'])->name('melhoresFilmes2023');

Route::get('/filmes-indicados-ao-oscar-2024', [SiteController::class, 'showIndicadosOscar2024'])->name('showIndicadosOscar2024');


Route::get('/ator/{id}', [AtorController::class, 'detalhesAtorRotaAntiga'])
    ->where('id', '[0-9]+')
    ->name('detalhesAtorRotaAntiga');
Route::get('/ator/{slug}', [AtorController::class, 'showDetalhesAtor'])->name('detalhesAtor');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', function () {
        return view('profile.show');
    })->name('dashboard');

    Route::get('/profile', function () {
        return view('profile.show');
    })->name('profile');

    Route::get('/minhasListas', [SiteController::class, 'showListasUsuario'])->name('minhasListas');

    Route::post('/filme/{id}', [FilmeController::class, 'storeVote'])->name('cadastrarVoto');
});

Route::post('/contatoUsuario', [MailController::class, 'contatoUsuario'])->name('contatoUsuario');

Route::post('/resetar-senha', [PasswordResetLinkController::class, 'store']);

Route::get('/logout', function () {
    return to_route('home');
});

Route::fallback(function () {
    return view('404.index');
});
