# Repository switch

## Demo app is here: https://order-shirt-app.herokuapp.com/all

## Introduction
This is a framework-less php application that dynamically changes available repositories. The classes implement PSR interfaces. 
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

## TruthShirtOrderRepository
This is the source of truth of data. The implementation is Mysql db. All "write" actions must go through this repository first and then cascade down to all available data repositories.

## CacheShirtOrderRepository
This is the basic native php caching service APCU that represents in memory repository data source. All read actions by default go through this repository

## ShirtOrder
The model extends standalone eloquent model (no laravel included) and is a standard data object that is injected into all repositories used.

## RepositorySelector
This is an implementation of PSR MiddlewareInterface that contains the logic and of deciding which repository implementation should be used.
Once decided it will instanciate every repository class needed, inject dependencies and releases the request to the next layer -> controllers.

## Front-end UI
Contains boilerplate basic html, javascript and css files to provide some interface for users to test the app.
Pages: /all, /view, /edit, /create
On every interaction with a particular repository th feedback is returned in the bottow left corner in bold red text.
two orange buttons can be used to toggle repository data sources. 

## Tests
The tests only cover repository classes
run "composer test" in project root
apcu cli must be enabled in order to test CacheShirtOrderRepository class, so by default it has been commented to not cause any test failures. Details are given in the comments









