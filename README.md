DOCKER-EMPTY
======

## Purpose

The purpose of this repository is to have a basic docker environment ready to clone and start a php project.

## Configure

Create the file .env:

```sh
cp .infra/docker/dist.env .infra/docker/.env
```

Afer this, modify the environment variables. 

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


- Modify the file /.infra/docker/www/config/000-default.conf in order to set up the domain of your project.

```code
<VirtualHost *:80>
    ServerName docker.test
    ServerAlias www.docker.test
    ...
```

- Modify the file /.infra/docker/www/config/000-default.conf in order to set up the root of your project (/var/www/html/public for a Symfony 4 project for instance).
```code
...
    DocumentRoot /var/www/html
    <Directory /var/www/html>
    ...
```

## Run

```sh
cd .infra/docker
docker-compose up --build -d
```

Now you should be able to access the project writing in the browser:
```sh
http://localhost:80
```

**Important!!! Change 80 for the port you have set in HTTP_PORT in .env**

Extra: You can change your /etc/hosts:
```sh
127.0.0.1 docker.test
```

And access via browser:
```sh
http://docker.test:80
```

### Terminal

We can access **as root** (not recommended) to the server via terminal writing the command:

```sh
docker-compose exec www bash
```

And non-root, with the user www-data:

```sh
docker-compose exec -u www-data www bash
```

### Script to make it Easy
You can copy the file .infra/docker/docker-exec to the root of your project and ma
ke it executable:
```sh
cp .infra/docker/docker-exec docker-exec
chmod a+x docker-exec
```

From now you will be able to access to the apache bash or execute any command in y
our php server executing the script docker-exec:
```sh
./docker-exec bash
```

Inside the Shell Script there are a few instructions, basically you will be able to change the script to access to the bash with another user or to other container, in case you have changed it.


### Other commands

Stop docker:

```sh
docker-compose down
```

Validate the docker-compose.yml file:

```sh
docker-compose config
```

Start a project forcing changes in Dockerfile:

```sh
docker-compose up --build -d --force
```

List networks

```sh
docker network ls
```

Inspect a concrete network

```sh
docker network inspect app_net
```

List services of the project

```sh
docker-compose ps
```

List docker containers

```sh
docker ps
```
