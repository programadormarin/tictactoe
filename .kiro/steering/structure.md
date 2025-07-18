# Project Structure

## Root Directory Organization
```
├── assets/          # Frontend assets (JS, SCSS, images)
├── bin/             # Executable scripts (phpunit, console)
├── config/          # Symfony configuration files
├── docker/          # Docker configuration files
├── public/          # Web-accessible files (index.php, favicon)
├── src/             # PHP source code
├── templates/       # Twig templates
├── tests/           # PHPUnit test files
└── vendor/          # Composer dependencies (auto-generated)
```

## Source Code Structure (`src/`)
- **Controller/** - HTTP request handlers
  - `ApiController.php` - REST API endpoints
  - `IndexController.php` - Web interface controller
- **Service/** - Business logic services
  - `MoveInterface.php` - Move service contract
  - `MoveService.php` - Game move implementation
- **Util/** - Utility classes
  - `BoardValidator.php` - Board state validation
  - `GameStatus.php` - Game state analysis
  - `WinnerMoves.php` - Win condition logic
- **Exception/** - Custom exception classes
- **EventListener/** - Symfony event subscribers

## Test Structure (`tests/`)
- Mirrors `src/` directory structure
- Uses PHPUnit with Symfony WebTestCase
- Includes data providers for test scenarios
- Tests both unit logic and HTTP endpoints

## Configuration Structure (`config/`)
- **packages/** - Bundle-specific configuration
- **routes/** - Routing definitions
- `services.yaml` - Service container configuration
- `bundles.php` - Registered bundles

## Naming Conventions
- **Namespace**: `Hmarinjr\TicTacToe\`
- **PSR-4 autoloading** for both src and tests
- **Controllers** end with `Controller` suffix
- **Services** implement interfaces when applicable
- **Tests** mirror source structure with `Test` suffix

## Asset Organization (`assets/`)
- `js/` - JavaScript files
- `scss/` - Sass stylesheets
- `image/` - Static images
- Compiled assets output to `public/assets/`