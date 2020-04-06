---
title: Installation
description: Installing Watchdog
extends: _layouts.documentation
section: content
---

# Installation

Before you get started, Watchdog requires the following:

| Requirements |
| --- |
| Laravel >= 6.0 |
| PHP >= 7.2 |
| PHP LDAP Extension Enabled |
| An LDAP server (Active Directory, OpenLDAP, FreeIPA etc.) |

Watchdog uses [Composer](https://getcomposer.org/) for installation.

Once you have composer installed, run the following command in the root directory of your project:

```text
composer require directorytree/watchdog
```

Then, publish Watchdog's configuration file:

```text
php artisan vendor:publish --provider="DirectoryTree\Watchdog\WatchdogServiceProvider"
```

Migrations are loaded automatically, so simply run migrations to create its required database tables:

```text
php artisan migrate
```