<?php

if (!isset($_POST['tambah'])) header('Location: index.php');

require_once 'koneksi.php';
$sql = "select * from contact";
$result = mysqli_query($koneksi, $sql);
if (isset($_POST['Submit'])) {
    $Nama = $_POST['nama'];
    $Email = $_POST['email'];
    $Phone = $_POST['phone'];
    $Messagee = $_POST['messagee'];
    include_once("koneksi.php");
    $result = mysqli_query($koneksi, "INSERT INTO contact (nama, email, phone, messagee) VALUES ('$Nama','$Email', '$Phone', '$Messagee')");
}
