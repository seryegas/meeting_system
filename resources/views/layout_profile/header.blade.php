<nav class="navbar navbar-expand d-flex flex-column align-items-start" id="sidebar">
    <a href="#" class="navbar-brand text-light mt-5">
        <div class="display-6 font-weight-bold">
            Профиль
        </div>
    </a>
    <ul class="navbar-nav d-flex flex-column mt-5 w-100">
        <li class="nav-item w-100">
            <a href="{{ route('profile', session('user_id')) }}" class="nav-link text-light pl-4">
                Профиль
            </a>
        </li>
        <li class="nav-item w-100">
            <a href="{{ route('wwe') }}" class="nav-link text-light pl-4">
                Работа с сотрудниками
            </a>
        </li>
        <li class="nav-item w-100">
            <a href="{{ route('wwc') }}" class="nav-link text-light pl-4">
                Работа с компанией
            </a>
        </li>
        <li class="nav-item w-100">
            <a href="{{ route('meetings') }}" class="nav-link text-light pl-4">
                Совещания
            </a>
        </li>
        <li class="nav-item w-100">
            <a href="{{ route('tasks') }}" class="nav-link text-light pl-4">
                Мои задания
            </a>
        </li>
        <li class="nav-item w-100">
            <a href="{{ route('archive') }}" class="nav-link text-light pl-4">
                Выполнение заданий
            </a>
        </li>

        <li class="nav-item w-100" style="margin-top: 270px">
            <a href="{{ route('logout') }}" class="nav-link text-light btn btn-danger">
                Выйти
            </a>
        </li>
    </ul>
</nav>