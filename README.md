# Read Time

[![Latest Version on Packagist](https://img.shields.io/packagist/v/pownall/read-time.svg?style=flat-square)](https://packagist.org/packages/pownall/read-time)
[![Tests](https://github.com/leepownall/read-time/actions/workflows/run-tests.yml/badge.svg?branch=main&style=flat-square)](https://github.com/leepownall/read-time/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/pownall/read-time.svg?style=flat-square)](https://packagist.org/packages/pownall/read-time)

Simple package for displaying read time.

## Installation

You can install the package via composer:

```bash
composer require leepownall/read-time
```

## Usage

### Using `get()`

```php
$readTime = new Pownall\ReadTime\ReadTime('Hello, world!');

$readTime->get();
```

### Using `__toString()`

```php
$readTime = new Pownall\ReadTime\ReadTime('Hello, world!');

echo $readTime;
```

### Using blade directive

```php
@readtime('Hello, world!')
```

### Pass in `wordsPerMinute`

```php
$readTime = new Pownall\ReadTime\ReadTime('Hello, world!', 300);
```

```php
@readtime('Hello, world!', 300)
```

## Output

It uses Carbon under the good, specifically `forHumans` on the `CarbonInterval`.

The output looks like

```php
2 hours 4 minutes
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Lee Pownall](https://github.com/leepownall)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
