# haproxy-log-parser

I got tired of trying to parse/understand haproxy logs by referring to the documentation and thought something like this could be helpful

Installation:
- Download repo and run composer
- Set up webserver to point to [project root]/public/index.php
- Visit http://[vhost]/

Running tests:
- Go to project root
- ./vendor/bin/behat --config tests/behat/behat.yml && ./vendor/bin/phpspec r --config tests/phpspec/phpspec.yml
