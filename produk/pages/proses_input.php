<?php

if (Route::is_ajax()) {

    // validasi data
    $msg = array();
    foreach ($_POST as $key => $value) {
        if (empty($_POST[$key])) {
            $msg[$key] = $key . " Tidak Boleh Kosong";
        }
    }

    if ($msg) {
        $error_validation = implode("<br/>", $msg);
        $response = array(
            'status' => 422,
            'messages' => $error_validation
        );
        echo json_encode($response);
    } else {
        if (empty($_POST["_method"])) {

            $nama_produk = strtoupper($_POST['nama_produk']);
            $sql = "insert into produk (nama_produk) values ('$nama_produk')";

            $query = mysqli_query($conn->connect(), $sql);

            if (!$query) {
                $response = [
                    'status' => 422,
                    'messages' => 'Gagal Input Produk'
                ];
            } else {
                $response = [
                    'status' => 200,
                    'messages' => 'Sukses Input Produk'
                ];
            }
        } else {
            
            // proses update data
            if ($_POST['_method'] == "PUT") {
                $nama_produk = strtoupper($_POST['nama_produk']);
                $id = $_POST['id'];

                $sql = "update produk set nama_produk = '$nama_produk' where id = $id and 1=1";

                $query = mysqli_query($conn->connect(), $sql);

                if (!$query) {
                    $response = [
                        'status' => 422,
                        'messages' => 'Gagal Update Produk'
                    ];
                } else {
                    $response = [
                        'status' => 200,
                        'messages' => 'Sukses Update Produk'
                    ];
                }
            } else {
                $response = [
                    'status' => 422,
                    'messages' => 'Gagal Update Produk'
                ];
            }
        }

        echo json_encode($response);
    }
}
