@include('admin.includes.alerts')

@csrf
<div class="form-group">
    <input type="text" class="form-control" name="nome" placeholder="Nome:" value="{{ $local->nome ?? old('nome') }}">
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary">Enviar</button>
</div>