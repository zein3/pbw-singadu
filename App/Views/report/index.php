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
  <script src="/assets/js/modal.js"></script>
  <script src="/assets/js/error.js"></script>
  <script src="/assets/js/daftar-laporan.js"></script>
</head>
<body>
  <?php include __DIR__ . '/../components/navbar.php' ?>

  <main class="main">
    <?php include __DIR__ . '/../components/sidebar.php' ?>
    <div class="content">

      <h1 class="header">Daftar Laporan</h1>

      <div class="form-div" style="margin: 1.5rem 0 1rem 0;">
        <input id="search" type="text" class="form-input" placeholder="Search...">
      </div>

      <div class="card" style="overflow-x: auto;">
        <table class="table">
          <thead>
            <tr>
              <th>Jenis Masalah</th>
              <th>Pelapor</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody id="data-laporan">
          </tbody>
        </table>
      </div>

    </div>
  </main>

  <div id="detail-modal" class="modal">
    <div class="card">
      <div class="card-header">
        <h1>Detail</h1>

        <div class="btn-icon" style="margin-left: auto;" onclick="this.parentElement.parentElement.parentElement.classList.remove('open')">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </div>
      </div>

      <hr style="width: 100%;">
      <div id="detail"></div>
    </div>
  </div>

  <div id="delete-modal" class="modal">
    <div class="card">
      <div class="card-header">
        <h1>Hapus Laporan</h1>

        <div class="btn-icon" style="margin-left: auto;" onclick="this.parentElement.parentElement.parentElement.classList.remove('open')">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </div>
      </div>
      <hr style="width: 100%;">
      <div style="display: flex; flex-direction: column; align-items: center;">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon large danger">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
        </svg>

        <h2>Hapus laporan ini?</h2>

        <div style="display: flex; flex-direction: row; justify-content: center; gap: 2rem;">
          <button class="btn btn-secondary" onclick="document.querySelector('#delete-modal').classList.remove('open')">
            Tidak
          </button>
          <form id="delete-form">
            <input type="hidden" id="delete-id">
            <button class="btn btn-danger" type="submit">
              Ya
            </button>
          </form>
          <script>
            document.querySelector("#delete-form").addEventListener('submit', async (e) => {
              e.preventDefault();

              const id = document.querySelector("#delete-id").value;

              try {
                const response = await fetch(`/api/v1/report/${id}`, {
                  method: 'DELETE',
                });

                console.log(response);
                if (response.status == 200) {
                  document.querySelector("#delete-modal").classList.remove('open');
                  getReports();
                }
              } catch(e) {
                console.warn(e);
              }
            })
          </script>
        </div>

      </div>
    </div>
  </div>

  <div id="edit-report-modal" class="modal">
    <div class="card">
      <div class="card-header">
        <h1>Edit Laporan</h1>

        <div class="btn-icon" style="margin-left: auto;" onclick="this.parentElement.parentElement.parentElement.classList.remove('open')">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </div>
      </div>
      <hr style="width: 100%;">
      <div id="edit-report-error-alert" class="alert danger">
        <span></span>
        <div class="btn-icon" style="margin-left: auto;" onclick="this.parentElement.classList.remove('open')">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </div>
      </div>
      <form id="edit-report-form">

        <input type="hidden" name="id">
        <input type="hidden" name="reporterId">

        <div class="form-group">
          <label>Pelapor</label>
          <div class="form-div">
            <input name="reporterName" type="text" disabled class="form-input" value="Rafi">
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
          <label>Deskripsi Masalah</label>
          <div class="form-div">
            <textarea required name="description" rows="3" class="form-input"></textarea>
          </div>
        </div>

        <div class="form-group">
          <label>Tanggal Laporan</label>
          <div class="form-div">
            <input required type="date" name="reportedDate" class="form-input">
          </div>
        </div>

        <div class="form-group">
          <label>Masalah selesai</label>
          <input type="checkbox" name="solved">
        </div>

        <div style="margin-top: 1.5rem;">
          <button class="btn btn-primary btn-block" type="submit">Simpan</button>
        </div>

      </form>
      <script>
        document.querySelector("#edit-report-form").addEventListener("submit", async (e) => {
          e.preventDefault();
          const formData = new FormData(e.target);
          const data = Object.fromEntries(formData.entries());

          data.reporter = { id: data.reporterId };
          data.problemType = { id: data.problemTypeId };
          data.solved = (data.solved == undefined) ? false : true;

          delete data.reporterId;
          delete data.problemTypeId;

          try {
            const response = await fetch(`/api/v1/report/${data.id}`, {
              method: "PUT",
              headers: {
                'Content-Type': 'application/json'
              },
              body: JSON.stringify(data)
            });

            if (response.status == 200) {
              const data = await response.json();
              if (data == 0) {
                alert("Something went wrong.");
                return;
              }

              getReports();
              document.querySelector("#edit-report-modal").classList.remove("open");
              document.querySelector("#success-modal-message").innerText = "Berhasil mengubah laporan";
              document.querySelector("#success-modal").classList.add("open");
            } else {
              const error = await response.json();
              showError(error, "edit-report-error-alert");
            }
          } catch (e) {

          }
        })
      </script>
    </div>
  </div>

  <?php include __DIR__ . '/../components/success-modal.php' ?>

</body>
</html>
