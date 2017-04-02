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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/list-stock', function() {
    $begin = memory_get_usage();
    foreach (DB::table('products')->get() as $product) {
      if ( $product->stock > 20 ) {
        echo $product->name . ' : ' . $product->stock . '<br>';
      }
    }
    echo 'Total memory usage : ' . (memory_get_usage() - $begin);
});

/* You must specify an orderBy clause when using this function.
Route::get('/list-stock-chunk', function() {
    $begin = memory_get_usage();
    DB::table('products')->chunk(100, function($products)
    {
    foreach ($products as $product)
      {
      if ( $product->stock > 20 ) {
        echo $product->name . ' : ' . $product->stock . '<br>';
      }
    }
    });
    echo 'Total memory usage : ' . (memory_get_usage() - $begin);
});
*/
