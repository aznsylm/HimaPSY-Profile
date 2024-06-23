<?php
// Menampilkan semua error
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "psy") or die(mysqli_connect_error());

// Cek apakah form telah disubmit
if(isset($_POST['proses'])){
    // Ambil data dari form
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $ponsel = mysqli_real_escape_string($koneksi, $_POST['ponsel']);
    $nim = mysqli_real_escape_string($koneksi, $_POST['nim']);
    $pesan = mysqli_real_escape_string($koneksi, $_POST['pesan']);

    // Query untuk memeriksa apakah NIM sudah ada
    $checkQuery = "SELECT * FROM datas WHERE nim='$nim'";
    $result = mysqli_query($koneksi, $checkQuery);

    if(mysqli_num_rows($result) > 0){
        // Jika NIM sudah ada, tampilkan pesan dan kembali ke halaman form
        echo "<script>alert('Anda sudah pernah memberikan masukkan, Terimakasih.'); window.location.href='saran.html';</script>";
    } else {
        // Jika NIM belum ada, masukkan data baru
        $insertQuery = "INSERT INTO datas (nama, ponsel, nim, pesan) VALUES ('$nama', '$ponsel', '$nim', '$pesan')";
        
        if(mysqli_query($koneksi, $insertQuery)){
            echo "<script>alert('Data Berhasil Tersimpan, Terimakasih Masukkannya'); window.location.href='saran.html';</script>";
        } else {
            echo "Error: " . mysqli_error($koneksi);
        }
    }
}
?>
