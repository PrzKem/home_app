[![Build Status](https://travis-ci.org/joemccann/dillinger.svg?branch=master)](https://github.com/PrzKem/home_app)

## About project
This project is created to help house maintanence. As final product it will be able to help at 4 fields.

### Food
>This app will help you managing food. You can create basic food plan based on your meals. You can add various meals with their ingredients - limitations are only in your DB! Moreover, you can create shopping list based on your food plan.

### Calendar
>Calendar section will help you managing various type of events. Starting with home events you can create scheduled task, on every week (in mobile app there will be tost-notifications for them). You wll have reminders for your friends birthdays. Next section of this part allows you to add trips and you will be able to manage subtask in every trip to estimate time and total costs.

### IoT
>This part will give you an opportunity to connect your IoT home devices using database. Devices can be controlled in dashboard, values can be readed on charts and in sensors. Sensors are connected to controllers. You can send values from arduino (apparently doesn't work for docker - has to go throught node-red gateway) using API. Actual status is displayed and refresh.

### Budget
[Section and pages will be added]
>This part will help you with budget managment. You will be able to track your expenses (in future, using API or dedicated APP you will be able to connect camera to read recipes) as well as create PARETO chart.

### Kaizen
[Section and pages will be added]
---

## Tech stack
 - PHP 8 with Laravel 10
 - MariaDB
 - JS
 - HTML & CSS & Bootstrap

## Instalation
>Just add those files to your project, fulfill .env file with your connection data and it will be done. Can be developed in docker as well.
