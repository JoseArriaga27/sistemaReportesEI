@if(session('mensajeExito'))
<div class="alert-modern success">
    <span class="a-icon"><i class="fa-solid fa-circle-check"></i></span>
    <span>{{ session('mensajeExito') }}</span>
    <button class="a-close">&times;</button>
</div>
@endif
@if(session('error'))
<div class="alert-modern error">
    <span class="a-icon"><i class="fa-solid fa-circle-xmark"></i></span>
    <span>{{ session('error') }}</span>
    <button class="a-close">&times;</button>
</div>
@endif
@if(session('warning'))
<div class="alert-modern warning">
    <span class="a-icon"><i class="fa-solid fa-triangle-exclamation"></i></span>
    <span>{{ session('warning') }}</span>
    <button class="a-close">&times;</button>
</div>
@endif
@if(session('info'))
<div class="alert-modern info">
    <span class="a-icon"><i class="fa-solid fa-circle-info"></i></span>
    <span>{{ session('info') }}</span>
    <button class="a-close">&times;</button>
</div>
@endif
@if($errors->any())
<div class="alert-modern error">
    <span class="a-icon"><i class="fa-solid fa-circle-xmark"></i></span>
    <div>
        <strong>Por favor corrige los siguientes errores:</strong>
        <ul class="mb-0 mt-1 ps-3">
            @foreach($errors->all() as $e)<li style="font-size:13px">{{ $e }}</li>@endforeach
        </ul>
    </div>
    <button class="a-close">&times;</button>
</div>
@endif
