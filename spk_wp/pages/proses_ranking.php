<?php

if (Route::is_ajax()) {

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
            if($value > 10) {
                $msg[$key] = getNameKriteria($conn, $key, 'nama_kriteria') . ' Nilai Inputan Maksimal 10';
            }
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
            // Maintence::debug($record);

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

        $sql = "select*from kriteria_produk a join produk b on a.id_produk = b.id join kriteria c on a.id_kriteria = c.id";

        $query = mysqli_query($conn->connect(), $sql);

        $map = [];
        $record = [];
        $no = 1;

        while ($alternatif = mysqli_fetch_array($query)) {
            $row = [];
            $row[$alternatif['id_kriteria']] = converter($conn, $alternatif['id_kriteria'], $alternatif['nilai_kriteria']);
            $map[$alternatif['id_produk']][$alternatif['nama_produk']][] = $row;
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

            // PROSES FINISHING UNTUK MENAMPILKAN KE TABEL SESUAI RANKING
            array_multisort(array_column($vektorV, 'vektor_v'), SORT_DESC, $vektorV);

            // Input Ke Table user_ranking
            if(empty($_POST['nama_peranking'])) {
                $namaUser = 'bot';
            } else {
                $namaUser = $_POST['nama_peranking'];
            }

            $recordParameter = [];
            foreach($_POST['nilai'] as $key => $value) {
                $row = [];
                $row[getNameKriteria($conn, $key, 'nama_kriteria')] = $value;
                $recordParameter[] = $row;
            }

            $recordHasilRank = [];
            for($i = 0; $i < 5; $i++) {
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

            $html = "";
            $no = 1;
            foreach ($vektorV as $key => $value) {
                $html .= "<tr>";
                $html .= "<td>" . $no . "</td>";
                $html .= "<td>" . $value['v_vektor_id'] . "</td>";
                $html .= "<td>" . $value['nama_produk'] . "</td>";
                $html .= "<td>" . $value['vektor_s'] . "</td>";
                $html .= "<td>" . $value['vektor_v'] . "</td>";
                $html .= "</tr>";
                $no++;
            }

            echo json_encode([
                'status' => 200,
                'messages' => 'Perankingan Sukses Dilakukan',
                'html' => $html
            ]);
        } else {
            echo json_encode([
                'status' => 422,
                'messages' => 'Nilai Total Perbaikan Bobot Harus 1',
            ]);
        }
    }
}
