<?php include 'config/functions.php';
// redirect user (admin only)
if ($_SESSION['pengguna']['level'] === 'Karyawan') { echo "<script>alert('Hanya admin yang dapat mengakses');location.href='index.php';</script>"; };

$idKaryawan = $_GET['id'];
try {
  $queryDelete = querySQL("DELETE FROM users WHERE id_user = $idKaryawan");
  if($idKaryawan == $_SESSION['pengguna']['id_user']) {
    echo "<script>alert('Hapus Data Karyawan Berhasil');location.href='logout.php';</script>";
  } else if($queryDelete) {
    echo "<script>alert('Hapus Data Karyawan Berhasil');location.href='?page=data_karyawan';</script>";
  } else {
    echo "<script>alert('Hapus Data Karyawan Gagal');location.href='?page=data_karyawan';</script>";
  }
} catch (Exception $e) {
  echo "<script>alert('Tidak dapat menghapus data karyawan');location.href='?page=data_karyawan';</script>";
}
?>