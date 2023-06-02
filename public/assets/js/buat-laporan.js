document.addEventListener("DOMContentLoaded", () => {
  const form = document.querySelector("#create-report-form");

  form.addEventListener('submit', async (e) => {
    e.preventDefault();
    const formData = new FormData(e.target);
    const data = Object.fromEntries(formData.entries());
    console.log(data);

    try {
      const response = await fetch("/api/v1/report", {
        method: "POST",
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
      });

      if (response.status == 200) {
        document.querySelector("#success-modal-message").innerText = "Berhasil menambah laporan";
        document.querySelector("#success-modal").classList.add("open");
      } else {
        const error = await response.json();
        showError(error, "add-report-error-alert");
        // showError({ "error": "gagal menambahkan laporan" }, "add-report-error-alert");
      }
    } catch(e) {
      console.log(e);
    }
  })

  const select = form.querySelector("select");

  fetch("/api/v1/problem-type")
    .then(response => response.json())
    .then(data => {
      console.log(data);
      data.map(ptype => {
        const option = document.createElement("option");
        option.value = ptype.id;
        option.innerText = ptype.name;

        select.appendChild(option);
      })
    })

  document.querySelector("[name=reportedDate]").valueAsDate = new Date();
})
