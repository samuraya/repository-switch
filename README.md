# Dynamic Repository switch

## Demo app is here: https://order-shirt-app.herokuapp.com/all

## Introduction
This is the framework-less php application that dynamically changes available repositories. The classes implement PSR interfaces. 
Basic front-end UI is also given in order to test capabilities and behavior.

## Installation
1. "composer install" from the project root
2. provide local environmental variables in .env file for your local mysql database connection
3. create new database in your local host
4. uncomment two files in folder "migrations" and run in project root "composer migrate" to set up a database table.
5. run "php -S localhost:8080 -t public/" in project root and visit "localhost:8080/all"

## Project structure
The main folder "src" contains core classes that build the logic and behavior of the app. 
There are separate controllers for each CRUD action whose. 
There are two Repository implementations of a ShirtOrderRepositoryInterface to demonstrate the overall behavior.
There is one core Middleware class that performs switching between the repository implementations according to the incoming request.

## ShirtOrderRepositoryInterface
Provides standard methods for manipulating the data sources. This interface is injected into main ShirtOrderController class.
All classes that implement this interface receive ShirtOrder model in their constructor

## 





