<?php


namespace App\Classes;


use App\User;

class Users
{
    public function access($option, $var=0,$store=0){
        switch ($option){
            case 0: return User::all();
                break;
            case 1: return $this->deleteUser($var);
                break;
            case 2: return $this->validate($var,$store);
                break;
            case 3: return User::find($var);
                break;
        }
    }

    protected function validate($request,$store){
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'cpf' => 'required|unique:users',
            'admin' => 'required'
        ]);
        switch ($store){
            case 0: return $this->createUser($request);
                break;
            case 1: return $this->updateUser($request);
                break;
        }

    }
    protected function createUser($request){
        $user = new User();
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = bcrypt($request['password']);
        $user->cpf = $request['cpf'];
        $user->admin = $request['admin'];

        if($user->save())
            return "Usuário criado com sucesso!";
        return "Ocorreu um erro ao criar o usuário!";
    }
    protected function updateUser($request){
        $user = User::find($request['id']);
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = bcrypt($request['password']);
        $user->cpf = $request['cpf'];
        $user->admin = $request['admin'];
        if($user->save())
            return "Usuário Atualizado com sucesso!";
        return "Ocorreu um erro ao atualizar o usuário!";
    }
    protected function deleteUser($id){
        if(User::destroy($id))
            return "Usuário deletado com sucesso!";
        return "Ocorreu um erro ao deletar o usuário!";
    }

}
