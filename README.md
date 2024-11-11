#Blue Window Ltd Test Task
This project consists of a backend built with Laravel and a frontend composed of a single HTML file, index.html, along with accompanying styles and JavaScript files.

##Project Setup

###Prerequisites
Docker and Docker Compose installed on your machine

###Getting Started
####1. Run Docker Containers

From the root project directory, run:

```bush
docker compose up -d --build
```

This will build and start the required Docker containers.

####2. First-Time Deployment

For initial project setup, execute:

```bush
make deploy-project-first-time
```

This command will perform the following steps:

Install all necessary dependencies.
Run migrations and seed the database

##Frontend

The frontend files are located in the `./public/frontend/` directory, with index.html as the main entry point.
You can access it in your browser at:

```arduino
http://localhost/frontend/index.html
```
