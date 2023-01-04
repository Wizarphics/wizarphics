<?php

/*
 * Copyright (c) 2022.
 * User: Fesdam
 * project: WizarFrameWork
 * Date Created: 15/11/22, 8:10 AM
 * Last Modified at: 15/11/22, 8:10 AM
 * Time: 8:10
 * @author Wizarphics <Wizarphics@gmail.com>
 *
 */

namespace wizarphics\wizarframework\helpers\form;

use wizarphics\wizarframework\Model;

class TextAreaField extends BaseField
{
    public Model $model;
    public string $attribute;

    /**
     * @param Model $model
     * @param string $attribute
     */
    public function __construct(Model $model, string $attribute, array $fieldAttributes = [])
    {
        parent::__construct($model, $attribute, $fieldAttributes);
        $class = $this->globalClass.' form-control';
        $this->globalClass = $class;
    }

    /**
     * @return string
     */
    public function renderInput(): string
    {
        return sprintf(
            '<textarea name="%s" class="%s %s" %s>%s</textarea>',
            $this->attribute,
            $this->globalClass,
            $this->model->hasError($this->attribute) ? 'is-invalid' : '',
            $this->fieldAttributes,
            $this->model->{$this->attribute},
        );
    }
}
