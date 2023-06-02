<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Si-Ngadu</title>

  <link rel="stylesheet" href="/assets/css/base.css">
  <link rel="stylesheet" href="/assets/css/style.css">
  <link rel="stylesheet" href="/assets/css/dashboard.css">
  <link rel="stylesheet" href="/assets/css/toggle-switch.css">

  <script src="/assets/js/theme.js"></script>
  <script src="/assets/js/sidebar.js"></script>
  <script src="/assets/js/error.js"></script>
  <script src="/assets/js/buat-laporan.js"></script>
</head>
<body>
  <?php include __DIR__.'/../components/navbar.php' ?>

  <main class="main">
    <?php include __DIR__.'/../components/sidebar.php' ?>
    <div class="content">
      <h1 class="header">
        Form Laporan
      </h1>

      <div class="card">
        <div id="add-report-error-alert" class="alert danger">
          <span></span>
          <div class="btn-icon" style="margin-left: auto;" onclick="this.parentElement.classList.remove('open')">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </div>
        </div>
        <form id="create-report-form">

          <div class="form-group">
            <label>Deskripsi Masalah</label>
            <div class="form-div">
              <textarea required name="description" rows="3" class="form-input"></textarea>
            </div>
          </div>

          <div class="form-group">
            <label>Jenis Masalah</label>
            <div class="form-div">
              <select name="problemTypeId" class="form-input">
              </select>
            </div>
          </div>

          <div class="form-group">
            <label>Tanggal Pelaporan</label>
            <div class="form-div">
              <input required name="reportedDate" class="form-input" type="date">
            </div>
          </div>

          <div style="margin-top: 1.5rem;">
            <button class="btn btn-primary btn-block" type="submit">Buat Laporan</button>
          </div>

        </form>
      </div>
    </div>
  </main>

  <?php include __DIR__.'/../components/success-modal.php' ?>
</body>
</html>
