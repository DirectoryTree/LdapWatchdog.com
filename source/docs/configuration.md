---
title: Configuring Watchdog
description: Configuring Watchdogs features
extends: _layouts.documentation
section: content
---

# Configuration

- [Watchers](#watchers)
  - [Notification Channels](#notification-channels)
  - [Disabling Notifications](#disabling-notifications)
- [Scan Frequency](#scan-frequency)
- [Notifications](#notifications)
  - [Mail]()
  - [Seconds Between]()
- [Date Options]()
  - [Timezone]()
  - [Format]()
- [Attributes]()
  - [Transformers]()
  - [Ignoring Attributes]()

## Introduction

Watchdog's configuration file various settings for each feature.

This guide will explain each configuration option in-depth.

## Watchers {#watchers}

Watchers in Watchdog are setup inside of the `watch` key in the `config/watchdog.php` file:

```php
'watch' => [
    \LdapRecord\Models\ActiveDirectory\Entry::class => [
        \DirectoryTree\Watchdog\Dogs\WatchGroupMembers::class => ['mail'],
        // ...
    ],
],
```

Each **key** inside of this array must be an [LdapRecord](https://ldaprecord.com/docs/models) model.

The **value** of the above key must be an array of [Watchdogs](docs/dogs/), along with their notification channels.

### Notification Channels {#notification-channels}

By default, only the `mail` notification channel is supported.

### Disabling Notifications {#disabling-notifications}

To disable the dispatch of notifications of a specific watchdog, simply remove the channels you do not 
want the watchdog to send notifications to:

> Removing the notification channels **does not** disable the watchdog from tracking the notifications
> it generates. It simply won't send the notification once watchdogs conditions pass.

```php
\DirectoryTree\Watchdog\Dogs\WatchGroupMembers::class => [],
```

## Scan Frequency {#scan-frequency}

The `frequency` option is how often Watchdog must wait before being allowed to start another scan:

```php
'frequency' => env('WATCHDOG_SCAN_FREQUENCY', 5),
```

## Notifications

Watchdog sends emails to the configured recipient located inside the configuration file:
 
```php
'notifications' => [

    'mail' => [
        'to' => [env('WATCHDOG_NOTIFICATION_EMAIL', 'your@email.com')],
    ],

    // ...
],
```
 
Paste the following in your `.env` to easily customize it:

```text
WATCHDOG_NOTIFICATION_EMAIL=your@email.com
```

Next is the `seconds_between_notifications` option:

```php
'notifications' => [
    //... 

    'seconds_between_notifications' => 5,
],
```

This option adds a delay to each notification job that is created, so emails aren't
sent too quickly -- which prevents the "Too many emails per second" SMTP error.

This is very useful if you have a large directory and many changes can be detected at the same time.

For example, if a scan is executed and 10 password changes are detected, this option will stagger each

## Date Options {#date-options}

```php
'date' => [

    'timezone' => env('WATCHDOG_DATE_TIMEZONE', 'UTC'),

    'format' => env('WATCHDOG_DATE_FORMAT', 'F jS, Y @ g:i A'),

],
```

## Attributes {#attributes}

```php
'transform' => [
    'objectsid'             => 'objectsid',
    'whenchanged'           => 'windows',
    'whencreated'           => 'windows',
    'dscorepropagationdata' => 'windows',
    'lastlogon'             => 'windows-int',
    'lastlogontimestamp'    => 'windows-int',
    'pwdlastset'            => 'windows-int',
    'lockouttime'           => 'windows-int',
    'accountexpires'        => 'windows-int',
    'badpasswordtime'       => 'windows-int',
],

'transformers' => [
    'objectsid'   => \DirectoryTree\Watchdog\Ldap\Transformers\ObjectSid::class,
    'windows'     => \DirectoryTree\Watchdog\Ldap\Transformers\WindowsTimestamp::class,
    'windows-int' => \DirectoryTree\Watchdog\Ldap\Transformers\WindowsIntTimestamp::class,
],

'ignore' => [
    'dscorepropagationdata',
],
```
