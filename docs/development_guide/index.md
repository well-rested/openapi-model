# Development Guide

## Prerequisites

Before you start, you'll need the following installed on your machine:

- **Docker** — all PHP tooling runs inside a container, so this is the only hard requirement
- **Node.js >= 24.13.1 / npm >= 11.8.0** — optional, only needed for commit linting; older versions will still work but will produce a warning

Run the following to verify your environment meets the requirements:

```sh
make verify
```

This checks that Docker is present and warns if your Node/npm versions are below the recommended minimums.

---

## Getting Started

Run the one-time setup command to build the image, register the git hooks, and copy the default `phpunit.xml`:

```sh
make init
```

This runs the following steps in order:

1. `make verify` — checks prerequisites
2. `make setup-githooks` — points git's hooks directory at `.githooks/`
3. `make copy-phpunit-xml` — copies `phpunit.xml.dist` to `phpunit.xml` if it doesn't already exist
4. `make build` — builds the Docker image

---

## Dev Container

A [Dev Container](https://containers.dev/) configuration is provided at [.devcontainer/devcontainer.json](.devcontainer/devcontainer.json). This targets VS Code (and any other editor with Dev Containers support) and uses the same `Dockerfile` as the Makefile targets, so the environment is identical.

The container mounts the workspace at `/srv` and runs as `root`. The following VS Code extensions are pre-installed:

| Extension | Purpose |
|---|---|
| `bmewburn.vscode-intelephense-client` | PHP language server |
| `SanderRonde.phpstan-vscode` | Inline PHPStan errors |
| `MehediDracula.php-namespace-resolver` | Auto-import/resolve namespaces |
| `emallin.phpunit` | Run PHPUnit tests from the editor |
| `ms-azuretools.vscode-containers` | Docker management |
| `eamodio.gitlens` | Git history/blame |
| `Anthropic.claude-code` | Claude Code CLI |

---

## Docker

The [Dockerfile](Dockerfile) builds a `php:8.4-cli` image with the `pcov` extension for coverage. Composer is installed via [scripts/install_composer.sh](scripts/install_composer.sh).

All Makefile targets that run PHP tooling mount the current directory into the container at `/srv`, so you never need to install PHP locally.

```sh
make build   # (Re)build the image
make exec    # Open an interactive shell inside the container
```

---

## Running Tests

```sh
make test
```

This runs `composer test` inside the container, which maps to:

```sh
./vendor/bin/phpunit --no-coverage
```

Coverage variants are also available via Composer scripts directly (inside the container via `make exec`):

| Command | Description |
|---|---|
| `composer coverage` | Print coverage summary to the terminal |
| `composer coverage-html` | Generate an HTML report to `docs/coverage/` |
| `composer coverage-check` | Assert minimum coverage threshold |
| `composer coverage-badge` | Write a JSON badge file |

---

## Code Style — PHP CS Fixer

Code style is enforced by [PHP CS Fixer](https://cs.symfony.com/), configured in [.php-cs-fixer.php](.php-cs-fixer.php).

The ruleset extends **PER-CS** (PHP Extended Recommendation Coding Style) with the following additions:

- Tabs for indentation
- `declare(strict_types=1)` enforced on every file (risky rule)
- Unused `use` imports removed (risky rule)
- Global namespace imports auto-added for classes, constants, and functions
- Trailing whitespace removed; single blank line at EOF
- Extra blank lines removed after `throw`, `return`, `use`, `break`, etc.
- One blank line separating class properties, constants, and methods

To **auto-fix** style issues:

```sh
make csfix
```

To perform a **dry-run** (check only, no changes):

```sh
composer csfix-dry-run   # inside the container
```

The dry-run is also included in `make lint`.

---

## Static Analysis — PHPStan

[PHPStan](https://phpstan.org/) is configured in [phpstan.neon](phpstan.neon) and runs at **level 10** (the strictest level) against the `src/` directory.

```sh
# inside the container (make exec)
composer stan
```

Level 10 enforces strict checks including strict return types, strict property access, and strict generics. PHPStan also runs as part of `make lint`.

---

## Linting (Combined Check)

To run both the CS Fixer dry-run and PHPStan in one step:

```sh
make lint
```

This is what CI runs. It does **not** modify files — use `make csfix` if you want to auto-fix style issues.

---

## Git Hooks

Git hooks live in [.githooks/](.githooks/) and are activated by `make setup-githooks` (which `make init` calls automatically). This sets `core.hooksPath` to `.githooks/` locally so the hooks are picked up by git.

### `pre-commit`

The pre-commit hook runs [.githooks/pre-commit](.githooks/pre-commit) before every commit. It:

1. Collects all staged files (Added, Copied, Modified)
2. Runs `make csfix-hook` — this executes PHP CS Fixer inside Docker in non-interactive mode
3. Re-stages all originally staged files so any fixes made by CS Fixer are included in the commit automatically

This means your commits will always conform to the code style rules without you needing to run `make csfix` manually.

!!! note
    `csfix-hook` uses a non-interactive Docker run (no `-it` flag) since git hooks don't have a TTY.

---

## Commit Messages — commitlint

Commit messages are linted against the [Conventional Commits](https://www.conventionalcommits.org/) specification using [commitlint](https://commitlint.io/). The config is in [commitlint.config.js](commitlint.config.js).

### Format

```
<type>(<optional scope>): <short description>

<body — required, 80 chars max per line>

<footer — optional, 80 chars max per line>
```

### Allowed Types

| Type | When to use |
|---|---|
| `feat` | A new feature |
| `fix` | A bug fix |
| `docs` | Documentation changes only |
| `test` | Adding or updating tests |
| `refactor` | Code change that neither fixes a bug nor adds a feature |
| `style` | Formatting, whitespace — no logic changes |
| `perf` | Performance improvement |
| `build` | Build system or dependency changes |
| `ci` | CI configuration changes |
| `chore` | Routine tasks, maintenance |
| `revert` | Reverting a previous commit |

### Rules enforced

- **Subject line** must be <= 80 characters; no leading/trailing whitespace
- **Body** is required and must not be empty; blank line between subject and body; 80 chars max per line
- **Footer** (if present) must be preceded by a blank line; 80 chars max per line

### Checking your last commit

```sh
make lint-last-commit
```

This runs `npx commitlint --last` against the most recent commit on the current branch. It requires Node/npm to be installed.

---

## Makefile Reference

| Target | Description |
|---|---|
| `make init` | One-time setup: verify, hooks, phpunit.xml, build |
| `make build` | Build the Docker image |
| `make exec` | Open an interactive shell in the container |
| `make test` | Run the PHPUnit test suite |
| `make lint` | CS Fixer dry-run + PHPStan |
| `make csfix` | Auto-fix code style issues |
| `make verify` | Check Docker and Node/npm prerequisites |
| `make setup-githooks` | Register `.githooks/` with git |
| `make lint-last-commit` | Lint the most recent commit message |
| `make mkdocs-up` | Start the documentation server |
| `make mkdocs-down` | Stop the documentation server |

*[< Back](../)*