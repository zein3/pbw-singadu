const loadLaporan = (dataLaporan) => {
  const table = document.querySelector("#data-laporan");
  let newTable = "";

  dataLaporan.forEach(laporan => {
    newTable += `
            <tr>
              <td>${laporan.masalah}</td>
              <td>${laporan.pelapor}</td>
              <td>${laporan.status}</td>
              <td>
                <span style="margin-right: 0.5rem;" class="btn-action" onclick="openDetailModal('${laporan.deskripsi}')">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="icon small primary">
                    <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 01.67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 11-.671-1.34l.041-.022zM12 9a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd" />
                  </svg>
                </span>
                <a style="margin-right: 0.5rem;" class="btn-action" href="./edit-laporan.html">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon small success">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                  </svg>
                </a>
                <span class="btn-action" onclick="openDeleteModal(${laporan.id})">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon small danger">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                  </svg>
                </span>
              </td>
            </tr>
    `;
  });

  table.innerHTML = newTable;
}

document.addEventListener('DOMContentLoaded', () => {
  loadLaporan([
    {
      id: 1,
      masalah: 'Responden tidak mau ditemui',
      pelapor: 'Budi',
      status: 'Belum selesai',
      deskripsi: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam a ante non ipsum malesuada commodo eget at massa. Suspendisse porta, augue eu placerat volutpat, purus ipsum euismod urna, a vestibulum purus libero eu sem. Vestibulum tempor sed neque laoreet commodo. Morbi rhoncus nunc lobortis, bibendum libero ac, eleifend turpis. Nam semper sollicitudin est, eu ullamcorper ex luctus pretium. Praesent lacus libero, ullamcorper non condimentum malesuada, lobortis eget quam. Donec tincidunt mattis sem non consectetur.'
    },
    {
      id: 2,
      masalah: 'Responden tidak mau ditemui',
      pelapor: 'Yanto',
      status: 'Selesai',
      deskripsi: 'Maecenas lectus nibh, condimentum mattis est a, hendrerit elementum metus. Phasellus malesuada mattis purus et volutpat. Sed vel turpis augue. Nullam congue rhoncus sapien et pretium. Phasellus urna lacus, pharetra at maximus ac, lacinia ut lacus. Etiam tempus sit amet ex a rutrum. In ut porttitor eros, ac viverra risus. Nam ornare laoreet efficitur. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; In eu dictum eros, quis semper diam. In dignissim, magna at volutpat varius, enim nibh volutpat mauris, vitae hendrerit diam nisl eget odio. Vivamus nec turpis in neque pellentesque aliquam id nec nulla. Nam quis maximus libero. Mauris mollis gravida mi sed faucibus.'
    },
    {
      id: 3,
      masalah: 'Responden tidak mau ditemui',
      pelapor: 'Budi',
      status: 'Belum selesai',
      deskripsi: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam a ante non ipsum malesuada commodo eget at massa. Suspendisse porta, augue eu placerat volutpat, purus ipsum euismod urna, a vestibulum purus libero eu sem. Vestibulum tempor sed neque laoreet commodo. Morbi rhoncus nunc lobortis, bibendum libero ac, eleifend turpis. Nam semper sollicitudin est, eu ullamcorper ex luctus pretium. Praesent lacus libero, ullamcorper non condimentum malesuada, lobortis eget quam. Donec tincidunt mattis sem non consectetur.'
    },
  ]);
})