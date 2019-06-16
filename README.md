Homework task
============

# Intro

`Epic`: Restaurants and it’s tables management

`Stories`:
  - I can login as a system’s user. (#1)
  - As a logged in user I can create/update/delete restaurants. Restaurant has properties:
   title,  photo, identification number, status (active, inactive) (#2)
  - As a logged in user I can see all restaurants and filter by title. (In list I can see title, photo, identification number, status (active, inactive), count of active tables). (#3)
  - As a logged in user I can create/read/update/delete restaurant’s tables. Restaurant’s table has properties: capacity, number, status (active, inactive). (#4)

>Numbers in brackets are used in commit messages to reference story.

## Test user credentials

`Email` - aurimas@vilys.lt
`Password` - aurimas 

## Project run

* Start docker

* Create docker php image

```bash
docker image build scripts/php -t php-new
```

* Then execute:
```bash
scripts/start.sh
```

* After starting containers run installation scripts:
```bash
scripts/install-first.sh
```

* To stop containers:
```bash
scripts/stop.sh
```

## Remark

Project is based on [*OFFICIAL NFQ Academy Symfony 4 start project*](https://github.com/nfqakademija/kickstart).