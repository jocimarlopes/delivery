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
                                    <h3 class="mb-0">Configurações</h3>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Previsão em Minutos</th>
                                        {{--<th scope="col">Taxa de Entrega</th>--}}
                                        <th scope="col">Abertura</th>
                                        <th scope="col">Fechamento</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Contato</th>
                                        <th scope="col">Editar</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($config as $conf)
                                        <tr>
                                            <td>{{ $conf->previsao_minutos }}</td>
                                            {{--<td>{{ $conf->taxa_entrega }}</td>--}}
                                            <td>{{ $conf->abertura }}</td>
                                            <td>{{ $conf->fechamento }}</td>
                                            <td><span class="badge badge-default">{{ $conf->status }}</span></td>
                                            <td>{{ $conf->contato }}</td>
                                            <td>
                                                <form action="{{ route('config.edit', $conf->id) }}">
                                                    @csrf

                                                    <button type="submit" class="btn btn-success btn-sm">Editar</button>
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
