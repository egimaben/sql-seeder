# sql_seeder

## Structure

If any of the following are applicable to your project, then the directory structure should follow industry best practices by being named the following.

```
bin/        
config/
src/
tests/
vendor/
```


## Install

Via Composer

``` bash
$ composer require egimaben/sql_seeder
```

## Usage

``` php
$skeleton = new egimaben\sql_seeder();
echo $skeleton->echoPhrase('Hello, League!');
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CODE_OF_CONDUCT](CODE_OF_CONDUCT.md) for details.

## Security

If you discover any security related issues, please email egimaben@gmail.com instead of using the issue tracker.

## Credits

- [Benedict Egima][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/egimaben/sql_seeder.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/egimaben/sql_seeder/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/egimaben/sql_seeder.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/egimaben/sql_seeder.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/egimaben/sql_seeder.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/egimaben/sql_seeder
[link-travis]: https://travis-ci.org/egimaben/sql_seeder
[link-scrutinizer]: https://scrutinizer-ci.com/g/egimaben/sql_seeder/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/egimaben/sql_seeder
[link-downloads]: https://packagist.org/packages/egimaben/sql_seeder
[link-author]: https://github.com/egimaben
[link-contributors]: ../../contributors
