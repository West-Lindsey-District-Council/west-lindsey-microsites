# LocalGov Drupal Microsites Composer project template

This project template provides a starter kit for managing your LocalGov Drupal Microsites dependencies with [Composer](https://getcomposer.org/).

## Usage

First you need to [install Composer](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx).

After that you can create the project:

```shell
composer create-project --stability beta localgovdrupal/localgov_microsites_project:^4.0@beta MY_PROJECT  --no-install
```

## Using Lando

If using Lando, you can then boot up Lando and run the site install

```shell
cd MY_PROJECT
lando start
lando composer install
lando drush si localgov_microsites
```

## Not using Lando

If you're not using lando, you'll still need to run the composer install.

```shell
cd MY_PROJECT
composer install
drush si localgov_microsites
```

## Running PHPUnit tests in Lando

The included phpunit.xml.dist file contains configuration for automatically
running the LocalGov Drupal test suite.

The default .lando.dist.xml includes environment variables for:

```bash
BROWSERTEST_OUTPUT_DIRECTORY: '/app/web/sites/simpletest/browser_output'
BROWSERTEST_OUTPUT_BASE_URL: 'https://localgov-micro.lndo.site'
```

To allow html output, manually create a directory for browser output.

```bash
mkdir web/sites/simpletest/browser_output
```

To run all LocalGov Drupal tests from Lando:

```bash
lando ssh
phpunit
```

To run all the tests for a specific module:

```bash
lando ssh
phpunit web/modules/contrib/localgov_my_module
```

Tests can be filtered using the `--filter` option. To only run a specific test:

```bash
lando ssh
phpunit --filter=myTestName
```


## Running PHPUnit tests in DDEV

The included phpunit.xml.dist file contains configuration for automatically
running the LocalGov Drupal test suite.

The default .ddev/config.yml includes configuration for some extra domains that
ddev and phpunit will need to resolve different microsite domains.

When ddev starts, it will attempt to write these to /etc/hosts

If DDEV cannot write to /etc/hosts, you may need to add these manually.

If you are having problems runnign phpunit tests in DDEV, try adding the
following to `/etc/hosts`

```
127.0.0.1 group-1.web group-2.web group-3.web group-4.web group-5.web
```

To allow html output, manually create a directory for browser output.

```bash
mkdir web/sites/simpletest/browser_output
```

To run all LocalGov Drupal tests from inside DDEV:

```bash
ddev ssh
phpunit
```

To run all the tests for a specific module:

```bash
ddev ssh
phpunit web/modules/contrib/localgov_my_module
```

Tests can be filtered using the `--filter` option. To only run a specific test:

```bash
ddev ssh
phpunit --filter=myTestName
```


## Maintainers

This project is currently maintained by:

 - Ekes: https://www.drupal.org/u/ekes
 - Finn Lewis: https://www.drupal.org/u/finn-lewis
 - Stephen Cox: https://www.drupal.org/u/stephen-cox
#   w l _ m i c r o s i t e s  
 