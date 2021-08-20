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
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
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

    public function destroy()
    {
        $carrinho = DB::table('carrinho')->truncate();

        if (!$carrinho)
            return redirect()->back();

        return redirect()->route('home.index');
    }
}
