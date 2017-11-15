<?php

/**
 * Основной класс выполняет обновление валют в БД
 */

class shopCurrencyupdatePlugin extends shopPlugin
{
    public $url = 'http://www.cbr.ru/scripts/XML_daily.asp';

    public function saveSettings($settings = array())
    {
        $ar = $this->getRates();
        $model = new shopCurrencyupdateModel();
        $model->saveToTable($ar);
        $settings['date'] = $ar['date'];
        parent::saveSettings($settings);
        $response = array();
        foreach ($ar as $key => $value) {
            $response[$key] = $value;
        }
        return $response;
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
