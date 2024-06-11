<?php

namespace gift\appli\core\services;

use gift\appli\app\utils\CsrfService;
use gift\appli\core\domain\entites\Categorie;
use gift\appli\core\domain\entites\Prestation;
use gift\appli\core\domain\entites\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AuthentificationService implements AuthentificationServiceInterface {


    public function addUser($email , $password , $role): void {
        $user = new User ;
        $user->user_id = $email ;
        $user->password = $password ;
        $user->role = $role ;
        $user->save() ;
    }

    public function getUserByEmail($email){

    return User::where('user_id' , 'like' , $email)->first() ;

    }

    public function verifyPassword($password , $user) {
        return password_verify($password ,$user->password);
    }
}