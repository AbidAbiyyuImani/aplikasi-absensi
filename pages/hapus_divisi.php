<?php include 'config/functions.php';
// redirect user (admin only)
if ($_SESSION['pengguna']['level'] === 'Karyawan') { echo "<script>alert('Hanya admin yang dapat mengakses');location.href='index.php';</script>"; };

$idDivisi = $_GET['id'];
try {
  $queryDelete = querySQL("DELETE FROM divisi WHERE id_divisi = $idDivisi");
  if ($queryDelete) {
    echo "<script>popUp(false, '?page=data_divisi', 'Berhasil menghapus divisi', 'Mengalihkan ke halaman data divisi...', 'success');</script>";
  } else {
    echo "<script>popUp(false, '?page=data_divisi', 'Gagal menghapus divisi', 'Mengalihkan ke halaman data divisi...', 'error');</script>";
  }
} catch (Exception $e) {
  echo "<script>popUp(false, '?page=data_divisi', 'Tidak dapat menghapus divisi', 'Mengalihkan ke halaman data divisi...', 'error');</script>";
}
?>