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
  <script src="/assets/js/ptypes.js"></script>
  <script src="/assets/js/error.js"></script>
</head>
<body>
  <?php include __DIR__.'/../components/navbar.php' ?>

  <main class="main">
    <?php include __DIR__.'/../components/sidebar.php' ?>
    <div class="content">
      <h1 class="header">Daftar Jenis Masalah</h1>

      <button onclick="document.querySelector('#add-ptype-modal').classList.add('open')" class="btn btn-primary">+ Tambah</button>

      <div class="form-div" style="margin: 1.5rem 0 1rem 0;">
        <input id="search" type="text" class="form-input" placeholder="Search...">
      </div>

      <div class="card" style="overflow-x: auto;">
        <table class="table">
          <thead>
            <tr>
              <th>Nama</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody id="data-ptype">
          </tbody>
        </table>
      </div>
    </div>
  </main>

  <div id="delete-modal" class="modal">
    <div class="card">
      <div class="card-header">
        <h1>Hapus Jenis Masalah</h1>

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

        <h2>Hapus jenis masalah ini?</h2>

        <div style="display: flex; flex-direction: row; justify-content: center; gap: 2rem;">
          <button class="btn btn-secondary" onclick="document.querySelector('#delete-modal').classList.remove('open')">
            Tidak
          </button>
          <form id="delete-ptype-form">
            <input type="hidden" id="delete-id">
            <button class="btn btn-danger">
              Ya
            </button>
          </form>
          <script>
            document.querySelector("#delete-ptype-form").addEventListener('submit', async (e) => {
              e.preventDefault();
              const id = document.querySelector("#delete-id").value;
              if (isNaN(id)) return;

              try {
                const response = await fetch(`/api/v1/problem-type/${id}`, {
                  method: 'DELETE',
                });

                if (response.status == 200) {
                  getProblemTypes();
                  document.querySelector('#delete-modal').classList.remove('open')
                }
              } catch (e) {
                console.log("error encountered");
                console.log(e);
              }
            })
          </script>
        </div>

      </div>
    </div>
  </div>

  <div id="add-ptype-modal" class="modal">
    <div class="card">
      <div class="card-header">
        <h1>Tambah Jenis Masalah</h1>

        <div class="btn-icon" style="margin-left: auto;" onclick="this.parentElement.parentElement.parentElement.classList.remove('open')">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </div>
      </div>
      <hr style="width: 100%;">

      <div id="add-ptype-error-alert" class="alert danger">
        <span></span>
        <div class="btn-icon" style="margin-left: auto;" onclick="this.parentElement.classList.remove('open')">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </div>
      </div>

      <form id="add-ptype-form">
        <div class="form-group">
          <label>Nama</label>
          <div class="form-div">
            <input required name="name" type="text" class="form-input">
          </div>
        </div>

        <div style="margin-top: 1.5rem;">
          <button class="btn btn-primary btn-block" type="submit">Buat</button>
        </div>
      </form>
      <script>
        document.querySelector("#add-ptype-form").addEventListener("submit", async (e) => {
          e.preventDefault();
          const formData = new FormData(e.target);
          const data = Object.fromEntries(formData.entries());

          try {
            const response = await fetch("/api/v1/problem-type", {
              method: "POST",
              headers: {
                'Content-Type': 'application/json',
              },
              body: JSON.stringify(data)
            });

            if (response.status == 200) {
              getProblemTypes();
              document.querySelector("#add-ptype-modal").classList.remove("open");
            } else {
              const errors = await response.json();
              showError(errors, "add-ptype-error-alert");
            }
          } catch(e) {
            console.warn(e);
          }
        })
      </script>
    </div>
  </div>
</body>
</html>
