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
( cd web/app/themes/pvtl; yarn )
```

---

## Local development

### Installation

Working in the [Pivotal Docker Dev environment](https://github.com/pvtl/docker-dev), you'll need to do the following:

- You'll need `DB_HOST=mysql` in your `.env`
- You'll need to create a symlink of `/public` to `/web` (`ln -s web public`)
- Your Hostname will need to be {website}__.pub.localhost__ (note the `.pub`)


## Developing With NPM, Gulp, SASS and Browser Sync

### Running

From the `pvtl` theme directory: to work and compile your Sass files on the fly start:

- `$ gulp watch`

Or, to run with Browser-Sync:

- First change the browser-sync options to reflect your environment in the file `/gulpconfig.json` in the beginning of the file:
```javascript
  "browserSyncOptions" : {
    "proxy": "localhost/wordpress/",
    "notify": false
  }
};
```
- then run: `$ gulp watch-bs`

[1] Visit [https://browsersync.io/](https://browsersync.io/) for more information on Browser Sync

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

---

### Gutenburg (w/ ACF) Blocks

#### Basics

- All blocks must __reside in__ `/template-parts/blocks`
- Blocks are a (PHP) Class __made up of__:
    - Config (eg. it's name, icon for backend, description etc)
    - A render method, which outputs HTML on the front-end (and a basic layout in the Gutenburg editor)
- Blocks are __automatically registered__, based on the fact that they live in the blocks directory and contain what they need to (i.e. config, render method) in the correct format
- A Block gets __fields__ from the ACF Pro plugin. After registering a plugin (by simply creating a correctly formatted block file), you must then create a new ACF Field Group, add the fields you need and assign that field group to the Block registered

#### Requirements

- Blocks are built with ACF Pro, so require the ACF Pro plugin v5.8.0+ (installed and activated)
- Block file names (and Gutenburg blocks) must ONLY start with a letter (eg. NOT a number)
- Your Block's Class name and file name must match (file name in dash-case and class name in CamelCase)
    - eg. a filename of `hero-banner.php` must have the class name of `HeroBanner`
