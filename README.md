# persiansit

## Yii2 persian number helper.

A Persian Yii2 component to help work with Persian digits and mobile numbers.

#### Install from composer
```$xslt
composer require madensit/persiansit-yii
```
Or add
```$xslt
"madensit/persiansit-yii": "*"
```
To you composer.json file.

#### Usage
Add following code to your configuration file (main.php (or main-local.php)) "components" section:
```php
'persiansit' => [
    'class' => 'madensit\persiansit\Persiansit'
]
```

To convert all english digits in a string to persian digits use:
```php
/** @var $persiansit madensit\persiansit\Persiansit */
$persiansit = Yii::$app->persiansit;
$persiansit->toPrDigit($number);
```

To convert all persian and arabic digits in a string to english digits use:
```php
/** @var $persiansit madensit\persiansit\Persiansit */
$persiansit = Yii::$app->persiansit;
$persiansit->toEnDigit($number);
```

To convert all english digits in a string to persian digits and get in number format (separated with ",") use:
```php
/** @var $persiansit madensit\persiansit\Persiansit */
$persiansit = Yii::$app->persiansit;
$persiansit->ToPrDigitWithNumberFormat($number);
```

To check if a mobile number is in international format (start with +98 or 98) use:
```php
/** @var $persiansit madensit\persiansit\Persiansit */
$persiansit = Yii::$app->persiansit;
$persiansit->isInternationalMobileNumber($mobileNumber);
```

To convert a mobile number to international format (start with +98 or 98) use :
```php
/** @var $persiansit madensit\persiansit\Persiansit */
$persiansit = Yii::$app->persiansit;
$persiansit->toInternationalMobileNumber($mobileNumber);
```

To convert a mobile number to common format (start with 09) use :
```php
/** @var $persiansit madensit\persiansit\Persiansit */
$persiansit = Yii::$app->persiansit;
$persiansit->toCommonFormat($mobileNumber);
```

To make a mobile number obfuscate (09123456***) use :
```php
/** @var $persiansit madensit\persiansit\Persiansit */
$persiansit = Yii::$app->persiansit;
$persiansit->toObfuscateFormat($mobileNumber);
```