compose_file := "docker-compose.yml"
php_service := "php"

.PHONY: artisan

up:
	@docker-compose -f $(compose_file) up -d

ccc:
	@docker-compose -f $(compose_file) exec $(php_service) sh -c "composer $(CMD)"

mysql:
	@docker-compose -f $(compose_file) exec $(php_service) sh -c "mysql -u root -psecret -h db $(CMD)"

doctrine:
	@docker-compose -f $(compose_file) exec $(php_service) sh -c "php doctrine.php $(CMD)"

fix:
	@docker-compose -f $(compose_file) exec $(php_service) sh -c "php-cs-fixer fix $(CMD)"

freshdb:
	@docker-compose -f $(compose_file) exec $(php_service) sh -c "php doctrine.php migrate first"
	@docker-compose -f $(compose_file) exec $(php_service) sh -c "php doctrine.php migrate"

phinx:
	@docker-compose -f $(compose_file) exec $(php_service) sh -c "composer phinx $(CMD)"

tt:
	@docker-compose -f $(compose_file) exec $(php_service) sh -c "composer test $(CMD)"

ttc:
	@docker-compose -f $(compose_file) exec $(php_service) sh -c "composer test -- --coverage-html .coverage $(CMD)"
	@chromium ".coverage/index.html"

ttcn:
	@docker-compose -f $(compose_file) exec $(php_service) sh -c "composer test -- --coverage-html .coverage $(CMD)"

artisan:
	@docker-compose -f $(compose_file) exec $(php_service) sh -c "php artisan $(CMD)"

p:
	@docker-compose -f $(compose_file) exec $(php_service) sh -c "php $(CMD)"
