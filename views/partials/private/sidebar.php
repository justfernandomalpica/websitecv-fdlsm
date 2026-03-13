<ul class="aside-container">
    <li  class="aside-elements <?php echo ($routeName === "admin.projects") ? "active" : "" ?>">
        <svg
        xmlns="http://www.w3.org/2000/svg"
        width="24"
        height="24"
        viewBox="0 0 24 24"
        fill="none"
        stroke="#000000"
        stroke-width="1.25"
        stroke-linecap="round"
        stroke-linejoin="round"
        >
        <path d="M3 7m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" />
        <path d="M8 7v-2a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v2" />
        <path d="M12 12l0 .01" />
        <path d="M3 13a20 20 0 0 0 18 0" />
        </svg>

        <a href="/admin/projects">Proyectos</a>
    </li>
    <li  class="aside-elements <?php echo ($routeName === "admin.career") ? "active" : "" ?>">
        <svg
        xmlns="http://www.w3.org/2000/svg"
        width="24"
        height="24"
        viewBox="0 0 24 24"
        fill="none"
        stroke="#000000"
        stroke-width="1.25"
        stroke-linecap="round"
        stroke-linejoin="round"
        >
        <path d="M14 3v4a1 1 0 0 0 1 1h4" />
        <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
        <path d="M11 12.5a1.5 1.5 0 0 0 -3 0v3a1.5 1.5 0 0 0 3 0" />
        <path d="M13 11l1.5 6l1.5 -6" />
        </svg>

        <a href="/admin/career">Curriculum</a>
    </li>
    <li  class="aside-elements <?php echo ($routeName === "admin.experiences") ? "active" : "" ?>">
        <svg
        xmlns="http://www.w3.org/2000/svg"
        width="24"
        height="24"
        viewBox="0 0 24 24"
        fill="none"
        stroke="#000000"
        stroke-width="1.25"
        stroke-linecap="round"
        stroke-linejoin="round"
        >
        <path d="M14 3v4a1 1 0 0 0 1 1h4" />
        <path d="M5 8v-3a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2h-5" />
        <path d="M6 14m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
        <path d="M4.5 17l-1.5 5l3 -1.5l3 1.5l-1.5 -5" />
        </svg>

        <a href="/admin/experiences">Areas de conocimiento</a>
    </li>
    <li class="aside-elements <?php echo ($routeName === "admin.relationships") ? "active" : "" ?>">
        <svg
        xmlns="http://www.w3.org/2000/svg"
        width="24"
        height="24"
        viewBox="0 0 24 24"
        fill="none"
        stroke="#000000"
        stroke-width="1.25"
        stroke-linecap="round"
        stroke-linejoin="round"
        >
        <path d="M9 15l6 -6" />
        <path d="M11 6l.463 -.536a5 5 0 0 1 7.071 7.072l-.534 .464" />
        <path d="M13 18l-.397 .534a5.068 5.068 0 0 1 -7.127 0a4.972 4.972 0 0 1 0 -7.071l.524 -.463" />
        </svg>


        <a href="/admin/relationships">Relaciones</a>
    </li>
    <li class="aside-elements">
        <svg
        xmlns="http://www.w3.org/2000/svg"
        width="24"
        height="24"
        viewBox="0 0 24 24"
        fill="none"
        stroke="#000000"
        stroke-width="1.25"
        stroke-linecap="round"
        stroke-linejoin="round"
        >
        <path d="M9 8v-2a2 2 0 0 1 2 -2h7a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-2" />
        <path d="M3 12h13l-3 -3" />
        <path d="M13 15l3 -3" />
        </svg>

        <a href="/login">Página Login</a>
    </li>
    <li class="aside-elements">
        <svg
        xmlns="http://www.w3.org/2000/svg"
        width="24"
        height="24"
        viewBox="0 0 24 24"
        fill="none"
        stroke="#000000"
        stroke-width="1.25"
        stroke-linecap="round"
        stroke-linejoin="round"
        >
        <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
        <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
        <path d="M10 12h4v4h-4z" />
        </svg>

        <a href="/">Pagina principal</a>
    </li>
    <li class="aside-elements">
        <svg
        xmlns="http://www.w3.org/2000/svg"
        width="24"
        height="24"
        viewBox="0 0 24 24"
        fill="none"
        stroke="#000000"
        stroke-width="1.25"
        stroke-linecap="round"
        stroke-linejoin="round"
        >
        <path d="M15 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
        <path d="M21 12h-13l3 -3" />
        <path d="M11 15l-3 -3" />
        </svg>

        <a href="/logout">Logout</a>
    </li>
</ul>