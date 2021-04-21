@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">Editar Veículos</div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="/vehicle/edit" method="post" enctype="multipart/form-data">
                            {!! csrf_field() !!}
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="brand">Marcas</label>
                                        <input type="text" class="form-control" id="brand" name="brand"  placeholder="Marca do veículo" value="{{$vehicles->Brand->name}}" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="model">Modelos</label>
                                        <input type="text" class="form-control" id="model_vehicle" name="model_vehicle"  placeholder="Modelo do veículo" value="{{$vehicles->ModelVehicle->name}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="license_plate">Placa</label>
                                        <input type="text" class="form-control" id="plate" name="plate"  placeholder="Placa do veículo" value="{{$vehicles->plate}}" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="model_year">Ano</label>
                                        <input type="number" class="form-control" id="year" name="year" max="2021" step="1" min="1900" placeholder="Ano do Veículo" value="{{$vehicles->year}}" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="type">Tipo</label>
                                        <select name="type" id="type" class="form-control" required>
                                            <option value="Carro" {{$vehicles->type == 'Carro' ? 'selected' : ''}}>Carro</option>
                                            <option value="Moto"  {{$vehicles->type == 'Moto' ? 'selected' : ''}}>Moto</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description">Descrição</label>
                                <input type="text" class="form-control" id="description" name="description"  placeholder="Detalhes do veículo" value="{{$vehicles->description}}" required>
                            </div>
                            <div class="row mr-0 ml-0">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input name="photo" type="file" class="custom-file-input" accept="image/*" value="{{$vehicles->photo}}"id="customFile">
                                        <label class="custom-file-label" for="customFile">Escolha uma foto</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mr-0 ml-0">
                                <div class="col-lg-12">
                                    <img src="{{asset('images/'.$vehicles->photo)}}" alt="" title="" style="max-height: 100px; max-width: 100px">
                                </div>
                            </div>
                            <input hidden="true" name="id" value="{{$vehicles->id}}"/>
                            <div class="row p-2">
                                <div class="col-lg-2">
                                    <button type="submit" class="btn btn-primary">Editar Veículo</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
