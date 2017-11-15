# Плагин обновления курса валют для Shop-Script 7

## Что может?
Плагин может брать актуальную информацию с сайт ЦБ о курсах валют по отношению к рублю и обновлять соответсвующую информацию в базе Shop-Script.

## Установка
- Скопировать содержимое репозитория в папку
```sh
[корень установки webasyst]/wa-apps/shop/plugins/currencyupdate/
```
## Использование
- Зайти в бэкэнд Shop-Script, далее в Плагины, далее в списке слева выбрать "Обновлятор три тыщи"
*При первом использовании информация, отображаемая плагином, скорее всего будет не совсем корректной*
- Нажать на огромную зеленую кнопку "Обновить", при этом актуальная информация запишется в БД и отобразится на странице настроек плагина
- Радоваться

## Настройка автоматического обновления
На странице настроек плагина отображается строка для добавления cronjob.
Сначала опробовать данную строку вручную, если работает - то добавлять уже крон джоб
*ЦБ обновляет актуальный курс где-то в середине дня по MSK, лучше добавить задачу на 1 час ночи ежедневно.*
Если по какой-то причине скрипт обновления через cli не исполняется (webasyst не видит скрипта), то необходимо скопировать файл **shopCurrencyupdate.cli.php** из папки плагина
```sh
[корень установки webasyst]/wa-apps/shop/plugins/currencyupdate/lib/cli/
```
в папку cli скриптов самого Shop-Script 
```sh
[корень установки webasyst]/wa-apps/shop/lib/cli/
```

## Вопросы
- Откуда и в каком формате берутся курсы?

Отсюда http://www.cbr.ru/scripts/XML_daily.asp в формате `xml`
- Какие валюты доступны для обновления?

Все, для которых ЦБ предостовляет рублевый курс, см. url выше
- Чот ничо не работает

Плагин стопроцентно корректно работает только если рубль назначен в качестве основной валюты
- Для какой версии шоп скрипта плагин?

Плагин писался на версии `7.2.17.165`, должен работать и на других, где архитектура и названия таблиц БД такие же. Единственная точка привязки плагина к струтуре Shop-Script это таблицы в БД


