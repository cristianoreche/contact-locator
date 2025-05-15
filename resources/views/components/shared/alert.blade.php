@if (session('success'))
    <div class="uc-alert uc-alert--success" role="alert">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="uc-alert uc-alert--error" role="alert">
        {{ session('error') }}
    </div>
@endif

@if (session('info'))
    <div class="uc-alert uc-alert--info" role="alert">
        {{ session('info') }}
    </div>
@endif

@if (session('warning'))
    <div class="uc-alert uc-alert--warning" role="alert">
        {{ session('warning') }}
    </div>
@endif

@if (session('status')) 
    <div class="uc-alert uc-alert--success" role="alert">
        {{ session('status') }}
    </div>
@endif

@if ($errors->any())
    <div class="uc-alert uc-alert--error" role="alert">
        <ul class="uc-alert__list">
            @foreach ($errors->all() as $error)
                <li class="uc-alert__item">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
