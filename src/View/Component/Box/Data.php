<?php namespace CI4Xpander_AdminLTE\View\Component\Box;

class Data extends \CI4Xpander\View\Data
{
    /**
     * @var \CI4Xpander_AdminLTE\View\Component\Box\Data\Head $head
     */
    public $head;

    public $body = '';

    use \CI4Xpander\View\DataFactoryTrait;
}
