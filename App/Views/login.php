<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Login</title>

  <link rel="stylesheet" href="assets/css/base.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/login.css">
  <link rel="stylesheet" href="assets/css/toggle-switch.css">

  <script src="assets/js/theme.js"></script>
</head>
<body>
  <main class="login-column">
    <div class="login-card">
      <header class="login-header">
        <img src="assets/svg/bps.svg" height="128" width="128">
        <h2 class="h2">SISTEM PENGADUAN TERPADU</h2>
      </header>

      <?php if(isset($_GET['success'])): ?>
      <div class="alert success open">
        <span><?= $_GET['success'] ?></span>
        <div class="btn-icon" style="margin-left: auto;" onclick="this.parentElement.classList.remove('open')">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </div>
      </div>
      <?php endif; ?>
      <?php if(isset($_GET['error'])): ?>
      <div class="alert danger open">
        <span><?= $_GET['error'] ?></span>
        <div class="btn-icon" style="margin-left: auto;" onclick="this.parentElement.classList.remove('open')">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </div>
      </div>
      <?php endif; ?>

      <form action="/login" method="POST">
        <div class="form-div big">
          <input class="form-input" type="email" name="email" placeholder="Email" required>
        </div>
        <!-- <span class="danger text-error">Error</span> -->
        <div class="form-div big">
          <input class="form-input" type="password" name="password" placeholder="Password" required>
        </div>

        <div class="login-submit-btn">
          <button class="btn btn-primary btn-block" type="submit">LOG IN</button>
        </div>
      </form>
    </div>

    <div class="h-center" style="margin: 0.6rem 0;">
      <div class="toggle-switch">
        <label>
          <input id="theme-toggler" type="checkbox">
          <span class="slider"></span>
        </label>
      </div>
    </div>
  </main>
</body>
</html>