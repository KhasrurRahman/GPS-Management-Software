<footer class="main-footer"><strong><b>Developed By</b> <a href="https://portfolio-ratin.com/" target="_blank"> Md.Khasrur Rahman</a></strong>
    <div class="float-right d-none d-sm-inline-block"><strong>Copyright &copy; 2020 <a href="http://epwebs.com" target="null">epwebs.com</a>.</strong>All rights reserved.</div>
</footer>
<aside class="control-sidebar control-sidebar-dark"></aside>
</div>
<script src="{{asset('public/assets/backend/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('public/assets/backend/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="{{asset('public/assets/backend/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('public/assets/backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<script src="{{asset('public/assets/backend/js/adminlte.js')}}"></script>
<script src="{{asset('public/assets/backend/js/Chart.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@stack('js')
{!! Toastr::message() !!}
<script>
    @if($errors->any())
    @foreach($errors->all() as $error)
    toastr.error('{{ $error }}', 'Error', {
        closeButton: true,
        progressBar: true,
    });
    @endforeach
    @endif
    $.widget.bridge('uibutton', $.ui.button)
</script>
</body>
</html>
