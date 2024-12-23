<?php include 'config/functions.php';
// redirect user (admin only)
if ($_SESSION['pengguna']['level'] === 'User') { echo "<script>alert('Hanya admin yang dapat mengakses');location.href='index.php';</script>"; };

$idCuti = $_GET['id'];
try {
  $queryDelete = querySQL("DELETE FROM absensi_cuti WHERE id_cuti = $idCuti");
  if($queryDelete) {
    echo "<script>alert('Hapus Data Cuti Berhasil'); location.href='?page=data_cuti';</script>";
  } else {
    echo "<script>alert('Hapus Data Cuti Gagal');</script>";
  }
} catch (Exception $e) {
  echo "<script>alert('Hapus Data Cuti Gagal');location.href='?page=data_cuti';</script>";
}
?>