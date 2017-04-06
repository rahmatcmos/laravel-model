<?php

namespace App;

class ProductObserver {
    public function created($model)
    {
        \Log::info('Berhasil menambah ' . $model->name . '. Stok : ' . $model->stock . ' (dibuat dari ProductObserver');
    }
}
