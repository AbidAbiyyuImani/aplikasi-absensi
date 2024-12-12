<?php include 'config/functions.php';
// redirect user (admin only)
if ($_SESSION['pengguna']['level'] === 'User') { echo "<script>alert('Hanya admin yang dapat mengakses');location.href='index.php';</script>"; };

$idIzin = $_GET['id'];
try {
  $queryDelete = querySQL("DELETE FROM absensi_sakit WHERE id_sakit = $idIzin");
  if($queryDelete) {
    echo "<script>alert('Hapus Data Izin Berhasil'); location.href='?page=data_izin';</script>";
  } else {
    echo "<script>alert('Hapus Data Izin Gagal');</script>";
  }
} catch (Exception $e) {
  echo "<script>alert('Hapus Data Izin Gagal');location.href='?page=izin';</script>";
}
?>