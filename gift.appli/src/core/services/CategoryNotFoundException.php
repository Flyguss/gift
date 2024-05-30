<?php
namespace gift\appli\core\services ;
class CategoryNotFoundException extends \Exception
{
    protected $message = 'Category not found';
}