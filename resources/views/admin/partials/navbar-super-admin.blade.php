<nav>
    <div class="logo-name">
        <div class="logo-image">
            <img src="{{ asset('images/logo.png') }}" alt="">
        </div>
        <span class="logo_name">CodingLab</span>
    </div>

    <div class="menu-items">
        <ul class="nav-links" id="dynamic-nav-links">
            <li><a href="{{ route('admin/dashboard') }}">
                <i class="uil uil-estate"></i>
                <span class="link-name">Dashboard</span>
            </a></li>
            <li class="has-sub-menu" id="kategori-menu">
                <a href="#" onclick="toggleSubMenuDinamis(event)">
                    <i class="uil uil-files-landscapes"></i>
                    <span class="link-name">Manage Kategori</span>
                </a>
                <ul class="sub-nav" id="kategori-sub-nav">
                    <li><a href="{{ route('admin/kategori') }}">Tambah Kategori</a></li>
                    <!-- Submenu dinamis akan ditambahkan di sini -->
                </ul>
            </li>
            <li><a href="{{ route('admin/berita/draft')}}">
                <i class="uil uil-chart"></i>
                <span class="link-name">Draft</span>
            </a></li>
            <li><a href="{{ route('admin/manage') }}">
                <i class="uil uil-thumbs-up"></i>
                <span class="link-name">Akun</span>
            </a></li>
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

<script type="text/javascript">
    function toggleSubMenuDinamis(event) {
        event.preventDefault();
        const parentLi = event.target.closest('li');
        parentLi.classList.toggle('show-sub-menu');
    }

    async function getKategori(){
        try {
            const response = await fetch(`{{ url('api/kategori') }}`);
            const data = await response.json();

            const kategoriSubNav = document.getElementById('kategori-sub-nav');
            data.forEach(kategori => {
                const subLi = document.createElement('li');
                subLi.innerHTML = `<a href="${kategori.url}">${kategori.nama_kategori}</a>`;
                kategoriSubNav.appendChild(subLi);
            });
        } catch (error) {
            console.error('Error fetching kategori:', error);
        }
    }

    document.addEventListener('DOMContentLoaded', getKategori);
</script>

<style>
    .sub-nav {
        display: none;
    }
    .has-sub-menu.show-sub-menu .sub-nav {
        display: block;
    }
</style>
