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

Samuel Kim's contribution was vital for the website functionality as he was mainly responsible for database creation and the login capability. Sam handled the create table statements as well the files that are required for the login function. Sam also developed the form that allows users to insert the courses students take upon logging in to the site for the first time. Finally, the website's functionality was mainly tested by Sam, by hosting the site on his account.

Files created/worked on:
* createTables.sql
* dropTables.sql
* generateData.sql
* Master Calendar ER Model.pdf
* auth.inc.php
* lib_authenticate.php
* login.php
* home.php
* courseForm.php
* insertStudentCourses.php
* insertCourseCodes.php


### Jess Lonetti

Jess Lonetti implemented the meat of the project in the form of the actual scraping of individual course websites and consolidating the information into usable tables to which we could display to the user. Jess also created our own implementation of the course calendar that would contain all of the student's information.

Files created/worked on:
* calander_creator.php
* calander_retiever.php
* calander.js
* courseinsert.php
* Daysnatcher.php


## Example Users

Our website is unique in the fact that we implemented USNA authentication. This means that anyone with academy credentials can access the website. Therefore, we do not have example users as that would require divulging real passwords.

## Technical Report

The following is a technical report outlining the functionality of the Master Calendar website from a code perspective.

### Database

The database for Master Calendar is a simple, SQL based format consisting of two types of tables, those that handle login capability and those that maintain calendar information.

* [The Entity Relationship model](tables/projectERModel.pdf)
* [createTables.sql](tables/sql/createTables.sql)

For login, there are three tables: auth_user, auth_session, and auth_access. The auth_user table maintains all of the base information for a recurring user that can be tracked. The auth_session table maintains session information for a user so that the system can remember session information as required. Finally, the auth_access table implements a hierarchy of users.   

To handle the calendar system there are an additional three tables: courseCode, student_courses, and assignments. The courseCode table keeps a list of CS/IT courses that use the official Calendar template that students could take. Next, the student_courses table keeps track of which courses students are taking that have signed up. Finally, the assignments table contains the assignments from each individual CS/IT calendar and their respective date.

#### Trigger

The database also contains a trigger. The trigger is labeled *insertAccess()* and its role in the database is to insert a default entry into the auth_access table upon an insert into the auth_user table. This allows every new user to automatically have a default entry in the auth_access table.

* [triggers.sql](tables/sql/triggers.sql)


### Login/User Management

Our website is unique in that we utilize the USNA login in order to authenticate users. What this means is that instead of us maintaining passwords we decided to allow use the USNA system to handle it for us. Therefore in order to log onto the site a USNA account is required. The connection to the login system is facilitated in [lib_authenticate.php](login/lib_authenticate.php) okay
