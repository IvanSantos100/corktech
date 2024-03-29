@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Visualizar produto</div>
                <div class="panel-body">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label class="control-label col-sm-2" >Descrição:</label>
                            <div class="col-sm-10">
                                {{ $produto->descricao }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" >Preço:</label>
                            <div class="col-sm-10">
                                {{ $produto->preco }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" >Estampa:</label>
                            <div class="col-sm-10">
                                {{ $produto->estampas->descricao }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" >Tipo produto:</label>
                            <div class="col-sm-10">
                                {{ $produto->tipoprodutos->descricao }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" >Classe:</label>
                            <div class="col-sm-10">
                                {{ $produto->classes->descricao }}
                            </div>
                        </div>
                    </form>
                    <div class="alert alert-danger">
                        Deseja realmente excluir?.
                    </div>
                    <div>
                        {!! Form::open(['route' => ['admin.produtos.destroy', 'produto' => $produto->id], 'id' => $produto->id, 'method' => 'DELETE']) !!}
                        <a href="{{ route('admin.produtos.index') }}" class="btn btn-success">Voltar</a>
                        {!! Form::submit('Excluir', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection