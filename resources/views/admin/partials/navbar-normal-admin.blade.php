<nav>
    <div class="logo-name">
        <div class="logo-image">
            <img src="{{ asset('images/logo.png') }}" alt="">
        </div>
        <span class="logo_name">CodingLab</span>
    </div>

    <div class="menu-items">
        <ul class="nav-links">
            <li><a href="{{ route('admin/dashboard') }}">
                <i class="uil uil-estate"></i>
                <span class="link-name">Dashboard</span>
            </a></li>
            <li class="has-sub-menu">
                <a href="#" onclick="toggleSubMenu(event)">
                    <i class="uil uil-files-landscapes"></i>
                    <span class="link-name">Berita</span>
                </a>
                <ul class="sub-nav">
                    <li><a href="{{ route('admin/berita/publish') }}">Publish</a></li>
                    <li><a href="{{ route('admin/berita/draft') }}">Draft</a></li>
                </ul>
            </li>
        </ul>
        
        <ul class="logout-mode">
            <li><a href="#">
                <i class="uil uil-signout"></i>
                <span class="link-name">Logout</span>
            </a></li>

            <li class="mode">
                <a href="#">
                    <i class="uil uil-moon"></i>
                <span class="link-name">Dark Mode</span>
                </a>

                <div class="mode-toggle">
                    <span class="switch"></span>
                </div>
            </li>
        </ul>
    </div>
</nav>
