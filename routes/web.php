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

Route::get('/product-query', function() {
  DB::connection()->enableQueryLog();

  /* Update dan forgot(hapus) cache
  DB::table('products')->where('id', 1)->update(['price'=>110000000]);
  Cache::forget('product.lowest-price');
  */

  $product = Cache::remember('product.lowest-price', 10, function()
  {
    return DB::table('products')->where('price', DB::table('products')->min('price'))->get();
  });
  var_dump($product);
  var_dump(DB::getQueryLog());
});

Route::get('/customers-log', function() {
  DB::connection()->enableQueryLog();
  $products = DB::table('products')->get();
  $products = DB::table('customers')->whereIn('id', [1,4,5])->select(['name','phone'])->get();
  $customers = DB::table('customers')->leftJoin('membership_types','customers.membership_type_id', '=', 'membership_types.id')->get();
  //var_dump(DB::getQueryLog());
  /* DD Helper output log lebih menarik
  dd(DB::getQueryLog());
  */
});

Route::get('/order-product-manual', function() {
    // memulai transaksi
    DB::beginTransaction();
    try {
    // Membuat record di table `orders`
    $order_id = DB::table('orders')->insertGetId(['customer_id'=>1]);
    // Menambah record baru di `order_products`
    DB::table('orders_products')->insert(['order_id'=>$order_id, 'product_id'=>5]);
    // throw new Exception("Koneksi ke database terputus..");
    } catch (Exception $e) {
    DB::commit();
        return "Error: " . $e->getMessage();
    }
    try {
    // Membayar order (mengisi field `paid_at` di table `orders`)
    DB::table('orders')->where('id',$order_id)->update(['paid_at'=>new DateTime]);
    // throw new Exception("Server Database mati..");
    // Mengurangi stock product
    DB::table('products')->decrement('stock');
    } catch (Exception $e) {
    DB::rollback();
        return "Error: " . $e->getMessage();
    }
    // meyimpan transaksi
    DB::commit();
    echo "Berhasil menjual " . DB::table('products')->find(5)->name . '. <br>';
    echo "Stock terkini : " . DB::table('products')->find(5)->stock;
});

Route::get('/order-product', function() {
    // memulai transaksi
    DB::transaction(function()
    {
    // Membuat record di table `orders`
    $order_id = DB::table('orders')->insertGetId(['customer_id'=>1]);
    // Menambah record baru di `order_products`
    DB::table('orders_products')->insert(['order_id'=>$order_id, 'product_id'=>5]);
    // Membayar order (mengisi field `paid_at` di table `orders`)
    DB::table('orders')->where('id',$order_id)->update(['paid_at'=>new DateTime]);
    // Terjadi error..
    // throw new Exception("Oooppssss.. ada error!");
    // Mengurangi stock product
    DB::table('products')->decrement('stock');
    });
    echo "Berhasil menjual " . DB::table('products')->find(5)->name . '. <br>';
    echo "Stock terkini : " . DB::table('products')->find(5)->stock;
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
