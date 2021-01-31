# Order Service
## Summary
This application is a standalone micro service which provides REST HTTP endpoints for order pricing management.

## Features Overview
* Fully isolated and dockerized application
* Infrastructure level logs(Web server logs)
* Powerful error handling
* Descriptive API documentation powered by Swagger

## Installation guide
Follow these steps to simply run the project.

### Clone the project
Clone this repository to your local machine using the following command:
```bash
git clone git@github.com:majidakbari/order-service.git
```

### Environment variables
There is a `.env.example` file in the project root directory containing OS level environment variables that are used for deploying the whole application.
Every single variable inside the file has a default value, so you do not need to change them; But you can also override your own variables. First copy the example file to the `.env` file:
```bash
cd /path-to-project
cp .env.example .env
```
Then open your favorite text editor like `vim` or `nano` and change the variables. All variables have comments which describe them.

For example `BACKEND_PORT` environment variable shows that the project will run on the following port. You can change them to your desired values.

> Note: In this application, laravel `.env` file is removed and `OS` level environment variables are used instead. So if you want to modify any values "after running containers", do not forget to recreate and restart the application container so that your changes will affect. For restarting containers use the following command:
> ```bash
> docker-compose up -d --force-recreate
> ```

### Running containers
Open `Terminal` and type the following command:
```bash
docker-compose up -d 
```

Only the first time you're running the application, you must execute the following command:

```bash
docker-compose exec order-core bootup
```
It will install dependencies and will migrate/seed the database.

## Features descriptions 

### Logs
In this application there are two levels of logs, you can figure out more in the following sections:

#### Infrastructure level logs
In the project's root, there is `.data` directory which is used to storing logs (and also used for some other purposes). You can use your preferred logging tool like `ELK` or etc. to manage them.
Under `.data/app/log` directory there is a directory named `webserver` which holds apache server `access` and `error` logs.

#### Application level logs
Under `storage/logs` directory, you can find detailed logs of API calls.

### API Documentation
Models and endpoints are fully specified using swagger openApi.
Navigate to `localhost:{{SWAGGER_PORT}}` (default equals to http://localhost:9093) on your host to see API documentation.

### Suggestions
Based on the project scope, some important topics were skipped, they are as follows.
* Having unit and feature tests for the application.
* Having pricing strategy (At the moment the very first rules that match a shopping cart will be applied; We could have strategies to choose the cheapest or even the most expensive basket after applying the rules).


## Technical discussions (Images/Containers)
This project includes three docker containers based on `php-apache`, `MySQL` and `Swagger` images.
It is under development, So the source code is mounted from the host to containers. On production environment you should remove these volumes.

`order-core`
php:8.0.1-apache

`order-db`
MySQL latest (8.0.22)

`order-swagger`
swaggerapi/swagger-ui

## Author
Majid Akbari [Linkedin](https://linkedin.com/in/majid-akbari)

## Licence
[MIT](https://choosealicense.com/licenses/mit/)
