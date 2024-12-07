<?php include 'config/functions.php';
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