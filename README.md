# Tooling for the scrum process

A tool to query the Github API for estimates in a given sprint.

## Usage

````sh
$ ./bin/runner points -s closed "easybib/issues" "Sprint 07 (2014-08-26)"
milestone;state;number;point
Sprint 07 (2014-08-26);closed;2006;0.25
Sprint 07 (2014-08-26);closed;1999;0.5
Sprint 07 (2014-08-26);closed;1998;1
Sprint 07 (2014-08-26);closed;1997;0.5
Sprint 07 (2014-08-26);closed;1981;0.5
Sprint 07 (2014-08-26);closed;1970;0.25
Sprint 07 (2014-08-26);closed;1966;0.25
Sprint 07 (2014-08-26);closed;1935;0.5
Sprint 07 (2014-08-26);closed;1913;0.5
Sprint 07 (2014-08-26);closed;1908;0.5
Sprint 07 (2014-08-26);closed;1907;2
Sprint 07 (2014-08-26);closed;1857;0.5
```

```
$ ./bin/runner points -s open "easybib/issues" "Sprint 07 (2014-08-26)"
milestone;state;number;point
Sprint 07 (2014-08-26);open;2043;1
Sprint 07 (2014-08-26);open;2010;1
Sprint 07 (2014-08-26);open;2009;0.5
Sprint 07 (2014-08-26);open;2008;3
Sprint 07 (2014-08-26);open;1969;2
Sprint 07 (2014-08-26);open;1938;0.25
Sprint 07 (2014-08-26);open;1898;2
Sprint 07 (2014-08-26);open;1887;0.25
Sprint 07 (2014-08-26);open;1550;1
Sprint 07 (2014-08-26);open;483;2
```

## Setup

 1. git clone this repository
 2. Run: `./composer.phar install`
 3. Create [a personal Github token](https://github.com/settings/tokens/new) with repo scope ![](https://www.dropbox.com/s/r68ba4t1x5hx3co/Screenshot%202014-09-04%2019.00.26.png?dl=1)
 4. Create `etc/config.php` from `etc/config.php-dist` and paste the token in there
 5. See Usage to run this
 6. Do something in Excel or Google Drive

