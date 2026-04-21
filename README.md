# Series API

A RESTful API built with **Laravel 11** for managing TV series, seasons, and episodes. Features user authentication, episode watch tracking, and address lookup via the ViaCEP external API.

## Tech Stack

- **PHP 8.3** / **Laravel 11**
- **MySQL** (Docker) / SQLite (local)
- **Laravel Sanctum** — token-based authentication
- **GuzzleHTTP** — HTTP client for external API calls
- **Docker** — containerized environment (PHP-FPM, Nginx, MySQL)
- **Pest** — test framework

## Architecture

The project follows a layered architecture with clear separation of concerns:

```
Controllers → Services → Repositories → Models
```

- **Repository Pattern** — data access abstracted behind interfaces
- **Service Layer** — business logic decoupled from controllers
- **DTOs (Data Transfer Objects)** — typed data transport between layers
- **Dependency Injection** — all interfaces resolved via Service Providers
- **Adapter Pattern** — GuzzleHTTP wrapped behind `HttpClientInterface`
- **Events & Listeners** — `SeriesCreated` event triggers email notifications and logging (queued)
- **Jobs** — queued job to delete series attachments asynchronously

## API Endpoints

All endpoints are prefixed with `/api`. Authenticated routes require a `Bearer` token (obtained via login).

### Authentication
| Method | Endpoint | Description |
|--------|----------|-------------|
| POST | `/login` | Login and receive API token |
| POST | `/users/register` | Register a new user |
| POST | `/logout` | Revoke token |

### Series
| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/series` | List series (paginated + search) |
| POST | `/series` | Create series with seasons and episodes |
| GET | `/series/{id}` | Get a series |
| PUT | `/series/{id}` | Update series, seasons, and episodes |
| DELETE | `/series/{id}` | Delete series |
| GET | `/series/seasons` | All series with their seasons |
| GET | `/series/seasons/episodes` | All series with seasons and episodes |
| GET | `/series/{id}/serie-seasons` | Series with its seasons |
| GET | `/series/{id}/serie-seasons/episodes` | Series with seasons and episodes |
| GET | `/series/{id}/seasons` | Seasons for a series |
| GET | `/series/{id}/episodes` | All episodes across all seasons |
| GET | `/series/{id}/seasons/episodes` | Seasons with nested episodes |

### Seasons
| Method | Endpoint | Description |
|--------|----------|-------------|
| POST | `/seasons` | Create a season |
| PUT | `/seasons/{id}` | Update a season |
| DELETE | `/seasons/{id}` | Delete a season |

### Episodes
| Method | Endpoint | Description |
|--------|----------|-------------|
| POST | `/episodes` | Create an episode |
| PUT/PATCH | `/episodes/{id}` | Update an episode |
| PATCH | `/episodes/{id}/watched` | Mark episode as watched |
| PATCH | `/episodes/{id}/unwatched` | Mark episode as unwatched |
| DELETE | `/episodes/{id}` | Delete an episode |

### Address
| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/address/cep?cep={cep}` | Look up address by postal code (ViaCEP) |

## Getting Started

### Prerequisites

- Docker and Docker Compose

### Setup

1. Clone the repository and navigate to the Docker folder:

```bash
cd docker-laravel
```

2. Start the containers:

```bash
docker-compose up
```

3. Access the PHP container:

```bash
docker-compose exec app bash
```

4. Install dependencies:

```bash
composer install
```

5. Copy the environment file and generate the app key:

```bash
cp .env.example .env
php artisan key:generate
```

6. Run migrations:

```bash
php artisan migrate
```

7. (Optional) Run the queue worker to process jobs and notifications:

```bash
php artisan queue:work
```

The API will be available at `http://localhost:8000`.

> **Windows (WSL):** Start Docker with `service docker start` and prefix all `docker-compose` commands with `sudo`.

### Useful Commands

```bash
# Stop and remove all containers, networks, and volumes
docker-compose down

# Stop all running containers
docker stop $(docker ps -q)
```

## Postman Collection

A ready-to-use Postman collection is included at the root of the repository (`Laravel.postman_collection.json`). Import it into Postman to explore and test all endpoints.

## Running Tests

```bash
# Inside the PHP container
php artisan test
```
