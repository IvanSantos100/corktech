<?php
/**
 * Created by PhpStorm.
 * User: Pichau
 * Date: 04/04/2017
 * Time: 21:40
 */

namespace CorkTech\Http\Controllers;

use CorkTech\Http\Requests\UsuariosRequest;
use CorkTech\Repositories\UsuariosRepository;
use CorkTech\Repositories\CentroDistribuicoesRepository;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsuariosController extends Controller
{
    protected $repository;

    private $centroDistribuicoesRepository;

    public function __construct(
        UsuariosRepository $repository,
        CentroDistribuicoesRepository $centroDistribuicoesRepository
    ){
        $this->repository = $repository;
        $this->centroDistribuicoesRepository = $centroDistribuicoesRepository;
    }

    public function index(Request $request)
    {
        $search = $request->get('search');
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));

        if(Auth::user()->centrodistribuicao_id==1){
            $usuarios = $this->repository->paginate(10);
        }else{
            $centrodis = Auth::user()->centrodistribuicao_id;
            $usuarios = $this->repository->findWherePaginate([['centrodistribuicao_id','=',$centrodis]],10);
        }


        return view('admin.usuarios.index', compact('usuarios','search'));
    }

    public function create()
    {
        $centroDistribuicoes = $this->centroDistribuicoesRepository->pluck('descricao', 'id');
        return view('admin.usuarios.create', compact('centroDistribuicoes'));
    }

    public function store(UsuariosRequest $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $data['is_permission'] = 1;
        $this->repository->create( $data);
        $url = $request->get('redirect_to', route('admin.usuarios.index'));
        $request->session()->flash('message', 'Usuário cadastrado com sucesso.');

        return redirect()->to($url);
    }

    public function edit($id)
    {
        $usuario = $this->repository->find($id);
        $centroDistribuicoes = $this->centroDistribuicoesRepository->pluck('descricao', 'id');

        return view('admin.usuarios.edit', compact('usuario', 'centroDistribuicoes'));
    }

    public function update(UsuariosRequest $request, $id)
    {
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $data['is_permission'] = 1;
        $this->repository->update($data, $id);
        $url = $request->get('redirect_to', route('admin.usuarios.index'));
        $request->session()->flash('message', ' Usuário atualizado com sucesso.');

        return redirect()->to($url);
    }

    public function show($id)
    {
        $usuario = $this->repository->find($id);

        return view('admin.usuarios.show', compact('usuario'));
    }

    public function destroy($id)
    {
        try {
            $this->repository->delete($id);
            \Session::flash('message', 'Usuário excluída com sucesso.');
        }catch (QueryException $ex){
            \Session::flash('error', 'Usuário não pode ser excluido. Ele está relacionado com outro registro .');
        }

        return redirect('admin/usuarios');
    }

}