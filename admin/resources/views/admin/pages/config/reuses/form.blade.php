@include('admin.includes.alerts')

@csrf
<div class="form-group">
    <label class="title">Previsão de Entrega</label>
    <input type="text" class="form-control" name="previsao_minutos" placeholder="Previsao Minutos:" value="{{ $conf->previsao_minutos ?? old('previsao_minutos') }}">

</div>
{{--<div class="form-group">
    <label class="title">Valor da Tele-Entrega</label>

    <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text">R$</span>
        </div>
        <input type="text" name="taxa_entrega" class="form-control" placeholder="Taxa Entrega:"  value="{{ $conf->taxa_entrega ?? old('taxa_entrega') }}">
      </div>

</div>--}}
<div class="form-group">
    <label class="title">Abertura do Comércio</label>
    <input type="time" name="abertura" class="form-control" placeholder="Abertura:"  value="{{ $conf->abertura ?? old('abertura') }}">
</div>
<div class="form-group">
    <label class="title">Fechamento do Comércio</label>
    <input type="time" name="fechamento" class="form-control" placeholder="Fechamento:"  value="{{ $conf->fechamento ?? old('fechamento') }}">
</div>
<div class="form-group">
    <label class="title">Status do Comércio</label>
    <select name="status" value="{{ $conf->status ?? old('status') }}" class="form-control">
      <option value="Aberto">Aberto</option>
      <option value="Fechado">Fechado</option>
    </select>
    {{-- <input type="text" name="status" class="form-control" placeholder="Status:"  value="{{ $conf->status ?? old('status') }}"> --}}
</div>
<div class="form-group">
    <label class="title">Whatsapp de Contato</label>
    <input type="text" name="contato" class="form-control" id="contato" placeholder="Contato:"  value="{{ $conf->contato ?? old('contato') }}">
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary">Enviar</button>
</div>

