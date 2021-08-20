@extends('layouts.app')
    
@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row">
                <div class="col">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <h1>Produto {{ $produto->nome }} <a href="{{ route('products.index') }}"><<</a></h1>

                            <ul>
                                <li><strong>Nome: </strong>{{ $produto->nome }}</li>
                                <li><strong>Preço: </strong>{{ $produto->valor }}</li>
                                <li><strong>Descrição: </strong>{{ $produto->descricao }}</li>
                            </ul>

                            <form action="{{ route('products.destroy', $produto->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-primary">Deletar o produto: {{ $produto->nome }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection