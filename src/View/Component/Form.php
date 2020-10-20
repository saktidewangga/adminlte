<?php namespace CI4Xpander_AdminLTE\View\Component;

use CI4Xpander_AdminLTE\View\Component\Form\Type;
use DateTime;
use Stringy\StaticStringy;

class Form extends \CI4Xpander\View\Component
{
    protected $_name = 'Form';

    public $action = '';
    public $method = 'POST';
    public $input = [];
    public $hidden = [];
    public $request;
    public $validator;
    public $script;
    public $isMultipart = false;

    protected function _init()
    {
        helper('form');
        parent::_init();
    }

    public static function getInputID($name = '', $input = '')
    {
        return ucfirst($input['type']) . str_replace([
            '[', ']'
        ], '', ucfirst($name));
    }

    public function render()
    {
        if ($this->isMultipart) {
            $view = form_open_multipart($this->action ?: uri_string(), [
                'role' => 'form',
                'autocomplete' => 'off'
            ], $this->hidden);
        } else {
            $view = form_open($this->action ?: uri_string(), [
                'role' => 'form',
                'autocomplete' => 'off'
            ], $this->hidden);
        }

        if ($this->method == 'GET') {
            $method = 'Get';
        } else {
            $method = 'Post';
            $view .= form_hidden('_method', $this->method);
        }

        foreach ($this->input as $name => $input) {
            if (is_array($input) && array_key_exists('type', $input)) {
                $ID = self::getInputID($name, $input);

                $containerAttr = $input['containerAttr'] ?? [];

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

                if (isset($input['containerClass'])) {
                    $containerClass += array_merge($containerClass, $input['containerClass']);
                }

                $containerClass = implode(' ', $containerClass);

                $attr = [];
                foreach ($containerAttr as $attrName => $attrValue) {
                    $attr[] = $attrName . '="' . $attrValue . '"';
                }
                $attr = implode(' ', $attr);

                $view .= "<div id=\"{$ID}_container\" class=\"{$containerClass}\" {$attr}>";

                $label = '';
                if (isset($input['label'])) {
                    $label = $input['label'];
                } else {
                    $label = StaticStringy::toTitleCase(str_replace('_', ' ', $name));
                }

                if (in_array($input['type'], [
                    Type::TEXT, Type::EMAIL, Type::PASSWORD, Type::DROPDOWN_AUTOCOMPLETE, Type::CHECKBOX, Type::CHECKBOX_SINGLE, Type::RADIO, Type::DATE, Type::DATE_RANGE, Type::TEXT_AREA, Type::WYSIWYG, Type::SLIDER, Type::SLIDER_RANGE, Type::TIME, Type::FILE
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
                    Type::SELECT, Type::DROPDOWN_AUTOCOMPLETE, Type::DROPDOWN
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
                    if (isset($input['button'])) {
                        $view .= '<div class="input-group">';
                    }

                    $view .= form_input($name, $value, array_merge(
                        $disabled,
                        [
                            'class' => 'form-control',
                            'id' => $ID,
                            'autocomplete' => 'off'
                        ]
                    ), $input['type']);

                    if (isset($input['button'])) {
                        $inputButtonClass = $input['button']['class'] ?? 'primary';
                        $view .= '<span class="input-group-btn"><button type="button" class="btn btn-' . $inputButtonClass . '">' . $input['button']['label'] . '</button></span></div>';
                    }
                } elseif ($input['type'] == Type::FILE) {
                    $view .= form_upload($name, $value, array_merge(
                        $disabled,
                        [
                            'class' => 'form-control',
                            'id' => $ID,
                            'autocomplete' => 'off'
                        ]
                    ));
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
                        \Config\Services::viewScript()->add(view('CI4Xpander_AdminLTE\Views\Script\AutocompleteDropdown', array_merge(
                            [
                                'id' => $ID,
                                'options' => $options
                            ],
                            isset($input['ajax']) ? [
                                'ajax' => $input['ajax']
                            ] : [],
                            isset($input['allowCreateNew']) ? (
                                $input['allowCreateNew'] ? [
                                    'isTags' => true
                                ] : []
                            ) : [],
                            isset($input['multipleValue']) ? (
                                $input['multipleValue'] ? [
                                    'isMultiple' => true
                                ] : []
                            ) : []
                        ), [
                            'saveData' => false
                        ]));
                    }

                    $isMultiple = $input['multipleValue'] ?? false;

                    if ($isMultiple) {
                        if (!is_array($value)) {
                            $value = [
                                $value
                            ];
                        }

                        $view .= form_multiselect($name, $options, $value, array_merge(
                            $disabled,
                            [
                                'class' => implode(' ', $class),
                                'id' => $ID
                            ],
                            $attributes
                        ));
                    } else {
                        $view .= form_dropdown($name, $options, $value, array_merge(
                            $disabled,
                            [
                                'class' => implode(' ', $class),
                                'id' => $ID
                            ],
                            $attributes
                        ));
                    }
                } elseif ($input['type'] == Type::CHECKBOX) {
                    $options = isset($input['options']) ? (
                        is_callable($input['options']) ? $input['options']() : $input['options']
                    ) : [];

                    $column = isset($input['column']) ? $input['column'] : 1;

                    $columnCount = 0;
                    foreach ($options as $code => $optionLabel) {
                        $columnCount++;
                        $columnClass = [];
                        if ($column > 1) {
                            $columnDiv = 12 / $column;
                            $columnClass[] = "col-md-{$columnDiv}";

                            if ($columnCount == 1) {
                                $view .= "<div class=\"row\">";
                            }
                        }

                        $view .= '<div class="checkbox ' . implode(' ', $columnClass) . '"><label>' . form_checkbox($name . '[]', $code, false, array_merge([
                            'id' => $ID . ucfirst($code)
                        ], $disabled)) . $optionLabel . '</label></div>';

                        if ($column > 1) {
                            if ($columnCount == $column) {
                                $view .= '</div>';
                                $columnCount = 0;
                            }
                        }
                    }

                    if ($columnCount > 0) {
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

                    \Config\Services::viewScript()->add(view('CI4Xpander_AdminLTE\Views\Script\\' . ($input['type'] == Type::DATE ? 'DatePicker' : 'DateRangePicker'), [
                        'id' => $ID,
                    ], [
                        'saveData' => false
                    ]));
                } elseif ($input['type'] == Type::TIME) {
                    \Config\Services::viewScript()->add(view('CI4Xpander_AdminLTE\Views\Script\TimePicker', [
                        'id' => $ID
                    ], [
                        'saveData' => false
                    ]));

                    $view .= '<div class="input-group">';

                    $view .= form_input($name, $value, array_merge(
                        $disabled,
                        [
                            'class' => 'form-control',
                            'id' => $ID,
                            'autocomplete' => 'off'
                        ]
                    ), 'text');

                    $view .= '<div class="input-group-addon"><i class="fa fa-clock-o"></i></div></div>';
                } elseif (in_array($input['type'], [
                    Type::TEXT_AREA, Type::WYSIWYG
                ])) {
                    if ($input['type'] == Type::WYSIWYG) {
                        \Config\Services::viewScript()->add(view('CI4Xpander_AdminLTE\Views\Script\WYSIWYG', [
                            'id' => $ID,
                        ], [
                            'saveData' => false
                        ]));
                    }

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
                } elseif ($input['type'] == Type::BUTTON) {
                    $view .= form_button($name, $label, array_merge(
                        [
                            'class' => 'btn btn-primary',
                            'id' => $ID,
                        ],
                        $disabled
                    ));
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
                        if (isset($button['label'])) {
                            $buttonText = $button['label'];
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

        if (isset($this->script)) {
            foreach ($this->script as $script) {
                \Config\Services::viewScript()->add(view($script['file'], $script['data'] ?? []));
            }
        }

        return $view;
    }

    use \CI4Xpander\View\ComponentFactoryTrait;
}
