<?php

$data = $_GET['id'];

//gunakan fungsi di bawah ini agar session bisa dibuat
session_start();

//koneksi ke database latihan
$koneksi = mysqli_connect("localhost", "root", "", "crud");

//hapus data dari tabel kontak
$delete = mysqli_query($koneksi, "delete from peserta where id_peserta=".$data);

//set session sukses
$_SESSION["sukses"] = 'Data Berhasil Dihapus';

//redirect ke halaman index.php
header('Location: index.php'); 