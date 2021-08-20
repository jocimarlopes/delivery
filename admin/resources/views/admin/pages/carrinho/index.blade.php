@extends('layouts.app')

@section('content') 
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
            </div>
        </div>
    </div>

    <div class="container-fluid mt--7">
        <div class="header-body">
            <div class="row">
                <div class="col">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="mb-0">Carrinho</h3>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">ID Venda</th>
                                        <th scope="col">ID Produto</th>
                                        <th scope="col">Celular</th>
                                        <th scope="col">Quantidade</th>
                                        <th scope="col" width="100">Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($carrinho as $car)
                                        <tr>
                                            <td>{{ $car->id_venda }}</td>
                                            <td>{{ $car->id_produto }}</td>
                                            <td>{{ $car->cpf }}</td>
                                            <td>{{ $car->quantidade }}</td>
                                            <td>
                                                <form action="{{ route('carrinho.destroy', $car->id) }}" method="post">
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
                            {!! $carrinho->appends($filters)->links() !!}
                            @else
                            {!! $carrinho->links() !!}
                            @endif
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection