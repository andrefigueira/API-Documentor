API-Documentor
==============

New version of API Documentor.

Licence
==============

http://creativecommons.org/licenses/by/3.0/

Requirements
==============

* PHP 5.3+
* MySQL database with InnoDB

Installation
==============

* Copy the contents into a directory of your website
* Create a new database and copy the details into ´lib/config.php´
* Run the MySQL queries in ´install.sql´
* Get started!

Usage
==============

Essentially this is just a custom CMS, so, Not all APIS run the same way and having a generator can never be as robust as 
something you can manually edit yourself. However a straight up CMS doesn't exactly work unless you customise it heavily and make it take a 
whole bunch of custom fields... So this is a custom CMS for those of you who need to document your APIS.

There is still a bunch of things I want to work on, so I will be updating this periodically.

Improvements TODO:
==============

1- Make sure that there is no duplicated code, CUD is kind of repetitive, so need to eliminate that by making
something that will run for all.

2- I want to add a testing platform using cURL perhaps a Terminal style command line for running calls in browser with shortcuts.

Enjoy!