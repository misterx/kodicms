# [KodiCMS](http://www.kodicms.ru/)

KodiCMS основана на базе [Kohana framework](http://kohanaframework.org/). Kohana - 
фреймворк для создания web приложений. Вы можете создавать собственные модули, 
плагины в полном объеме используя инструменты Kohana.

В качестве шаблона Backend интерфейса используется [Twitter Bootstrap](http://twitter.github.com/bootstrap/),
который позволит вам не тратить много времени на разработку шаблонов для новых
разделов.

## Требования

* Apache server with .htaccess.
* PHP 5.3.3 (или более новая)
* MySQL (и доступ к управлению данными)

## Установка
1. Создайте клон репозитория `https://github.com/butschster/kodicms.git` или 
[скачайте zip архив](https://github.com/butschster/kodicms/zipball/master)
с последней версией.

2. Разместите файлы на вашем web-сервере.

> При установке сайта не в корневую директорию, необходимо в двух местах внести изменеия.
> В файлах:
> * `.htaccess => RewriteBase /subfolder/`
> * `cms\app\bootstrap.php` => `Kohana::init( array( 'base_url' => '/subfolder/', ... ) );`

3. Откройте главную страницу через браузер. Запустится процесс интсалляции системы. 
4. Заполните все необходимые поля и нажмите кнопку "Установить". 
5. После установки системы вы окажетесь на странице авторизации, где будет 
указан ваш логин и пароль для входа в систему.


## Bug tracker

Если у вас возникли проблемы во время использования CMS, сообщайте их на наш
баг трекер.

https://github.com/butschster/kodicms/issues

## Copyright and license

Copyright 2012 Buchnev Pavel <butschster@gmail.com>.

---

KodiCMS is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

KodiCMS is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with KodiCMS.  If not, see <http://www.gnu.org/licenses/>.

KodiCMS has made an exception to the GNU General Public License for plugins.
See exception.txt for details and the full text.