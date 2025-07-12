# Epidemia

Epidemia is a small Symfony 7 application used to manage countries, zones and surveillance points (hospitals) for an imaginary epidemiological monitoring system. The repository contains a sample back office built with Twig templates and a simple security configuration. When creating a surveillance point you specify the number of inhabitants monitored, symptomatic cases and confirmed positives.

## Requirements
- PHP 8.2 or higher
- Composer
- PostgreSQL (default credentials are defined in `.env`)
- Optional: Docker Compose to start the database and a local mail server

## Installation
1. Install PHP dependencies:
   ```bash
   composer install
   ```
2. Start the services (database and mailer) using Docker Compose:
   ```bash
   docker compose up -d
   ```
3. Run the database migrations:
   ```bash
   php bin/console doctrine:migrations:migrate
   ```
4. Access the application at `https://localhost:8000/` when using the Symfony local web server or your preferred setup.

Zones contain one to four surveillance points. Each point represents a hospital and stores the number of inhabitants monitored, symptomatic people and confirmed cases. The totals for a zone are calculated from its points.

## Testing
The project uses PHPUnit. After installing dependencies you can run:
```bash
vendor/bin/phpunit
```
There are currently no test cases provided, so the test suite will report `No tests executed`.

## License
This project is provided under a proprietary license as defined in `composer.json`.
