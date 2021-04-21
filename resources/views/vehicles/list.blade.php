@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 pt-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-10"><h3>Lista de Veículos</h3></div>
                            @if(Auth::user()->admin)
                                <div class="col-lg-2"><a class="btn btn-primary" href="/vehicle/create" role="button">Cadastrar
                                        Veículo</a></div>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        @if(session('status'))
                            <div class="alert alert-info">
                                {{session('status')}}
                            </div>
                        @endif
                        <table class="table table-hover table-responsive-lg">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tipo</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Placa</th>
                                <th>Ano</th>
                                <th>Descrição</th>
                                <th>Foto</th>
                                <th>Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($vehicles as $vehicle)
                                <tr>
                                    <th>{{$vehicle->id}}</th>
                                    <td>{{$vehicle->type}}</td>
                                    <td>{{$vehicle->Brand->name}}</td>
                                    <td>{{$vehicle->ModelVehicle->name}}</td>
                                    <td>{{$vehicle->plate}}</td>
                                    <td>{{$vehicle->year}}</td>
                                    <td>{{$vehicle->description}}</td>
                                    <td><img src="{{asset('images/'.$vehicle->photo)}}" alt="" title=""
                                             style="max-height: 50px; max-width: 50px"></td>
                                    <td>
                                        <a href="/booking/list/{{$vehicle->id}}">
                                            <i class="fas fa-calendar-alt" style="color:green;"></i>
                                        </a>
                                        @if(Auth::user()->admin)
                                            |
                                            <a href="/vehicle/edit/{{$vehicle->id}}">
                                                <i class="fas fa-edit" style="color:blue;"></i>
                                            </a> |
                                            <a href="/vehicle/destroy/{{$vehicle->id}}" onclick="
                                                event.preventDefault();
                                                $('#form-delete').attr('action', '/vehicle/delete/{{$vehicle->id}}').submit();
                                                ">
                                                <i class="fas fa-trash-alt" style="color:red;"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <form id="form-delete" action="" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
