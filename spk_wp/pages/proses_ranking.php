<?php

// if (Route::is_ajax()) {

function getNameKriteria($conn, $id, $column)
{
    $sql = "select*from kriteria where id = $id";
    $query = mysqli_query($conn->connect(), $sql);
    $kriteria = mysqli_fetch_assoc($query);
    return $kriteria[$column];
}

// validasi data
$msg = array();
foreach ($_POST['nilai'] as $key => $value) {
    if (empty($_POST['nilai'][$key])) {
        $msg[$key] = getNameKriteria($conn, $key, 'nama_kriteria') . " Tidak Boleh Kosong";
    } else {
        if ($value > 100) {
            $msg[$key] = getNameKriteria($conn, $key, 'nama_kriteria') . ' Nilai Inputan Maksimal 100';
        }
    }
}

if ($msg) {
    // jika ada pesan error kembali ke tampilan awal pemilihan
    $error_validation = implode("<br/>", $msg);
    $_SESSION['apps']['validation'] = $error_validation;
    Route::redirect('../spk_wp');
} else {

    // FUNGSI KONVERSI NILAI BOBOT
    function converter($conn, $id, $alternatif)
    {
        $sql = "select*from nilai_bobot_kriteria where id_kriteria = $id";
        $query = mysqli_query($conn->connect(), $sql);
        $record = [];
        while ($nilai_bobot = mysqli_fetch_assoc($query)) {
            $row = [];
            $explode = explode('-', $nilai_bobot['batas_nilai_parameter']);
            $hilang_huruf = [];
            foreach ($explode as $value) {
                if (is_numeric($value)) {
                    $hilang_huruf[] = $value;
                } else {
                    $filter_angka = preg_replace("/[^a-zA-Z0-9]/", "", $value);
                    $hilang_huruf[] = $filter_angka;
                }
            }
            $row['nilai_parameter'] = $hilang_huruf;
            $row['nilai_bobot'] = $nilai_bobot['nilai_bobot_kriteria'];
            $record[] = $row;
        }


        // Check alternatif jika nilai nya tidak numeric maka hilangkan karakter
        if (is_numeric($alternatif)) {
            $alternatif = $alternatif;
        } else {
            $filter_angka = preg_replace("/[^a-zA-Z0-9]/", "", $alternatif);
            $alternatif = $filter_angka;
        }

        foreach ($record as $key => $value) {
            if (count($value['nilai_parameter']) > 1) {
                if (in_array($alternatif, range($value['nilai_parameter'][0], $value['nilai_parameter'][1]))) {
                    $nilai_bobot = $value['nilai_bobot'];
                }
            } else {
                if ($alternatif > $value['nilai_parameter'][0]) {
                    $nilai_bobot = $value['nilai_bobot'];
                }
            }
        }

        return $nilai_bobot;
    }

    // PROSES MAPPING NILAI BOBOT

    $sql = "select*from kriteria_produk a join produk b on a.id_produk = b.id join kriteria c on a.id_kriteria = c.id where a.id_produk in (select id_produk from temp_list)";

    $query = mysqli_query($conn->connect(), $sql);

    $map = [];
    $record = [];
    $no = 1;

    while ($alternatif = mysqli_fetch_array($query)) {
        $row = [];
        $row[$alternatif['id_kriteria']] = converter($conn, $alternatif['id_kriteria'], $alternatif['nilai_kriteria']);
        $map[$alternatif['id_produk']][$alternatif['nama_produk']][] = $row;
    }

    $sql = "select*from kriteria where id in (select id_kriteria from nilai_bobot_kriteria)";
    $query_kriteria = mysqli_query($conn->connect(), $sql);


    // isi tampilan nilai bobot alternatif produk yang dipilih
    $htmlNilaiBobot = "";
    foreach ($map as $key => $value) {
        $htmlNilaiBobot .= "<tr>";
        foreach ($value as $key2 => $value2) {
            $htmlNilaiBobot .= "<td>" . $key2 . "</td>";
        }
        foreach ($value2 as $key3 => $value3) {
            foreach ($value3 as $key4 => $value4) {
                $htmlNilaiBobot .= "<td>" . $value4 . "</td>";
            }
        }
        $htmlNilaiBobot .= "</tr>";
    }

    // PROSES PENJUMLAHAN NILAI AWAL BOBOT SETIAP KRITERIA

    $sumNilaiAwal = array_sum($_POST['nilai']);


    // PERBAIKAN NILAI BOBOT

    $nilaiPerbaikanBobot = [];
    $totalPerbaikan = 0;
    foreach ($_POST['nilai'] as $key => $value) {

        $nilai = $value / $sumNilaiAwal;

        // CHECK COST / BENEFIT
        $checkCostOrBenefit = getNameKriteria($conn, $key, 'status_kriteria');

        if ($checkCostOrBenefit == 0) {
            $nilaiPerbaikanBobot[] = $nilai * 1;
        } else if ($checkCostOrBenefit == 1) {
            $nilaiPerbaikanBobot[] = $nilai * -1;
        }

        $totalPerbaikan += $nilai;
    }

    $recordParameter = [];
    foreach ($_POST['nilai'] as $key => $value) {
        $row = [];
        $row[getNameKriteria($conn, $key, 'nama_kriteria')] = $value;
        $recordParameter[] = $row;
    }

    // isi tampilan parameter nilai bobot dan normalisasi bobot
    $htmlParameterKriteria = "";
    $i = 0;
    foreach ($recordParameter as $key => $value) {
        foreach ($value as $key2 => $value2) {
            $htmlParameterKriteria .= "<tr>";
            $htmlParameterKriteria .= "<td>" . $key2 . "</td>";
            $htmlParameterKriteria .= "<td>" . $value2 . "</td>";
            $htmlParameterKriteria .= "<td>" . $value2 / array_sum($_POST['nilai']) . "</td>";
            $htmlParameterKriteria .= "<td>" . round($nilaiPerbaikanBobot[$i], 2) . "</td>";
            $htmlParameterKriteria .= "</tr>";
        }
        $i++;
    }

    $htmlParameterKriteria .= "<tr>";
    $htmlParameterKriteria .= "<td>Total Nilai</td>";
    $htmlParameterKriteria .= "<td>" . array_sum($_POST['nilai']) . "</td>";
    $htmlParameterKriteria .= "<td>" . $totalPerbaikan . "</td>";
    $htmlParameterKriteria .= "<td>" . round(array_sum($nilaiPerbaikanBobot), 2) . "</td>";
    $htmlParameterKriteria .= "</tr>";

    if ($totalPerbaikan == 1) {

        // PROSES PENGHITUNGAN VEKTOR S

        $vektorS = [];
        foreach ($map as $key => $value) {
            $row = [];
            $hitungVektorS = [];
            $row['id_produk'] = $key;
            $row['s_vektor_id'] = 'S' . $key;
            foreach ($value as $key2 => $value2) {
                $row['nama_produk'] = $key2;
            }
            $i = 0;
            foreach ($value2 as $key3 => $value3) {
                foreach ($value3 as $key4 => $value4) {
                    $hitungVektorS[] = pow($value4, $nilaiPerbaikanBobot[$i]); // Konversi Nilai Awal ke nilai bobot
                    $i++;
                }
            }

            $perkalianVektorS = 0;
            foreach ($hitungVektorS as $value) {
                if ($perkalianVektorS == 0) {
                    $perkalianVektorS = $value;
                } else {
                    $perkalianVektorS *= $value;
                }
            }

            $row['vektor_s'] = $perkalianVektorS;

            $vektorS[] = $row;
        }

        // PROSES PENJUMLAHAN TOTAL VEKTOR S
        $totalVektorS = 0;
        foreach ($vektorS as $key => $value) {
            $totalVektorS += $value['vektor_s'];
        }

        // isi tampilan nilai vektor s
        $htmlVektorS = "";
        $no = 1;
        foreach ($vektorS as $key => $value) {
            $htmlVektorS .= "<tr>";
            $htmlVektorS .= "<td>" . $no . "</td>";
            $htmlVektorS .= "<td>" . $value['s_vektor_id'] . "</td>";
            $htmlVektorS .= "<td>" . $value['nama_produk'] . "</td>";
            $htmlVektorS .= "<td>" . $value['vektor_s'] . "</td>";
            $htmlVektorS .= "</tr>";
            $no++;
        }


        // PROSES PENGHITUNGAN VEKTOR V
        $vektorV = [];
        foreach ($vektorS as $key => $value) {
            $row = [];
            $row['id_produk'] = $value['id_produk'];
            $row['v_vektor_id'] = 'V' . $value['id_produk'];
            $row['nama_produk'] = $value['nama_produk'];
            $row['vektor_s'] = $value['vektor_s'];
            $row['vektor_v'] = $value['vektor_s'] / $totalVektorS;
            $vektorV[] = $row;
        }

        // isi tampilan nilai vektor v
        $htmlVektorV = "";
        $no = 1;
        foreach ($vektorV as $key => $value) {
            $htmlVektorV .= "<tr>";
            $htmlVektorV .= "<td>" . $no . "</td>";
            $htmlVektorV .= "<td>" . $value['v_vektor_id'] . "</td>";
            $htmlVektorV .= "<td>" . $value['nama_produk'] . "</td>";
            $htmlVektorV .= "<td>" . $value['vektor_v'] . "</td>";
            $htmlVektorV .= "</tr>";
            $no++;
        }


        // PROSES FINISHING UNTUK MENAMPILKAN KE TABEL SESUAI RANKING
        array_multisort(array_column($vektorV, 'vektor_v'), SORT_DESC, $vektorV);

        // Input Ke Table user_ranking
        if (empty($_POST['nama_peranking'])) {
            $namaUser = 'bot';
        } else {
            $namaUser = $_POST['nama_peranking'];
        }

        $recordHasilRank = [];
        for ($i = 0; $i < 5; $i++) {
            $row = [];
            $row['v_vektor_id'] = $vektorV[$i]['v_vektor_id'];
            $row['nama_produk'] = $vektorV[$i]['nama_produk'];
            $row['vektor_s'] = $vektorV[$i]['vektor_s'];
            $row['vektor_v'] = $vektorV[$i]['vektor_v'];
            $recordHasilRank[] = $row;
        }

        $parameterRanking = json_encode($recordParameter);
        $hasilRanking = json_encode($recordHasilRank);

        $sqlInsertUserRank = "insert into user_rank (nama_peranking, parameter_ranking, hasil_ranking, eksekusi) values ('$namaUser', '$parameterRanking', '$hasilRanking', 0)";
        $queryInsertUserRank = mysqli_query($conn->connect(), $sqlInsertUserRank);

        // isi tampilan hasil ranking sesuai nilai vektor tertinggi
        $htmlRank = "";
        $no = 1;
        foreach ($vektorV as $key => $value) {
            $htmlRank .= "<tr>";
            $htmlRank .= "<td>" . $no . "</td>";
            $htmlRank .= "<td>" . $value['v_vektor_id'] . "</td>";
            $htmlRank .= "<td>" . $value['nama_produk'] . "</td>";
            $htmlRank .= "</tr>";
            $no++;
        }
    } else {

        $_SESSION['apps']['validation'] = "nilai normalisasi bobot harus 1";
        Route::redirect('../spk_wp');
    }
}

Page::useLayout("app");

?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"> Ranking Weighted Product</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo $config['base_url'] . $config['path']; ?>">Home</a></li>
                    <li class="breadcrumb-item active">Ranking WP</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container">
        <div class="row">

            <!-- Indentitas peranking -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title m-0">Indentitas Peranking</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                            <thead>
                                <th>Nama Pengguna</th>
                                <td><?php echo $namaUser; ?></td>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>

            <!-- tampilan hasil ranking sesuai nilai vektor tertinggi -->
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title m-0">Hasil Ranking Weighted Product</h5>
                    </div>
                    <div class="card-body">
                        <table id="ranking" class="table table-bordered table-hover" width="100%" cellspacing="0">
                            <thead>
                                <th>No</th>
                                <th>Id Produk</th>
                                <th>Nama Produk</th>
                            </thead>
                            <tbody>
                                <?php echo $htmlRank; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <?php if (Auth::getSession('role') == 1) {
            ?>
                <div class="col-lg-6">
                    <button type="button" class="btn btn-sm btn-flat btn-primary" id="lihat_hitung"><i class="fas fa-eye"></i> Lihat Hasil Perhitungan</button>
                    <button type="button" class="btn btn-sm btn-flat btn-danger" id="sembunyi_hitung"><i class="fas fa-eye-slash"></i> Sembunyi Hasil Perhitungan</button>
                    <br />
                    <br />
                </div>
            <?php   } ?>

        </div>

        <?php if (Auth::getSession('role') == 1) {
        ?>

            <div class="row" id="lihat_hitung_view">
                <!-- tampilan nilai bobot alternatif produk yang dipilih -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title m-0">Nilai Bobot Setiap Alternatif</h5>
                        </div>
                        <div class="card-body">
                            <table id="nilai_bobot" class="table table-bordered table-hover" width="100%" cellspacing="0">
                                <thead>
                                    <th>Nama Produk</th>
                                    <?php while ($kriteria = mysqli_fetch_assoc($query_kriteria)) {
                                    ?>
                                        <th><?php echo ucwords($kriteria['nama_kriteria']); ?></th>
                                    <?php  } ?>
                                </thead>
                                <tbody>
                                    <?php echo $htmlNilaiBobot; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- tampilan parameter nilai bobot dan normalisasi bobot -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title m-0">Nilai Inputan Bobot Kriteria</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                                <thead>
                                    <th>Nama Kriteria</th>
                                    <th>Nilai Inputan Bobot</th>
                                    <th>Nilai Normalisasi Bobot</th>
                                    <th>Nilai Perbaikan Bobot</th>
                                </thead>
                                <tbody>
                                    <?php echo $htmlParameterKriteria; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- tampilan nilai vektor s -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title m-0">Nilai Vektor S</h5>
                        </div>
                        <div class="card-body">
                            <table id="vektor_s" class="table table-bordered table-hover" width="100%" cellspacing="0">
                                <thead>
                                    <th>No</th>
                                    <th>Id Produk</th>
                                    <th>Nama Produk</th>
                                    <th>Vektor S</th>
                                </thead>
                                <tbody>
                                    <?php echo $htmlVektorS; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- tampilan nilai vektor v -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title m-0">Nilai Vektor V</h5>
                        </div>
                        <div class="card-body">
                            <table id="vektor_v" class="table table-bordered table-hover" width="100%" cellspacing="0">
                                <thead>
                                    <th>No</th>
                                    <th>Id Produk</th>
                                    <th>Nama Produk</th>
                                    <th>Vektor V</th>
                                </thead>
                                <tbody>
                                    <?php echo $htmlVektorV; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->
</div>
<!-- /.content -->

<?php Page::buildLayout(); ?>

<script>
    $('#nilai_bobot').DataTable();
    $('#vektor_s').DataTable();
    $('#vektor_v').DataTable();

    $('#lihat_hitung_view').hide();
    $('#sembunyi_hitung').hide();

    $('#lihat_hitung').on('click', function() {
        $('#lihat_hitung_view').show();
        $('#sembunyi_hitung').show();
        $('#lihat_hitung').hide();
    });

    $('#sembunyi_hitung').on('click', function() {
        $('#lihat_hitung_view').hide();
        $('#sembunyi_hitung').hide();
        $('#lihat_hitung').show();
    })
</script>