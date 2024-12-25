<header class="header" id="header">
    <nav class="nav container">
        <div class="mlg-logo">
            <img src="{{ asset('img/mlg.png')}}" alt="">
            <a href="{{ URL('/admin') }}" class="nav__logo">MLG College of Learning</a>
        </div>


      <div class="nav__menu" id="nav-menu">
        <ul class="nav__list">
          <li class="nav__item">
            <a href="{{ URL('admin')}}" class="nav__link">Home</a>
          </li>

          <li class="nav__item">
            <a href="{{ URL('student')}}" class="nav__link">Students</a>
          </li>

          <li class="nav__item">
            <a href="{{ URL('employee')}}" class="nav__link">Employees</a>
          </li>


          <hr class="nav-divider">

          <li class="nav-item dropdown">
            <a href="#" class="nav-link" onclick="toggleDropdown(event)">
             <h5>Welcome,</h5>{{ Auth::user()->name }}
            </a>
            <div class="dropdown-menu" id="userDropdown">
              <a class="dropdown-item" href="#"
                 onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                Logout
              </a>
            </div>
          </li>

        </ul>


        <div class="nav__close" id="nav-close">
          <i class="ri-close-line"></i>
        </div>
      </div>

      <div class="nav__actions">

        <i class="ri-search-line nav__search" id="search-btn"></i>


        <i class="ri-user-line nav__login" id="login-btn"></i>


        <div class="nav__toggle" id="nav-toggle">
          <i class="ri-menu-line"></i>
        </div>
      </div>
    </nav>
  </header>

  <script>
    function toggleDropdown(event) {
      event.preventDefault();

      var dropdown = document.getElementById('userDropdown');
      dropdown.style.display = (dropdown.style.display === 'block') ? 'none' : 'block';


      document.addEventListener('click', function(e) {
        if (!e.target.closest('.nav-item')) {
          dropdown.style.display = 'none';
        }
      }, { once: true });
    }
  </script>


  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
  </form>

  <script src="{{ asset('/js/main.js') }}"></script>
