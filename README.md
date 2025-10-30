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

# Clone the repository
git clone https://github.com/nousheedkasim/interview-task-nousheed.git
cd interview-task-nousheed

# Install dependencies
composer install
npm install
npm run dev

# Copy the environment file
copy .env.example .env

### Configure the Environment (.env file)

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306   # Change if your MySQL runs on a different port
DB_DATABASE=gpca
DB_USERNAME=root
DB_PASSWORD=''

### Generate App Key & Run Migrations

php artisan key:generate
php artisan migrate --seed

### Start the Development Server
php artisan serve



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




