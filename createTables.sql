# MIDN 2/C Kim m213474, Lonetti m213990, Polmatier m215294

# {1}

/* create table statements needed to create the tables */
/* list all functional dependencies as comments  */
DROP TABLE IF EXISTS auth_user;
CREATE TABLE auth_user(
  alpha INT NOT NULL,
  hash VARCHAR(250) NOT NULL,
  firstName VARCHAR(250) NULL,
  lastName VARCHAR (250) NULL,
  session TEXT NULL,
  lastLogin TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT PK_auth_user PRIMARY KEY (alpha)
);
/* alpha -> (hash, first, last, sessionText, lastLogin) */

DROP TABLE IF EXISTS auth_session;
CREATE TABLE auth_session(
  id VARCHAR(96) NOT NULL,
  alpha INT NOT NULL,
  lastVisit TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT PK_auth_session PRIMARY KEY (id, alpha),
  CONSTRAINT FK_auth_session_alpha FOREIGN KEY(alpha)
    REFERENCES auth_user (alpha)
    ON DELETE CASCADE ON UPDATE CASCADE
);
/* (id, alpha) -> lastVisit */

DROP TABLE IF EXISTS auth_access;
CREATE TABLE auth_access(
  alpha INT NOT NULL,
  value INT NOT NULL,
  CONSTRAINT PK_auth_access PRIMARY KEY (alpha, value),
  CONSTRAINT FK_auth_access_alpha FOREIGN KEY(alpha)
   REFERENCES auth_user (alpha)
   ON DELETE CASCADE ON UPDATE CASCADE
);
/* identifier contains all columns in table */

DROP TABLE IF EXISTS courses;
CREATE TABLE courses(
  courseCode VARCHAR(10) NOT NULL,
  courseTitle VARCHAR(100) NULL,
  CONSTRAINT PK_courses PRIMARY KEY (courseCode)
);
/* courseCode -> courseTitle */

DROP TABLE IF EXISTS student_courses;
CREATE TABLE student_courses(
  alpha INT NOT NULL,
  courseCode VARCHAR(10) NOT NULL,
  CONSTRAINT PK_student_courses PRIMARY KEY (alpha, courseCode),
  CONSTRAINT FK_student_courses_student FOREIGN KEY(alpha)
   REFERENCES auth_user (alpha)
   ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT FK_student_courses_courses FOREIGN KEY(courseCode)
   REFERENCES courses (courseCode)
   ON DELETE CASCADE ON UPDATE CASCADE
);
/* identifier contains all columns in table */

DROP TABLE IF EXISTS assignments;
CREATE TABLE assignments(
  assignmentID INT NOT NULL,
  courseCode VARCHAR(10) NOT NULL,
  assignmentDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  notes TEXT NULL,
  CONSTRAINT PK_assignments PRIMARY KEY (assignmentID, courseCode),
  CONSTRAINT FK_assignments_courses FOREIGN KEY(courseCode)
   REFERENCES courses (courseCode)
   ON DELETE CASCADE ON UPDATE CASCADE
);
/* (assignmentID, courseCode) -> (assignmentDate, notes) */
