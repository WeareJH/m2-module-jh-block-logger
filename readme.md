# JH Block Logger

## Installation
This module is installable via `Composer`.

- via composer CLI
```
$ cd project-root
$ ./composer.phar require "wearejh/m2-module-jh-block-logger:dev-master"
```

- adding to dev dependencies in composer.json
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

## Use it with M2 Dev Tools Chrome/Firefox Extension

With this module enabled, you'll get access to all the M2 Dev Tools features.

