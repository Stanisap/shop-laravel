<?php


namespace App\Models\Traits;


use Illuminate\Support\Facades\App;
use LogicException;

trait Translatable
{
    protected $_RU = 'ru';

    public function __($originFieldName)
    {
        $locale = App::getLocale() ?? $this->_RU;
        if ($locale === 'en') {
            $fieldName = $originFieldName . '_en';
        } else {
            $fieldName = $originFieldName;
        }

        $attributes = array_keys($this->attributes);

        if (!in_array($fieldName, $attributes)) {
            throw new LogicException('No such attributes for model ' . get_class($this));
        }

        if ($locale === 'en' && (is_null($this->$fieldName) || empty($this->$fieldName))) {
            return $this->$originFieldName;
        }

        return $this->$fieldName;

    }
}