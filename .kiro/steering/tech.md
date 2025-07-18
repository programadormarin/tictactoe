# Technology Stack

## Backend
- **PHP 7.2+** - Core language
- **Symfony 4** - Web framework
- **Composer** - PHP dependency management
- **PHPUnit** - Testing framework
- **Guzzle HTTP** - HTTP client library

## Frontend
- **Webpack Encore** - Asset compilation
- **Sass/SCSS** - CSS preprocessing
- **jQuery** - JavaScript library
- **Bootstrap 4** - CSS framework
- **Twig** - Template engine

## Development Environment
- **Docker Compose** - Containerized development
- **Nginx** - Web server
- **PHP-FPM** - PHP process manager
- **Node.js** - Frontend build tools

## Common Commands

### Local Development
```bash
# Install PHP dependencies
composer install

# Install frontend dependencies
npm install
# or
yarn install

# Build frontend assets
npm run dev          # Development build
npm run watch        # Watch for changes
npm run build        # Production build
```

### Docker Development
```bash
# Start all services
docker-compose up --build -d

# Access application at http://localhost:8000

# Run composer in container
docker-compose exec php composer install
```

### Testing
```bash
# Run tests locally
bin/phpunit

# Run tests in Docker
docker-compose exec php ./bin/phpunit
```

## Code Quality Tools
- **PHPStan** - Static analysis
- **CodeClimate** - Code quality monitoring
- **Travis CI** - Continuous integration