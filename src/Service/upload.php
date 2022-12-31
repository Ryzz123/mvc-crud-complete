<?php
function upload() {
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek gambar
    if ($error == 4) {
        echo "
                 <script>alert('Pilih Gambar Terlebih Dahulu')</script>
                ";
        return false;
    }

    $ektensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.',$namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ektensiGambarValid)) {
        echo "
                 <script>alert('Yang Anda Masukan Bukan Gambar')</script>
                ";
        return false;
    }

    // cek ukuran gambar
    if ($ukuranFile === 2000000) {
        echo "
                 <script>alert('Gambar Yang Anda Masukan Terlalu Besar')</script>
                ";
        return false;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, '../public/image/'. $namaFileBaru);

    return $namaFileBaru;
}