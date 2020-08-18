<?php namespace CI4Xpander_AdminLTE\View\Component\Button;

class Data extends \CI4Xpander_Dashboard\View\Data
{
    public $type = 'button';
    public $style = 'default';
    public $text = '';
    public $size = '';
    public $isEnabled = true;
    public $isFlat = false;
    public $isBlock = false;
    public $isLink = false;
    public $url = '';
    public $attributes = [];

    use \CI4Xpander\View\DataFactoryTrait;
}
