<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Http\File;

// ROTAS SITE

Route::GET('/', 'SiteHomeController@index');
Route::GET('/home', 'SiteHomeController@index');
Route::GET('/sobre', 'SiteHomeController@sobre');
Route::GET('/cursos', 'SiteHomeController@cursos');
Route::GET('/curso_detalhado/{id}/{nome}', 'SiteHomeController@curso_detalhe');
Route::GET('/nossa_galeria', 'SiteHomeController@galeria');
Route::GET('/info_contatos', 'ContatoController@contato')->name('page_contato');
Route::POST('/contatos/enviar', 'ContatoController@enviar_formulario_contato')->name('contatos.enviar');
Route::GET('/blog', 'SiteHomeController@blog');
Route::GET('/blog_detalhado/{id}/{nome}', 'SiteHomeController@blog_detalhado');
Route::GET('/blog_filtro/{filtro}/{tipo}', 'SiteHomeController@blog_filtro');
Route::POST('/blog_filtro/{filtro}/{tipo}', 'SiteHomeController@blog_filtro');

Route::POST('/upload_image_ckeditor', 'PaginasController@upload')->name('upload.site');
Route::POST('/newsleatter/enviar', 'ContatoController@newsletter_enviar')->name('newsletter.enviar');

// FIM ROTAS SITE


//todas as rotas de baixo são do painel administrativo
Auth::routes();

Route::group(['prefix' => 'painel',  'middleware' => ['auth']], function () {
  Route::get('/', 'DashboardController@index')->name('admin.dashboard');

  // CATEGORIAS
  Route::get('/categorias', 'CategoriaController@index')->name('categorias.index');
  Route::post('categorias/salvar', 'CategoriaController@store')->name('categorias.store');
  Route::get('/categorias/listar', 'CategoriaController@listar')->name('categorias.listar');
  Route::get('/categorias/editar/{id}', 'CategoriaController@editar')->name('categorias.editar');
  Route::post('/categorias/salvar{id}', 'CategoriaController@salvar_edit')->name('categorias.salvar_edit');
  Route::post('/categorias/deletar', 'CategoriaController@deletar')->name('categorias.deletar');
  // FIM CATEGORIAS
  
  Route::resource('segmentos', 'SegmentosController');

  Route::resource('arquivos', 'ArquivoController');
  Route::get('arquivos/status/{id}', 'ArquivoController@alt_status')->name('status');

  Route::post('contato/informacao', 'ContatoController@get_info')->name('contato.get_info');

  Route::resource('contatos', 'ContatoController');
  
  Route::post('/segmentos/filtro', 'SegmentosController@filtro_busca')->name('segmento.filtro');
  
  Route::post('/segmentos/alterar_status', 'SegmentosController@alterar_status')->name('segmento.alterar_status');
  
  Route::post('/segmentos/remover_imagem', 'SegmentosController@remover_imagem')->name('segmento.remover_imagem');
  
  Route::resource('videos', 'VideosController');
  
  Route::post('/videos/alterar_status', 'VideosController@alterar_status')->name('videos.alterar_status');
  
  Route::resource('cases', 'CasesController');
  
  Route::post('/cases/alterar_status', 'CasesController@alterar_status')->name('cases.alterar_status');
  
  Route::post('/cases/remover_imagem', 'CasesController@remover_imagem')->name('cases.remover_imagem');
  
  Route::get('/metas/edit_metas', 'MetaController@edit_metas')->name('metas.edit_metas');

  Route::resource('metas', 'MetaController');
  
  Route::post('/metas/retornar_formulario_meta', 'MetaController@retornar_formulario_meta')->name('metas.retornar_formulario_meta');

  Route::post('/metas/retornar_formulario_meta_editar', 'MetaController@retornar_formulario_meta_editar')->name('metas.retornar_formulario_meta_editar');
  
  Route::post('/metas/cadastro/texto', 'MetaController@store_texto')->name('metas.store_texto');
  
  Route::post('/metas/cadastro/imagem', 'MetaController@store_imagem')->name('metas.store_imagem');
  
  Route::post('/metas/editar/imagem', 'MetaController@update_img')->name('metas.update_img');  

});

//rotas Banners
Route::get('/banners', 'BannerController@banner')->middleware('auth');
Route::post('/banner/alterar_status', 'BannerController@alterar_status');
Route::post('/banner/cadastro', 'BannerController@cadastro_banner');
Route::get('/banner/{id}', 'BannerController@banner_editar')->middleware('auth');
Route::post('/banner/cadastro/banco', 'BannerController@cadastro_banner_banco');
Route::post('/banner/excluir', 'BannerController@excluir_banner');

// rotas paginas e localizacao
Route::get('/paginas', 'PaginasController@listar')->middleware('auth');
Route::get('/cadastro_pagina', 'PaginasController@cadastro_paginas_tela')->middleware('auth');
Route::post('/cadastro_pagina/cadastro', 'PaginasController@cadastro_pagina_banco');
Route::post('/paginas/cadastro/localizacao', 'PaginasController@cadastrar_localizacao');
Route::post('/paginas/remover/localizacao', 'PaginasController@remove_localizacao');
Route::post('/paginas/alterar_status/localizacao', 'PaginasController@alterar_status_pagina');
Route::post('/paginas/listar/paginas/id', 'PaginasController@listar_paginas_id');
Route::get('/paginas/editar/{id}', 'PaginasController@editar')->middleware('auth');
Route::post('/paginas/remover_imagem', 'PaginasController@remove_image');
Route::delete('/paginas/remover_icone/{id}', 'PaginasController@remove_icone');



// rotas galeria
Route::get('/galeria', 'GaleriaController@galeria')->middleware('auth');
Route::post('/galeria/alterar_status', 'GaleriaController@alterar_status_galeria');
Route::post('/galeria/cadastro/localizacao', 'GaleriaController@cadastro_localizacao_galeria');
Route::post('/galeria/editar/titulo', 'GaleriaController@galeria_editar_titulo');

//rotas Fotos
Route::get('/fotos/{id}', 'FotosController@index')->middleware('auth');
Route::post('/cadastro/fotos', 'FotosController@cadastro_fotos');
Route::post('/editar/foto/titulo', 'FotosController@editar_titulo');
Route::post('/excluir/foto/', 'FotosController@excluir_foto');
Route::get('/logout', 'Auth\LoginController@logout');
