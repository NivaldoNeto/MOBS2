<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\PrincipalConttroller;
use App\Http\Controllers\SobreNosController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\FornecedoresController;
use App\Http\Controllers\TesteController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\PedidoProdutoController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ProdutoDetalheController;



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
Route::get('/contato', [ContatoController::class, 'contato'])->name('site.contato')->middleware('log.acesso');
Route::post('/contato', [ContatoController::class, 'salvar'])->name('site.contato');
Route::get('/login/{erro?}', [LoginController::class, 'index'])->name('site.login');
Route::post('/login', [LoginController::class, 'autenticar'])->name('site.login');


Route::middleware('autenticacao:padrao,visitante')->prefix('/app')->group(function(){
    Route::get('/home', [HomeController::class, 'index'])->name('app.home');
    Route::get('/sair', [LoginController::class, 'sair'])->name('app.sair');
    Route::get('/cliente', [ClienteController::class, 'index'])->name('app.cliente');
    
    Route::get('/fornecedor', [FornecedoresController::class, 'index'])->name('app.fornecedor');
    Route::post('/fornecedor/listar', [FornecedoresController::class, 'listar'])->name('app.fornecedor.listar');
    Route::get('/fornecedor/listar', [FornecedoresController::class, 'listar'])->name('app.fornecedor.listar');
    Route::get('/fornecedor/adicionar', [FornecedoresController::class, 'adicionar'])->name('app.fornecedor.adicionar');
    Route::post('/fornecedor/adicionar', [FornecedoresController::class, 'adicionar'])->name('app.fornecedor.adicionar');
    Route::get('/fornecedor/editar/{id}/{msg?}',[FornecedoresController::class,'editar'])->name('app.fornecedor.editar');
    Route::get('/fornecedor/excluir/{id}',[FornecedoresController::class,'excluir'])->name('app.fornecedor.excluir');

    //Produtos
    Route::resource('produto', ProdutoController::class);

    //Produto Detalhe
    Route::resource('produto-detalhe', ProdutoDetalheController::class);
    
    Route::resource('cliente',ClienteController::class);
    Route::resource('pedido', PedidoController::class);
    //Route::resource('pedido-produto',PedidoProdutoController::class);
    Route::get('/pedido-produto/create/{pedido}',[PedidoProdutoController::class,'create'])->name('pedido-produto.create');
    Route::post('/pedido-produto/store/{pedido}',[PedidoProdutoController::class,'store'])->name('pedido-produto.store');
    //Route::delete('pedido-produto/destroy/{pedido}/{produto}',[PedidoProdutoController::class,'destroy'])->name('pedido-produto.destroy');
    Route::delete('pedido-produto/destroy/{pedidoProduto}/{pedido}',[PedidoProdutoController::class,'destroy'])->name('pedido-produto.destroy');

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