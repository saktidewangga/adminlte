<?php namespace CI4Xpander_AdminLTE\View\Component\Menu\Item;

class Data extends \CI4Xpander\View\Data
{
    public $name = '';
    public $url = '';
    public $isActive = false;
    public $icon = 'fa fa-circle-o';
    public $childs = [];

    use \CI4Xpander\View\DataFactoryTrait;
}