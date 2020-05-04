# Elements Local Environment

Docker, motherfucker, do you use it ?!

Инфраструктуру описывает docker-compose.yml Раздел services задает набор
служб, из которых должно состоять окружение проекта. Конфиги для них удобно хранить на хост машине и пробрасывать внутрь создаваемых 
контейнеров.

## Зависимости

* docker
* docker-compose
* make

## Обычный ежедневный WorkFlow:
После перезагрузки компьютера для запуска контейнеров достаточно запустить команду 

    make start 

Далее можно работать - в проекте меняем код и он сразу доступен для проверки/тестирования.

## Make
Основные команды для работы с окружением.
Для начала нужно создать Makefile из шаблона Makefile-template. 
Полный список команд можно посмотреть в консоли: `make <tab>`.
Команды можно комбинировать. Например, 

    make start stop ps

make -n command - покажет текст команды без выполнения (dry run)

Текущий список команд:

    add-hosts                 deploy-dev                php-env-check             ssh-clickhouse-client     ssh-mariadb-bash          stop
    composer-autoload         down                      ps                        ssh-clickhouse-client-db  ssh-php                   up
    composer-install          down-with-data-drop       rebuild-hard              ssh-mariadb-as-elements   ssh-redis                 
    composer-update           init-databases            ssh-clickhouse-bash       ssh-mariadb-as-root       start 

# Создание окружения - первый запуск

* создаем конфиг приложения `config/config.php` из шаблона `config/config_template.php`
* создаем файл `config/environment` - с содержимым: `DEV`
* создаем конфиги для тестового фреймворка апи `env/api-tester/config/projects/elements.php` & `env/api-tester/config/config.php`
* создаем `env/Makefile` из шаблона `env/Makefile-template`
* добавляем тестовые хосты `make add-hosts` (через sudo)
* поднимаем связку контейнеров `make up`
* инициализируем базы данных и накатываем миграции `make init-databases`
* для проверки запускаем `make ps` и/или `make php-env-check`

Если что-то пошло не так, можно попробовать все разломать и собрать заново `make rebuild-hard`

## Файловая структура

* api-tester - фреймворк для тестов апи, доступен по адресу `http://test.loc`
* env/data - разное говно - логи, кеш композера
* docker - докерфайлы и все что еще может касаться докера
* init - bash-скрипты для старта окружения
* local - содержимое в гитигноре; сюда можно свалить всякое нужное лично вам, но не нужное в репе
* server-config - тут все должно быть понятно