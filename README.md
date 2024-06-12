# Тестовое задание для Flowwow (бэкенд)

Компонент, получающий данные с openexchangerates.org.

Требуется PHP версии 8.2

Чтобы запустить:
1. Установить зависимости `composer install`
2. Зарегистрироваться на https://openexchangerates.org/signup/free и получить ключ API
3. Скопировать файл .env.example в .env и заменить в нём значение OPENEXCHANGERATES_API_KEY на реальный полученный ключ API

Пример использования компонента лежит в index.php, проверить можно с помощью `php index.php`

Запустить тесты можно с помощью `./vendor/bin/phpunit tests`
