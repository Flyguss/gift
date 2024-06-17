<?php
namespace gift\appli\core\services ;
class CategoryNotFoundException extends \Exception
{
    protected $message = 'Categorie not found';
}