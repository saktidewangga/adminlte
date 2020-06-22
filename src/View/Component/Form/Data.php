<?php namespace CI4Xpander_AdminLTE\View\Component\Form;

class Data extends \CI4Xpander\View\Data
{
    public $method = 'POST';
    public $action = '';
    public $input = [];
    public $id = '';
    public $class = '';

    use \CI4Xpander\View\DataFactoryTrait;
}