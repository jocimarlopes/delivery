<?php

namespace App\Http\Controllers; 

use App\Models\Produto;
use Illuminate\Http\Request;
use App\Models\ProdutoCategoria;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProdutoCategoriaRequest;

class ProdutoCategoriaController extends Controller
{
    protected $request;
    private $repository;

    public function __construct(Request $request, ProdutoCategoria $categoria)
    {
        $this->request = $request;
        $this->repository = $categoria;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProdutoCategoria $model)
    {
        $categorias = ProdutoCategoria::paginate(25);

        return view('admin.pages.categorias.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.categorias.create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProdutoCategoriaRequest $request, ProdutoCategoria $categoria)
    {
        $data = $request->only('name', 'image');

        if ($request->hasFile('image') && $request->image->isValid()) {
            $imagePath = $request->image->store('categorias');

            $data['image'] = $imagePath;
        }

        $this->repository->create($data);

        return redirect()->route('categorias.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ProdutoCategoria $categoria)
    {
        return view('admin.pages.categorias.show', [
            'categoria' => $categoria,
            'produtos' => Produto::where('produto_categoria_id', $categoria->id)->paginate(25)
        ]);
    } 

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!$categoria = $this->repository->find($id))
            return redirect()->back();

        return view('admin.pages.categorias.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProdutoCategoriaRequest $request, $id)
    {   
        if (!$categoria = $this->repository->find($id))
            return redirect()->back();

        $data = $request->all();

        if ($request->hasFile('image') && $request->image->isValid()) {

            if ($categoria->image && Storage::exists($categoria->image)) {
                Storage::delete($categoria->image);
            }

            $imagePath = $request->image->store('categorias');
            $data['image'] = $imagePath;
        }

        $categoria->update($data);

        return redirect()->route('categorias.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $categoria = $this->repository->where('id', $id)->first();
        if (!$categoria)
            return redirect()->back();

        if ($categoria->image && Storage::exists($categoria->image)) {
            Storage::delete($categoria->image);
        }

        $categoria->delete();

        return redirect()->route('categorias.index');
    }

}
