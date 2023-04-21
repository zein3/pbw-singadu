  <nav class="top-nav">
    <!-- Sidebar toggler -->
    <div class="btn-icon" onclick="toggleSidebar()">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon">
        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
      </svg>
    </div>

    <!-- Theme toggler and profile -->
    <div style="display: flex; flex-direction: row;">

      <div class="toggle-switch" style="margin: 0 0.5rem;">
        <label>
          <input id="theme-toggler" type="checkbox">
          <span class="slider"></span>
        </label>
      </div>

      <div class="dropdown">
        <div class="btn-icon" onclick="event.target.parentElement.classList.toggle('open')">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
          </svg>
        </div>
        <ul>
          <li><a href="/my-profile">Profile</a></li>
          <li>
            <form id="logout" action="/logout" method="post">
              <a style="cursor: pointer;" onclick="document.querySelector('#logout').submit()">Logout</a>
            </form>
          </li>
        </ul>
      </div>

    </div>
  </nav>