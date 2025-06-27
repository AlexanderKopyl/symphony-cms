# symphony-cms

This example uses **Symfony 7** and demonstrates Onion architecture with
Domain, Application, Infrastructure and Controller layers. Doctrine ORM stores
`Article` and `User` entities in a SQLite database.

## Structure

```
src/
    ArticleDomain/
        Domain/
            Model/
            Repository/
        Application/
            Service/
        Infrastructure/
            Persistence/
    UserDomain/
        Domain/
            Model/
            Repository/
        Application/
            Service/
        Infrastructure/
            Persistence/
    SharedKernel/
    Controller/
```

- **ArticleDomain** and **UserDomain** contain domain models, repository
  interfaces, application services and infrastructure for each domain.
- **SharedKernel** provides common utilities like slug generation and UUIDs.
- **Controller** exposes only the admin dashboard; the API is handled by API Platform.

## Example


API Platform exposes all entities under `/api`. Authentication is performed via
JWT at `/api/login` with refresh tokens obtainable from `/api/token/refresh`.
The admin dashboard is available at `/admin` thanks to EasyAdmin.

Translations reside under `translations/`. Example English and French files
demonstrate localised article strings.

To run the project you need PHP and Composer installed:

```bash
composer install
php bin/console doctrine:database:create --if-not-exists
php bin/console doctrine:schema:update --force
symfony server:start
```
