# business.phila.gov
Deployment repo for business.phila.gov


## Local setup

- [Install Vagrant](https://docs.vagrantup.com/v2/installation/)

- Clone this repo.
```
git clone git@github.com:CityOfPhiladelphia/phila.gov.git
```

- Initialize the virtual environment and log in:
```
$ vagrant up
$ vagrant ssh
```

Composer relies on our private repo. Add it to the global config with this command:
```
$ composer config -g repositories.private composer <repo_url>
```

Then install php components with composer:
```
$ composer install
```
