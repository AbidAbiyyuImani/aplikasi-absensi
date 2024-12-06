<?php include 'config/functions.php'; ?>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <a href="?page=tambah_jam" class="mb-3 btn btn-primary float-right">Tambah</a>
        <div class="table-responsive">
          <table class="table table-bordered text-nowrap">
            <thead>
              <tr>
                <th>No</th>
                <th>Jam Masuk</th>
                <th>Jam Keluar</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $i = 1;
                $queryJamKerja = querySQL("SELECT * FROM jam_kerja");
                if(mysqli_num_rows($queryJamKerja) > 0) {
                // ada data
                while ($dataJamKerja = mysqli_fetch_assoc($queryJamKerja)) {
              ?>
                <tr>
                  <td><?= $i++ ?></td>
                  <td><?= $dataJamKerja['jam_masuk'] ?></td>
                  <td><?= $dataJamKerja['jam_keluar'] ?></td>
                  <td>
                    <a href="?page=ubah_jam&id=<?= $dataJamKerja['id_jam'] ?>" class="btn btn-warning">Ubah</a>
                    <a href="?page=hapus_jam&id=<?= $dataJamKerja['id_jam'] ?>" onclick="return confirm('Apakah anda yakin akan menghapus data jam kerja ini?');" class="btn btn-danger">Hapus</a>
                  </td>
                </tr>
              <?php } }else { ?>
                <!-- ga ada data -->
                <tr>
                  <td colspan="4" class="text-center">Tidak ada data jam kerja</td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>