# LAGFSD (Laravel, Aspnet, Gin, Flask, Springboot, Django)

Services:
Altough services are designed to work with API Gateway and Django, they can be also run independently with their own UI.
```
Laravel     - Product       - 8001:80   - React/Bootstrap
ASPNET      - User          - 8002:80   -
Gin         - Payment       - 8003:80   -
Flask       - Announces     - 8004:5000 -
---
Springboot  - Gateway       - 8080:80   -
---
Django      - Pages         - 80:80     -
---
@db (5x)    - Mysql         - 3306:3306 -
@db         - Microsoft     - 3306:3306 -
@Nginx      -               - 8000:80    -
```

Services flow:
```
@Authenticated user
@Unauthenticated
```

Services workflow:
```
- docker-compose up
@Laravel
- docker-compose exec laravel bash
- php artisan migrate
- npm run watch
```