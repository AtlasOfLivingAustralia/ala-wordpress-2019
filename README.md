# A Wordpress site by Pivotal Agency

## Installation

#### 1. Clone this repo
```bash
git clone <repo-url>
```

#### 2. Copy `.env.example` to `.env` and add your environment's settings
```bash
cp .env.example .env
```

#### 3. Import the DB

Once imported: scrub any sensitive data (eg. customer info, credit card tokens etc).

#### 4. Install dependencies (composer, npm)
```bash
composer install --ignore-platform-reqs
( cd web/app/themes/pvtl ; yarn )
( cd web/app/themes/pvtl ; yarn production )
```

---

## Local development

### Installation

Working in the [Pivotal Docker Dev environment](https://github.com/pvtl/docker-dev), you'll need to do the following:

- You'll need `DB_HOST=mysql` in your `.env`
- You'll need to create a symlink of `/public` to `/web` (`ln -s web public`)
- Your Hostname will need to be {website}__.pub.localhost__ (note the `.pub`)
- Enable Browsersync - `cp web/app/themes/pvtl/config-default.yml web/app/themes/pvtl/config.yml`
    - _Then update `BROWSERSYNC` > `url` to be your site's Wordpress URL_

### Theme Development

To compile theme assets, the following commands can be used from within the theme directory.

| Command | Description |
| --- | --- |
| `yarn dev` | Compiles/copies assets to /dist |
| `yarn watch` | Watches your directory and compiles/copies assets to /dist each time you press save on a SCSS or JS file. Uses LiveReload to automatically inject assets into any open browser. Note that it polls a live reload server on port 3000. |
| `yarn production` | Compiles/minifies/copies assets to /dist ready for production |
| `yarn lint-js` | Provides a report on your JS, against the code styleguide |

---

## Wordpress Plugins

Wordpress Plugins are managed through composer.

### Installing

- Visit [WP Packagist](https://wpackagist.org/)
- Find the plugin (eg. akismet)
- Copy the packagist name (eg. `wpackagist-plugin/plugin-name`) and run `composer require wpackagist-plugin/plugin-name`

### Updating

Simply update the plugin's version number (to the desired version) in `composer.json` and run `composer update`.

### Removing

Simply run `composer remove wpackagist-plugin/plugin-name`
