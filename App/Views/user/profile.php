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
  <script src="/assets/js/profile.js"></script>
</head>
<body>
  <!-- <nav th:replace="~{fragments/nav :: nav}"></nav> -->
  <?php include __DIR__.'/../components/navbar.php' ?>

  <main class="main">
    <!-- <nav th:replace="~{fragments/sidebar :: sidebar}"></nav> -->
    <?php include __DIR__.'/../components/sidebar.php' ?>
    <div class="content">

      <h1 class="header">
        Profil
      </h1>

      <div class="card">
        <div id="edit-profile-error-alert" class="alert danger">
          <span></span>
          <div class="btn-icon" style="margin-left: auto;" onclick="this.parentElement.classList.remove('open')">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </div>
        </div>
        <form id="change-profile-form">

          <div class="form-group">
            <label>Nama</label>
            <div class="form-div">
              <input required name="name" type="text" class="form-input" value="<?= $data['name'] ?>">
            </div>
          </div>

          <div class="form-group">
            <label>Email</label>
            <div class="form-div">
              <input required name="email" type="email" class="form-input" value="<?= $data['email'] ?>">
            </div>
          </div>

          <div style="margin-top: 1.5rem;">
            <button class="btn btn-primary btn-block" type="submit">Ubah Profil</button>
          </div>

        </form>
      </div>

      <h1 class="header">Ganti Password</h1>
      <div id="edit-password-error-alert" class="alert danger">
        <span></span>
        <div class="btn-icon" style="margin-left: auto;" onclick="this.parentElement.classList.remove('open')">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </div>
      </div>
      <div class="card">
        <form id="change-password-form">
          <div class="form-group">
            <label>Password Lama</label>
            <div class="form-div">
              <input required name="oldPassword" type="password" class="form-input">
            </div>
          </div>

          <div class="form-group">
            <label>Password Baru</label>
            <div class="form-div">
              <input required name="newPassword" type="password" class="form-input">
            </div>
          </div>

          <div class="form-group">
            <label>Konfirmasi Password Baru</label>
            <div class="form-div">
              <input required name="confirmPassword" type="password" class="form-input">
            </div>
            <span id="confirmPasswordError" class="danger text-error"></span>
          </div>

          <div style="margin-top: 1.5rem;">
            <button class="btn btn-primary btn-block" type="submit">Ubah Password</button>
          </div>
        </form>
      </div>

    </div>
  </main>
</body>
</html>
