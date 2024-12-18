<?php include 'config/functions.php';
// redirect user (admin only)
if ($_SESSION['pengguna']['level'] === 'User') { echo "<script>alert('Hanya admin yang dapat mengakses');location.href='index.php';</script>"; };

$idJK = $_GET['id'];
try {
  $queryDelete = querySQL("DELETE FROM jam_kerja WHERE id_jk = $idJK");
  if($queryDelete) {
    echo "<script>alert('Hapus Data Jam Berhasil'); location.href='?page=data_jk';</script>";
  } else {
    echo "<script>alert('Hapus Data Jam Gagal');</script>";
  }
} catch (Exception $e) {
  echo "<script>alert('Tidak dapat menghapus jam kerja');location.href='?page=data_jk';</script>";
}
?>