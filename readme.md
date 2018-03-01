# JH Block Logger

## Installation
This module is installable via `Composer`.

```
$ cd project-root
$ ./composer.phar require "wearejh/m2-module-block-logger"
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

Just enable it, then clear caches and look in the console/element inspector.
