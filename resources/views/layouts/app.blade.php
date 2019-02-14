<!DOCTYPE html>
<html lang="en">
    @section('htmlheader')
        @include('layouts.htmlhead')
    @show
    <body class="hold-transition sidebar-mini">
      @if (Auth::guest())
      <div class="wrapper">
        @yield('content')
      </div>
      @else
        <div class="wrapper" id="app">
            @include('layouts.navbar')
            @include('layouts.sidebar')
            <!-- Main Content -->
            <div class="content-wrapper">
                <div class="content">
                    <div class="container-fluid">
                        <router-view></router-view>
                    </div>
                </div>
            </div>
            <!-- /Main Content -->
            @include('layouts.footer')
            <!-- @section('scripts')
                @include('layouts.scripts')
            @show -->
        </div>
        @endif
<script src="/js/app.js"></script>
    </body>
</html>
