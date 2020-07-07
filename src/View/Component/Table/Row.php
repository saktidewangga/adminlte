<?php namespace CI4Xpander_AdminLTE\View\Component\Table;

class Row extends \CI4Xpander\View\Component
{
    protected $_name = 'TableRow';

    public $id = null;
    public $columns = [];

    public function setId($id = null)
    {
        $this->id = $id;
        return $this;
    }

    public function setColumns($columns = [])
    {
        $this->columns = $columns;
        return $this;
    }

    public function render()
    {
        return view('CI4Xpander_AdminLTE\Views\Component\Table\Row', [
            'id' => $this->id,
            'columns' => $this->columns
        ], [
            'saveData' => false
        ]);
    }

    use \CI4Xpander\View\ComponentFactoryTrait;
}