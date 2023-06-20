<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\PrincipalConttroller;
use App\Http\Controllers\SobreNosController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\FornecedoresController;
use App\Http\Controllers\TesteController;



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

/*Route::get('/', function () {
    return view('Hello World');
});*/

Route::get('/', [PrincipalConttroller::class, 'principal'])->name('site.index')->middleware('log.acesso');
Route::get('/sobre-nos', [SobreNosController::class, 'sobrenos'])->name('site.sobre-nos');
Route::get('/contato', [ContatoController::class, 'contato'])
    ->name('site.contato')
    ->middleware(LogAcessoMiddleware::class);
Route::post('/contato', [ContatoController::class, 'salvar'])->name('site.contato');
Route::get('/login', function(){return 'Login';})->name('site.login');


Route::middleware('autenticacao:padrao,visitante')->prefix('/app')->group(function(){
    Route::get('/clientes', function(){return 'Clientes';})->name('app.clientes');
    Route::get('/produtos', function(){return 'produtos';})->name('app.produtos');
    Route::get('/fornecedores', [FornecedoresController::class, 'index'])->name('app.fornecedores');
});
/*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*==**=*=*=*=*=*=*=*==*==*=*/

/*Route::get('/rota2', function() {
    return redirect()->route('site.rota1'); //redirecionamento da rota
})->name('site.rota2');*/

//Route::redirect('/rota2', '/rota1');

/*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*==**=*=*=*=*=*=*=*==*==*=*/

/*Route::get('/teste/{p1}/{p2}', 'TesteController@teste($p1, $p2)')->name('teste');*/  

Route::get('/teste/{p1}/{p2}', [TesteController::class, 'teste'])->name('teste');


Route::fallback(function() {
    echo 'A rota acessada não existe, <a href="'.route('site.index').'"> clique aqui</a> para ir para a pagina inicial';
});


























//nome, categoria, assunto, mensagem
/*
Route::get(
    '/contato/{nome}/{categoria}', 
    function(
        string $nome = 'Desconhecido', 
        int $categoria_id = 1 // 1 - 'Informação,
    ) {
        echo "Estamos aqui: $nome - $categoria_id";
    }
)->where('categoria_id', '[0-9]+')->where('nome', '[A-Za-z]+');
*/
    
/* verbos http
get
post
put
patch
delete
options

*/