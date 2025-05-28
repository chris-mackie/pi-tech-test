# YourParkingSpace - ParkInsight Tech Test

## Brief
You are responsible for the parking sessions service. Currently this just features APIs to create and update a parking session. You have received the following requirements:

1. Add an API to list all parking sessions currently stored. This should include an optional `vrm` filter to only return sessions for the given VRM.
2. Fetch and record the matching permit ID for a parking session when it is finished. The permit ID can be retrieved via the external find permit API, documentation of which can be found within the `find-permit-api.yml` file. Please note: this is a dummy API and does not actually exist.
3. Fix an issue reported by a user where they are able to update a parking session and set the `ends_at` field to be a date and time before the session `starts_at` field.

## Setup
A `docker-compose.yml` file is included for use in local development. This includes a MongoDB container which is used as the database storage solution for the service.

To get setup, clone the repository and run the following from within the project directory:
```shell
docker compose up -d --build
docker exec laravel_app composer install
```

The current APIs are covered by unit tests written using [PestPHP](https://pestphp.com/). These tests can be run from within the container:
```shell
docker exec laravel_app vendor/bin/pest
```

## What we are looking for
- Neat implementation of the given requirements using SOLID design principles
- Clean code, following PSR-12 standards
- Use of Laravel 12 and PHP 8.4 features where appropriate
- All existing unit tests passing and sufficient coverage of new code

## Submission instructions
When developing please use Git as you normally would. To submit create a [git bundle](https://git-scm.com/docs/git-bundle/) and send the file across:
```
git bundle create <yourname>.bundle --all --branches
```
