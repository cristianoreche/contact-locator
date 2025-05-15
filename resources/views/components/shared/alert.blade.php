@if (session('success'))
    <div class="uc-alert uc-alert--success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="uc-alert uc-alert--error">
        {{ session('error') }}
    </div>
@endif
