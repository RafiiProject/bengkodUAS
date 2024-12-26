<?php
include('koneksi.php'); // Koneksi ke database

// Mendapatkan ID mahasiswa dari URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Mengambil data mahasiswa berdasarkan ID
$sql = "SELECT * FROM inputmhs WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();
    $namaMhs = $data['namaMhs'];
    $nim = $data['nim'];
    $ipk = $data['ipk'];

    // Mengambil mata kuliah mahasiswa
    $matkulResult = $conn->query("SELECT * FROM jwl_mhs WHERE mhs_id = $id");
} else {
    echo "Data mahasiswa tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Rencana Studi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.0/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: none;
            width: 100%;
        }
        .header-info {
            background-color: #cce5ff; /* Biru muda */
            padding-top: 20px;
            padding-right: 20px;
            padding-left: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .header-info p {
            margin: 0;
            font-size: 16px;
        }
        .header-info strong {
            font-weight: bold;
        }
        .table-container {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
        }
        .table th, .table td {
            text-align: center;
        }
        .action-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .btn-success {
            background-color: #28a745;
            border: none;
        }
        .btn-warning {
            background-color: #ffc107;
            border: none;
            margin-left: 1006px;
            margin-top: -50px;
        }

        /* Tabel Styling */
        .table thead {
            background-color: #4682B4; /* Biru muda terang */
            color: white; /* Teks putih */
        }
        .table tbody tr:nth-child(odd) {
            background-color: #e9f7ff; /* Biru muda */
        }
        .table tbody tr:nth-child(even) {
            background-color: #f0f8ff; /* Biru sangat muda */
        }
        .table tbody tr:hover {
            background-color: #d1e7ff; /* Biru hover */
        }

        /* Gaya khusus untuk mode cetak */
        @media print {
            .table thead {
            background-color: black; /* Biru muda terang */
            color: white; /* Teks putih */
            }
            body {
                background-color: white;
                font-size: 14px;
            }
            .btn-warning, .btn-success, .action-buttons {
                display: none; /* Sembunyikan tombol pada mode cetak */
            }
            .card {
                box-shadow: none;
                border: 1px solid #dee2e6;
                margin: 0 auto;
                max-width: 800px; /* Batas lebar untuk cetak agar terlihat rapi */
            }
            .header-info {
                background-color: #e9ecef;
                color: #000;
                border: 1px solid #dee2e6;
                text-align: left;
                padding: 15px;
                margin-bottom: 20px;
            }
            .header-info p {
                font-size: 16px;
                line-height: 1.6;
            }
            .table {
                border: 1px solid #dee2e6;
                border-collapse: collapse;
                width: 100%;
            }
            .table th, .table td {
                border: 1px solid #dee2e6;
                padding: 8px;
            }
            .table th {
                background-color: #495057;
                color: #fff;
                font-size: 14px;
            }
            .table-container {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h1 class="text-center">Kartu Rencana Studi</h1>
                <p class="text-center">Lihat jadwal mata kuliah yang telah diinputkan di sini!</p>
                <div class="header-info">
                    <p><strong>Mahasiswa:</strong> <?php echo $namaMhs; ?>  | <strong>NIM:</strong> <?php echo $nim; ?>  |  <strong>IPK:</strong> <?php echo $ipk; ?></p>
                    <a href="index.php" class="btn btn-warning">Kembali ke data mahasiswa</a>
                </div>
                
                <div class="table-container">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Matakuliah</th>
                                <th>SKS</th>
                                <th>Kelompok</th>
                                <th>Ruangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $totalSks = 0;
                            $no = 1;
                            while ($row = $matkulResult->fetch_assoc()) {
                                $totalSks += $row['sks'];
                                echo "<tr>
                                    <td>{$no}</td>
                                    <td>{$row['matakuliah']}</td>
                                    <td>{$row['sks']}</td>
                                    <td>{$row['kelp']}</td>
                                    <td>{$row['ruangan']}</td>
                                </tr>";
                                $no++;
                            }
                            ?>
                            <tr>
                                <td colspan="2" class="text-end"><strong>Total SKS</strong></td>
                                <td colspan="3"><?php echo $totalSks; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="action-buttons">
                    <button onclick="window.print()" class="btn btn-success">Cetak PDF</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
