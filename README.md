# LAGFSD (Laravel, Aspnet, Gin, Flask, Springboot, Django)

Services:
Altough services are designed to work with API Gateway and Django, they can be also run independently with their own UI.
```
Laravel     - Product       - 8001:80   - React/Bootstrap
ASPNET      - User          - 8002:80   -
Gin         - Payment       - 8003:80   -
Flask       - Announces     - 8004:80   -
---
Springboot  - Gateway       - 8080:80   -
@Nginx
@DB
---
Django      - Pages         - 80:80     -
```

Services flow:
```
@Authenticated user
@Unauthenticated
```

Services workflow:
```
@Laravel
- php artisan migrate
- docker-compose up
- npm run watch
```