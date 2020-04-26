# Master Calendar

The following outlines both the technical and user stipulations of the *Master Calendar*, a website that consolidates course calendars for the CS/IT student at the United States Naval Academy.

Created by Samuel Kim, Jess Lonetti, and Gregory Polmatier.

## Contributors

A list of the team members involved in the project and their contributions is outlined below.

### Gregory Polmatier

Gregory was considered 'Team Lead' which involved managing deadlines for milestones and version control through *github*. In terms of code Gregory implemented the *insertAccess()* trigger that sets a default entry in our *auth_access* table upon an insert into the *auth_user* table. Finally, Gregory was responsible for the styling involved in the website to include both the bootstrap and css files. It should be noted that most of the bootstrap and css files are borrowed from the USNA course calendar template created by Jeff Kenney.

Files created/worked on:
* README.md
* triggers.sql
* home.php
* login.php
* bootstrap/css files integrated
* ProjectReport.md

### Samuel Kim

Samuel Kim's contribution was vital for the website functionality as he was mainly responsible for database creation and the login capability. Sam handled the create table statements as well the files that are required for the login function. Sam also developed the form that allows users to insert the courses they take. Finally, the website's functionality was mainly tested by Sam.

Files created/worked on:
* createTables.sql
* dropTables.sql
* generateData.sql
* Master Calendar ER Model.pdf
* auth.inc.php
* lib_authenticate.php
* login.php
* home.php

### Jess Lonetti

Jess Lonetti implemented the meat of the project in the form of the actual scraping of individual course websites and consolidating the information into usable tables to which we could display to the user. Jess also created our own implementation of the course calendar that would contain all of the student's information.

Files created/worked on:
* ...

## Example Users

Our website is unique in the fact that we implemented USNA authentication. This means that anyone with academy credentials can access the website. Therefore, we do not have example users as that would require divulging real passwords.

## Technical Report
