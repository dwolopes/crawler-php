@extends('layouts.master')

@section('content')

    @include('layouts.partials._jumbotron')

    <div class="container">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Código da URL</th>
                <th scope="col">URL</th>
                <th scope="col">Marca</th>
                <th scope="col">Modelo</th>
                <th scope="col">Ano de Fabricação</th>
                <th scope="col">Ano do Modelo</th>
                <th scope="col">Preço</th>
                <th scope="col">Código do veículo</th>
                <th scope="col">Status Crawler</th>
            </tr>
            </thead>
            <tbody>
            @foreach($links as $link)
                <tr id="{{$link->id}}">
                    <th scope="row">{{$link->id}}</th>
                    <td><a href="{{$link->url}}" target="_blank">{{$link->url}}</a></td>
                    <td id="{{$link->id}}_marca"></td>
                    <td id="{{$link->id}}_modelo"></td>
                    <td id="{{$link->id}}_ano_fabricacao"></td>
                    <td id="{{$link->id}}_ano_modelo"></td>
                    <td id="{{$link->id}}_preco"></td>
                    <td id="{{$link->id}}_codigo_veiculo"></td>
                    <td id="{{$link->id}}_status_crawler"></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>


@endsection