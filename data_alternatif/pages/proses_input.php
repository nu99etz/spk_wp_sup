<?php

if (Route::is_ajax()) {

    // Maintence::debug($_POST['nilai']);

    // validasi data
    $msg = array();
    foreach ($_POST as $key => $value) {
        if ($_POST[$key] == "") {
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

            $nama_produk = $_POST['nama_produk'];

            foreach ($_POST['nilai'] as $key => $value) {
                $sql = "insert into kriteria_produk (id_produk, id_kriteria, nilai_kriteria) values ('$nama_produk', '$key', '$value')";
                $query = mysqli_query($conn->connect(), $sql);
            }

            if (!$query) {
                $response = [
                    'status' => 422,
                    'messages' => 'Gagal Input Alternatif'
                ];
            } else {
                $response = [
                    'status' => 200,
                    'messages' => 'Sukses Input Alternatif'
                ];
            }
        } else {

            // proses update data
            if ($_POST['_method'] == "PUT") {

                // Hapus Data Alternatif dulu
                $id = $_POST['id'];

                $sqlHapusAlternatif = "delete from kriteria_produk where id_produk = $id";
                $queryHapusAlternatif = mysqli_query($conn->connect(), $sqlHapusAlternatif);

                $nama_produk = $_POST['nama_produk'];

                foreach ($_POST['nilai'] as $key => $value) {
                    $sql = "insert into kriteria_produk (id_produk, id_kriteria, nilai_kriteria) values ('$nama_produk', '$key', '$value')";
                    $query = mysqli_query($conn->connect(), $sql);
                }

                if (!$query) {
                    $response = [
                        'status' => 422,
                        'messages' => 'Gagal Update Alternatif'
                    ];
                } else {
                    $response = [
                        'status' => 200,
                        'messages' => 'Sukses Update Alternatif'
                    ];
                }
            } else {
                $response = [
                    'status' => 422,
                    'messages' => 'Gagal Update Alternatif'
                ];
            }
        }

        echo json_encode($response);
    }
}
