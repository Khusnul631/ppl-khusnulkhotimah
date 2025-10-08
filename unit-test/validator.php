<?php
// File:Validator.php
function validateAge($age) {
    if (!is_numeric($age)){
        throw new InvalidArgumentException("Umur harus berupa angka");
    }
    if ($age< 0){
        throw new InvalidArgumentException("Umur tidak boleh negatif");
    }

  return true;
}

// Fungsi baru: validateName()
function validateName($name) {
    if (empty($name)) {
        throw new InvalidArgumentException("Nama tidak boleh kosong");
    }

    if (!preg_match("/^[a-zA-Z\s]+$/", $name)) {
        throw new InvalidArgumentException("Nama hanya boleh berisi huruf dan spasi");
    }

  return true;
}