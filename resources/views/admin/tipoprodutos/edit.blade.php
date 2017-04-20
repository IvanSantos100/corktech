@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Editar tipo produto</div>
                {!! Form::model($tipoproduto,[
                   'route' => ['admin.tipoprodutos.update' , 'class' => $tipoproduto->id],
                   'class' => 'form', 'method' => 'PUT']) !!}
                <div class="panel-body">
                    @include('admin.tipoprodutos._form')
                </div>
                <div class="panel-footer">
                    <center>
                        {!! Html::openFormGroup() !!}
                        {!! form::submit('Salvar tipo produto', ['class' => 'btn btn-primary']) !!}
                        {!! Html::closeFormGroup() !!}
                    </center>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection