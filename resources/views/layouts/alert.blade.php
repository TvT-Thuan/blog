@if (session()->has('success'))
    <div class="alert alert-success">
        <p class="m-0">{{ session('success') }}</p>
    </div>
@endif

@if (session()->has('error'))
    <div class="alert alert-danger">
        <p class="m-0">{{ session('error') }}</p>
    </div>
@endif
