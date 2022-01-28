# JH Block Logger

## Installation
This module is installable via `Composer`.

## Add repository

```
"repositories": [
    {
        "type": "vcs",
        "url": "git@github.com:WeareJH/m2-module-jh-block-logger.git"
    }
]
```

### via composer CLI

```
$ cd project-root
$ ./composer.phar require "wearejh/m2-module-jh-block-logger:dev-master"
```

### adding to dev dependencies in composer.json

```json
    "require-dev": {
        "wearejh/m2-module-jh-block-logger": "dev-master"
    }
```

## Using the module

This module will instrument the output HTML with meta data, so you should only enable it during development.

```
./bin/magento module:enable Jh_BlockLogger
./bin/magento setup:upgrade
```

Now when you load any pages they will contain meta data about block & containers. 

## Integration tests

Module is dev feature and its output shouldn't be visible in integration tests. In order to
disable it for integration tests add following instruction to install-config-mysql.php:

```
'disable-modules'   => implode(
        ',',
        [
            'Jh_BlockLogger'
        ]
    ),
```


## Use it with M2 Dev Tools Chrome/Firefox Extension

With this module enabled, you'll get access to all the M2 Dev Tools features.

