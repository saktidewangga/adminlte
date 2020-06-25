<?php namespace CI4Xpander_AdminLTE\View\Component;

use CI4Xpander_AdminLTE\View\Component\Form\Type;
use DateTime;
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
                            $columnClass[] = "col-md-{$columnDiv}";

                            if ($columnCount == 1) {
                                $view .= "<div class=\"row\">";
                            }
                        }

                        $view .= '<div class="checkbox' . implode(' ', $columnClass) . '"><label>' . form_checkbox($name . '[]', $code, false, array_merge([
                            'id' => $ID . ucfirst($code)
                        ], $disabled)) . $name . '</label></div>';

                        if ($column > 1) {
                            if ($columnCount == $column) {
                                $view .= '</div>';
                                $columnCount = 0;
                            }

                            $columnCount++;
                        }
                    }

                    if ($columnCount < $column) {
                        for ($i = $columnCount; $i <= $column; $i++) {
                            $view .= '<div class="col-md-' . (12 / $column) . '"></div>';
                        }
                        $view .= '</div>';
                    }
                } elseif ($input['type'] == Type::CHECKBOX_SINGLE) {
                    $submittedCheck = false;
                    $singleCheckboxValue = isset($input['value']) ? $input['value'] : 'true';
                    if (isset($submittedValue)) {
                        if (!is_null($submittedValue)) {
                            if ($singleCheckboxValue == $submittedValue) {
                                $submittedCheck = true;
                            }
                        }
                    }

                    $view .= '<div class="checkbox"><label>' . form_checkbox($name, $singleCheckboxValue, isset($input['checked']) ? $input['checked'] : $submittedCheck, array_merge([
                        'id' => $ID
                    ], $disabled)) . '</label></div>';
                } elseif ($input['type'] == 'hidden') {
                    $view .= form_hidden($name, $value);
                } elseif ($input['type'] == Type::RADIO) {
                    if (isset($input['options'])) {
                        foreach ($input['options'] as $keyRadio => $valRadio) {
                            $selected = false;
                            if (isset($input['checked'])) {
                                $selected = $input['checked'] == $keyRadio;
                            } else {
                                if (isset($submittedValue)) {
                                    $selected = $submittedValue == $keyRadio;
                                } else {
                                    if (isset($input['default'])) {
                                        $selected = $input['default'] == $keyRadio;
                                    }
                                }
                            }

                            $view .= '<div class="radio"><label>';
                            $view .= form_radio($name, $keyRadio, $selected, array_merge(
                                $disabled,
                                [
                                    'id' => $ID . ucfirst(str_replace('-', '', $keyRadio))
                                ]
                            )) . $valRadio;
                            $view .= '</label></div>';
                        }
                    }
                } elseif (in_array($input['type'], [Type::DATE, Type::DATE_RANGE])) {
                    $view .= '<div class="input-group date"><div class="input-group-addon"><i class="fa fa-calendar"></i></div>';

                    if (is_object($value)) {
                        if ($value instanceof DateTime) {
                            $value = $value->format('Y-m-d');
                        }
                    }

                    $view .= form_input($name, $value, array_merge($disabled, [
                        'class' => 'form-control',
                        'id' => $ID,
                        'autocomplete' => 'off'
                    ]), 'text');
                    $view .= '</div>';
                } elseif (in_array($input['type'], [
                    Type::TEXT_AREA, Type::WYSIWYG
                ])) {
                    $view .= form_textarea($name, $value, array_merge(
                        [
                            'class' => 'form-control',
                            'id' => $ID,
                        ],
                        $disabled
                    ));
                } elseif ($input['type'] == Type::SEPARATOR) {
                    $view .= form_label('<u>' . $label . '</u>', '', [
                        'class' => 'control-label'
                    ]);
                } elseif ($input['type'] == Type::BUTTON_SUBMIT) {
                    $view .= form_submit($name, $label, array_merge(
                        [
                            'class' => 'btn btn-primary'
                        ],
                        $disabled
                    ));
                } elseif ($input['type'] == Type::BUTTON_GROUP) {
                    foreach ($input['buttons'] as $buttonName => $button) {
                        $buttonText = '';
                        if (isset($button['text'])) {
                            $buttonText = $button['text'];
                        } else {
                            $buttonText = StaticStringy::toTitleCase(str_replace('_', ' ', $buttonName));
                        }

                        if ($button['type'] == Type::BUTTON_SUBMIT) {
                            $view .= form_submit($buttonName, $buttonText, array_merge(
                                [
                                    'class' => 'btn btn-primary'
                                ],
                                $disabled
                            ));
                        } elseif ($button['type'] == Type::BUTTON_RESET) {
                            $view .= form_reset($buttonName, $buttonText, array_merge(
                                [
                                    'class' => 'btn btn-warning'
                                ],
                                $disabled
                            ));
                        } else {
                            $view .= form_button($buttonName, $buttonText, array_merge(
                                [
                                    'class' => 'btn btn-primary'
                                ],
                                $disabled
                            ));
                        }
                    }
                } elseif ($input['type'] == Type::PREDEFINED) {
                    $view = $input['value'];
                } elseif ($input['type'] == Type::SLIDER || $input['type'] == Type::SLIDER_RANGE) {
                    $min = $input['min'] ?? 0;
                    $max = $input['max'] ?? 100;
                    $step = $input['step'] ?? 1;

                    $matched = null;
                    if ($input['type'] == Type::SLIDER_RANGE) {
                        preg_match('/^\[\d+,\d+\]$/', $value, $matched);

                        if (count($matched) > 0) {
                            $value = $matched[0];
                        } else {
                            preg_match('/^\d+,\d+$/', $value, $matched);
                            if (count($matched) > 0) {
                                $value = '[' . $matched[0] . ']';
                            } else {
                                $value = '[' . strval($min) . ',' . strval($max) . ']';
                            }
                        }
                    } else {
                        if (empty($value)) {
                            $value = '0';
                        }
                    }

                    $view .= form_input($name, '', array_merge($disabled, [
                        'class' => 'slider form-control',
                        'id' => $ID,
                        'autocomplete' => 'off',
                        'data-slider-min' => strval($min),
                        'data-slider-max' => strval($max),
                        'data-slider-step' => strval($step),
                        'data-slider-value' => strval($value),
                        'data-slider-orientation' => 'horizontal',
                        'data-slider-id' => $ID,
                    ]), 'text');
                }

                if (isset($input['hint'])) {
                    $view .= '<span class="help-block"><i>' . $input['hint'] . '</i></span>';
                }

                $view .= "</div>";
            }
        }

        $view .= form_close();

        return $view;
    }

    use \CI4Xpander\View\ComponentFactoryTrait;
}
