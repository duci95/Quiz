@include('partials.head')

@yield('content')

@include('partials.footer')
<script src="{{asset("/")}}plugins/jquery/jquery.min.js"></script>
<script src="{{asset("/")}}plugins/bootstrap/js/bootstrap.js"></script>
<script src="{{asset("/")}}plugins/notify.min.js"></script>
@yield('functions')
@yield('scripts')