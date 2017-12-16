CREATE DEFINER=`vfmobo6d`@`localhost` FUNCTION `get_work_profit`(`given_work_id` INT) RETURNS float
BEGIN
  DECLARE advances FLOAT;
  DECLARE expenses FLOAT;
  
  SELECT SUM(amount) INTO advances FROM work_advances WHERE work_id=given_work_id;
  SELECT SUM(amount) INTO expenses FROM work_expenses WHERE work_id=given_work_id;
  
  RETURN (advances-expenses);
END