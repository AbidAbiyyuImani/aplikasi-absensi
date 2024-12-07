<?php include 'config/functions.php';
$idUser = $_GET['id'];
try {
  $queryDelete = querySQL("DELETE FROM users WHERE id_user = $idUser");
  if($idUser == $_SESSION['pengguna']['id_user']) {
    echo "<script>alert('Hapus Data Karyawan Berhasil'); location.href='logout.php';</script>";
  } else if($queryDelete) {
    echo "<script>alert('Hapus Data Karyawan Berhasil'); location.href='?page=data_karyawan';</script>";
  } else {
    echo "<script>alert('Hapus Data Karyawan Gagal');location.href='?page=data_karyawan';</script>";
  }
} catch (Exception $e) {
  echo "<script>alert('Hapus Data Karyawan Gagal');location.href='?page=data_karyawan';</script>";
}
?>