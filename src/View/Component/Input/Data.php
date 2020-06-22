<?php namespace CI4Xpander_AdminLTE\View\Component\Input;

class Data extends \CI4Xpander\View\Data
{
    public $type = 'text';
    public $id = '';
    public $class = 'form-control';
    public $name = '';
    public $value = '';
    public $placeholder = '';

    use \CI4Xpander\View\DataFactoryTrait;
}