<?php
use App\Http\Controllers\Admin\AnexosPolizasAutomotorController;
use App\Http\Controllers\Admin\DocumentosAnexosController;
use App\Http\Controllers\Admin\ManualSuscripcionAutoController;
use App\Http\Controllers\Admin\ManualSuscripcionMotoController;
use App\Http\Controllers\AseguradoController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CallCenterController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\CotizaVehiculoController;
use App\Http\Controllers\FormularioProductorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InmobiliariaController;
use App\Http\Controllers\OperarioController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\PrecioEstimativoController;
use App\Http\Controllers\ProductorController;
use App\Http\Controllers\SepelioController;
use App\Http\Controllers\SiniestroController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\TerceroController;
use App\Http\Livewire\Admin\PanelAdmin;
use App\Http\Livewire\Auditoria;
use App\Http\Livewire\PanelInmobiliaria;
use App\Http\Livewire\PanelOperario;
use App\Http\Livewire\Sepelio\FormSepelio;
use App\Models\Solicitud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DenunciaAseguradoController;
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

Auth::routes();
Route::group(['middleware' =>'guest'], function () {

//Route::get('/login/github', [LoginController::class, 'github']);

Route::get('/login/{provider}', [LoginController::class, 'provider']);
Route::get('/login/{provider}/redirect', [LoginController::class, 'providerRedirect']);
//Route::get('/login/github/redirect', [LoginController::class, 'githubRedirect']);

//Route::get('/login/facebook', [LoginController::class, 'facebook']);
//Route::get('/login/facebook/redirect', [LoginController::class, 'facebookRedirect']);
});

Route::get('/pdf/{poliza}', [PDFController::class, 'generatePDF'])->name('pdf.generate');


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/somos-finisterre',function () {
    return view('somos-finisterre');
})->name('somos-finisterre');

Route::get('/garantias',function () {
    return view('garantias');
})->name('garantias');

Route::get('/solicitar-seguro',function () {
    return view('solicitar-seguro');
})->name('solicitar-seguro');

Route::get('/gracias',function () {
    return view('gracias');
})->name('gracias');

Route::get('/muchas-gracias',function (Request $request) {
    return view('muchas-gracias',['email' => $request->email]);
})->name('muchas-gracias');

Route::get('/contacto/gracias',function (Request $request) {
    return view('gracias-contacto');
})->name('gracias-contacto');

Route::get('/denuncia/gracias',function (Request $request) {
    return view('gracias-denuncia');
})->name('gracias-denuncia');


Route::get('/ciudades/{city}', [CityController::class, 'getCities'])->name('city.get');

Route::get('/legales',function () {
    return view('legales');
})->name('legales');

Route::get('/preguntas-frecuentes',function () {
    return view('preguntas-frecuentes');
})->name('preguntas-frecuentes');


Route::get('/contacto', [ContactoController::class,'index'])->name('contacto');
Route::post('/contacto', [ContactoController::class,'mail'])->name('contacto.mail');

Route::get('/productor/alta', [FormularioProductorController::class,'index'])->name('productor.alta');
Route::post('/productor/alta', [FormularioProductorController::class,'mail'])->name('productor.mail');
Route::get('/panel-productor/{user}', [ProductorController::class,'index'])->name('panel-productor')->middleware('check.productor');

Route::get('/sepelio/solicitud/alta', [SepelioController::class,'index'])->name('sepelio.index')->middleware('auth');
Route::post('/sepelio/solicitud/firma/{firma}', [FormSepelio::class,'setFirma'])->name('sepelio.setFirma')->middleware('auth');



// Route::get('/produci-con-finisterre',function () {
//     return view('trabaja-con-nosotros');
// })->name('trabaja');

Route::group(['middleware' =>'auth'], function () {
Route::post('estado-poliza', [SolicitudController::class, 'store'])->name('estadoPoliza.create');
Route::get('estado-poliza/{solicitud}', [SolicitudController::class, 'show'])->name('estadoPoliza.show')->middleware('check.solicitud');
Route::get('/panel/{user}', PanelInmobiliaria::class)->name('panel')->middleware('check.user'); // PANEL INMOBILIARIA ES TANTO PARA PARTICULARES COMO INMOBILIARIAS
Route::get('/panel-operario', PanelOperario::class)->name('panel-operario')->middleware('check.operario');
Route::get('/auditoria/{solicitud}', Auditoria::class)->name('auditoria')->middleware('check.operario');
Route::get('/datos-poliza/{solicitud}',function (Solicitud $solicitud) {
    return view('auth.operario.datos-poliza',['solicitud' => $solicitud]);
})->name('datos-poliza')->middleware('check.operario');

Route::post('/monto/update/{id}', [OperarioController::class,'update'])->name('monto.update')->middleware('check.operario');

});
Route::post('/pago/{pago}', [PagoController::class,'store'])->name('pago.store')->middleware('check.pago');

/*Route::get('/precio-estimativo-alquileres/{precio}', function(Request $request){

	return view('precio-estimativo-alquileres', ['precio' => $request->precio]);
})->name('precio-estimativo-alquileres'); */

Route::post('precio-estimativo-alquileres', [PrecioEstimativoController::class, 'showPrecio'])->name('precio-estimativo-alquileres');
/*Route::get('/precio-estimativo-alquileres',function () {
    return view('precio-estimativo-alquileres');
})->name('precio-estimativo-alquileres'); */

Route::post('notificacion/pago',[PagoController::class,'ipnNotificacion'])->name('notificacion.pago');


Route::get('siniestros', [SiniestroController::class,'index'])->name('siniestro.index');


Route::get('siniestros/asegurados', [AseguradoController::class,'index'])->name('asegurado.index');
Route::get('siniestros/terceros', [TerceroController::class,'index'])->name('tercero.index');


// RUTA DE ADMIN
Route::group(['middleware' =>'auth'], function () {
    Route::get('/panel-admin', PanelAdmin::class)->name('panel-admin')->middleware('check.admin');
    Route::get('/panel-admin/anexos-polizas-automotor', [AnexosPolizasAutomotorController::class,'index'])->name('anexos-polizas-automotor')->middleware('check.admin');
    Route::get('/panel-admin/manual-suscripcion-automotor', [ManualSuscripcionAutoController::class,'index'])->name('manual-suscripcion-automotor')->middleware('check.admin');
    Route::get('/panel-admin/manual-suscripcion-moto', [ManualSuscripcionMotoController::class,'index'])->name('manual-suscripcion-moto')->middleware('check.admin');
    Route::post('/panel-admin/agregardocumento', [DocumentosAnexosController::class,'store'])->name('documentoanexo.store')->middleware('check.admin');
});


Route::get('/cotiza-vehiculo', [CotizaVehiculoController::class,'index'])->name('cotiza-vehiculo');
Route::post('/cotiza-vehiculo', [CotizaVehiculoController::class,'mail'])->name('cotiza-vehiculo-mail');

Route::get('render-marcas', [CotizaVehiculoController::class,'renderMarcas'])->name('render-marcas');
Route::get('render-modelos', [CotizaVehiculoController::class,'renderModelos'])->name('render-modelos');
Route::get('render-usos', [CotizaVehiculoController::class,'renderUsos'])->name('render-usos');
Route::get('render-tipos', [CotizaVehiculoController::class,'renderTipos'])->name('render-tipos');


Route::get('/callcenter', [CallCenterController::class,'index'])->name('panel-callcenter')->middleware('check.callcenter');
Route::get('/callcenter/{cotizacion}', [CallCenterController::class,'show'])->name('panel-callcenter.show')->middleware('check.callcenter');


Route::get('asegurados/denuncias/paso-1',[DenunciaAseguradoController::class,'paso1create'])->name('asegurados-denuncias-paso1.create');
Route::post('asegurados/denuncias/paso-1',[DenunciaAseguradoController::class,'paso1store'])->name('asegurados-denuncias-paso1.store');

Route::get('asegurados/denuncias/paso-2',[DenunciaAseguradoController::class,'paso2create'])->name('asegurados-denuncias-paso2.create');
Route::post('asegurados/denuncias/paso-2',[DenunciaAseguradoController::class,'paso2store'])->name('asegurados-denuncias-paso2.store');


Route::get('asegurados/denuncias/paso-3',[DenunciaAseguradoController::class,'paso3create'])->name('asegurados-denuncias-paso3.create');
Route::post('asegurados/denuncias/paso-3',[DenunciaAseguradoController::class,'paso3store'])->name('asegurados-denuncias-paso3.store');


Route::get('asegurados/denuncias/paso-4',[DenunciaAseguradoController::class,'paso4create'])->name('asegurados-denuncias-paso4.create');
Route::post('asegurados/denuncias/paso-4',[DenunciaAseguradoController::class,'paso4store'])->name('asegurados-denuncias-paso4.store');


Route::get('asegurados/denuncias/paso-5',[DenunciaAseguradoController::class,'paso5create'])->name('asegurados-denuncias-paso5.create');
Route::post('asegurados/denuncias/paso-5',[DenunciaAseguradoController::class,'paso5store'])->name('asegurados-denuncias-paso5.store');


Route::get('asegurados/denuncias/paso-6',[DenunciaAseguradoController::class,'paso6create'])->name('asegurados-denuncias-paso6.create');
Route::post('asegurados/denuncias/paso-6',[DenunciaAseguradoController::class,'paso6store'])->name('asegurados-denuncias-paso6.store');

Route::get('asegurados/denuncias/paso-6/agregar',[DenunciaAseguradoController::class,'paso6agregarcreate'])->name('asegurados-denuncias-paso6agregar.create');
Route::post('asegurados/denuncias/paso-6/agregar',[DenunciaAseguradoController::class,'paso6agregarstore'])->name('asegurados-denuncias-paso6agregar.store');

Route::get('asegurados/denuncias/paso-6/editar',[DenunciaAseguradoController::class,'paso6edit'])->name('asegurados-denuncias-paso6.edit');
Route::post('asegurados/denuncias/paso-6/editar',[DenunciaAseguradoController::class,'paso6update'])->name('asegurados-denuncias-paso6.update');
Route::get('asegurados/denuncias/paso-6/delete',[DenunciaAseguradoController::class,'paso6DeleteItem'])->name('asegurados-denuncias-paso6.deleteItem');

Route::get('asegurados/denuncias/paso-7',[DenunciaAseguradoController::class,'paso7create'])->name('asegurados-denuncias-paso7.create');
Route::post('asegurados/denuncias/paso-7',[DenunciaAseguradoController::class,'paso7store'])->name('asegurados-denuncias-paso7.store');

Route::get('asegurados/denuncias/paso-7/agregar',[DenunciaAseguradoController::class,'paso7agregarcreate'])->name('asegurados-denuncias-paso7agregar.create');
Route::post('asegurados/denuncias/paso-7/agregar',[DenunciaAseguradoController::class,'paso7agregarstore'])->name('asegurados-denuncias-paso7agregar.store');

Route::get('asegurados/denuncias/paso-7/editar',[DenunciaAseguradoController::class,'paso7edit'])->name('asegurados-denuncias-paso7.edit');
Route::post('asegurados/denuncias/paso-7/editar',[DenunciaAseguradoController::class,'paso7update'])->name('asegurados-denuncias-paso7.update');
Route::get('asegurados/denuncias/paso-7/delete',[DenunciaAseguradoController::class,'paso7DeleteItem'])->name('asegurados-denuncias-paso7.deleteItem');


Route::get('asegurados/denuncias/paso-8',[DenunciaAseguradoController::class,'paso8create'])->name('asegurados-denuncias-paso8.create');
Route::post('asegurados/denuncias/paso-8',[DenunciaAseguradoController::class,'paso8store'])->name('asegurados-denuncias-paso8.store');

Route::get('asegurados/denuncias/paso-8/agregar',[DenunciaAseguradoController::class,'paso8agregarcreate'])->name('asegurados-denuncias-paso8agregar.create');
Route::post('asegurados/denuncias/paso-8/agregar',[DenunciaAseguradoController::class,'paso8agregarstore'])->name('asegurados-denuncias-paso8agregar.store');

Route::get('asegurados/denuncias/paso-8/editar',[DenunciaAseguradoController::class,'paso8edit'])->name('asegurados-denuncias-paso8.edit');
Route::post('asegurados/denuncias/paso-8/editar',[DenunciaAseguradoController::class,'paso8update'])->name('asegurados-denuncias-paso8.update');
Route::get('asegurados/denuncias/paso-8/delete',[DenunciaAseguradoController::class,'paso8DeleteItem'])->name('asegurados-denuncias-paso8.deleteItem');


Route::get('asegurados/denuncias/paso-9',[DenunciaAseguradoController::class,'paso9create'])->name('asegurados-denuncias-paso9.create');
Route::post('asegurados/denuncias/paso-9',[DenunciaAseguradoController::class,'paso9store'])->name('asegurados-denuncias-paso9.store');

Route::get('asegurados/denuncias/paso-10',[DenunciaAseguradoController::class,'paso10create'])->name('asegurados-denuncias-paso10.create');
Route::post('asegurados/denuncias/paso-10',[DenunciaAseguradoController::class,'paso10store'])->name('asegurados-denuncias-paso10.store');

Route::get('asegurados/denuncias/paso-11',[DenunciaAseguradoController::class,'paso11create'])->name('asegurados-denuncias-paso11.create');


Route::get('asegurados/denuncias/paso-12',[DenunciaAseguradoController::class,'paso12create'])->name('asegurados-denuncias-paso12.create');
Route::post('asegurados/denuncias/paso-12',[DenunciaAseguradoController::class,'paso12store'])->name('asegurados-denuncias-paso12.store');

Route::get('/panel-siniestros', [DenunciaAseguradoController::class,'index'])->name('panel-siniestros')->middleware('check.siniestro');
Route::get('/panel-siniestros/denuncias/{denuncia}', [DenunciaAseguradoController::class,'show'])->name('panel-siniestros.denuncia.show')->middleware('check.siniestro');
Route::post('/panel-siniestros/denuncias/{denuncia}/cambiar-estado', [DenunciaAseguradoController::class,'cambiarEstado'])->name('panel-siniestros.denuncia.cambiar-estado')->middleware('check.siniestro');
Route::get('/panel-siniestros/denuncias/{denuncia}/observaciones', [DenunciaAseguradoController::class,'agregarObservaciones'])->name('panel-siniestros.denuncia.observaciones')->middleware('check.siniestro');
Route::post('/panel-siniestros/denuncias/{denuncia}/observaciones', [DenunciaAseguradoController::class,'agregarObservacionesStore'])->name('panel-siniestros.denuncia.observaciones.store')->middleware('check.siniestro');
Route::get('/panel-siniestros/delete/denuncias/{denuncia}', [DenunciaAseguradoController::class,'delete'])->name('panel-siniestros.denuncia.delete')->middleware('check.siniestro');
Route::get('/panel-siniestros/pdf/denuncias/{denuncia}', [DenunciaAseguradoController::class,'generarPDF'])->name('panel-siniestros.denuncia.pdf');
Route::post('/panel/siniestro/croquis/', [DenunciaAseguradoController::class,'storeCroquis'])->name('asegurados-denuncias.storeCroquis');
Route::get('/panel-siniestros/buscador', [DenunciaAseguradoController::class,'buscar'])->name('panel-siniestros.denuncia.buscador')->middleware('check.siniestro');

Route::get('/panel-siniestros/update/denuncias/{denuncia}/nropoliza', [DenunciaAseguradoController::class,'updateDenunciaNroPoliza'])->name('panel-siniestros.denuncia.update.nropoliza')->middleware('check.siniestro');
Route::get('/panel-siniestros/update/denuncias/{denuncia}/nrodenuncia', [DenunciaAseguradoController::class,'updateDenunciaNroDenuncia'])->name('panel-siniestros.denuncia.update.nrodenuncia')->middleware('check.siniestro');
Route::get('/panel-siniestros/update/denuncias/{denuncia}/nrosiniestro', [DenunciaAseguradoController::class,'updateDenunciaNroSiniestro'])->name('panel-siniestros.denuncia.update.nrosiniestro')->middleware('check.siniestro');
