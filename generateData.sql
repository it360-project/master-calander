# MIDN 2/C Kim m213474, Lonetti m213990, Polmatier m215294

# {1}

/* contains the SQL statements to insert at least two rows */

INSERT INTO auth_user (alpha, hash, firstName, lastName)
  VALUES (213474, "hash1", "Sam", "Kim"),
  (213990, "hash2", "Jess", "Lonetti"),
  (215294, "hash3", "Greg", "Polmatier");

INSERT INTO auth_session (id, alpha)
  VALUES ("id1", 213474),
  ("id2", 213990),
  ("id3", 215294);

INSERT INTO auth_access VALUES
  (213474, "admin", "1"),
  (213990, "admin", "1"),
  (215294, "admin", "1");

INSERT INTO courses VALUES
  ("EM300", "Principles of Propulsion"),
  ("IT360", "Applied Database Systems");

INSERT INTO student_courses VALUES
  (213474, "IT360"),
  (213990, "IT360"),
  (215294, "IT360"),
  (213474, "EM300");

INSERT INTO assignments (assignmentID, courseCode)
  VALUES (0, "IT360"),
  (5, "EM300");
