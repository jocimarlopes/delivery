@extends('layouts.app')

@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row">
                <div class="col">
                    <div class="card shadow">
                        <div class="p-4 bg-secondary">
                            <h1>Editar Local</h1>
                                <form method="post" action="{{ route('locais.update', $local) }}" autocomplete="off">
                                    @csrf
                                   @method('put')
        
                                    <div class="pl-lg-4">
                                        
                                        <div class="form-group{{ $errors->has('nome') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-name">{{ __('Nome') }}</label>
                                            <input type="text" name="nome" id="input-nome" class="form-control form-control-alternative{{ $errors->has('nome') ? ' is-invalid' : '' }}" placeholder="{{ __('Nome') }}" value="{{ old('nome', $local->nome) }}" required autofocus>
                                            @include('alerts.feedback', ['field' => 'nome'])
                                        </div>
                                    
                                                <div class="form-group{{ $errors->has('valor') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-valor">Taxa de Entrega</label>
                                                    <input type="number" step=".01" name="valor" id="input-valor" class="form-control form-control-alternative" placeholder="Taxa de Entrega" value="{{ old('valor', $local->valor) }}" required>
                                                    @include('alerts.feedback', ['field' => 'valor'])
                                                </div>
        
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-success mt-4">Enviar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>   
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection