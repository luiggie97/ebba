@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Usuário Logado!') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ __('Seja bem vindo ao Sistema de aluguel de veículos, aqui você pode alugar seu veículo no conforto da sua casa') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
