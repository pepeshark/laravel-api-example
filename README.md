## Laravel api example with test

This is an example repo for api and test

### Init

```
php artisan migrate
php artisan db:seed
```

### /product endpoint parameters

```
/api/product?sort=desc
/api/product?search=something
```

### Test

/product endpoint covered with tests. You can use:

```
./vendor/bin/phpuni
```
