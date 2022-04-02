# ReadJson

[![Latest Version](https://img.shields.io/github/release/victorap93/readjson.svg?style=flat-square)](https://github.com/victorap93/readjson/releases)
[![Total Downloads](https://img.shields.io/packagist/dt/victorap93/readjson.svg?style=flat-square)](https://packagist.org/packages/victorap93/readjson)

PowerBIEmbedded was created to facilitate the obtention of the necessary token to build its interface.


## Installing ReadJson

The recommended way to install this is through
[Composer](https://getcomposer.org/).

```bash
composer require victorap93/readjson
```


## How to use ReadJson

Assuming you have a *.json* file `./readjson/stores.json` with the following content.
```json 
{
    "stores": [
        {
            "name": "store one",
            "products": [
                {
                    "name": "product one",
                    "amount": 10
                },
                {
                    "name": "product two",
                    "amount": 20
                }
            ]
        },
        {
            "name": "store two",
            "products": [
                {
                    "name": "product two",
                    "amount": 22
                },
                {
                    "name": "product three",
                    "amount": 33
                }
            ]
        }
    ]
}
```

And this *.php* in the same folder `./readjson/index.php`, the example below show different ways to acess *.json* file.
```php
use \victorap93\ReadJson;

$json_path = "./stores.json";

// Get all json content.
$ReadJson = new ReadJson($json_path);
$json_object_value1 = $ReadJson->getJsonObject();

// Accessing the obtained object.
$json_object_value2 = $json_object_value1->stores[0]->products;

// Get a specified json content position in instance of class.
$ReadJson = new ReadJson($json_path, ['stores', 0, 'products']);
$json_object_value3 = $ReadJson->getJsonObject();

// Get a specified json content position in method call.
$ReadJson = new ReadJson($json_path, ['stores', 0]);
$json_object_value4 = $ReadJson->getJsonObject(['products']);

// Get a specified json content position with object.
$json_object_value5 = $ReadJson->accessRecursiveKeys($json_object_value4, [0, 'name']);
```


## Help and docs

- [JSON](https://www.json.org/json-en.html)


## License

PowerBIEmbedded is made available under the MIT License (MIT). Please see [License File](LICENSE) for more information.
