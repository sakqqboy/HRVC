-- ============================================================
-- A8: Remove duplicate user accounts (test data duplicates)
-- Keeps: user linked to active employee (status IN 1,8), lowest userId on tie
-- Deletes: user_access, user_role, user rows for duplicates
-- Also trims trailing spaces from usernames
-- ============================================================

SET SESSION sql_mode = '';

-- Step 1: Build temp table of userIds to delete
CREATE TEMPORARY TABLE tmp_delete_users AS
SELECT u.userId
FROM user u
JOIN employee e ON e.employeeId = u.employeeId
WHERE TRIM(u.username) IN (
  SELECT TRIM(username) FROM user GROUP BY TRIM(username) HAVING COUNT(*) > 1
)
AND u.userId != (
  SELECT u2.userId FROM user u2
  JOIN employee e2 ON e2.employeeId = u2.employeeId
  WHERE TRIM(u2.username) = TRIM(u.username)
  ORDER BY CASE WHEN e2.status IN (1,8) THEN 0 ELSE 1 END, u2.userId ASC
  LIMIT 1
);

-- Preview (run SELECT before DELETE to verify)
-- SELECT userId FROM tmp_delete_users ORDER BY userId;

-- Step 2: Delete related records
DELETE FROM user_access WHERE userId IN (SELECT userId FROM tmp_delete_users);
DELETE FROM user_role   WHERE userId IN (SELECT userId FROM tmp_delete_users);
DELETE FROM user        WHERE userId IN (SELECT userId FROM tmp_delete_users);

DROP TEMPORARY TABLE tmp_delete_users;

-- Step 3: Trim trailing spaces in remaining usernames
UPDATE user SET username = TRIM(username) WHERE username != TRIM(username);

-- Step 4: Add unique constraint (was blocked before by duplicates)
ALTER TABLE user ADD UNIQUE KEY uk_username (username);
