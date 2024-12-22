<?php include 'config/functions.php';
// mengalihkan karyawan ke halaman utama
if ($_SESSION['pengguna']['level'] === 'Karyawan') {
  echo "<script>alertPopUp('index.php', 'error', 'Gagal', 'Anda tidak memiliki akses ke halaman ini.');</script>";
} else {
  if (isset($_GET['id'])) {
    try {
      $idDivisi = $_GET['id'];
      $queryDelete = querySQL("DELETE FROM divisi WHERE id_divisi = $idDivisi");
      if ($queryDelete) {
        echo "<script>alertPopUp('?page=data_divisi', 'success', 'Berhasil menghapus divisi', 'Mengalihkan ke halaman data divisi...');</script>";
      } else {
        echo "<script>alertPopUp('?page=data_divisi', 'error', 'Gagal menghapus divisi', 'Mengalihkan ke halaman data divisi...');</script>";
      }
    } catch (Exception $e) {
      echo "<script>alertPopUp('?page=data_divisi', 'warning', 'Tidak dapat menghapus divisi', 'Mengalihkan ke halaman data divisi...');</script>";
    }
  } else {
    echo "<script>alertPopUp('?page=data_divisi', 'error', 'Tidak ada data divisi yang dipilih', 'Mengalihkan ke halaman data divisi...');</script>";
  }
}
?>