<?php

if (Route::is_ajax()) {

    $id = $p_act;

    $sqlAlternatif = "select count(id_produk) as total from kriteria_produk where id_produk = $id";
    $queryAlternatif = mysqli_query($conn->connect(), $sqlAlternatif);
    $total = mysqli_fetch_assoc($queryAlternatif);

    if($total['total'] > 0) {
        $response = [
            'status' => 422,
            'messages' => 'Hapus Produk Gagal karena sudah menjadi referensi kriteria_produk'
        ];
    } else {
        $sql = "select gambar from produk where id = $id";
        $query = mysqli_query($conn->connect(), $sql);
        $product = mysqli_fetch_array($query);
        unlink(Route::getUploadPath('produk', $product['gambar']));
    
        $sql_produk = "delete from produk where id = $id";
        $query_produk = mysqli_query($conn->connect(), $sql_produk);

        $response = [
            'status' => 200,
            'messages' => 'Hapus Produk Sukses'
        ];
    }

    echo json_encode($response);
}
