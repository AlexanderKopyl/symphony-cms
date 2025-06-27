# symphony-cms

This example uses **Symfony 7.3**, the latest minor version at the time of
writing. It demonstrates Onion architecture with Domain, Application,
Infrastructure and Controller layers.

## Structure

```
src/
    ArticleDomain/
    UserDomain/
    SharedKernel/
    Application/
    Infrastructure/
    Controller/
```

- **ArticleDomain** and **UserDomain** hold entities and repository interfaces.
- **SharedKernel** provides common utilities like slug generation and UUIDs.
- **Application** contains use cases.
- **Infrastructure** provides concrete implementations.
- **Controller** exposes HTTP endpoints.

## Example

The route `/articles` returns a JSON list of article titles using an in-memory repository.
The route `/users` returns a JSON list of usernames from an in-memory repository.

API Platform exposes entities under `/api`, enabling JSON-LD HAL output for the `Article` resource.
EasyAdmin provides an example admin dashboard at `/admin`.

To run the project you need PHP and Composer installed:

```bash
composer install
symfony server:start
```
