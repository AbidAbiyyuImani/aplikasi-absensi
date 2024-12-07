<?php include 'config/functions.php';
$idDivisi = $_GET['id'];
try {
  $queryDelete = querySQL("DELETE FROM divisi WHERE id_divisi = $idDivisi");
  if($queryDelete) {
    echo "<script>alert('Hapus Data Divisi Berhasil'); location.href='?page=data_divisi';</script>";
  } else {
    echo "<script>alert('Hapus Data Divisi Gagal');</script>";
  }
} catch (Exception $e) {
  echo "<script>alert('Hapus Data Divisi Gagal');location.href='?page=data_divisi';</script>";
}
?>