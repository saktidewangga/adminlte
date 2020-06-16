<?php namespace CI4Xpander_AdminLTE\View\Component\Button;

class Data extends \CI4Xpander_Dashboard\View\Data
{
    public $type = 'default';
    public $text = '';
    public $size = '';
    public $isEnabled = true;
    public $isFlat = false;
    public $isBlock = false;
    public $isLink = false;
    public $url = '';

    use \CI4Xpander\View\DataFactoryTrait;
}
