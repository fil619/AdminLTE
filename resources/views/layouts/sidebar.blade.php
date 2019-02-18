<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ url('/img/logo.png') }}" alt="LaraStart" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Apex MyERP</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <router-link to="/dashboard" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i><p>Dashboard</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/Ledgers" class="nav-link">
                        <i class="nav-icon fas fa-book"></i><p>Ledgers</p>
                    </router-link>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-users"></i>
                        <p>
                            Expenses
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <router-link to="/DisplayExpenses" class="nav-link">
                                <i class="nav-icon fas fa-users"></i><p>Display Expenses</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/directexpenses" class="nav-link">
                                <i class="nav-icon fas fa-users"></i><p>Add Direct Expenses</p>
                            </router-link>
                        </li>
                        <router-link to="expenses" class="nav-link">
                            <i class="nav-icon fas fa-key"></i><p>Add Indirect Expenses</p>
                        </router-link>
                    </ul>
                </li>
                <li class="nav-item">
                    <router-link to="/calendar" class="nav-link">
                        <i class="material-icons" style="display:inline-flex ; vertical-align:middle">date_range</i><p>Calendar</p>
                    </router-link>
                </li>
            </ul>
        </nav> <!-- /.sidebar-menu -->
    </div> <!-- /.sidebar -->
</aside>
<!-- / Main Sidebar -->
