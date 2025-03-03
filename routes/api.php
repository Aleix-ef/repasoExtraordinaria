Route::post('login', [AuthController::class, 'login'])->middleware('api');
Route::post('register', [AuthController::class, 'register'])->middleware('api');


Route::middleware(['auth:sanctum','api'])->group( function () {
    Route::apiResource('jugadores',  JugadoraController::class);
    Route::post('logout', [AuthController::class, 'logout']);

});