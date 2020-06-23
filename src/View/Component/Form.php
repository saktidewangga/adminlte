<?php namespace CI4Xpander_AdminLTE\View\Component;

use CI4Xpander_AdminLTE\View\Component\Form\Type;
use Stringy\StaticStringy;

/**
 * @property \CI4Xpander_AdminLTE\View\Component\Form\Data $data
 */
class Form extends \CI4Xpander\View\Component
{
    protected $_name = 'Form';

    public $action = '';
    public $method = 'POST';
    public $input = [];
    public $hidden = [];
    public $request;
    public $validator;

    protected function _init()
    {
        helper('form');
        parent::_init();
    }

    public function render()
    {
        $view = form_open($this->action ?: uri_string(), [
            'role' => 'form',
            'autocomplete' => 'off'
        ], $this->hidden);

        if ($this->method == 'GET') {
            $method = 'Get';
        } else {
            $method = 'Post';
            $view .= form_hidden('_method', $this->method);
        }

        foreach ($this->input as $name => $input) {
            if (is_array($input) && array_key_exists('type', $input)) {
                $ID = ucfirst($input['type']) . str_replace('[]', '', ucfirst($name));

                $containerClass = [
                    'form-group'
                ];
                if (!is_null($this->validator)) {
                    if ($this->validator->hasError($name)) {
                        $containerClass[] = 'has-error';
                    }

                    if ($input['type'] == Type::HIDDEN) {

                    }
                }

                $containerClass = implode(' ', $containerClass);
                $view .= "<div id=\"{$ID}_container\" class=\"{$containerClass}\">";

                $label = '';
                if (isset($input['label'])) {
                    $label = $input['label'];
                } else {
                    $label = StaticStringy::toTitleCase(str_replace('_', ' ', $name));
                }

                if (in_array($input['type'], [
                    Type::TEXT, Type::EMAIL, Type::PASSWORD, Type::DROPDOWN_AUTOCOMPLETE, Type::CHECKBOX, Type::CHECKBOX_SINGLE, Type::RADIO, Type::DATE, Type::DATE_RANGE, Type::TEXT_AREA, Type::WYSIWYG, Type::SLIDER, Type::SLIDER_RANGE
                ])) {
                    $view .= form_label($label, $ID, [
                        'class' => 'control-label',
                        'id' => "{$ID}_label"
                    ]);
                }

                $disabled = [];
                if (isset($input['disabled'])) {
                    $disabled = [
                        'disabled' => 'disabled'
                    ];
                }

                $getName = "get{$method}";
                $submittedValue = $this->request->$getName($name);

                if (!is_null($this->validator)) {
                    if ($this->validator->hasError($name)) {
                        $view .= "<span class=\"help-block\">{$this->validator->getError($name)}</span>";
                    }
                }

                $valueName = 'value';
                if (in_array($input['type'], [
                    Type::SELECT, Type::DROPDOWN_AUTOCOMPLETE
                ])) {
                    $valueName = 'selected';
                } elseif (in_array($input['type'], [
                    Type::CHECKBOX, Type::CHECKBOX_SINGLE, Type::RADIO
                ])) {
                    $valueName = 'checked';
                }

                $value = isset($input[$valueName]) ? $input[$valueName] : (
                    isset($submittedValue) ? $submittedValue : (
                        isset($input['default']) ? $input['default'] : ''
                    )
                );

                if (in_array($input['type'], [
                    Type::TEXT, Type::EMAIL
                ])) {
                    $view .= form_input($name, $value, array_merge(
                        $disabled,
                        [
                            'class' => 'form-control',
                            'id' => $ID,
                            'autocomplete' => 'off'
                        ]
                    ), $input['type']);
                } elseif ($input['type'] == Type::PASSWORD) {
                    $view .= form_input($name, $value, array_merge(
                        $disabled,
                        [
                            'class' => 'form-control',
                            'id' => $ID,
                            'autocomplete' => 'new-password'
                        ]
                    ), 'password');
                } elseif (in_array($input['type'], [
                    Type::SELECT, Type::DROPDOWN_AUTOCOMPLETE
                ])) {
                    $options = isset($input['options']) ? (
                        is_callable($input['options']) ? $input['options']() : $input['options']
                    ) : [];

                    $attributes = [];
                    $class = ['form-control'];
                    if ($input['type'] == Type::DROPDOWN_AUTOCOMPLETE) {
                        $class[] = 'ci4xpander-adminlte-autocomplete-dropdown';

                        if (isset($input['ajax'])) {
                            $attributes['data-ajax-url'] = $input['ajax']['url'];
                        }
                    }

                    $view .= form_dropdown($name, $options, $value, array_merge(
                        $disabled,
                        [
                            'class' => implode(' ', $class),
                            'id' => $ID
                        ],
                        $attributes
                    ));
                } elseif ($input['type'] == Type::CHECKBOX) {
                    $options = isset($input['options']) ? (
                        is_callable($input['options']) ? $input['options']() : $input['options']
                    ) : [];

                    $column = isset($input['column']) ? $input['column'] : 1;

                    $columnCount = 1;
                    foreach ($options as $code => $name) {
                        $columnClass = [];
                        if ($column > 1) {
                            $columnDiv = 12 / $column;
                            $columnClass[] = "cl-md-{$columnDiv}";
                        }
                    }
                }

                $view .= "</div>";
            }
        }

        $view .= form_close();

        return $view;
    }

    use \CI4Xpander\View\ComponentFactoryTrait;
}
