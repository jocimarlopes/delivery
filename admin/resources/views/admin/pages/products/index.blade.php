@extends('layouts.app')

@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">

    <div class="container-fluid">
        <div class="header-body">
            <div class="row">
                <div class="col">
                    <div class="card shadow"> 
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="mb-0">Listagem De Produtos</h3>
                                </div>
                                <div class="col text-right">
                                    <a href="{{ route('products.create') }}" class="btn btn-sm btn-primary">Cadastrar</a>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col" width="100">Imagem</th>
                                        <th scope="col">Nome</th>
                                        <th scope="col">Categoria</th>
                                        <th scope="col">Estoque</th>
                                        <th scope="col">Preço</th>
                                        <th scope="col" width="100">Ações</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($produtos as $produto)
                                        <tr>
                                            <td>
                                                @if ($produto->image)
                                                    <img src="{{ url("storage/{$produto->image}") }}" alt="{{ $produto->nome }}" style="max-width: 100px;">
                                                @endif
                                            </td>
                                            <td>{{ $produto->nome }}</td>
                                            <td>{{ $produto->categoria->name }}</a></td>
                                            <td>{{ $produto->estoque }}</td>
                                            <td>R$ {{ $produto->valor }}</td>
                                            <td>
                                                <form action="{{ route('products.edit', $produto->id) }}">
                                                    @csrf
                                                    
                                                    <button type="submit" class="btn btn-success btn-sm">Editar</button>
                                                </form>
                                                <br>
                                                <form action="{{ route('products.destroy', $produto->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Deletar</button>
                                                </form>                                               
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @if (isset($filters))
                            {!! $produtos->appends($filters)->links() !!}
                            @else
                            {!! $produtos->links() !!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
