<?php

namespace gift\appli\core\services ;

interface AuthentificationServiceInterface {

    public function addUser($email , $password , $role);

    public function getUserByEmail($email);
}
