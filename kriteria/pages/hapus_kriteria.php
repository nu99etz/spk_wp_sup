<?php

if (Route::is_ajax()) {

    $id = $p_act;

    $sql = "select count(id_kriteria) as total from nilai_bobot_kriteria where id_kriteria = $id";
    $query = mysqli_query($conn->connect(), $sql);
    $total = mysqli_fetch_assoc($query);

    if($total > 0) {
        $response = [
            'status' => 422,
            'messages' => 'Hapus Kriteria Gagal karena sudah menjadi referensi nilai_bobot_kriteria'
        ];
    } else {
        $sql_kriteria = "delete from kriteria where id = $id";
        $query_kriteria = mysqli_query($conn->connect(), $sql_kriteria);

        $response = [
            'status' => 200,
            'messages' => 'Hapus Kriteria Sukses'
        ];
    }

    echo json_encode($response);
}