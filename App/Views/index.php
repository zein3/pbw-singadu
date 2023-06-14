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
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js@4.3.0/dist/chart.umd.min.js"></script>
</head>
<body>
  <?php include 'components/navbar.php' ?>

  <main class="main">
    <?php include 'components/sidebar.php' ?>
    <div class="content">

      <div style="margin-bottom: 1rem;" class="welcome">
        <h3>
          Welcome <?= $data['user']->name ?>!
        </h3>
      </div>

      <div class="stat-grid">
        <div class="stat-grid-item">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="stat-grid-icon">
            <path fill-rule="evenodd" d="M5.625 1.5c-1.036 0-1.875.84-1.875 1.875v17.25c0 1.035.84 1.875 1.875 1.875h12.75c1.035 0 1.875-.84 1.875-1.875V12.75A3.75 3.75 0 0016.5 9h-1.875a1.875 1.875 0 01-1.875-1.875V5.25A3.75 3.75 0 009 1.5H5.625zM7.5 15a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5A.75.75 0 017.5 15zm.75 2.25a.75.75 0 000 1.5H12a.75.75 0 000-1.5H8.25z" clip-rule="evenodd" />
            <path d="M12.971 1.816A5.23 5.23 0 0114.25 5.25v1.875c0 .207.168.375.375.375H16.5a5.23 5.23 0 013.434 1.279 9.768 9.768 0 00-6.963-6.963z" />
          </svg>
          <p><?= $data['jumlah_laporan'] ?> Laporan</p>
        </div>
        <div class="stat-grid-item">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="stat-grid-icon">
            <path fill-rule="evenodd" d="M8.25 6.75a3.75 3.75 0 117.5 0 3.75 3.75 0 01-7.5 0zM15.75 9.75a3 3 0 116 0 3 3 0 01-6 0zM2.25 9.75a3 3 0 116 0 3 3 0 01-6 0zM6.31 15.117A6.745 6.745 0 0112 12a6.745 6.745 0 016.709 7.498.75.75 0 01-.372.568A12.696 12.696 0 0112 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 01-.372-.568 6.787 6.787 0 011.019-4.38z" clip-rule="evenodd" />
            <path d="M5.082 14.254a8.287 8.287 0 00-1.308 5.135 9.687 9.687 0 01-1.764-.44l-.115-.04a.563.563 0 01-.373-.487l-.01-.121a3.75 3.75 0 013.57-4.047zM20.226 19.389a8.287 8.287 0 00-1.308-5.135 3.75 3.75 0 013.57 4.047l-.01.121a.563.563 0 01-.373.486l-.115.04c-.567.2-1.156.349-1.764.441z" />
          </svg>
          <p><?= $data['jumlah_pencacah'] ?> Pencacah</p>
        </div>
        <div class="stat-grid-item">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="stat-grid-icon">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
          </svg>
          <p><?= $data['jumlah_pengawas'] ?> Pengawas</p>
        </div>

        <div class="stat-grid-item" style="grid-column: 1 / span 3;">
          <!-- Pie chart laporan -->
          <canvas id="reports-pie-chart" width="400" height="400" role="img" aria-label="Pie Chart Laporan">
            <p><span id="jumlah-laporan-selesai"><?= $data['jumlah_laporan_selesai'] ?></span> laporan sudah diselesaikan</p>
            <p><span id="jumlah-laporan-belum-selesai"><?= $data['jumlah_laporan_belum_selesai'] ?></span> laporan belum diselesaikan</p>
          </canvas>
        </div>
      </div>

    </div>
  </main>

  <script>
    (async function() {
      const data = {
        labels: [
          'Masalah selesai',
          'Masalah belum selesai'
        ],
        datasets: [{
          data: [
            document.querySelector('#jumlah-laporan-selesai').innerHTML,
            document.querySelector('#jumlah-laporan-belum-selesai').innerHTML
          ],
          backgroundColor: [
            'rgb(54, 162, 235)',
            'rgb(255, 99, 132)'
          ],
          hoverOffset: 4
        }]
      };

      const config = {
        type: 'pie',
        data: data,
      };

      new Chart(document.querySelector('#reports-pie-chart'), config)
    })();
  </script>
</body>
</html>
