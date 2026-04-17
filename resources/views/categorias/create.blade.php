@extends('layouts.app')
@section('page-title','Nueva Categoría')
@section('content')
<div class="page-header">
    <div><h2>Nueva categoría</h2><p>Agrupa reportes bajo una misma etiqueta</p></div>
    <a href="{{ route('categorias.index') }}" class="btn-outline-custom"><i class="fa-solid fa-arrow-left"></i> Volver</a>
</div>
<div class="form-card">
    <div class="form-head">
        <h4><i class="fa-solid fa-tag me-2" style="color:var(--primary)"></i>Datos de la categoría</h4>
    </div>
    <div class="form-body">
        @include('partials.alerts')
        <form action="{{ route('categorias.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-8">
                    <label class="form-label-custom">Nombre *</label>
                    <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre') }}" required>
                    @error('nombre')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label-custom">Color de etiqueta *</label>
                    <div style="display:flex;gap:8px;align-items:center">
                        <input type="color" name="color" id="colorPicker" class="form-control" value="{{ old('color','#4F46E5') }}" style="width:48px;height:42px;padding:2px;cursor:pointer">
                        <input type="text" id="colorText" class="form-control" value="{{ old('color','#4F46E5') }}" readonly style="font-family:monospace">
                    </div>
                    @error('color')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                    <label class="form-label-custom">Descripción</label>
                    <textarea name="descripcion" class="form-control" rows="2" placeholder="Describe el tipo de reportes que agrupa esta categoría...">{{ old('descripcion') }}</textarea>
                </div>
            </div>
            <div style="display:flex;justify-content:flex-end;gap:10px;margin-top:24px;padding-top:20px;border-top:1px solid var(--border)">
                <a href="{{ route('categorias.index') }}" class="btn-outline-custom">Cancelar</a>
                <button type="submit" class="btn-primary-custom"><i class="fa-solid fa-check"></i> Crear categoría</button>
            </div>
        </form>
    </div>
</div>
@endsection
@push('scripts')
<script>
document.getElementById('colorPicker').addEventListener('input',function(){
    document.getElementById('colorText').value=this.value;
});
</script>
@endpush
