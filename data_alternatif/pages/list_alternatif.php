<?php

if (Route::is_ajax()) {

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
        $row[] = $no;
        foreach($value as $key2 => $value2) {
            $row[] = $key2;
        }
        foreach ($kriteriaRow as $value) {
            $row[] = getAlternatif($value2, $value);
        }
        if(Auth::getSession('role') == 1) {
            $button = '<button type="button" name="hapus" id="' . $key . '" class="hapus btn-flat btn-danger btn-sm"><i class = "fa fa-trash"></i></button> ';
            $button .= '<button type="button" name="ubah" id="' . $key . '" class="ubah btn-flat btn-warning btn-sm"><i class = "fa fa-edit"></i></button> ';
            $row[] = $button;
        }
        $no++;
        $record[] = $row;
    }

    echo json_encode([
        'data' => $record,
    ]);
}
