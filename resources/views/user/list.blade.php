@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-lg-12 pt-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-10"><h3>Lista de Usuários</h3></div>
                            <div class="col-lg-2"><a class="btn btn-primary" href="/user/create" role="button">Cadastrar Usuário</a></div>
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
                                <th>Nome</th>
                                <th>Email</th>
                                <th>CPF</th>
                                <th>Role</th>
                                <th>Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <th>{{$user->id}}</th>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->cpf}}</td>
                                    <td>{{$user->admin == 1 ? 'Administrador' : 'Usuário'}}</td>
                                    <td>
                                        <a href="/user/edit/{{$user->id}}">
                                            <i class="fas fa-edit" style="color:blue;"></i>
                                        </a> |
                                        <a href="/user/destroy/{{$user->id}}" onclick="
                                            event.preventDefault();
                                            $('#form-delete').attr('action', '/user/delete/{{$user->id}}').submit();
                                        ">
                                            <i class="fas fa-trash-alt" style="color:red;"></i>
                                        </a>
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
