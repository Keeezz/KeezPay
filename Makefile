.PHONY: phpstan tests

DISABLE_XDEBUG=XDEBUG_MODE=off

install:
	composer install

phpstan:
	$(DISABLE_XDEBUG) php vendor/bin/phpstan analyse -c phpstan.neon

tests:
	php vendor/bin/phpunit-watcher watch