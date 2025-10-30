Project Overview
----------------
# GPCA Event Management System

A Laravel-based system with both:
- **Blade UI** for managing events, sessions, and speakers.
- **RESTful API** endpoints for programmatic access to the same data.

Includes:
- Dashboard (counts of Events, Sessions, Speakers)
- CRUD for Events, Sessions, Speakers
- Validation (Form Requests)
- API routes returning JSON responses



Setup Instructions
------------------
## Setup Guide

### Requirements
- PHP >= 8.2
- Composer
- MySQL
- Node.js & npm

### Installation
```bash
git clone https://github.com/nousheedkasim/interview-task-nousheed.git
cd GPCA
composer install
npm install
npm run dev
copy .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve


Database Setup
--------------
DB_DATABASE=gpca
DB_USERNAME=root
DB_PASSWORD=

Migration and Seeder
--------------------
php artisan migrate --seed


Run Project
-----------
php artisan serve  -  http://127.0.0.1:8000


Login Credentials
-----------------
login email  = admin@mail.com
login password = 123456


Api Endpoints
-------------

| Method 	| Endpoint 	| Description 		|
|---------------|--------------	|-----------------------|
| GET 		| /api/events 	| List all events 	|
| GET 		| /api/sessions | List all sessions 	|
| POST 		| /api/sessions | Create new session 	|
| GET 		| /api/speakers | List all speakers 	|


Sample payload for new session creation
---------------------------------------
{
  "event_id": 1,
  "title": "Opening Ceremony",
  "start_time": "09:00",
  "end_time": "10:00",
  "description": "Kickoff session for the event."
}


Blade UI Pages
--------------
- /Dashboard - Shows total counts
- /Events - Manage events (list, create, edit)
- /Sessions - Manage event sessions
- /Speakers - Manage speakers
- /Session Roster - List all session mapped with speaker, New Mapping 




