@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Listagem de tipo produto</div>
                <div class="panel-body">
                    <div class="pull-left">
                        {!! Form::model(compact('search'), ['class'=>'form-inline', 'method'=> 'GET'])!!}
                        {!! Form::label('search', 'Pesquisar', ['class' => 'control-label']) !!}
                        {!! Form::text('search', null, ['class' => 'form-control']) !!}
                        {!! Form::submit('Pesquisar', array('class' => 'btn btn-primary')) !!}
                        {!! Form::close()!!}
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-primary" href="{{route('admin.tipoprodutos.create')}}">Novo tipo produto</a>
                    </div>
                    <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th >Descrição</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tipoprodutos as $tipoproduto)
                            <tr>
                                <td class="col-md-3">{{ $tipoproduto->descricao}}</td>
                                <td class="col-md-2">
                                    <ul class="list-inline">
                                        <li>
                                            <a class='btn btn-warning' href="{{ route('admin.tipoprodutos.edit', ['tipoproduto' => $tipoproduto->id]) }}">Editar</a>
                                        </li>
                                        <li>
                                            <a class='btn btn-danger' href="{{ route('admin.tipoprodutos.show', ['tipoproduto' => $tipoproduto->id]) }}">Excluir</a>
                                        </li>
                                    </ul>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $tipoprodutos->links() }}
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection