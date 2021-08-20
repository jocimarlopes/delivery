
@csrf
<div class="form-group">
    <input type="text" class="form-control" name="nome" placeholder="Nome:" value="{{ $categoria->nome ?? old('nome') }}">
</div>
<div class="form-group">
    <input type="text" name="descricao" class="form-control" placeholder="Descrição:"  value="{{ $categoria->descricao ?? old('descricao') }}">
</div>
<div class="form-group">
    <input type="text" name="nome_url" class="form-control" placeholder="Nome da URL:"  value="{{ $categoria->nome_url ?? old('nome_url') }}">
</div>
<div class="form-group">
    <input type="file" name="imagem" class="form-control">
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary">Enviar</button>
</div>