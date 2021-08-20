@extends('layouts.app')

@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row">
                <div class="col">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <h1>Editar Categoria {{ $categoria->nome }}</h1>

                            <form method="post" action="{{ route('categorias.update', $categoria) }}" enctype="multipart/form-data" autocomplete="off">
                                @csrf
                                @method('put')
                                    <div class="pl-lg-4">
                                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-name"></label>
                                        <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Nome" value="{{ old('name', $categoria->name) }}" required autofocus>
                                        @include('alerts.feedback', ['field' => 'name'])
                                    </div>
                                    
                                    <div class="form-group">
                                        <input type="file" name="image" class="form-control form-control-alternative"  required>
                                        @include('alerts.feedback', ['field' => 'image'])
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
@endsection