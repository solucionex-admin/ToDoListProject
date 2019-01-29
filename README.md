DOCKER-EMPTY
======

## Purpose

The purpose of this repository is to have a basic example of api platform & Symfony

## Configure Docker

1.Create the .env file for docker:

```sh
cp .infra/docker/dist.env .infra/docker/.env
```

2.Modify the environment variables. 

- The file is ready to start working with an index in the root of the project:
```code
APP_DIR=../..
``` 
- Using the 80 port:
```code
HTTP_PORT=80
``` 

- And 3306 for database:
```code
DB_PORT=3306
``` 

**Important!!! If the ports are being used change them or the compose-up will exit showing an error**


3.Run Docker

```sh
cd .infra/docker
docker-compose up --build -d
```

4.Copy the file .infra/docker/docker-exec to the root of your project and make it executable:
  ```sh
  cp .infra/docker/docker-exec docker-exec
  chmod a+x docker-exec
  ```

## Install the project

5.Exec composer install
  ```sh
  ./docker-exec composer install
  ```

6.Create the database schema
  ```sh
  ./docker-exec php bin/console doctrine:schema:update --force
  ```

7.Load the fixtures
  ```sh
  ./docker-exec php bin/console doctrine:fixtures:load -n
  ```


## Access via browser

8.Now you should be able to access the project writing in the browser:
```sh
http://localhost:80
```

**Important!!! Change 80 for the port you have set in HTTP_PORT in .env**

Extra: You can change your /etc/hosts:
```sh
127.0.0.1 apiplatform.test
```

9.Access to the url to manage the data via api:
```sh
http://apiplatform.test:80/api
```

10.Access to the next url to manage data from the Easy Admin Bundle:
  ```sh
  http://apiplatform.test:80/admin
  ```
