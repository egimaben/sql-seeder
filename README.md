# sql_seeder

## Install

Create a project directory:
``` bash
$ mkdir myseeder && cd myseeder
```
Create your composer.json file
``` bash
vim composer.json
```
Add the following content

``` json
{
	"name":"myseeder/test",
		"description":"testing client for egimaben/sql_seeder",
		"license":"proprietary",
		"repositories": [
		{
			"type": "package",
			"package": {
				"name": "egimaben/sql_seeder",
				"version": "1.1-dev",
				"source": {
					"url": "git://github.com/egimaben/sql_seeder.git",
					"type": "git",
					"reference": "master"
				},
				"bin": ["seed"],
				"autoload": {
					"psr-4" : {
						"egimaben\\sql_seeder\\" : "src"
					}
				}
			}
		}
		],
		"require":{
			"egimaben/sql_seeder":"1.1-dev",
			"fzaninotto/faker": "^1.8"
		}
}
```
If you are installing `egimaben\sql_seeder` to use in an existing project, then just add the entry in the `repositories` array as well as the `require` entry.
Complete the installation by running
``` bash
$ composer install
```

## Usage

``` bash
composer seed $host $user $password $database '[$numRecords]' '[[table1,table2,table3...]]' 
```
Alternatively
``` bash
./vendor/bin/seed $host $user $password $database '[$numRecords]' '[[table1,table2,table3...]]
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

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
