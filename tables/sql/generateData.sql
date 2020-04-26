# MIDN 2/C Kim m213474, Lonetti m213990, Polmatier m215294

# {1}

/* contains the SQL statements to insert at least two rows */
INSERT INTO auth_user (alpha, firstName, lastName)
  VALUES ("m213474", "Sam", "Kim"),
  ("m213990", "Jess", "Lonetti"),
  ("m215294", "Greg", "Polmatier");

INSERT INTO auth_session (id, alpha)
  VALUES ("id1", "m213474"),
  ("id2", "m213990"),
  ("id3", "m215294");

INSERT INTO auth_access VALUES
  (213474, 1),
  (213990, 1),
  (215294, 1);

INSERT INTO courses VALUES
  ("EM300", "Principles of Propulsion"),
  ("IT360", "Applied Database Systems");

INSERT INTO student_courses VALUES
  (213474, "IT360"),
  (213990, "IT360"),
  (215294, "IT360"),
  (213474, "EM300");

INSERT INTO assignments (courseCode, assignmentDate)
  VALUES ("IT360", NOW()),
  ("EM300", NOW());
