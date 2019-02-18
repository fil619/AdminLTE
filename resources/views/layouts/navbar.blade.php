 <!-- Navbar -->
<nav class="main-header navbar navbar-expand bg-primary navbar-dark border-bottom fixed-top ">
    <!-- Left navbar links -->
    <ul class="navbar-nav ">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>
    </ul>

    <!-- SEARCH FORM -->
    <!-- <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>
    </form> -->

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->

        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                {{ Auth::user()->name }}
                <span class="fa fa-angle-down"></span>
            </a>
            <ul class="dropdown-menu" style="right: 0;left: auto; width: 15rem;">
                <!-- User image -->
                <li class="user-header" style="text-align: center">
                    <img src="{{ url('/img/profile.png') }}" style="height: 10.7rem; width: 9.7rem;" class="img-circle" alt="User Image">
                    <p>{{ Auth::user()->name }}</p>
                    <p><small>Member since {{ Auth::user()->created_at->format('M. Y') }}</small></p>
                </li>
                <!-- Menu Footer-->
                <li style="padding: 10px;">
                    <div class="float-left">
                        <router-link to="/profile">
                            <button class="btn btn-primary btn-flat">Profile</button>
                        </router-link>
                    </div>
                    <div class="float-right">
                        <a href="#" class="btn btn-primary btn-flat">Logout</a>
                    </div>
                </li>
            </ul>
        </li>
        <div class="image navbar-image">
          <notification></notification>
        </div>
    </ul>
</nav>
<!-- /.navbar -->
