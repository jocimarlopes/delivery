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
                                    <h3 class="mb-0">Listagem De Categorias</h3>
                                </div>
                                <div class="col text-right">
                                    <a href="{{ route('categorias.create') }}" class="btn btn-sm btn-primary">Cadastrar</a>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col" width="100">Imagem</th>
                                        <th scope="col">Nome</th>
                                        <th scope="col">Produtos</th>
                                        <th scope="col">Estoque Total</th>
                                        <th scope="col" width="100">Ações</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($categorias as $categoria)
                                        <tr>
                                            <td>
                                                @if ($categoria->image)
                                                    <img src="{{ url("storage/{$categoria->image}") }}" alt="{{ $categoria->nome }}" style="max-width: 100px;">
                                                @endif 
                                            </td>
                                            <td>{{ $categoria->name }}</td>
                                            <td>{{ count($categoria->produtos) }}</td>
                                            <td>{{ $categoria->produtos->sum('estoque') }}</td>
                                            
                                            <td>
                                                <form action="{{ route('categorias.edit', $categoria->id) }}">
                                                    @csrf
                                                    
                                                    <button type="submit" class="btn btn-success btn-sm">Editar</button>
                                                </form>
                                                <br>
                                                <form action="{{ route('categorias.destroy', $categoria->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Deletar</button>
                                                </form>                                               
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection