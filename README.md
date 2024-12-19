### Первые шаги по разворачивания проекта с использованием Docker.
Создание сети для докера:
```
make network-create
```
___
Копируем подготовленное значения для необходимой работы бэкенда:
```
make copy-env
```
___
Поднятие контейнеров:
```
make up
```
___
Подтянуть зависимости библиотек из asset-package:
```
make composer install
```
___
Миграция таблиц в БД:
```
make migrate-up
```
___
### Тестирования приложения
Перед тестирования приложения обязательно стереть данные в БД.
```
make migrate-down
```
___
Миграция таблиц в БД:
```
make migrate-up
```
___
Наполнение тестовых данных в БД:
```
make fixture-up
```
___
Протестировать приложение:
```
make run-test
```
___
Показатель покрытия кода:
```
make run-test-coverage
```
Подробный результат тестирования кода можно найти здесь:
```
/src/tests/_output/coverage
```
___
