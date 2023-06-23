# laravel-woocommerce

Services:

```
Laravel     - Product
ASPNET      - User
Gin         - Payment
Flask       - Announces
---
Springboot  - Gateway
---
Django      - Pages
```

Services description:
Altough services are designed to work with API Gateway and Django, they can be also run independently with their own UI.
```
@Laravel
    -> Discounts
    -> React

@ASPNET
    -> Angular

@Gin
    -> PSP

@Flask
    -> Importance
    -> Vue

@Springboot

@Django
    -> React
```

Services flow:
```
@Authenticated user
@Unauthenticated
```

Services workflow:
```
@Laravel
- docker-compose up
- npm run watch
```