<?php namespace CI4Xpander_AdminLTE\View\Component\TextArea;

class Data extends \CI4Xpander\View\Data
{
    public $id = '';
    public $class = 'form-control';
    public $name = '';
    public $value = '';
    public $placeholder = '';
    public $rows = 3;
    public $cols = null;

    use \CI4Xpander\View\DataFactoryTrait;
}