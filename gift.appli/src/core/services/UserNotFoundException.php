<?php

namespace gift\appli\core\services;

class UserNotFoundException extends \Exception
{
    protected $message = 'User not found';
}