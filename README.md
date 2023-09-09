### Payroll Case Study
The application inside this repo was inspired in Robert C. Martin 
"Agile Software Development, Principles, Patterns, and Practices" book, 
more especificly, the payroll case study mentioned in several chapters.

My main idea about develop this is to practice some of the principles 
and patterns, aditionaly learn some features of symfony.

---
### Steps to get setup and running
1. Start the container
```bash
docker compose up -d
```
2. Install the project dependencies with composer
```bash
docker compose exec php composer install
```
3. Run the migrations
```bash
docker compose exec php bin/console doctrine:migrations:migrate
# in both, default environment and test environment
docker compose exec php bin/console doctrine:migrations:migrate --env test
```
4. Now you can run the test to verify all is setup
```bash
docker compose exec php bin/phpunit
```