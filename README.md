# Secrets

Some simple examples where the PHP code reads file contents, environment variables and `docker secrets`, then uses these data to print them to stdout and connect to a MySQL database.

You'll need your machine to be in a `swarm` in order to create `secrets` and to `deploy` the application `stack`:
```bash
$ docker swarm init
```

The external secrets must be created before you deploy the `docker-compose.yml` file:
```bash
$ echo "A secret phrase" | docker secret create secret-phrase -
$ echo "A secret content" | docker secret create secret-in-a-file -
```

Build the image (`docker stack` ignores the build option so you must do it manually):
```bash
$ docker build -t php:7.2-apache_ext-mysqli .
```

Deploy the stack with `docker stack`;
```bash
$ docker stack deploy -c docker-compose.yml secrets
``` 

Discover the container ID of the `php` service:
```bash
$ docker ps
CONTAINER ID        IMAGE                       COMMAND                  CREATED             STATUS              PORTS                 NAMES
7534fc2cd823        php:7.2-apache_ext-mysqli   "docker-php-entrypoi…"   9 minutes ago       Up 9 minutes        80/tcp                secrets_php.1.jxqxr8zpgvekhuggwo9qs5778
b2f634be48cd        mysql:8                     "docker-entrypoint.s…"   9 minutes ago       Up 9 minutes        3306/tcp, 33060/tcp   secrets_mysql.1.k1s3zn7dbk7ma15mukv6dlrbr
```

Run the examples:
```bash
$ docker exec -it 7534fc2cd823 php 1_read-file-contents.php
Hello, File Content!

$ docker exec -it 7534fc2cd823 php 2_read-env-var.php
Lorem ipsum dolor sit amet
$ docker exec -it 7534fc2cd823 php 3_read-secret-fixed-path.php
A secret phrase

$ docker exec -it 7534fc2cd823 php 4_read-secret-path-from-env-var.php
A secret content

$ docker exec -it 7534fc2cd823 php 5_connect-to-database-with-secrets.php
Arguments: mysqli_connect('mysql', 'user', 'password', 'mydb');
Successful connection

```
