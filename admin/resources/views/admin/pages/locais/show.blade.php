@extends('layouts.app')
    
@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row">
                <div class="col">
                    <div class="card shadow">
                        <div class="card-header border-0"> 
                            <h1>Produto {{ $local->nome }} <a href="{{ route('locais.index') }}"><<</a></h1>

                            <ul>
                                <li><strong>Nome: </strong>{{ $local->nome }}</li>
                            </ul>

                            <form action="{{ route('locais.destroy', $local->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-primary">Deletar o local: {{ $local->nome }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection