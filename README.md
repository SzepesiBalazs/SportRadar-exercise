# SportRadar-exercise

A simple PHP application that manages sports events, running in a Dockerized environment with Apache and MySQL.

The frontend uses TailwindCSS and vanilla JavaScript to display data fetched from the PHP API.


# Setup & Run

To start the containers use:

```
docker compose up -d
```

To build the containers use:

```
docker compose build
```

These commands will start the Apache and PHP containers and also the database.

After it's started, use these urls to get:

### Frontend: http://localhost:8080
### Events API: http://localhost:8080/api/events


To stop the containers:

```
docker compose down
```

This will stop the application while still keeping the data.


# Database setup:

In my database, there are many relations:

1. competitions → countries

Relation: competitions.country_id → countries.id

Type: Many competitions belong to one country.

Cardinality: countries (1) —— (∞) competitions

2. venues → countries

Relation: venues.country_id → countries.id

Type: Many venues belong to one country.

Cardinality: countries (1) —— (∞) venues

3. competitors → countries

Relation: competitors.nationality → countries.id

Type: Many competitors can have the same nationality.

Cardinality: countries (1) —— (∞) competitors

4. competitors → genders

Relation: competitors.gender_id → genders.id

Type: Many competitors share one gender.

Cardinality: genders (1) —— (∞) competitors

5. events → sports

Relation: events.sport_id → sports.id

Type: Many events are for one sport.

Cardinality: sports (1) —— (∞) events

6. events → competitions

Relation: events.competition_id → competitions.id

Type: Many events belong to one competition.

Cardinality: competitions (1) —— (∞) events

7. events → competitors (home team)

Relation: events.competitor_home_id → competitors.id

Type: One event has one home competitor.

Cardinality: competitors (1) —— (∞) events (as home)

8. events → competitors (away team)

Relation: events.competitor_away_id → competitors.id

Type: One event has one away competitor.

Cardinality: competitors (1) —— (∞) events (as away)

9. events → venues

Relation: events.venue_id → venues.id

Type: Many events can take place at one venue.

Cardinality: venues (1) —— (∞) events



Before running migrations or seeder, use this command to enter the PHP running container:

docker exec -it sr_exercise bash

Inside the container, use these commands to get:

```
Migration: php database/migrate.php
Seeder: php database/seed.php
```

# Frontend:

The frontend is located at index.html and uses TailwindCSS for styling.
It fetches events dynamically from the API and renders them using a reusable HTML.

Javascript logic is inside /js/app.js and handles:

Fetching API data
Rendering event cards
Displaying loading/error states.