<?php
include('koneksi.php'); // Koneksi ke database
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table thead {
            background-color: #4682B4; /* Biru tua */
            color: white;
        }
        .table tbody tr:nth-child(odd) {
            background-color: #F0F8FF; /* Biru lembut */
        }
        .table tbody tr:nth-child(even) {
            background-color: #E8F4FA; /* Biru terang */
        }
        .table tbody tr:hover {
            background-color: #D4ECF9; /* Biru hover */
        }
        .btn-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0.375rem;
            width: 32px;
            height: 32px;
            border-radius: 50%;
        }
        .matkul-list {
            text-align: left;
            padding-left: 10px;
            margin: 0;
        }
        .matkul-list li {
            margin-bottom: 3px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow p-4 mb-5">
            <div class="text-center mb-4">
                <h1 class="display-5">Sistem Input Kartu Rencana Studi (KRS)</h1>
                <p class="text-secondary">Kelola data mahasiswa dengan mudah dan cepat.</p>
            </div>
            <div class="card shadow p-4 mb-5">
                <form method="POST">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <input type="text" name="namaMhs" class="form-control" placeholder="Nama Mahasiswa" required>
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="nim" class="form-control" placeholder="NIM" required>
                        </div>
                        <div class="col-md-3">
                            <input type="number" step="0.01" name="ipk" class="form-control" placeholder="IPK" required>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" name="submit" class="btn btn-primary w-100">Tambah Mahasiswa</button>
                        </div>
                    </div>
                </form>

                <?php
                if (isset($_POST['submit'])) {
                    $namaMhs = $_POST['namaMhs'];
                    $nim = $_POST['nim'];
                    $ipk = floatval($_POST['ipk']);
                    $sks = $ipk < 3 ? 20 : 24;

                    $check = $conn->query("SELECT * FROM inputmhs WHERE nim = '$nim'");
                    if ($check->num_rows > 0) {
                        echo "<div class='alert alert-danger mt-3'>NIM sudah digunakan!</div>";
                    } else {
                        $sql = "INSERT INTO inputmhs (namaMhs, nim, ipk, sks) VALUES ('$namaMhs', '$nim', '$ipk', '$sks')";
                        if ($conn->query($sql) === TRUE) {
                            echo "<div class='alert alert-success mt-3'>Mahasiswa berhasil ditambahkan!</div>";
                        } else {
                            echo "<div class='alert alert-danger mt-3'>Terjadi kesalahan: " . $conn->error . "</div>";
                        }
                    }
                }
                ?>
            </div>

            <div class="card shadow p-4">
                <h2 class="text-center">Daftar Mahasiswa</h2>
                <table class="table table-hover text-center mt-3">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>IPK</th>
                            <th>SKS Maksimal</th>
                            <th>Mata Kuliah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "
                            SELECT 
                                m.id AS mhs_id, 
                                m.namaMhs, 
                                m.ipk, 
                                m.sks AS max_sks, 
                                GROUP_CONCAT(CONCAT(j.matakuliah, ' (', j.sks, ' SKS)') SEPARATOR '|') AS matakuliah
                            FROM 
                                inputmhs m
                            LEFT JOIN 
                                jwl_mhs j ON m.id = j.mhs_id
                            GROUP BY 
                                m.id
                        ";
                        $result = $conn->query($query);
                        $no = 1;

                        while ($row = $result->fetch_assoc()) {
                            $matakuliahList = $row['matakuliah'] 
                                ? explode('|', $row['matakuliah']) 
                                : ["-"];
                            
                            // Batasi hanya 3 mata kuliah pertama
                            $limitedMatkul = array_slice($matakuliahList, 0, 3);
                            $remainingMatkulCount = count($matakuliahList) - 3;

                            echo "<tr>
                                <td>{$no}</td>
                                <td>{$row['namaMhs']}</td>
                                <td>{$row['ipk']}</td>
                                <td>{$row['max_sks']}</td>
                                <td>
                                    <ul class='matkul-list'>";
                                    
                            foreach ($limitedMatkul as $matkul) {
                                echo "<li>{$matkul}</li>";
                            }
                            
                            if ($remainingMatkulCount > 0) {
                                echo "<li>...dan {$remainingMatkulCount} mata kuliah lainnya</li>";
                            }

                            echo "</ul>
                                </td>
                                <td>
                                    <a href='edit_mhs.php?id={$row['mhs_id']}' class='btn btn-warning btn-sm'>Edit</a>
                                    <a href='cetakKRS.php?id={$row['mhs_id']}' class='btn btn-info btn-sm'>Lihat</a>
                                    <a href='hapus_mhs.php?id={$row['mhs_id']}' class='btn btn-danger btn-sm'>Hapus</a>
                                </td>
                            </tr>";
                            $no++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
