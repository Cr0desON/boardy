![01-composer-php.png](screenshots/01-composer-php.png)
![02-folders.png](screenshots/02-folders.png)
![03-laravel-version.png](screenshots/03-laravel-version.png)

Одной фразой назначение пяти папок:  app/, routes/, resources/views/, database/, public/?
-app/ - само приложение 
-routes/ - маршруты url 
-resources/views/ - шаблоны
-database/ - связь с бд
-public/ - файлы проекта

Почему document_root nginx должен указывать на public/?
-Там находятся файлы, которые нужно отображать, в том числе index.php. В общей папке находятся конфигурационные файлы, которые браузеру не нужно открывать

![04-nginx-config.png](screenshots/04-nginx-config.png)
![05-laravel-welcome.png](screenshots/05-laravel-welcome.png)
![06-databases.png](screenshots/06-databases.png)
![07-tinker-pdo.png](screenshots/07-tinker-pdo.png)
![08-migrate-status.png](screenshots/08-migrate-status.png)
![09-show-tables.png](screenshots/09-show-tables.png)
![10-model-relations.png](screenshots/10-model-relations.png)
![11-seed-counts.png](screenshots/11-seed-counts.png)
![12-route-list.png](screenshots/12-route-list.png)
![13-posts-index.png](screenshots/13-posts-index.png)
![14-post-show.png](screenshots/14-post-show.png)
![15-post-create.png](screenshots/15-post-create.png)
![16-post-after-create.png](screenshots/16-post-after-create.png)
![17-edit-own.png](screenshots/17-edit-own.png)
![18-edit-foreign-403.png](screenshots/18-edit-foreign-403.png)
![19-post-deleted.png](screenshots/19-post-deleted.png)
![20-comment-created.png](screenshots/20-comment-created.png)
![21-register.png](screenshots/21-register.png)
![22-login.png](screenshots/22-login.png)
![23-after-register.png](screenshots/23-after-register.png)
![24-github-app.png](screenshots/24-github-app.png)
![25-login-with-github.png](screenshots/25-login-with-github.png)
![26-github-authorize.png](screenshots/26-github-authorize.png)
![27-after-github-login.png](screenshots/27-after-github-login.png)
![28-mysql-github-id.png](screenshots/28-mysql-github-id.png)