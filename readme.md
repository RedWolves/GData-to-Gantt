## Google Spreadsheet to jQuery.Gantt

This is something I am currently patching together for fun.  I want to be able to create Gantt charts with jQuery.Gantt and have the data come from a Google Spreadsheet.

**This is still a work in progress**

### Setup

Copy `config.sample.php` to `config.php` and edit it to provide your credentials for Google Docs. _(Note, do not use this method to access other people's accounts. Google provides an authentication process for those users so you don't need to ask for their credentials.)_

`cp config.sample.php config.php`