<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion" style="background: #fff;">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle"
                        href="#!"><i class="fas fa-bars"></i></button>
                    <div class="pb-5 px-5 pt-5"><img style="height:150px;width: auto; object-fit: contain;"
                            src="{{ url('/images/dti-logo.png') }}" /></div>
                    {{ Request::is('rd/dashboard') ? 'active' : '' }}
                    <a class="nav-link  {{ Request::is('dc/dashboard') ? 'active' : '' }}"
                        href="{{ url('dc/dashboard') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>

                        Dashboard
                    </a>
 <a class="nav-link  {{ Request::is('dc/view-target') ? 'active' : '' }}"
                        href="{{ url('dc/view-target') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                        View Targetsssss

                    </a>
                    {{-- <div class="sb-sidenav-menu-heading">Interface</div> --}}
                    <a class="nav-link  {{ Request::is('dc/job-fam') ? 'active' : '' }}"
                        href="{{ url('dc/job-fam') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                        Job Family Shoppings

                    </a>

                    <a class="nav-link  {{ Request::is('dc/accomplishment') ? 'active' : '' }}"
                        href="{{ url('dc/accomplishment') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-file-contract"></i></div>
                        Add Accompishment

                    </a>

                    <a class="nav-link  {{ Request::is('dc/coaching') ? 'active' : '' }}" href="{{ url('dc/coaching') }}">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-calendar-plus"></i></div>
                        Coaching and Mentoring
                       
                    </a>

                    {{-- <div class="sb-sidenav-menu-heading">Addons</div> --}}
                    <a class="nav-link  {{ Request::is('dc/profile') ? 'active' : '' }}" href="{{ url('dc/profile') }}">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>
                        My Profile
                    </a>
                       <button type="button" class="btn btn-primary mt-5 mx-2" data-toggle="modal" data-target="#logout-modal">
                        Logout
                    </button>

                </div>
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">
        {{ $slot }}
         <x-modal-logout/>
    </div>
</div>