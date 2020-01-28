Laximo API PHP Library
======================
[![Build Status](https://travis-ci.org/shude/laximo.svg?branch=master)](https://travis-ci.org/shude/laximo) 
[![Latest Stable Version](https://poser.pugx.org/shude/laximo/v/stable)](https://packagist.org/packages/shude/laximo)
[![Total Downloads](https://poser.pugx.org/shude/laximo/downloads)](https://packagist.org/packages/shude/laximo)
[![License](https://poser.pugx.org/shude/laximo/license)](https://packagist.org/packages/shude/laximo)
[![Latest Unstable Version](https://poser.pugx.org/shude/laximo/v/unstable)](https://packagist.org/packages/shude/laximo)

 Библиотека для работы с API сервиса [LaximoOEM](https://laximo.ru/oem/)
 
 ## Установка
 С помощью composer:
 ```
composer require shude/laximo
```
или добавить вручную в файл composer.json
```json
{
    "require": {
        "shude/laximo": "1.0.*"
    }
}
```

## Пример использования
```php

$credentials = new BasicCredentials('<your_login>', '<your_password>');
$client      = new SoapClient($credentials);
$laximo      = new Laximo($client, new QueryBuilder());

$laximo->addFindVehicle('KMHVD34N8VU263043');
$result = $laximo->execute();

var_dump($result[0]); // VehicleListObject
```

Подробное описание методов можно посмотреть в [оригинальной документации](http://wiki.technologytrade.ru/index.php/%D0%97%D0%B0%D0%B3%D0%BB%D0%B0%D0%B2%D0%BD%D0%B0%D1%8F_%D1%81%D1%82%D1%80%D0%B0%D0%BD%D0%B8%D1%86%D0%B0).
