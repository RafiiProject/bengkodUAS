<?php
include('koneksi.php'); // Koneksi ke database

// Cek apakah ID ada di URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Menghindari SQL Injection dengan casting ID ke integer

    $conn->begin_transaction(); 
    try {
        // Hapus data dari tabel jwl_mhs (relasi mahasiswa dan mata kuliah)
        $deleteKrs = "DELETE FROM jwl_mhs WHERE mhs_id = ?";
        $stmtDeleteKrs = $conn->prepare($deleteKrs);
        $stmtDeleteKrs->bind_param("i", $id);

        if (!$stmtDeleteKrs->execute()) {
            throw new Exception("Gagal menghapus data di tabel jwl_mhs: " . $stmtDeleteKrs->error);
        }
        $stmtDeleteKrs->close();

        // Hapus data dari tabel inputmhs (data mahasiswa utama)
        $deleteMhs = "DELETE FROM inputmhs WHERE id = ?";
        $stmtDeleteMhs = $conn->prepare($deleteMhs);
        $stmtDeleteMhs->bind_param("i", $id);

        if (!$stmtDeleteMhs->execute()) {
            throw new Exception("Gagal menghapus data di tabel inputmhs: " . $stmtDeleteMhs->error);
        }
        $stmtDeleteMhs->close();

        // Jika semua proses berhasil, lakukan commit
        $conn->commit();
        $successMessage = "Data Mahasiswa dan mata kuliah terkait berhasil dihapus.";

        // Redirect kembali ke halaman utama dengan pesan sukses
        header("Location: index.php?success=" . urlencode($successMessage));
        exit;
    } catch (Exception $e) {
        // Jika ada error, rollback transaksi
        $conn->rollback();
        $errorMessage = "Terjadi kesalahan: " . $e->getMessage();

        // Redirect kembali ke halaman utama dengan pesan error
        header("Location: index.php?error=" . urlencode($errorMessage));
        exit;
    }
} else {
    // Redirect ke halaman utama jika ID tidak ditemukan
    header("Location: index.php?error=" . urlencode("ID tidak ditemukan."));
    exit;
}
?>
