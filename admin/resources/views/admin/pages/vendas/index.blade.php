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
                                    <h3 class="mb-0">Listagem De Pedidos</h3>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Pedido</th>
                                        <th scope="col">Cliente</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Total Pago</th>
                                        <th scope="col">Troco</th>
                                        <th scope="col">Tipo-Pagamento</th>
                                        <th scope="col">Data</th>
                                        <th scope="col">Hora</th>
                                        <th scope="col">Status</th>
                                        <th scope="col" width="100">Observação</th>

                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($vendas as $venda)
                                        @if($venda)
                                            <tr>
                                                <td>{{ $venda->id }}</td>
                                                <td>{{ $venda->nome_cliente }}</td>
                                                <td>{{ $venda->total }}</td>
                                                <td>{{ $venda->total_pago }}</td>
                                                <td>{{ $venda->troco }}</td>
                                                <td>{{ $venda->tipo_pgto }}</td>
                                                <td>{{ $venda->data }}</td>
                                                <td>{{ $venda->hora }}</td>
                                                <td>{{ $venda->status }}</td>
                                                <td>{{ $venda->obs }}</td>
                                            </tr>

                                        @else
                                              <p class="text-center">SEM VENDAS</p>
                                        @endif
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
