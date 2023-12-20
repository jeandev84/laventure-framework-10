### PHP Stan
- https://phpstan.org/user-guide/getting-started
```bash
$ composer require --dev phpstan/phpstan
$ vendor/bin/phpstan analyse src tests
```

### PHP CodeSniffer
- https://github.com/squizlabs/PHP_CodeSniffer
```bash
$ composer require "squizlabs/php_codesniffer=*"
$ composer global require "squizlabs/php_codesniffer=*"
```

### PHP Code Fixer 
- https://github.com/PHP-CS-Fixer/PHP-CS-Fixer
```bash
mkdir -p tools/php-cs-fixer
composer require --working-dir=tools/php-cs-fixer friendsofphp/php-cs-fixer

or 
composer require --dev friendsofphp/php-cs-fixer

Usage:
tools/php-cs-fixer/vendor/bin/php-cs-fixer fix src
```



### PHPUnit
```
./vendor/bin/phpunit tests/phpunit/Component/Routing/RouterTest.php
```