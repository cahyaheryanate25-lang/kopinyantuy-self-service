<?php
// Konfigurasi Koneksi Database
$host = "localhost";
$user = "admin_kopi";
$pass = "kolorijo123";
$db   = "db"; // Sesuaikan jika nama database Anda berbeda di phpMyAdmin

// Membuat koneksi ke MySQL
$conn = mysqli_connect($host, $user, $pass, $db);

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Mengambil data dari form (POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_pelanggan = isset($_POST['nama_pelanggan']) ? mysqli_real_escape_string($conn, $_POST['nama_pelanggan']) : '';
    $detail_pesanan = isset($_POST['detail_pesanan']) ? mysqli_real_escape_string($conn, $_POST['detail_pesanan']) : '';
    $total_harga    = isset($_POST['total_harga']) ? mysqli_real_escape_string($conn, $_POST['total_harga']) : 0;

    // Simpan ke tabel pesanan
    $sql = "INSERT INTO pesanan (nama_pelanggan, detail_pesanan, total_harga, tanggal) 
            VALUES ('$nama_pelanggan', '$detail_pesanan', '$total_harga', NOW())";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
                alert('Pesanan berhasil disimpan!');
                window.location.href = 'index.php';
              </script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>