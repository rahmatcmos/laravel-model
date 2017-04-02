<?php namespace App;

class Sekolah {
    protected $nama;
    protected $alamat;

    public function __construct($nama, $alamat)
    {
      $this->nama = $nama;
      $this->alamat = $alamat;
    }

    public function __toString()
    {
      /* String
      return "Nama : " . $this->nama . "\n" . "Alamat : " . $this->alamat;
      */

      // Json
      return json_encode(['nama' => $this->nama, 'alamat' => $this->alamat]);
      
    }
}
