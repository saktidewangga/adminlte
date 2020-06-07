<?php

namespace CI4Xpander\AdminLTE\View\Data\Template\Menu;

class Item extends \CI4Xpander\View\Data
{
    public $name = '';
    public $link = '#';
    public $isActive = false;
    public $icon = 'fas fa-circle';
    public $childs = [];
}
