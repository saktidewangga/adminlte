<?php

namespace CI4Xpander\AdminLTE\View;

class Data extends \CI4Xpander\View\Data
{
    /**
     * @var \CI4Xpander\AdminLTE\View\Data\Site
     */
    public $site;

    /**
     * @var \CI4Xpander\AdminLTE\View\Data\Page
     */
    public $page;

    /**
     * @var \CI4Xpander\AdminLTE\View\Data\User
     */
    public $user;

    /**
     * @var \CI4Xpander\AdminLTE\View\Data\Template
     */
    public $template;

    use \CI4Xpander\View\DataFactoryTrait;
}
