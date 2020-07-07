<?php namespace CI4Xpander_AdminLTE\View\Component\Form;

class Dropdown
{
    public static function buildOptions($data = null, $options = null)
    {
        $result = [
            0 => ''
        ];

        if (!is_null($data)) {
            $value = 'id';
            $label = 'label';

            if (!is_null($options)) {
                $value = $options['value'] ?? 'id';
                $label = $options['label'] ?? 'label';
            }

            array_walk($data, function ($item) use (&$result, $value, $label) {
                if (is_object($item)) {
                    $result[$item->{$value}] = $item->{$label};
                } else {
                    $result[$item[$value]] = $item[$label];
                }
            });

            return $result;
        }

        return [];
    }
}