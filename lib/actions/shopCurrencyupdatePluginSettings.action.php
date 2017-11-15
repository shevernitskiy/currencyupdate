<?php

/**
 * Класс выполняет действие при отображении страницы настроек плагина в бэкэнде
 */

class shopCurrencyupdatePluginSettingsAction extends waViewAction
{

    public function execute()
    {
        $model = new shopCurrencyupdateModel();
        $response = $model->getCurArray();
        foreach ($response as $key => $currency) {
            if ($key != 'RUB') {
                $settings[$key] = round($currency, 4);
            }
        }
        $set_model = new waAppSettingsModel();
        $settings['date'] = $set_model->getByField(array('app_id' => 'shop.currencyupdate', 'name' => 'date'))['value'];
        $settings['cron'] = 'php '.wa()->getConfig()->getPath('root').DIRECTORY_SEPARATOR.'cli.php shop Currencyupdate';
        $view = wa()->getView();
        $view->assign('settings', $settings);
    }
}
