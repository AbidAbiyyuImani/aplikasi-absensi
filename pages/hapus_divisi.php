<?php include 'config/functions.php';
// redirect user (admin only)
if ($_SESSION['pengguna']['level'] === 'User') { echo "<script>alert('Hanya admin yang dapat mengakses');location.href='index.php';</script>"; };

$idDivisi = $_GET['id'];
try {
  $queryDelete = querySQL("DELETE FROM divisi WHERE id_divisi = $idDivisi");
  if ($queryDelete) {
    echo "<script>alert('Hapus Data Divisi Berhasil'); location.href='?page=data_divisi';</script>";
  } else {
    echo "<script>alert('Hapus Data Divisi Gagal');</script>";
  }
} catch (Exception $e) {
  echo "<script>alert('Tidak dapat menghapus');location.href='?page=data_divisi';</script>";
}
?>