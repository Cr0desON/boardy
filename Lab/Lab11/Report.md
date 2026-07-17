![01-no-token.png](screenshots/01-no-token.png)
![02-me-php.png](screenshots/02-me-php.png)
![03-console-jwt.png](screenshots/03-console-jwt.png)
![04-bearer-header.png](screenshots/04-bearer-header.png)
![05-comment-created.png](screenshots/05-comment-created.png)
![06-jwt-io.png](screenshots/06-jwt-io.png)
![07-expired.png](screenshots/07-expired.png)
![08-invalid.png](screenshots/08-invalid.png)
![09-github-app.png](screenshots/09-github-app.png)
![10-describe.png](screenshots/10-describe.png)
![11-login-button.png](screenshots/11-login-button.png)
![12-github-authorize.png](screenshots/12-github-authorize.png)
![13-oauth-logged.png](screenshots/13-oauth-logged.png)
![14-github-user.png](screenshots/14-github-user.png)
![15-oauth-comment.png](screenshots/15-oauth-comment.png)
![16-three-users.png](screenshots/16-three-users.png)

| Вопрос                      | Куки+сессии | JWT                | OAuth                      |
|-----------------------------|-------------|--------------------|----------------------------|
| Где хранятся данные?        | На сервере  | Внутри токена      | У провайдера               |
| Кто прикрепляет к запросу?  | Браузер     | Клиент             | Браузер один раз при входе |
| Для какого типа клиентов?   | Браузер     | Любой клиент       | Веб и мобильные приложения |
| Можно ли отозвать?          | Да          | Можно, но доп. код | Можно у провайдера         |
| Кросс-доменно работает?     | Нет         | Да                 | Да                         |
