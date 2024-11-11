deploy-project-first-time: ## Run composer install, migrations and seeders
	docker exec -it -u www-data bwltd_php composer install
	docker exec -it -u www-data bwltd_php php artisan migrate
	docker exec -it -u www-data bwltd_php php artisan db:seed
	docker exec -it -u www-data bwltd_php php artisan l5-swagger:generate
