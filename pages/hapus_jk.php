<?php include 'config/functions.php';
// mengalihkan karyawan ke halaman utama
if ($_SESSION['pengguna']['level'] === 'Karyawan') {
  echo "<script>alertPopUp('index.php', 'error', 'Gagal', 'Anda tidak memiliki akses ke halaman ini.');</script>";
} else {
  if (isset($_GET['id'])) {
    try {
      $idJK = $_GET['id'];
      $queryDelete = querySQL("DELETE FROM jam_kerja WHERE id_jk = $idJK");
      if($queryDelete) {
        echo "<script>alertPopUp('?page=data_jk', 'success', 'Berhasil menghapus data jam kerja', 'Mengalihkan ke halaman data jam kerja...');</script>";
      } else {
        echo "<script>alertPopUp('?page=data_jk', 'error', 'Gagal menghapus data jam kerja', 'Mengalihkan ke halaman data jam kerja...');</script>";
      }
    } catch (Exception $e) {
      echo "<script>alertPopUp('?page=data_jk', 'warning', 'Tidak dapat menghapus data jam kerja', 'Mengalihkan ke halaman data jam kerja...');</script>";
    }
  } else {
    echo "<script>alertPopUp('?page=data_jk', 'error', 'Tidak ada data jam kerja yang dipilih', 'Mengalihkan ke halaman data jam kerja...');</script>";
  }
}
?>