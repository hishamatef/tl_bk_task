# Troylab Bk task
## Installation
```
git clone https://github.com/hishamatef/tl_bk_task.git
cp .env.example .env
```
- Create troylab DB
- Update .env with your db and mail creditabilities
- then run the following commands
```
composer install
php artisan key:generate
php artisan migrate:fresh --seed
php artisan module:seed
php artisan test
```
- To run re-order COMMAND
```
php artisan students:reOrder
```
