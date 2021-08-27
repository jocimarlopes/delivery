<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Venda;
use App\Models\Produto;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    private $repository;

    /**
     * Create a new controller instance.
     *
     * @return void 
     */
    public function __construct(Venda $venda)
    {
        $this->middleware('auth');
        $this->repository = $venda;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $carrinho = Car::first();

        $cliente = Cliente::first();

        $vendas = Venda::all();

        $produtos = Produto::first();

        return view('dashboard', [
            'carrinho' => $carrinho,
            'cliente'=> $cliente,
            'vendas' => $vendas,
            'produtos' => $produtos,
            'cliente' => $cliente,
        ]);
    }
 
    public function destroy($id)
    {
        $venda = $this->repository->where('id', $id)->first();
        if (!$venda)
            return redirect()->back();
    
        $venda->delete();

        return redirect()->route('home');
    }

}
