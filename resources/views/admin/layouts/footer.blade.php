<footer class="main-footer text-center">
    Trường Cao Đẳng Công Nghệ Cao Hà Nội
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>

<script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('admin/dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('admin/plugins/toastr/toastr.min.js') }}"></script>

<script src="{{ asset('admin/dist/js/main.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
{{-- <script src="{{ asset('js/chat.js') }}"></script> --}}
<script>
    window.Echo.private('channel_posts').listen("PostCreated", (e) => {
        if (e.status == 1) {
            toastr.success(e.notification.content);
        }
        if (e.status == 0) {
            toastr.error(e.notification.content);
        }
        if (e.status == 2) {
            toastr.info(e.notification.content);
        }
    });
    window.Echo.channel('channel_test').listen("TestEvent", (e) => {
        console.log(e);
        if (e.status == 1) {
            toastr.success("Việc của bạn sắp hết hạn");
        }
    });
</script>
@stack('js')
<script></script>

<!-- AdminLTE for demo purposes -->
</body>

</html>
