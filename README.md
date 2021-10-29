
# Symfony blog

A small Symfony application (Symfony 5.3) composed of an API and a frontend developed with the Twig template engine.

The posts and authors are obtained from the external API https://jsonplaceholder.typicode.com


## API Reference

#### Get all posts

```http
  GET /api/posts
```

#### Get a post

```http
  GET /api/posts/${id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `integer` | **Required**. Id of post to fetch |

#### Get the post author

```http
  GET /api/posts/${id}/author
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `integer` | **Required**. Id of post from which fetch the author |

#### Get all authors

```http
  GET /api/authors
```

#### Get an author

```http
  GET /api/authors/${id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `integer` | **Required**. Id of author to fetch |


## Frontend Reference

#### Get all posts

```http
  GET /
```

```http
  GET /posts
```

#### Get a post with its author

```http
  GET /posts/${id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `integer` | **Required**. Id of post to fetch |



## Usage/Examples

A docker-compose.yml has been prepared with an nginx and a docker image of php 7.4.

For the first run

```bash
docker-compose up -d
docker-compose exec php composer install
```

The following executions will only require the first command.
## Running Tests

To run tests, run the following command having the containers running.

```bash
    docker-compose exec php bin/phpunit
```

