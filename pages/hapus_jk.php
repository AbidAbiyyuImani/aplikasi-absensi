<?php include 'config/functions.php';
// redirect user (admin only)
if ($_SESSION['pengguna']['level'] === 'Karyawan') { echo "<script>alert('Hanya admin yang dapat mengakses');location.href='index.php';</script>"; };

$idJK = $_GET['id'];
try {
  $queryDelete = querySQL("DELETE FROM jam_kerja WHERE id_jk = $idJK");
  if($queryDelete) {
    echo "<script>popUp(false, '?page=data_jk', 'Berhasil menghapus jam kerja', 'Mengalihkan ke halaman data jam kerja...', 'error');</script>";
  } else {
    echo "<script>popUp(false, '?page=data_jk', 'Gagal menghapus jam kerja', 'Mengalihkan ke halaman data jam kerja...', 'error');</script>";
  }
} catch (Exception $e) {
  echo "<script>popUp(false, '?page=data_jk', 'Tidak dapat menghapus jam kerja', 'Mengalihkan ke halaman data jam kerja...', 'error');</script>";
}
?>