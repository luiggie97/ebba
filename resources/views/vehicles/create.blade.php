@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">Cadastro de Veículos</div>
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
                        <form action="/vehicle/create" method="post" enctype="multipart/form-data">
                            {!! csrf_field() !!}
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="brand">Marcas</label>
                                        <input type="text" class="form-control" id="brand" name="brand"  placeholder="Marca do veículo" value="{{old('brand')}}" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="model">Modelos</label>
                                        <input type="text" class="form-control" id="model_vehicle" name="model_vehicle"  placeholder="Modelo do veículo" value="{{old('brand')}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="license_plate">Placa</label>
                                        <input type="text" class="form-control" id="plate" name="plate"  placeholder="Placa do veículo" value="{{old('license_plate')}}" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="model_year">Ano</label>
                                        <input type="number" class="form-control" id="year" name="year" max="2021" step="1" min="1900" placeholder="Ano do Veículo" value="{{old('year')}}" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="type">Tipo</label>
                                        <select name="type" id="type" class="form-control" required>
                                            <option value="Carro" {{old('type') == 'Carro' ? 'selected' : ''}}>Carro</option>
                                            <option value="Moto" {{old('type') == 'Moto' ? 'selected' : ''}}>Moto</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description">Descrição</label>
                                <input type="text" class="form-control" id="description" name="description"  placeholder="Detalhes do veículo" value="{{old('description')}}" required>
                            </div>
                            <div class="row mr-0 ml-0">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input name="photo" type="file" class="custom-file-input" accept="image/*" id="customFile">
                                        <label class="custom-file-label" for="customFile">Escolha uma foto</label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Cadastrar Veículo</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
