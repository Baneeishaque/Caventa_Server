CREATE DEFINER=`vfmobo6d`@`localhost` PROCEDURE `get_work_overviews`(IN `given_sales_person_id` INT)
BEGIN
	
	DECLARE var_id INT;
	
	DECLARE done INT DEFAULT FALSE;
	DECLARE cur1 CURSOR FOR SELECT `works`.`id` FROM `works` WHERE `sales_person_id` = given_sales_person_id;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
	
	DROP TABLE IF EXISTS `work_overviews`;
	CREATE TEMPORARY TABLE IF NOT EXISTS `work_overviews` (
		`name` varchar(50) NOT NULL,
		`address` varchar(250) NOT NULL,
		`work_date` date NOT NULL,
		`total_advance` double DEFAULT NULL,
		`total_expense` double DEFAULT NULL
	) ENGINE=MyISAM DEFAULT CHARSET=latin1;

	OPEN cur1;
	
	read_loop: LOOP
		
		FETCH cur1 INTO var_id;
		
		IF done THEN
		  LEAVE read_loop;
		END IF;
		
		INSERT INTO `work_overviews`(`name`, `address`, `work_date`, `total_advance`, `total_expense`)
		SELECT `work_overview`.`name`,`work_overview`.`address`,`work_overview`.`work_date`,`work_overview`.`total_advance`,`work_overview`.`total_expense` FROM
			( SELECT * FROM 
				( SELECT `name`, `address`, `work_date`,`works`.`id` FROM `works` 
					WHERE `id` =var_id ) AS `works`
			JOIN
				( SELECT * FROM 
					( SELECT SUM( `work_advances`.`amount` ) AS total_advance,`work_advances`.`work_id` FROM `work_advances`
						WHERE  `work_advances`.`work_id`=var_id ) as `work_advances_sum`

				JOIN 
					( SELECT SUM( `work_expenses`.`amount` ) AS total_expense,`work_expenses`.`work_id` AS `expense_work_id` FROM `work_expenses` 
						WHERE `work_expenses`.`work_id`=var_id ) as `work_expenses_sum` ) 
			AS `work_advances_expenses_sum` ) 
		AS `work_overview`;
		
	END LOOP;
	
	CLOSE cur1;
	
	SELECT `name`, `address`, `work_date`, `total_advance`, `total_expense` FROM `work_overviews`;

END