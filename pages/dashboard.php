<?php include 'config/functions.php'; $level = $_SESSION['pengguna']['level'];
switch ($level) { case "Admin": ?>

<!-- Dashboard Admin -->
<div class="row">
  <div class="col-12">
    <h3 class="mb-3"><?= getDateTimeNow(); ?></h3>
  </div>
  <div class="col-12 col-sm-6 col-md-4">
    <a href="?page=data_jk">
      <div class="info-box bg-gradient-info">
        <span class="info-box-icon"><i class="fas fa-clock"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Jam Kerja</span>
          <span class="info-box-number"><?= getTotal("jam_kerja") ?></span>
        </div>
      </div>
    </a>
  </div>
  <div class="col-12 col-sm-6 col-md-4">
    <a href="?page=data_divisi">
      <div class="info-box bg-gradient-info">
        <span class="info-box-icon"><i class="fas fa-user"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Divisi</span>
          <span class="info-box-number"><?= getTotal("divisi"); ?></span>
        </div>
      </div>
    </a>
  </div>
  <div class="col-12 col-sm-6 col-md-4">
    <a href="?page=data_karyawan">
      <div class="info-box bg-gradient-info">
        <span class="info-box-icon"><i class="fas fa-users"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Karyawan</span>
          <span class="info-box-number"><?= getTotal("users"); ?></span>
        </div>
      </div>
    </a>
  </div>
</div>

<?php break; case "Karyawan": ?>

<!-- Dashboard Karyawan -->
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <h3 class="mb-3"><?= getDateTimeNow(); ?></h3>
        <div class="row">

          <div class="col-12 col-sm-6 col-md-3">
            <a href="?page=absen_masuk">
              <div class="info-box bg-gradient-success">
                <span class="info-box-icon"><i class="fas fa-sign-in-alt"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Absen Masuk</span>
                </div>
              </div>
            </a>
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <a href="?page=absen_keluar">
              <div class="info-box bg-gradient-warning">
                <span class="info-box-icon"><i class="fas fa-sign-out-alt"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Absen Keluar</span>
                </div>
              </div>
            </a>
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <a href="?page=absen_sakit">
              <div class="info-box bg-gradient-danger">
                <span class="info-box-icon"><i class="fas fa-procedures"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Absen Sakit</span>
                </div>
              </div>
            </a>
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <a href="?page=permohonan_cuti">
              <div class="info-box bg-gradient-info">
                <span class="info-box-icon"><i class="fas fa-calendar-times"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Permohonan Cuti</span>
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php break; } ?>