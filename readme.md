## Installation php 8.4

### Ubuntu 22.04
```sh
sudo apt update &&
sudo apt install software-properties-common &&
sudo add-apt-repository ppa:ondrej/php &&
sudo apt update &&
sudo apt install -y php8.4 php8.4-sqlite3 composer
```

### Debian 12
```sh
sudo apt update &&
sudo apt-get -y install lsb-release ca-certificates curl apt-transport-https &&
sudo curl -sSLo /tmp/debsuryorg-archive-keyring.deb https://packages.sury.org/debsuryorg-archive-keyring.deb &&
sudo dpkg -i /tmp/debsuryorg-archive-keyring.deb &&
sudo sh -c 'echo "deb [signed-by=/usr/share/keyrings/deb.sury.org-php.gpg] https://packages.sury.org/php/ $(lsb_release -sc) main" > /etc/apt/sources.list.d/php.list' &&
sudo apt update &&
sudo apt install -y php8.4 php8.4-sqlite3 composer
```

### macOS 15.5
```sh
brew install php@8.4 composer
```
or
```sh
sudo port install php84 php84-sqlite composer
```

### Windows 11
```sh
Set-ExecutionPolicy Bypass -Scope Process -Force; [System.Net.ServicePointManager]::SecurityProtocol = [System.Net.ServicePointManager]::SecurityProtocol -bor 3072; iex ((New-Object System.Net.WebClient).DownloadString('https://community.chocolatey.org/install.ps1')) &&
choco install php php-sqlite composer
```

## Installation and run laravel project

1. Create and go to a new folder for the project:
```sh
mkdir be-test-task && cd be-test-task
```

2. Clone the repository:
```sh
git clone git@github.com:axisbits/be-test-task.git .\
```

3. Install dependencies, migrate, db seed and run the server:
```sh
composer install && php artisan migrate --seed && php artisan serve
```

4. After starting the server, two users will be created:
```sh
email: admin@admin.admin
password: admin
role: admin

email: user@user.user
password: user
role: user
```

5. Additional commands (optional):
#### Fix code style
```sh
composer fix
```

#### Analyse code
```sh
composer analyse
```

#### Run tests
```sh
composer test
```

## Postman collection

The Postman collection for testing the API is located in the `postman/collection.json` folder

### Import the collection into Postman:

1. Open Postman
2. Click the "Import" button in the top left corner
3. Select the `postman/collection.json` file from the root of the project
4. Click "Import"

## Additional packages installed
<a href="https://github.com/andersao/l5-repository">prettus/l5-repository</a> - Repository pattern implementation for Laravel.

<a href="https://github.com/spatie/laravel-fractal">league/fractal</a> - Fractal provides a presentation layer for complex data output, the like JSON.

<a href="https://github.com/laravel/sanctum">laravel/sanctum</a> - Sanctum provides a featherweight authentication system for Laravel.

<a href="https://github.com/bensampo/laravel-enum">bensampo/laravel-enum</a> - Laravel Enum is a library that provides a way to define and use enumerated types in Laravel.

## Additional development packages installed
<a href="https://github.com/barryvdh/laravel-ide-helper">barryvdh/laravel-ide-helper</a> - Laravel IDE Helper, generates a helper file for IDE auto-completion.

<a href="https://github.com/beyondcode/laravel-dump-server">beyondcode/laravel-dump-server</a> - A dump server for the Laravel framework.

<a href="https://github.com/beyondcode/laravel-query-detector">beyondcode/laravel-query-detector</a> - Laravel Query Detector is a package that helps you detect and fix slow queries in your Laravel application.

<a href="https://github.com/friendsofphp/php-cs-fixer">friendsofphp/php-cs-fixer</a> - A tool to automatically fix PHP code issues (https://cs.symfony.com).

<a href="https://github.com/larastan/larastan">larastan/larastan</a> - Larastan is a static analysis tool for Laravel.
