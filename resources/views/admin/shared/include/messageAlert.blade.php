@if (session('success'))
<div id="alert-fadeout" class="alert alert-success text-center text-uppercase" role="alert">
    <strong>{{ session('success') }}</strong>
</div>
@endif
@if (session('error'))
    <div id="alert-fadeout" class="alert alert-danger text-center text-uppercase" role="alert">
        <strong>{{ session('error') }}</strong>
    </div>
@endif
<div class="pb-3">