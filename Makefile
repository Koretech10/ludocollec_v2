phpstan:
	symfony php ./vendor/bin/phpstan analyse -c config/checkers/phpstan.neon

php-cs-fixer:
	symfony php ./vendor/bin/php-cs-fixer fix --config=config/checkers/.php-cs-fixer.dist.php --cache-file=var/php_cs.cache
