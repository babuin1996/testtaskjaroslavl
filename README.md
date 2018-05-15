# Решение тестового задания для 3DaVinci

Проект разработал с использованием среды разработки NetBeans.
Использовал OS Windows 10

Инструкция по запуску: 

1) Создать базу данных jaroslavltesttask, либо с другим названием, но тогда нужно будет прописать имя новой базы данных в файле 'Config/settings.config.php'. Далее выполнить запрос:

CREATE TABLE `user` (
  `github_id` int(11) UNSIGNED NOT NULL,
  `github_login` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `user`
  ADD PRIMARY KEY (`github_id`),
  ADD UNIQUE KEY `github_id` (`github_id`),
  ADD UNIQUE KEY `github_login` (`github_login`);
COMMIT;

дамп находится в файле 'user.sql'

Условиями задачи не был указан конкретный способ решения проблемы с дубликатами и я выбрал использование уникальных полей в БД. Также это можно решить средствами PHP, но я выбрал такой способ.

2) Запустить 'getrows.bat'

3) Увидеть полученные данные с 'https://api.github.com/users'

4) Запустить ещё раз и убедиться, что дубликаты не создаются

5) Изменить логин у какой нибудь строки с помощью phpMyAdmin или другого средства

6) Запускаем снова 'getrows.bat', проверяем нашу таблицу и видим, что строки, в которых мы изменили логин вернули свои первоначальные значения. 

Если с API получим новые логины с прежними id, то данные в таблице обновятся и там будут новые логины.

Файлы:

'Config/settings.config.php' - конфигурация БД
'getrows.bat' - пакетный файл Windows, запускающий PHP скрипт
'results.php' - сам скрипт
'Controllers/DBController.php' - контроллер, обеспечивающий соединение с БД
'Controllers/InsertionController.php' - контроллер, обеспечивающий приём данных и запись в БД, в нём содержится логика.

Ссылка на тестовое задание https://github.com/3DaVinci/php-developer-test
