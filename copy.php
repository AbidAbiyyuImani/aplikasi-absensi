<div class="container min-vh-100 d-flex justify-content-center align-items-center">
    <div class="card col-6">
      <div class="card-body">
        <form method="post">
          <h3 class="text-center">Register</h3>
          <div class="form-group">
            <label for="nik" class="form-label">NIK</label>
            <input type="text" name="nik" id="nik" class="form-control">
          </div>
          <div class="form-group">
            <label for="namaLengkap" class="form-label">Nama Lengkap</label>
            <input type="text" name="namaLengkap" id="namaLengkap" class="form-control">
          </div>
          <div class="form-group">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" id="username" class="form-control">
          </div>
          <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control">
          </div>
          <div class="form-group">
            <label for="divisi" class="form-label">Divisi</label>
            <select name="divisi" id="divisi" class="form-control">
              <option selected disabled>Pilih divisi</option>
              <?php
              $query = mysqli_query($db, "SELECT * FROM divisi");
              if (mysqli_num_rows($query) > 0) {
                while ($data = mysqli_fetch_assoc($query)) { ?>
                <option value="<?= $dataDivisi['id_divisi'] ?>"><?= $data['nama_divisi'] ?></option>
              <?php } } else { ?>
              <option value="0" disabled>Tidak ada divisi</option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control">
          </div>
          <button type="submit" name="register" class="btn btn-primary mb-2">Register</button>
          <a href="login.php" class="d-block">Sudah mempunyai akun? login sekarang!</a>
        </form>
      </div>
    </div>
  </div>