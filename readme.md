# Contoh Laravel Database Model

Contoh Laravel Database Model

#### Placeholder Binding
>>> DB::insert('insert into products (name, description, price, stock) values (?, ?, ?, ?)', ["Toyota Avanzka", "Tipe Manual", 250000, 5]);

#### Named Binding
>>> DB::insert('insert into products (name, description, price, stock) values (:mobil, :penjelasan, :harga, :stok)', ["mobil"=>"Mazda 2", "penjelasan"=>"Tipe CVT", "harga"=>350000, "stok"=>3]);                                                                                                                                                                    

## Terima Kasih

* [Rahmat Awaludin](https://github.com/rawaludin/)
