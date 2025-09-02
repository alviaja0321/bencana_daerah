<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $lokasi = $_POST['lokasi'];
    $jenis = $_POST['jenis'];
    $tanggal = $_POST['tanggal'];
    $terdampak = $_POST['terdampak'];
    $kerusakan = $_POST['kerusakan'];
    $keterangan = $_POST['keterangan'];
    $tgl_rekom = $_POST['tgl_rekom'];
    $no_surat = $_POST['no_surat'];
    $tgl_surat = $_POST['tgl_surat'];
    $opd = $_POST['opd'];
    $tinggi = $_POST['tinggi'];
    $lebar = $_POST['lebar'];
    $panjang = $_POST['panjang'];
    $harga = $_POST['harga'];
    
    // Perhitungan Total Kerusakan dan Kerugian di sisi server
    $volume = $tinggi * $lebar * $panjang;
    $total_kerusakan = $volume;
    $total_kerugian = $volume * $harga;

    // Siapkan dan jalankan statement SQL
    $sql = "INSERT INTO data_bencana (lokasi, jenis, tanggal, terdampak, kerusakan, keterangan, tgl_rekom, no_surat, tgl_surat, opd, tinggi, lebar, panjang, harga, total_kerusakan, total_kerugian)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssisssssssddddd", $lokasi, $jenis, $tanggal, $terdampak, $kerusakan, $keterangan, $tgl_rekom, $no_surat, $tgl_surat, $opd, $tinggi, $lebar, $panjang, $harga, $total_kerusakan, $total_kerugian);
    
    if ($stmt->execute()) {
        // Jika berhasil, alihkan kembali ke halaman utama
        header("Location: index.php");
        exit();
    } else {
        // Jika gagal, tampilkan pesan error
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>