<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\ProdutoCategoria;
use App\Http\Requests\ProdutoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdutoController extends Controller
{
    protected $request;
    private $repository;

    public function __construct(Request $request, Produto $produto)
    {
        $this->request = $request;
        $this->repository = $produto;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produtos = Produto::paginate(25);

        return view('admin.pages.products.index', compact('produtos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = ProdutoCategoria::all();

        return view('admin.pages.products.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProdutoRequest $request, Produto $model)
    {
        $data = $request->only('nome', 'descricao', 'descricao_longa', 'produto_categoria_id', 'estoque', 'valor', 'image');

        if ($request->hasFile('image') && $request->image->isValid()) {
            $imagePath = $request->image->store('produtos');

            $data['image'] = $imagePath;
        }

        $this->repository->create($data);


        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Produto $produto)
    {
        $solds = $produto->solds()->latest()->limit(25)->get();

        $receiveds = $produto->receiveds()->latest()->limit(25)->get();

        return view('admin.pages.products.show', compact('produto', 'solds', 'receiveds'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Produto $produto, $id)
    {    
        $categorias = ProdutoCategoria::all();

        if (!$produto = $this->repository->find($id))
            return redirect()->back();

        return view('admin.pages.products.edit', compact('produto', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProdutoRequest $request, Produto $produto, $id)
    {
       if (!$produto = $this->repository->find($id))
            return redirect()->back();

        $data = $request->all();

        if ($request->hasFile('image') && $request->image->isValid()) {

            if ($produto->image && Storage::exists($produto->image)) {
                Storage::delete($produto->image);
            }

            $imagePath = $request->image->store('produtos');
            $data['image'] = $imagePath;
        }

        $produto->update($data);

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produto $produto, $id)
    {
        $produto = $this->repository->where('id', $id)->first();
        if (!$produto)
            return redirect()->back();

        if ($produto->image && Storage::exists($produto->image)) {
            Storage::delete($produto->image);
        }
    
        $produto->delete();

        return redirect()->route('products.index');
    }   
}
