let users = [];

const openEditModal = (id) => {
  const user = users.find(u => u.id === id);
  if (user == undefined)
    return;

  const form = document.querySelector("#edit-user-form");
  form.querySelector('[name="id"]').value = user.id;
  form.querySelector('[name="name"]').value = user.name;
  form.querySelector('[name="email"]').value = user.email;
  form.querySelector('[name="password"]').value = user.password;

  const options = Array.from(form.querySelector('[name="role"]').children);
  options.map(option => {
    option.selected = (option.value === user.role);
  })

  const editSupervisorDiv = form.querySelector("#edit-supervisor");
  const editSupervisorInput = editSupervisorDiv.querySelector("select");
  if (user.role === "PENCACAH") {
    editSupervisorDiv.style.display = "block";
    editSupervisorInput.disabled = false;
    if (user.supervisor != null) {
      Array.from(editSupervisorInput.children).map(option => {
        option.selected = (option.value == user.supervisor.id);
      })
    } else {
      Array.from(editSupervisorInput.children).map(option => option.selected = false);
    }
  } else {
    editSupervisorDiv.style.display = "none";
    editSupervisorInput.disabled = true;
  }

  document.querySelector("#edit-user-modal").classList.add("open");
}

const loadUser = (dataUser) => {
  const table = document.querySelector('#data-user');
  let newTable = "";

  dataUser.forEach(user => {
    newTable += `
            <tr>
              <td>${user.name}</td>
              <td>${user.email}</td>
              <td>${user.role.toLowerCase()}</td>
              <td>
                <span style="margin-right: 0.5rem;" class="btn-action" href="./edit-user.html" onclick="openEditModal(${user.id})">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon small success">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                  </svg>
                </span>
                <span class="btn-action" onclick="openDeleteModal(${user.id})">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon small danger">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                  </svg>
                </span>
              </td>
            </tr>
    `
  });

  table.innerHTML = newTable;
}

const getUsersData = async () => {
  const response = await fetch("/api/v1/user");
  if (response.redirected) {
    return;
  }

  const data = await response.json();
  users = data;

  loadUser(users);
}

const getPengawas = async () => {
  const response = await fetch("/api/v1/user/role/PENGAWAS");
  if (response.redirected)
    return null;
  
  return await response.json();
}

const updatePilihanPengawas = async () => {
  const selectSupervisorDiv = document.querySelector("#edit-supervisor");
  const selectSupervisorInput = selectSupervisorDiv.querySelector("select");
  selectSupervisorInput.innerHTML = "";

  const pengawas = await getPengawas();
  pengawas.map(p => {
    const option = document.createElement("option");
    option.value = p.id;
    option.innerText = p.name;

    selectSupervisorInput.appendChild(option);
  })
}

document.addEventListener('DOMContentLoaded', async () => {
  document.querySelector("#user-search").addEventListener("input", (e) => {
    const q = new RegExp(`.*${e.target.value}.*`, 'i');
    loadUser(users.filter(user => q.test(user.name) || q.test(user.email)));
  })


  const selectSupervisorDiv = document.querySelector("#edit-supervisor");
  const selectSupervisorInput = selectSupervisorDiv.querySelector("select");
  document.querySelector("#edit-role").addEventListener("change", (e) => {
    selectSupervisorDiv.style.display = (e.target.value === "PENCACAH") ? 'block' : 'none';
    selectSupervisorInput.disabled = (e.target.value !== "PENCACAH");
  });

  await updatePilihanPengawas();
  await getUsersData();
});
