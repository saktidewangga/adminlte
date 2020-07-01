<?php namespace CI4Xpander_AdminLTE\View\Component\Table\Row;

class Column extends \CI4Xpander\View\Component
{
    protected $_name = 'TableRowColumn';

    public $value = null;

    public function setValue($value = null)
    {
        $this->value = $value;
        return $this;
    }

    public function render()
    {
        return view('CI4Xpander_AdminLTE\Views\Component\Table\Row\Column', [
            'value' => $this->value
        ]);
    }

    use \CI4Xpander\View\ComponentFactoryTrait;
}