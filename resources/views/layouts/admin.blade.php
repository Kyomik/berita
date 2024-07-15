@include('admin.partials.header')
@include('admin.partials.navbar-super-admin')
    <!--Container Main start-->
    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>

            <img src="images/profile.jpg" alt="berrak">
        </div>

        <div class="dash-content">

         @yield('content')
         </div>


    </section>
@include('admin.partials.footer')


    

    

