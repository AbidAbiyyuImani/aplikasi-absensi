<?php include 'config/functions.php'; ?>
<?php $namaHalaman = "Karyawan"; $linkHalaman = "Data Karyawan"; include 'components/breadcrumb.php';?>
<div class="row">
  <div class="col-12">
    <div class="card card-outline card-primary">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered text-nowrap">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>Username</th>
                <th>Email</th>
                <th>Divisi</th>
                <th>Jam Kerja</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $i = 1;
                $queryUsers = querySQL("SELECT * FROM users LEFT JOIN divisi ON users.divisi_id = divisi.id_divisi LEFT JOIN jam_kerja ON users.jam_id = jam_kerja.id_jam");
                if(mysqli_num_rows($queryUsers) > 0) {
                // ada data
                while ($dataUsers = mysqli_fetch_assoc($queryUsers)) {
              ?>
                <tr>
                  <td><?= $i++ ?></td>
                  <td><?= $dataUsers['nama_lengkap'] ?></td>
                  <td><?= $dataUsers['username'] ?></td>
                  <td><?= $dataUsers['email'] ?></td>
                  <td><?= $dataUsers['nama_divisi'] ?></td>
                  <td><?= $dataUsers['jam_masuk'] ?> - <?= $dataUsers['jam_keluar'] ?></td>
                  <td>
                    <a href="?page=ubah_karyawan&id=<?= $dataUsers['id_user'] ?>" class="btn btn-warning">Ubah</a>
                    <a href="?page=hapus_karyawan&id=<?= $dataUsers['id_user'] ?>" onclick="return confirm('Apakah anda yakin akan menghapus data karyawan ini?');" class="btn btn-danger">Hapus</a>
                  </td>
                </tr>
              <?php } }else { ?>
                <!-- ga ada data -->
                <tr>
                  <td colspan="7" class="text-center">Tidak ada data karyawan</td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="card-footer">
        <a href="index.php" class="btn btn-secondary">Kembali</a>
        <a href="register.php" class="btn btn-primary float-right">Tambahkan Admin</a>
      </div>
    </div>
  </div>
</div>