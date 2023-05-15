@include('admin.layouts.header')
<div class="content-wrapper">
    {{-- <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Categories</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Categories</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section> --}}
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('admin.layouts.alert')
                    @yield('content')
                </div>
                <div class="col-md-6"></div>
            </div>
        </div>
    </section>
</div>
@include('admin.layouts.footer')
