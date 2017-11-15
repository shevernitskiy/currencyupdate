<?php

/**
 * Класс обновления валют в БД через CLI
 */

class shopCurrencyupdateCli extends waCliController
{
    protected $url = 'http://www.cbr.ru/scripts/XML_daily.asp';

    public function execute()
    {
        $ar = $this->getRates();
        $model = new cuWriteModel();
        $model->saveToTable($ar);
    }
    
    public function getRates()
    {
        $obj = simplexml_load_file($this->url);
        $array = array(
            'date' => (string)$obj->attributes()['Date']
        );
        foreach ($obj->Valute as $key => $currency) {
            $array += array((string)$currency->CharCode => (str_replace(",", ".", (string)$currency->Value) /  (string)$currency->Nominal));
        }
        return $array;
    }
}

class cuWriteModel extends waModel
{
    protected $table = 'shop_currency';

    public function saveToTable($array)
    {
        foreach ($array as $key => $value) {
            $this->updateByField('code', $key, array('rate' => $value));
        }
    }
}
