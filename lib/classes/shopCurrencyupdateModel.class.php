<?php

/**
 * Класс для доступа к таблице с валютами
 */

class shopCurrencyupdateModel extends waModel
{
    protected $table = 'shop_currency';

    public function getCurArray()
    {
        $out = array();
        $in = $this->getAll();
        foreach ($in as $value) {
            $out += array($value['code'] => $value['rate']);
        }
        return $out;
    }

    public function saveToTable($array)
    {
        foreach ($array as $key => $value) {
            $this->updateByField('code', $key, array('rate' => $value));
        }
    }
}
