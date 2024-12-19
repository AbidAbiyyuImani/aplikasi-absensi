<?php include 'config/functions.php'; $level = $_SESSION['pengguna']['level'];
// redirect user (admin only)
if ($_SESSION['pengguna']['level'] === 'Karyawan') { echo "<script>alert('Hanya admin yang dapat mengakses');location.href='index.php';</script>"; };

$idKaryawan = $_GET['id'];
$queryKaryawan = querySQL("SELECT * FROM users WHERE id_user = '$idKaryawan'");
$dataKaryawan = mysqli_fetch_assoc($queryKaryawan);

if(isset($_POST['ubah_karyawan'])) {
  try {
    $divisi = $_POST['divisi'];
    $jamKerja = $_POST['jamKerja'];
  
    if($idKaryawan == $_SESSION['pengguna']['id_user']) {
      $_SESSION['pengguna']['divisi_id'] = $divisi;
      $_SESSION['pengguna']['jk_id'] = $jamKerja;
    }
  
    $queryUpdate = querySQL("UPDATE users SET divisi_id = '$divisi', jk_id = '$jamKerja' WHERE id_user = '$idKaryawan'");
    if($queryUpdate) {
      echo "<script>alert('Ubah Data Karyawan Berhasil');location.href='?page=data_karyawan';</script>";
    } else {
      echo "<script>alert('Ubah Data Karyawan Gagal');</script>";
    }
  } catch (Exception $e) {
    echo "<script>alert('Tidak dapat mengubah data karyawan');location.href='?page=data_karyawan';</script>";
  }
}
?>
<?php $namaHalaman = "Ubah Karyawan"; $linkHalaman = "Ubah Data Karyawan"; include 'components/breadcrumb.php';?>
<div class="row">
  <div class="col-12">
    <div class="card card-outline card-warning">
      <div class="card-body">
        <form method="post">
          <div class="form-group">
            <label for="namaLengkap">Nama Lengkap</label>
            <input type="text" name="namaLengkap" id="namaLengkap" required value="<?= $dataKaryawan['nama_lengkap']; ?>" readonly class="form-control">
          </div>
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" required value="<?= $dataKaryawan['username']; ?>" readonly class="form-control">
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" required value="<?= $dataKaryawan['email']; ?>" readonly class="form-control">
          </div>
          <div class="form-group">
            <label for="divisi">Divisi</label>
            <?php if ($dataKaryawan['divisi_id'] == null) { ?>
              <!-- ga ada isi -->
              <select name="divisi" id="divisi" class="form-control">
                <option selected disabled>Pilih Divisi</option>
                <?php
                  $queryDivisi = querySQL("SELECT * FROM divisi");
                  if (mysqli_num_rows($queryDivisi) > 0) {
                    while ($dataDivisi = mysqli_fetch_assoc($queryDivisi)) {
                ?>
                  <option value="<?= $dataDivisi['id_divisi']; ?>"><?= $dataDivisi['nama_divisi']; ?></option>
                <?php } } else { ?>
                  <option disabled>Tidak ada divisi</option>
                <?php } ?>
              </select>
            <?php } else { ?>
              <!-- ada isi -->
              <select name="divisi" id="divisi" class="form-control">
                <option selected disabled>Pilih Divisi</option>
                <?php
                  $queryDivisi = querySQL("SELECT * FROM divisi");
                  if (mysqli_num_rows($queryDivisi) > 0) {
                    while ($dataDivisi = mysqli_fetch_assoc($queryDivisi)) {
                ?>
                  <option value="<?= $dataDivisi['id_divisi']; ?>" <?= ($dataKaryawan['divisi_id'] == $dataDivisi['id_divisi']) ? 'selected' : '' ?>><?= $dataDivisi['nama_divisi']; ?></option>
                <?php } }?>
              </select>
            <?php } ?>
          </div>
          <div class="form-group">
            <label for="jamKerja">Jam Kerja</label>
            <?php if ($dataKaryawan['jk_id'] == null) { ?>
              <!-- ga ada isi -->
              <select name="jamKerja" id="jamKerja" class="form-control">
                <option selected disabled>Pilih Jam Masuk</option>
                <?php 
                  $queryJamKerja = querySQL("SELECT * FROM jam_kerja");
                  if (mysqli_num_rows($queryJamKerja) > 0) {
                    while ($dataJamKerja = mysqli_fetch_assoc($queryJamKerja)) {
                ?>
                  <option value="<?= $dataJamKerja['id_jk']; ?>"><?= $dataJamKerja['jam_masuk']; ?> - <?= $dataJamKerja['jam_pulang']; ?></option>
                <?php } } else { ?>
                  <option disabled>Tidak ada jam kerja</option>
                <?php } ?>
              </select>
            <?php } else { ?>
              <!-- ada isi -->
               <select name="jamKerja" id="jamKerja" class="form-control">
                <option selected disabled>Pilih Jam Masuk</option>
                <?php 
                  $queryJamKerja = querySQL("SELECT * FROM jam_kerja");
                  if (mysqli_num_rows($queryJamKerja) > 0) {
                    while ($dataJamKerja = mysqli_fetch_assoc($queryJamKerja)) {
                ?>
                  <option value="<?= $dataJamKerja['id_jk']; ?>" <?= ($dataKaryawan['jk_id'] == $dataJamKerja['id_jk']) ? 'selected' : '' ?>><?= $dataJamKerja['jam_masuk']; ?> - <?= $dataJamKerja['jam_pulang']; ?></option>
                <?php } } ?>
              </select>
            <?php } ?>
          </div>
          <a href="?page=data_karyawan" class="btn btn-secondary">Kembali</a>
          <button type="submit" name="ubah_karyawan" class="btn btn-warning float-right">Ubah Data Karyawan</button>
        </form>
      </div>
    </div>
  </div>
</div>