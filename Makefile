install-pnpm:
	@echo 'La commande « corepack enable » a besoin des droits Administrateur sur Windows.'
	npm install --global corepack@latest
	corepack enable pnpm
	corepack use pnpm@latest-10

phpstan:
	symfony php ./vendor/bin/phpstan analyse -c config/checkers/phpstan.neon

php-cs-fixer:
	symfony php ./vendor/bin/php-cs-fixer fix --config=config/checkers/.php-cs-fixer.dist.php --cache-file=var/php_cs.cache

start: symfony-start vite

symfony-start:
	symfony server:start -d

vite:
	pnpm run dev

stop:
	symfony server:stop

install:
	symfony composer install
	pnpm install

outdated:
	symfony composer outdated --direct
	pnpm outdated

upgrade:
	symfony composer update
	pnpm update

tests:
	symfony php vendor/bin/phpunit -c config/tests/phpunit.xml.dist
