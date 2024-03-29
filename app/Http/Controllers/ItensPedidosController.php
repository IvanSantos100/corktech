<?php

namespace CorkTech\Http\Controllers;

use CorkTech\Http\Requests\ItensPedidosRequest;
use CorkTech\Repositories\ItensPedidosRepository;
use CorkTech\Repositories\PedidosRepository;
use CorkTech\Repositories\ProdutosRepository;
use Illuminate\Http\Request;

class ItensPedidosController extends Controller
{

    /**
     * @var ItensPedidosRepository
     */
    protected $repository;
    /**
     * @var PedidosRepository
     */
    private $pedidosRepository;

    private $produtosRepository;

    public function __construct(
        ItensPedidosRepository $repository, PedidosRepository $pedidosRepository,ProdutosRepository $produtosRepository
    ){
        $this->repository = $repository;
        $this->pedidosRepository = $pedidosRepository;
        $this->produtosRepository = $produtosRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $pedidorealizado = $request->get('pedido');

        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $this->pedidosRepository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));

        $itenspedidos = $this->repository->findWherePaginate([['pedido_id','=',$pedidorealizado]],10);
        $pedido = $this->pedidosRepository->find($pedidorealizado);

        return view('admin.itenspedidos.index', compact('itenspedidos','search', 'pedido'));
    }

    public function create()
    {
        $pedidos = $this->pedidosRepository->pluck('descricao', 'id');

        return view('admin.itenspedidos.create', compact('pedidos') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ItensPedidosRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ItensPedidosRequest $request)
    {
        $this->repository->create($request->all());
        $url = $request->get('redirect_to', route('admin.itenspedidos.index'));
        $request->session()->flash('message', 'Pedido cadastrado com sucesso.');

        return redirect()->to($url);
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pedido = $this->repository->find($id);

        $pedido->tipo = $this->opcao($pedido->tipo);

        return view('admin.itenspedidos.show', compact('pedido'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pedido = $this->repository->find($id);
        $origens = $this->origensRepository->pluck('descricao', 'id');
        $destinos = $this->destinosRepository->pluck('descricao', 'id');
        $clientes = $this->clientesRepository->pluck('nome', 'id');
        $opcao = [1 => 'Entrada', 2 => 'Movimentação', 3 => 'Saída'];

        return view('admin.itenspedidos.edit', compact('pedido', 'origens', 'destinos', 'clientes', 'opcao'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  ItensPedidosRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(ItensPedidosRequest $request, $id)
    {
        $this->repository->update($request->all(), $id);
        $url = $request->get('redirect_to', route('admin.itenspedidos.index'));
        $request->session()->flash('message', ' de pedido cadastrado com sucesso.');

        return redirect()->to($url);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repository->delete($id);
        \Session::flash('message', 'ItensPedidos excluída com sucesso.');

        return redirect('admin/itenspedidos');
    }

    private function opcao($p)
    {
        switch ($p){
            case 1 : return 'Entrada'; break;
            case 2 : return 'Movimentação'; break;
            case 3 : return 'Saída';
        }
    }
}
