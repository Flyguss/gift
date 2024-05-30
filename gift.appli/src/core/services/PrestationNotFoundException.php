<?php

namespace gift\appli\core\services;

class PrestationNotFoundException extends \Exception
{
    protected $message = 'Prestation not found';
}