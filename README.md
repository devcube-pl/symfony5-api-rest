# Symfony5ApiRest

[![Build Status](https://travis-ci.org/Tony133/symfony5-api-rest.svg?branch=master)](https://travis-ci.org/Tony133/symfony5-api-rest)

Simple example of an API REST with Symfony 5.1

## Install with Composer

```
    $ curl -s http://getcomposer.org/installer | php
    $ php composer.phar install or composer install
```

## Setting Environment

```
    $ cp .env.dist .env
```

## Getting with Curl

```
    $ curl -H 'content-type: application/json' -v -X GET http://127.0.0.1:8000/api/books
    $ curl -H 'content-type: application/json' -v -X GET http://127.0.0.1:8000/api/books/:id
    $ curl -H 'content-type: application/json' -v -X POST -d '{"title":"Foo bar","price":"19.99"}' http://127.0.0.1:8000/api/book/new
    $ curl -H 'content-type: application/json' -v -X PUT -d '{"title":"Foo bar","price":"19.99"}' http://127.0.0.1:8000/api/books/edit/:id
    $ curl -H 'content-type: application/json' -v -X DELETE http://127.0.0.1:8000/api/books/remove/:id
```

## User Authentication with Curl

```
    $ curl -H 'content-type: application/json' -v -X GET http://127.0.0.1:8000/api/books  -H 'Authorization:Basic username:password or email:password'
```

## Getting with Phpunit

```
    $ phpunit or ./bin/phpunit
```
