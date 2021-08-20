<?php

namespace App\Http\Controllers;

use App\Models\Local;
use Illuminate\Http\Request;

class LocalController extends Controller
{
    protected $request; 
    private $repository;

    public function __construct(Request $request, Local $local)
    {
        $this->request = $request;
        $this->repository = $local;

        //$this->middleware('auth');
        /*$this->middleware('auth')->only([
            'create', 'store'
        ]);*/
        /*$this->middleware('auth')->except([
            'index', 'show'
        ]);*/
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locais = Local::paginate(25);

        return view('admin.pages.locais.index', [
            'locais' => $locais,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.locais.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only('nome', 'id', 'valor');

        $this->repository->create($data);

        return redirect()->route('locais.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         //$product = Product::where('id', $id)->first();
         if (!$local = $this->repository->find($id))
         return redirect()->back();

        return view('admin.pages.locais.show', [
            'local' => $local
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
        if (!$local = $this->repository->find($id))
        return redirect()->back();

        return view('admin.pages.locais.edit', compact('local'));
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
        if (!$local = $this->repository->find($id))
            return redirect()->back(); 

        $data = $request->all();

        $local->update($data);

        return redirect()->route('locais.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $local = $this->repository->where('id', $id)->first();
        if (!$local)
            return redirect()->back();

        $local->delete();

        return redirect()->route('locais.index');
    }
}
