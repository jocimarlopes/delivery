@extends('layouts.app')

@section('content')

<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
<img src="https://lanchesdojo.store/admin/argon/img/logo-home-black.jpg" style="display: none !important;">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col">
                <a type="button" class="btn btn-success" style="margin-bottom: 15px" href="/admin/home" >
                    <i class="fa fa-refresh"></i>
                    Recarregar
                </a>            
            </div>
            <div class="col">       
            </div>
        </div>
        <div class="header-body">
            <!-- Card stats -->
            <div class="row">
                <div class="col-xl-6 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Lanches vendidos</h5>
                                    @if($carrinho != NULL)
                                    <span class="h2 font-weight-bold mb-0">{{ $carrinho->sum('quantidade') }}</span>
                                    @else
                                    <span class="h2 font-weight-bold mb-0">0</span>
                                    @endif
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                        <i class="ni ni-cart"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Caixa da Noite</h5>
                                    <span class="h2 font-weight-bold mb-0">R$ {{ $vendas->sum('total') }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                        <i class="fas fa-chart-pie"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid mt--7">
    <div class="header-body">
        <div class="row">
                @foreach ($vendas as $venda)
                <div class="card col-xl-2 col-lg-2 margin-20">
                    <div class="card-body">
                      <h5 class="card-title">#{{ $venda->id }} - {{ $venda->nome_cliente }}</h5>
                        <br>
                            <p class="card-text"><b>Lanche:</b>
                            @foreach ($venda->carrinho as $cart)

                                @foreach ($cart->produtos as $produto)
                                <br>
                                {{ $cart->quantidade }} - {{ $produto->nome }}

                                @endforeach
                            @endforeach
                            </p>
                      <p class="card-text"><b>Obs.:</b> {{ $venda->obs }}</p>
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal-{{ $venda->id }}">
                        Informações
                      </button>
                    </div>
                  <!-- Modal -->
                  <div class="modal fade" id="exampleModal-{{ $venda->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Informações</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 " id="pedido-{{ $venda->id }}">
                                    <h3>Pedido:</h3>
                                    <p class="card-text">
                                    @foreach ($venda->carrinho as $cart)
                                        @foreach ($cart->produtos as $produto)
                                        {{ $cart->quantidade }} - {{ $produto->nome }}<br>
                                        @endforeach
                                    @endforeach
                                    </p>
                                </div>
                                <div class="col-xl-6 col-lg-6" id="obs-{{ $venda->id }}">
                                    <h3>Observações:</h3>
                                    <p>{{ $venda->obs }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 " id="endereco-{{ $venda->id }}">
                                    <h3>Endereço de Entrega:</h3>
                                    <p>Rua: {{ $venda->rua }}</p>
                                    <p>Número: {{ $venda->numero }}</p>
                                    <p>Bairro: {{ $venda->bairro }}</p>
                                </div>
                                <div class="col-xl-6 col-lg-6" id="cliente-{{ $venda->id }}">
                                    <h3>Cliente:</h3>
                                    <p>Nome:{{ $venda->nome_cliente }}</p>
                                    <p>Telefone: {{ $venda->cliente }}</p>
                                    <p>Total: R${{ $venda->total }}</p>
                                    <p>Hora: {{ $venda->hora }}</p>
                                    <p>Pagar com: {{ $venda->tipo_pgto }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="col-xl-6 col-lg-6" style="float:left">
                          <button type="button" class="btn btn-primary" onclick="PrintElem({{ $venda->id }})">Imprimir</button>
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        </div>
                            <div class="col-xl-6 col-lg-6">
                            <form action="{{ route('home.destroy', $venda->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="float:right !important" class="btn btn-danger">Concluído</button>
                            </form>
                            </div>


                          <!-- APERTOU CONCLUIDO, TEM QUE ALTERAR STATUS DO PEDIDO + RETIRAR DA LISTA ATUAL -->
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach
        </div>
    </div>
</div>

@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>

    //Icons
    <link rel="stylesheet" href="{{ asset('argon') }}/icons/css/font-awesome.css">
@endpush
