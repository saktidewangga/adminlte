<?php

namespace CI4Xpander_AdminLTE\View;

class Data extends \CI4Xpander\View\Data
{
    /**
     * @var \CI4Xpander_AdminLTE\View\Data\Site $site
     */
    public $site;

    /**
     * @var \CI4Xpander_AdminLTE\View\Data\Page $page
     */
    public $page;

    /**
     * @var \CI4Xpander_AdminLTE\View\Data\User $user
     */
    public $user;

    /**
     * @var \CI4Xpander_AdminLTE\View\Data\Template $template
     */
    public $template;

    use \CI4Xpander\View\DataFactoryTrait;
}
