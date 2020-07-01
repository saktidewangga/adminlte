<?php namespace CI4Xpander_AdminLTE\View\Component\Table;

class Data extends \CI4Xpander\View\Data
{
    public $id = '';
    public $name = '';
    public $columns = [];
    public $rows = [];
    public $rowAction = [
        'detail',
        'update',
        'delete'
    ];

    public $isDataTable = false;

    use \CI4Xpander\View\DataFactoryTrait;
}
