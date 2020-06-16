<?php namespace CI4Xpander_AdminLTE\View\Component;

class Button extends \CI4Xpander\View\Component
{
    protected $_name = 'Button';

    public function render()
    {
        if ($this->data->isLink) {
            $this->_view = 'Link';
        }

        return parent::render();
    }

    use \CI4Xpander\View\ComponentFactoryTrait;
}
