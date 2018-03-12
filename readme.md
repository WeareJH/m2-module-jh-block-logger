# JH Block Logger

## Installation
This module is installable via `Composer`.

```
$ cd project-root
$ ./composer.phar require "wearejh/m2-module-jh-block-logger:dev-master"
```

Note: As these repositories are currently private and not available via a public package list like [Packagist](https://packagist.org/) Or [Firegento](http://packages.firegento.com") you need to add the repository to the projects `composer.json` before you require the project.

```
"repositories": [
    {
        "type": "vcs",
        "url": "git@github.com:WeareJH/m2-module-jh-block-logger.git"
    }
]
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

