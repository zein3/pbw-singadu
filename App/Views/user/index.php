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
  <script src="/assets/js/daftar-user.js"></script>
  <script src="/assets/js/error.js"></script>
</head>
<body>
  <?php include __DIR__.'/../components/navbar.php' ?>

  <main class="main">
    <?php include __DIR__.'/../components/sidebar.php' ?>
    <div class="content">
      <h1 class="header">Daftar User</h1>

      <button onclick="document.querySelector('#add-user-modal').classList.add('open')" class="btn btn-primary">+ Tambah User</button>

      <div class="form-div" style="margin: 1.5rem 0 1rem 0;">
        <input id="user-search" type="text" class="form-input" placeholder="Search...">
      </div>

      <div class="card" style="overflow-x: auto;">
        <table class="table">
          <thead>
            <tr>
              <th>Nama</th>
              <th>Email</th>
              <th>Role</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody id="data-user">
          </tbody>
        </table>
      </div>
    </div>
  </main>

  <div id="delete-modal" class="modal">
    <div class="card">
      <div class="card-header">
        <h1>Hapus user</h1>

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

        <h2>Hapus user ini?</h2>

        <div style="display: flex; flex-direction: row; justify-content: center; gap: 2rem;">
          <button class="btn btn-secondary" onclick="document.querySelector('#delete-modal').classList.remove('open')">
            Tidak
          </button>
          <form id="delete-user-form">
            <input type="hidden" id="delete-id">
            <button class="btn btn-danger">
              Ya
            </button>
          </form>
          <script>
            document.querySelector("#delete-user-form").addEventListener('submit', async (e) => {
              e.preventDefault();
              const id = document.querySelector("#delete-id").value;
              if (isNaN(id)) return;

              try {
                const response = await fetch(`/api/v1/user/${id}`, {
                  method: 'DELETE',
                });

                getUsersData();
                document.querySelector('#delete-modal').classList.remove('open')
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

  <div id="edit-user-modal" class="modal">
    <div class="card">
      <div class="card-header">
        <h1>Edit User</h1>

        <div class="btn-icon" style="margin-left: auto;" onclick="this.parentElement.parentElement.parentElement.classList.remove('open')">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </div>
      </div>
      <hr style="width: 100%;">
      <div id="edit-user-error-alert" class="alert danger">
        <span></span>
        <div class="btn-icon" style="margin-left: auto;" onclick="this.parentElement.classList.remove('open')">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </div>
      </div>
      <form id="edit-user-form">

        <input type="hidden" name="id">
        <input type="hidden" name="password">

        <div class="form-group">
          <label>Nama</label>
          <div class="form-div">
            <input readonly name="name" type="text" class="form-input">
          </div>
        </div>

        <div class="form-group">
          <label>Email</label>
          <div class="form-div">
            <input readonly name="email" type="email" class="form-input">
          </div>
        </div>

        <div class="form-group">
          <label>Role</label>
          <div class="form-div">
            <select id="edit-role" name="role" class="form-input">
              <option value="PENCACAH">Pencacah</option>
              <option value="PENGAWAS">Pengawas</option>
              <option value="ADMIN">Admin</option>
            </select>
          </div>
        </div>

        <div id="edit-supervisor" class="form-group" style="display: none;">
          <label>Supervisor</label>
          <div class="form-div">
            <select name="supervisor_id" class="form-input"></select>
          </div>
        </div>

        <div style="margin-top: 1.5rem;">
          <button class="btn btn-primary btn-block" type="submit">Update User</button>
        </div>

      </form>
      <script>
        document.querySelector("#edit-user-form").addEventListener("submit", async (e) => {
          e.preventDefault();
          const formData = new FormData(e.target);
          const data = Object.fromEntries(formData.entries());

          data.supervisor = {id: data.supervisor_id}
          delete data.supervisor_id;

          try {
            const response = await fetch(`/api/v1/user/${data.id}`, {
              method: "PUT",
              headers: {
                'Content-Type': 'application/json'
              },
              body: JSON.stringify(data)
            });

            if (response.status == 200) {
              getUsersData();
              updatePilihanPengawas();
              document.querySelector("#edit-user-modal").classList.remove("open");
              document.querySelector("#success-modal-message").innerText = "Berhasil mengubah user";
              document.querySelector("#success-modal").classList.add("open");
            } else {
              const errors = await response.json();
              showError(errors, "edit-user-error-alert");
            }
          } catch (e) {

          }
        })
      </script>
    </div>
  </div>

  <div id="add-user-modal" class="modal">
    <div class="card">
      <div class="card-header">
        <h1>Tambah User</h1>

        <div class="btn-icon" style="margin-left: auto;" onclick="this.parentElement.parentElement.parentElement.classList.remove('open')">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </div>
      </div>
      <hr style="width: 100%;">
      <div id="add-user-error-alert" class="alert danger">
        <span></span>
        <div class="btn-icon" style="margin-left: auto;" onclick="this.parentElement.classList.remove('open')">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </div>
      </div>
      <form id="add-user-form">
        <input type="hidden" th:name="${_csrf.parameterName}" th:value="${_csrf.token}">
        <div class="form-group">
          <label>Nama</label>
          <div class="form-div">
            <input required name="name" type="text" class="form-input">
          </div>
        </div>

        <div class="form-group">
          <label>Email</label>
          <div class="form-div">
            <input required name="email" type="email" class="form-input">
          </div>
        </div>

        <div class="form-group">
          <label>Password</label>
          <div class="form-div">
            <input required name="password" type="password" class="form-input">
          </div>
        </div>

        <div class="form-group">
          <label>Role</label>
          <div class="form-div">
            <select name="role" class="form-input">
              <option value="PENCACAH">Pencacah</option>
              <option value="PENGAWAS">Pengawas</option>
              <option value="ADMIN">Admin</option>
            </select>
          </div>
        </div>

        <div style="margin-top: 1.5rem;">
          <button class="btn btn-primary btn-block" type="submit">Buat User</button>
        </div>
      </form>
      <script>
        document.querySelector("#add-user-form").addEventListener("submit", async (e) => {
          e.preventDefault();
          const formData = new FormData(e.target);
          const data = Object.fromEntries(formData.entries());

          try {
            const response = await fetch("/api/v1/user", {
              method: "POST",
              headers: {
                "Content-Type": "application/json"
              },
              body: JSON.stringify(data)
            });

            console.log(response);
            if (response.status == 200) {
              getUsersData();
              updatePilihanPengawas();
              document.querySelector("#success-modal-message").innerText = "Berhasil membuat user";
              document.querySelector("#success-modal").classList.add("open");

              const form = document.querySelector("#add-user-form");
              form.querySelector("input[name='name']").value = "";
              form.querySelector("input[name='email']").value = "";
              form.querySelector("input[name='password']").value = "";
              document.querySelector("#add-user-modal").classList.remove("open");
            } else {
              const error = await response.json();
              showError(error, "add-user-error-alert");
            }
          } catch(e) {
            console.log("Error encountered!");
            console.warn(e);
          }
        })
      </script>
    </div>
  </div>

  <?php include __DIR__.'/../components/success-modal.php' ?>

</body>
</html>
