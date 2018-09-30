install:
	cp .env.dist .env
	composer install
	#mkdir -p config/jwt
	#openssl genrsa -out config/jwt/private.pem -aes256 -passout pass:f9c543a0e2c5cb54130325422fd9fd5b 4096
	#openssl rsa -passin pass:f9c543a0e2c5cb54130325422fd9fd5b -pubout -in config/jwt/private.pem -out config/jwt/public.pem
	make rebuild
	#make routing
	#bin/console ckeditor:install

rebuild-db:
	php bin/console doctrine:database:drop --force --env=test --connection=default
	php bin/console doctrine:database:create --env=test --connection=default
	php bin/console doctrine:schema:create --env=test
	php bin/console doctrine:fixtures:load --env=test -n


rebuild:
	php bin/console doctrine:database:drop --force
	php bin/console doctrine:database:create
	php bin/console doctrine:schema:create -q
	#php bin/console doctrine:fixtures:load --no-interaction
	#make routing
	php bin/console cache:clear

routing:
	bin/console fos:js-routing:dump --format=js --target=public/js/fos_js_routes.js

updatedb:
	php bin/console doctrine:schema:update --force --dump-sql
