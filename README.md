# Event and Event Dispatcher

This allows components to communicate with each other by dispatching events and listening to them.

## Installation

#### Library

```bash
git clone https://github.com/ntd1712/messenger.git
```

#### Composer

This can be installed with [Composer](https://getcomposer.org/doc/00-intro.md)

Define the following requirement in your `composer.json` file.

```json
{
    "require": {
        "chaos/messenger": "*"
    },

    "repositories": [
      {
        "type": "vcs",
        "url": "https://github.com/ntd1712/messenger"
      }
    ]
}
```

#### Usage

```php
<?php // For example, in Laravel

use Chaos\Support\Messenger\LaravelEventDispatcherAdapter;

$dispatcher = new LaravelEventDispatcherAdapter(app('events'));
$container['dispatcher'] = $dispatcher;
```
