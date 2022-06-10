<?php

if (Route::is_ajax()) {

    function ifExist($conn, $id)
    {
        $sql = "select count(id) as total from temp_list where id_produk = $id";
        $query = mysqli_query($conn->connect(), $sql);
        $total = mysqli_fetch_assoc($query);

        if ($total['total'] > 0) {
            return true;
        } else {
            return false;
        }
    }

    function getAlternatif($data, $idKriteria)
    {
        if (isset($data[$idKriteria])) {
            return $data[$idKriteria];
        } else {
            return " - ";
        }
    }

    $sql = "select*from kriteria_produk a join produk b on a.id_produk = b.id join kriteria c on a.id_kriteria = c.id";

    $query = mysqli_query($conn->connect(), $sql);

    $map = [];
    $record = [];
    $no = 1;

    while ($alternatif = mysqli_fetch_array($query)) {
        $row = [];
        $map[$alternatif['id_produk']][$alternatif['nama_produk']][$alternatif['id_kriteria']] = $alternatif['nilai_kriteria'];
    }

    $sqlKriteria = "select id from kriteria where id in (select id_kriteria from nilai_bobot_kriteria)";
    $queryKriteria = mysqli_query($conn->connect(), $sqlKriteria);

    $kriteriaRow = [];
    while ($kriteria = mysqli_fetch_array($queryKriteria)) {
        $kriteriaRow[] = $kriteria['id'];
    }

    foreach ($map as $key => $value) {
        $row = [];
        if (ifExist($conn, $key)) {
            $url = $config['base_url'] . $config['path'] . "/spk_wp/proses_pemilihan/delete/" . $key;
            $row[] = '<input type = "checkbox" id = "pilih" act = "' . $url . '" checked>';
        } else {
            $url = $config['base_url'] . $config['path'] . "/spk_wp/proses_pemilihan/add/" . $key;
            $row[] = '<input type = "checkbox" id = "pilih" act = "' . $url . '">';
        }
        foreach ($value as $key2 => $value2) {
            $row[] = $key2;
        }
        foreach ($kriteriaRow as $value) {
            $row[] = getAlternatif($value2, $value);
        }
        $no++;
        $record[] = $row;
    }

    // Maintence::debug($record);

    echo json_encode([
        'data' => $record,
    ]);
}