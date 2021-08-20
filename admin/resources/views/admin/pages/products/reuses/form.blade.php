@include('admin.includes.alerts')

@csrf
<div class="form-group">
    <input type="text" class="form-control" name="nome" placeholder="Nome:" value="{{ $produto->nome ?? ''->nome ?? old('nome') }}">
</div>
<div class="form-group">
    <input type="text" name="valor" class="form-control valor" placeholder="Preço:"  value="{{ $produto->valor ?? ''->valor ?? old('valor') }}">
</div>
<div class="form-group">
    <input type="text" name="descricao" class="form-control" placeholder="Descrição:"  value="{{ $produto->descricao ?? ''->descricao ?? old('descricao') }}">
</div>
<div class="form-group">
    <input type="text" name="descricao_longa" class="form-control" placeholder="Descrição detalhada:"  value="{{ $produto->descricao_longa ?? ''->descricao_longa ?? old('descricao_longa') }}">
</div>
<div class="form-group">
    <label for="exampleFormControlSelect1">Categoria</label>
    <select class="form-control" name="categoria" value="" placeholder="Selecione..">
    <option value="8">Lanches</option>
    <option value="1">Bebidas</option>
    <option value="14">Porções</option>
    </select>
  </div>
 <!--
<div class="form-group">
    <input type="text" name="categoria" class="form-control" placeholder="Categoria:"  value="{{ $produto ?? ''->categoria ?? old('categoria') }}">
</div>
<div class="form-group">
    <input type="text" name="nome_url" class="form-control" placeholder="Nome da URL:"  value="{{ $produto ?? ''->nome_url ?? old('nome_url') }}">
</div>-->
<div class="form-group">
    <input type="file" name="image" class="form-control">
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary">Enviar</button>
</div>
