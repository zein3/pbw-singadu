const loadUser = (dataUser) => {
  const table = document.querySelector('#data-user');
  let newTable = "";

  dataUser.forEach(user => {
    newTable += `
            <tr>
              <td>${user.name}</td>
              <td>${user.email}</td>
              <td>${user.role}</td>
              <td>
                <span style="margin-right: 0.5rem;" class="btn-action" onclick="openDetailModal('Bergabung pada: ')">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="icon small primary">
                    <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 01.67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 11-.671-1.34l.041-.022zM12 9a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd" />
                  </svg>
                </span>
                <a style="margin-right: 0.5rem;" class="btn-action" href="./edit-user.html">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon small success">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                  </svg>
                </a>
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

document.addEventListener('DOMContentLoaded', () => {
  loadUser([
    {
      id: 1,
      name: 'Rafi',
      email: 'rafi@gmail.com',
      role: 'Pencacah'
    },
    {
      id: 2,
      name: 'Yoga',
      email: 'yoga@gmail.com',
      role: 'Pengawas'
    },
    {
      id: 3,
      name: 'Budy',
      email: 'budy@gmail.com',
      role: 'Admin'
    },
  ]);
});