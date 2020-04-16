/*
Trigger that inserts a default access level into auth_access when a user
is inserted into auth_user.

Master Calander group - IT360

Gregory Polmatier
*/

DROP TRIGGER IF EXISTS insertAccess;

DELIMITER $$
CREATE TRIGGER insertAccess AFTER INSERT ON auth_user
  FOR EACH ROW
  BEGIN

    INSERT INTO auth_access (alpha, value)
      VALUES (NEW.alpha, 1);

  END;
$$
DELIMITER ;
