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
            <div class="content-wrapper">
                <div class="content" >
                    <div class="container-fluid" style="margin-top:50px">
                        <router-view></router-view>
                    </div>
                </div>
            </div>
        </div>
        @endif
<script src="/js/app.js"></script>
    </body>
</html>
