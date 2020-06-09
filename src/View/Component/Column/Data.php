<?php namespace CI4Xpander_AdminLTE\View\Component\Column;

class Data extends \CI4Xpander\View\Data
{
    public $class = 'col-lg-12';
    public $content = '';

    public function calcClass($class = null)
    {
        if (is_null($class)) {
            $class = $this->class;
        }

        $result = '';
        if (is_array($class)) {
            foreach ($class as $k => $v) {
                if (is_array($v)) {

                } else {
                    $result .= " {$v}";
                }
            }
        } elseif (is_string($class)) {
            $result = $class;
        }

        return trim($result);
    }

    use \CI4Xpander\View\DataFactoryTrait;
}