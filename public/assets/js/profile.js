document.addEventListener("DOMContentLoaded", () => {
  document.querySelector("#change-profile-form").addEventListener('submit', async (e) => {
    e.preventDefault();
    const formData = new FormData(e.target);
    const data = Object.fromEntries(formData.entries());
    const csrfToken = document.querySelector("#csrf").getAttribute("value");

    try {
      const response = await fetch("/api/v1/user/profile", {
        method: 'PUT',
        headers: {
          'X-CSRF-TOKEN': csrfToken,
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
      });

      if (response.status == 200) {
        alert("Berhasil mengubah profil");
      } else {
        const errors = await response.json();
        showError(errors, "edit-profile-error-alert")
      }
    } catch(e) {
      console.warn(e)
    }
  })

  document.querySelector("#change-password-form").addEventListener('submit', async (e) => {
    e.preventDefault();
    const formData = new FormData(e.target);
    const data = Object.fromEntries(formData.entries());
    const csrfToken = document.querySelector("#csrf").getAttribute("value");

    // validasi data
    if (data.newPassword !== data.confirmPassword) {
      document.querySelector("#confirmPasswordError").innerText = "Password tidak sama";
      return;
    } else {
      document.querySelector("#confirmPasswordError").innerText = "";
    }

    try {
      const response = await fetch("/api/v1/user/password", {
        method: 'PUT',
        headers: {
          'X-CSRF-TOKEN': csrfToken,
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
      });

      if (response.status == 200) {
        const result = await response.text();
        console.log(result);
        if (result != 0) {
          alert("Successfully changed password");
        } else {
          showError({"error": "Password salah"}, "edit-password-error-alert");
        }
      } else {
        const error = await response.json();
        showError(error, "edit-password-error-alert");
        // showError({"error": "Gagal mengubah password"}, "edit-password-error-alert");
      }
    } catch(e) {
      if (typeof e == "string") {
        alert(e);
      }
      console.warn(e);
    }
  })
})
