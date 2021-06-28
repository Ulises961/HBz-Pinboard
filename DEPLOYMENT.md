
# Requirements 
* PostgreSQL
* PHP version > 7.3 
* Apache Server

# Installation

* Clone the master branch to your local repository.
* Create a database named hbz using PostgreSQL.

* List the source folder HBz as publicly available by the Apache server. Alternatively place HBz in the Apache web-root folder. 
For further reference please visit http://httpd.apache.org/docs/2.4/getting-started.html

# Population of the database

## Linux
Import the outfile into postgres to populate the database using the following command
```
user$: psql -U user
postgres=# create database hbz;
postgres=# \q
user$: psql hbz < outfile
```
(Alternatively follow instructions for Windows which also work for Linux)
## Windows and MacOS

### Requirements

* [BeautifulSoup](https://pypi.org/project/BeautifulSoup/) library for Pyton
* Python3
* [psycopg](https://pypi.org/project/psycopg2/) Python driver for Postgres

To populate the database use the Scraper in the following order:

* [SubjectScraper.py](Scraper/SubjectScraper.py)
* [ProfessorScraper.py](Scraper/ProfessorScraper.py)
