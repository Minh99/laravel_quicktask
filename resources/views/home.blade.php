<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="{{route('show','plan')}}">@lang('Plans')</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('show','task')}}">@lang('Tasks')</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('show','member')}}">@lang('Members')</a>
      </li>
    </ul>
  </div>
</nav>
<a href="{{ route('i18n','vi') }}">VI</a>
<a href="{{ route('i18n','en') }}">EN</a>
<div class="container">
    <div class="row">
        @yield('content_Plan')
        @yield('content_Task')
        @yield('content_Member')
    </div>
</div>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
