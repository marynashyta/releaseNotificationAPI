# Release Notification API

A monolithic PHP service that lets users subscribe to GitHub repository release notifications via email.

## How it works

1. A user subscribes with their email and a GitHub repository (`owner/repo`).
2. The service validates the repository exists via the GitHub API, then saves a pending subscription and sends a confirmation email.
3. Once the user clicks the confirmation link, the subscription becomes active and the current latest release tag is stored as `last_seen_tag` — preventing notifications for releases that already existed at subscription time.
4. A background scanner runs every 5 minutes, fetches the latest release for each active subscription, and sends an email when a new tag is detected.
5. Every notification email contains a one-click unsubscribe link.

## Prerequisites

- Docker and Docker Compose

## Quick start

```bash
cp .env.example .env
docker compose up --build
```

The API is available at `http://localhost:8080`.  
The Mailpit email UI is at `http://localhost:8025`.

## API reference

See [swagger.yaml](swagger.yaml) for the full contract. Quick summary:

| Method | Path | Description |
|--------|------|-------------|
| `POST` | `/api/subscribe` | Subscribe an email to a repository |
| `GET` | `/api/confirm/{token}` | Confirm a pending subscription |
| `GET` | `/api/unsubscribe/{token}` | Unsubscribe |
| `GET` | `/api/subscriptions?email=` | List confirmed subscriptions for an email |
| `GET` | `/metrics` | Prometheus metrics (always public) |

### Subscribe

```bash
curl -X POST http://localhost:8080/api/subscribe \
  -H "Content-Type: application/json" \
  -d '{"email": "you@example.com", "repo": "owner/repo"}'
```

### List subscriptions

```bash
curl "http://localhost:8080/api/subscriptions?email=you@example.com"
```

## GitHub rate limiting

The scanner handles `429 Too Many Requests` responses from GitHub gracefully — it reads the `Retry-After` header and sleeps for that duration before continuing. GitHub API responses are also cached in Redis with a 10-minute TTL, significantly reducing the number of outbound requests.

Without a `GITHUB_TOKEN` the limit is 60 requests/hour. With a token it is 5 000/hour.

## Running tests

```bash
docker compose run --rm api php vendor/bin/phpunit
```

Or locally if PHP 8.2+ and Composer are installed:

```bash
composer install
php vendor/bin/phpunit
```

## CI

GitHub Actions runs on every push:

1. **Lint** — PHPStan level 9 static analysis
2. **Test** — PHPUnit test suite
3. **Build** — Docker image build + Trivy vulnerability scan (runs only when lint and tests pass)
