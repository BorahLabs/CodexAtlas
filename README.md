![CodexAtlas](public/images/banner.png)

## About Codex

CodexAtlas is a web application that creates AI-based documentation in real-time for software projects. It is built using Laravel and deployed using Laravel Vapor.

## Installation

The installation process is pretty straightforward:

1. Clone the project
2. Run `composer install` (you will need a token from Laravel Spark)
3. Run `npm install`
4. Setup a local Postgres database
5. Configure your `.env` file
6. Run `php artisan migrate`

### Additional setup

Even though this is enough to get the project running, there are a few more things you will need to have it 100% up and running:

- Setup the AWS credentials in your `.env` file
- Setup the GitHub credentials in your `.env` file
- Setup the OpenAI API key in your `.env` file
- It is recommended to have Redis installed and running

### Knowledge base
Part of Codex relies on Borah's [Knowledge Base](https://github.com/BorahLabs/Knowledge-Base) package. Please, follow the instructions in the repository to get it up and running.

## Running the project

Once everything is installed and configured, you can run the project using `php artisan serve` or accessing `codexatlas.test` if you're using a local server. For the front-end assets, run `npm run dev`.

It is recommended to run also `php artisan queue:listen --timeout=0` to process the jobs in the queue.

## Tests
This project is well-tested using [Pest](https://pestphp.com/). You can run the tests using `./vendor/bin/pest`.

### Test Coverage
To check the test coverage, you will need to install Xdebug and run `./vendor/bin/pest --coverage`.

### Static Analysis
This project uses Larastan for static analysis. You can run the static analysis using `./vendor/bin/phpstan analyse`

### Type Coverage
We aim to keep the type coverage of the project at 100%. To check the type coverage, run `./vendor/bin/pest --type-coverage`.

## Linting
This project uses [Laravel Pint](https://laravel.com/docs/10.x/pint) to lint the code. You can run the linter using `./vendor/bin/pint`.
