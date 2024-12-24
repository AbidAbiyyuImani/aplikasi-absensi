<?php include 'config/functions.php';
if (isset($_POST['ubah_user'])) {
  try {
    $idUser = $_SESSION['pengguna']['id_user'];
    $namaLengkap = $_POST['namaLengkap'];
    $username = $_POST['username'];
    $email = $_POST['email'];
  
    $divisi = ($_POST['divisi'] === "Belum ada divisi") ? null : $_POST['divisi'];
    $jamKerja = ($_POST['jamKerja'] === "Belum ada jam kerja") ? null : $_POST['jamKerja'];
  
    if ($_FILES['foto']['error'] === 4) {
      $foto = $_POST['fotoLama'];
    } else {
      $foto = upload('foto', ['jpg', 'jpeg', 'png'], 'dist/img/avatar/');
    }
  
    if ($divisi == null && $jamKerja == null) {
      $queryUpdate = querySQL("UPDATE users SET nama_lengkap = '$namaLengkap', username = '$username', email = '$email', foto = '$foto' WHERE id_user = $idUser");
      if ($queryUpdate) {
        echo "<script>alertPopUp('logout.php', 'success', 'Berhasil mengubah profile', 'Mengalihkan ke halaman login...');</script>";
      } else {
        echo "<script>alertPopUp('?page=profile', 'error', 'Gagal mengubah profile');</script>";
      }
    } else {
      $queryUpdate = querySQL("UPDATE users SET nama_lengkap = '$namaLengkap', username = '$username', email = '$email', divisi_id = '$divisi', jam_id = '$jamKerja', foto = '$foto' WHERE id_user = $idUser");
      if ($queryUpdate) {
        echo "<script>alertPopUp('logout.php', 'success', 'Berhasil mengubah profile', 'Mengalihkan ke halaman login...');</script>";
      } else {
        echo "<script>alertPopUp('?page=profile', 'error', 'Gagal mengubah profile');</script>";
      }
    }
  } catch (Exception $e) {
    echo "<script>alertPopUp('?page=profile', 'warning', 'Tidak dapat mengubah profile');</script>";
  }
}
?>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-12 col-sm-2">
            <h3 class="mb-3 text-center">Profile</h3>
            <?php if ($_SESSION['pengguna']['foto'] == "") { ?>
              <img style="object-fit: cover;" src="dist/img/boxed-bg.jpg" class="img-circle elevation-2 d-flex mx-auto mb-3" width="100px" height="100px" alt="<?= $_SESSION['pengguna']['nama_lengkap']; ?>">
            <?php } else { ?>
                <img style="object-fit: cover;" src="dist/img/avatar/<?= $_SESSION['pengguna']['foto']; ?>" class="img-circle elevation-2 d-flex mx-auto mb-3" width="100px" height="100px" alt="<?= $_SESSION['pengguna']['nama_lengkap']; ?>">
            <?php } ?>
          </div>
          <form method="post" enctype="multipart/form-data" class="col-12 col-sm-10">
            <div class="form-group">
              <label for="namaLengkap" class="form-label">Nama Lengkap</label>
              <input type="text" name="namaLengkap" id="namaLengkap" value="<?= $_SESSION['pengguna']['nama_lengkap']; ?>" disabled class="form-control">
            </div>
            <div class="form-group">
              <label for="username" class="form-label">Username</label>
              <input type="text" name="username" id="username" value="<?= $_SESSION['pengguna']['username']; ?>" disabled class="form-control">
            </div>
            <div class="form-group">
              <label for="email" class="form-label">Email</label>
              <input type="email" name="email" id="email" value="<?= $_SESSION['pengguna']['email']; ?>" disabled class="form-control">
            </div>
            <div class="form-group">
              <label for="divisi" class="form-label">Divisi</label>
              <select name="divisi" id="divisi" disabled class="form-control">
                <?php 
                if($_SESSION['pengguna']['divisi_id'] != null) {
                $queryDivisi = querySQL("SELECT * FROM divisi");
                while ($dataDivisi = mysqli_fetch_assoc($queryDivisi)) {
                ?>
                  <option value="<?= $dataDivisi['id_divisi']; ?>" <?= ($dataDivisi['id_divisi'] === $_SESSION['pengguna']['divisi_id']) ? 'selected' : '' ?>><?= $dataDivisi['nama_divisi']; ?></option>
                <?php } }else { ?>
                  <option selected>Belum ada divisi</option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label for="jam_kerja" class="form-label">Jam Kerja</label>
              <select name="jamKerja" id="jamKerja" disabled class="form-control">
                <option selected disabled>Pilih Jam Kerja</option>
                <?php 
                if($_SESSION['pengguna']['jam_id'] != null) {
                  $queryJamKerja = querySQL("SELECT * FROM jam_kerja");
                  while ($dataJamKerja = mysqli_fetch_assoc($queryJamKerja)) {
                ?>
                  <option value="<?= $dataJamKerja['id_jam']; ?>" <?= ($dataJamKerja['id_jam'] === $_SESSION['pengguna']['jam_id']) ? 'selected' : '' ?>><?= $dataJamKerja['jam_masuk']; ?> - <?= $dataJamKerja['jam_keluar']; ?></option>
                <?php } }else { ?>
                  <option selected>Belum ada jam kerja</option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label for="file">Foto</label>
              <input type="hidden" name="fotoLama" value="<?= $_SESSION['pengguna']['foto']; ?>">
              <div class="custom-file">
                <input type="file" name="foto" id="foto" disabled class="custom-file-input">
                <label for="foto" class="custom-file-label"><?= $_SESSION['pengguna']['foto']; ?></label>
              </div>
            </div>
            <a href="index.php" class="kembaliKeDashboard btn btn-secondary">Kembali</a>
            <button type="button" onclick="ubahUser()" href="?page=ubah_profile" class="ubahProfile btn btn-warning">Ubah Profile</button>
            <a href="?page=profile" class="kembaliKeProfile btn btn-secondary d-none">Kembali</a>
            <button type="submit" name="ubah_user" class="simpahProfile btn btn-primary d-none">Simpan</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  function ubahUser() {
    $('.form-control').removeAttr('disabled');
    $('.custom-file-input').removeAttr('disabled').attr('required');
    $('.ubahProfile').addClass('d-none');
    $('.kembaliKeDashboard').addClass('d-none');
    $('.kembaliKeProfile').removeClass('d-none');
    $('.simpahProfile').removeClass('d-none');
  }
</script>