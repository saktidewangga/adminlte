<?php

namespace CI4Xpander\AdminLTE\View;

class Data extends \CI4Xpander\View\Data
{
    /**
     * @var \CI4Xpander\AdminLTE\View\Data\Site
     */
    public \CI4Xpander\AdminLTE\View\Data\Site $site;

    /**
     * @var \CI4Xpander\AdminLTE\View\Data\Page
     */
    public \CI4Xpander\AdminLTE\View\Data\Page $page;

    /**
     * @var \CI4Xpander\AdminLTE\View\Data\User
     */
    public \CI4Xpander\AdminLTE\View\Data\User $user;

    /**
     * @var \CI4Xpander\AdminLTE\View\Data\Template
     */
    public \CI4Xpander\AdminLTE\View\Data\Template $template;

    use \CI4Xpander\View\DataFactoryTrait;
}
