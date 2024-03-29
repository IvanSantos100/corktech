@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Listagem de pedido</div>
                <div class="panel-body">
                    <div class="pull-left">
                        {!! Form::model(compact('search'), ['class'=>'form-inline', 'method'=> 'GET'])!!}
                        {!! Form::label('search', 'Pesquisar', ['class' => 'control-label']) !!}
                        {!! Form::text('search', null, ['class' => 'form-control']) !!}
                        {!! Form::submit('Pesquisar', array('class' => 'btn btn-primary')) !!}
                        {!! Form::close()!!}
                    </div>
                    <div class="pull-right">
                        <div class="btn-group pull-right">
                            <a class='btn btn-primary' href="{{route('admin.pedidos.index')}}">Andamento</a>
                        </div>
                    </div>
                    <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Tipo</th>
                            <th>Origem</th>
                            <th>Destino</th>
                            <th>Valor base</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pedidos as $pedido)
                            <tr>
                                <td class="col-md-2">{{ $pedido->id}}</td>
                                <td class="col-md-2">{{ $pedido->tipo}}</td>
                                @if($pedido->origem_id=="")
                                    <td class="col-md-2">Fábrica</td>
                                @else
                                    <td class="col-md-2">{{ $pedido->origem->descricao}}</td>
                                @endif
                                @if($pedido->destino_id=="")
                                    <td class="col-md-2">
                                        <a onclick="popupcliente('{{$pedido->cliente->nome}}','{{$pedido->cliente->tipo}}','{{$pedido->cliente->fone}}')">Cliente</a>
                                    </td>
                                @else
                                    <td class="col-md-2">{{ $pedido->destino->descricao}}</td>
                                @endif
                                <td class="col-md-2">R$ {{number_format($pedido->valor_base,2, ',', '.') }}</td>
                                <td class="col-md-2">
                                    <ul class="list-inline">
                                        <li>
                                            <a class='btn btn-primary' href="{{ route('admin.pedidosencerrados.itenspedido', ['pedido' => $pedido->id]) }}">Produtos</a>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $pedidos->links() }}
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="salvemsg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="Titulomodal"></h4>
                </div>
                <div class="modal-body" id="Corpomodal">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection