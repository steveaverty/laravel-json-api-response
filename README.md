# This package allows you to send elegant json response from your Laravel api.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/hoostr/json-api-response.svg?style=flat-square)](https://packagist.org/packages/hoostr/json-api-response)
[![Total Downloads](https://img.shields.io/packagist/dt/hoostr/json-api-response.svg?style=flat-square)](https://packagist.org/packages/hoostr/json-api-response)
![GitHub Actions](https://github.com/hoostr/json-api-response/actions/workflows/main.yml/badge.svg)

This package allows you to send elegant json response from your Laravel api.

## Installation

You can install the package via composer:

```bash
composer require avertys/json-api-response
```

## Usage
### Successful response

```php
  return JsonApiResponse::make($data)
        ->withSuccess()
        ->send(200);
```

### Add additional data

```php
  return JsonApiResponse::make($data)
        ->withSuccess()
        ->withAdditionalData([
            'deprecated' => true
        ])
        ->send(200);
```

### Unsuccessful response

```php
  return JsonApiResponse::make()
        ->withErrors($validator->errors())
        ->withAdditionalData([
            'deprecated' => true
        ])
        ->send(200);
```

### Working with pagination

```php
  return JsonApiResponse::make(User::paginate(10))
        ->withSuccess()
        ->send(200);
```

### Response format

```json
{
    "success": true,
    "data": [
        "id": 1,
        "name": "John" 
    ],
    "errors": null,
    "additional_data": [
        "pagination": {
            "current_page": 2,
            "to": 5,
            "total": 100
        },
        "deprecated": false
    ]
}
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email hoostr.co@gmail.com instead of using the issue tracker.

## Credits

-   [Hoostr](https://github.com/hoostr)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
