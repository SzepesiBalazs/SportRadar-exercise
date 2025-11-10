# SportRadar-exercise

A simple PHP application that manages sports events, running in a Dockerized environment with Apache and MySQL.
The frontend uses TailwindCSS and vanilla JavaScript to display data fetched from the PHP API.


Setup & Run

To start the containers use:

docker compose up -d

To build the containers use:

docker compose build

These commands will start the Apache and PHP containers and also the database.

After it's started, use these urls to get:

Frontend: http://localhost:8080
API root: http://localhost:8080/api
Events: http://localhost:8080/api/events


To stop the containers:

docker compose down

This will stop the application while still keeping the data.


Database setup:

Before running migrations or seeder, use this command to enter the PHP running container:

docker exec -it sr_exercise bash

Inside the container, use these commands to get:

Migration: php database/migrate.php
Seeder: php database/seed.php

