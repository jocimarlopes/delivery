<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;


class CarController extends Controller
{
    protected $request;
    private $repository;
    
    public function __construct(Request $request, Car $car)
    {
        $this->middleware('auth');
        $this->request = $request;
        $this->repository = $car;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carrinho = Car::first();

        return view('admin.pages.carrinho.index', [
            'carrinho' => $carrinho,
        ]);
    }

    /**
     * Relacionamento da tabela Carrinho com as Vendas
     */
    public function relacionamento()
    {
        Schema::create('carrinho', function (Blueprint $table) {
            $table->integer('id_produto')->unsigned();

            $table->foreign('id_produto')
                ->references('id')->on('produtos')
                ->onDelete('cascade');
        });
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car, $id)
    {
        $car = $this->repository->where('id', $id)->first();
        if (!$car)
            return redirect()->back();
    
        $car->delete();

        $car = DB::table('carrinho')->truncate();

        if (!$car)
            return redirect()->back();

        return redirect()->route('carrinho.index');
    }
}
