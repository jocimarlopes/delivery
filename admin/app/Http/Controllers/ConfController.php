<?php

namespace App\Http\Controllers;

use App\Models\Conf;
use Illuminate\Http\Request;

class ConfController extends Controller
{
    protected $request;
    private $repository;

    public function __construct(Request $request, Conf $conf)
    {
        $this->request = $request;
        $this->repository = $conf;

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
        $config = Conf::first()->paginate();

        return view('admin.pages.config.index', [
            'config' => $config,
        ]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!$conf = $this->repository->find($id))
            return redirect()->back();

        return view('admin.pages.config.edit', compact('conf'));
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
        if (!$conf = $this->repository->find($id))
            return redirect()->back();

        $data = $request->all();

        $conf->update($data);

        return redirect()->route('config.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
