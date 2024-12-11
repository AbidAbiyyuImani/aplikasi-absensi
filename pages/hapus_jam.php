<?php include 'config/functions.php';
// redirect user (admin only)
if ($_SESSION['pengguna']['level'] === 'User') { echo "<script>alert('Hanya admin yang dapat mengakses');location.href='index.php';</script>"; };

$idJam = $_GET['id'];
try {
  $queryDelete = querySQL("DELETE FROM jam_kerja WHERE id_jam = $idJam");
  if($queryDelete) {
    echo "<script>alert('Hapus Data Jam Berhasil'); location.href='?page=data_jam';</script>";
  } else {
    echo "<script>alert('Hapus Data Jam Gagal');</script>";
  }
} catch (Exception $e) {
  echo "<script>alert('Hapus Data Jam Gagal');location.href='?page=data_jam';</script>";
}
?>