<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDatesToMysqlForms extends Migration
{
   /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         DB::unprepared('DROP PROCEDURE IF EXISTS insert_data_into_temporary_form_table;'
                . "CREATE DEFINER=`root`@`%` PROCEDURE `insert_data_into_temporary_form_table`(IN table__name VARCHAR(500),IN form_key_value VARCHAR(500), IN list_of_fields VARCHAR(65535),IN start_date date, IN end_date date)
BEGIN
DECLARE field,field_value,input_values VARCHAR(65535);
DECLARE form_data_id,previous_value INT(10) UNSIGNED;
DECLARE created_at TIMESTAMP;
DECLARE done INT DEFAULT FALSE;
DECLARE key_cursor CURSOR FOR SELECT * FROM vw_form_submission;
DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
DROP VIEW IF EXISTS vw_form_submission;
SET @select = concat('CREATE VIEW vw_form_submission AS SELECT a.field,a.value, a.form_data_id, a.created_at FROM form_submission AS a WHERE a.form_data_id IN (SELECT b.id FROM form_submission_keys AS b WHERE b.form_id = (SELECT c.id FROM form AS c WHERE `form_key`= \"',form_key_value,'\")) AND a.field IN ', REPLACE(list_of_fields,'`','\"') ,' ORDER BY a.form_data_id,a.field');
    PREPARE stm FROM @select;
    EXECUTE stm;
    DEALLOCATE PREPARE stm;


OPEN key_cursor;
FETCH key_cursor INTO field,field_value,previous_value,created_at;
-- SET INITIAL VALUE OF INPUT
SET input_values = CONCAT('(','\"',previous_value, '\"',',','\"',created_at,'\"',',','\"',field_value,'\"');
-- Loop through all values pulled and form them into insertable lists
read_loop: LOOP
	FETCH key_cursor INTO field,field_value,form_data_id,created_at;
    IF done THEN
		LEAVE read_loop;
	ELSE
		IF form_data_id != previous_value THEN
			SET input_values = CONCAT(input_values, ')',',(','\"',form_data_id, '\"',',','\"',created_at,'\"',',');
            SET input_values = CONCAT(input_values,'\"',field_value,'\"');
            SET previous_value = form_data_id;
        ELSE
			SET input_values = CONCAT(input_values,',','\"',field_value,'\"');
		END IF;
    END IF;
END LOOP;
SET input_values = CONCAT(input_values,')');
IF input_values IS NOT NULL THEN
    SET @stmt = CONCAT('INSERT INTO ', table__name, ' ', list_of_fields, ' VALUES '  , input_values);
    PREPARE statement FROM @stmt;
    EXECUTE statement;
    DEALLOCATE prepare statement;
END IF;
DROP VIEW vw_form_submission;
SELECT * FROM temp WHERE created_at >= start_date AND created_at <= end_date;
CLOSE key_cursor;
END");
         
           DB::unprepared('DROP PROCEDURE IF EXISTS create_temporary_form_table;'
                . "CREATE DEFINER=`root`@`%` PROCEDURE `create_temporary_form_table`(IN form_key_value VARCHAR(33),IN start_date date, IN end_date date)
BEGIN
DECLARE a VARCHAR(65535);
DECLARE done INT DEFAULT FALSE;
DECLARE key_cursor CURSOR FOR SELECT `key` FROM form_keys WHERE form_id IN (SELECT id FROM form WHERE `form_key`= form_key_value) ORDER BY `key`;
DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
SET @stmt = '';
SET @list_of_fields = '';
OPEN key_cursor;
DROP TEMPORARY TABLE IF EXISTS temp;
CREATE TEMPORARY TABLE IF NOT EXISTS temp(id INTEGER, created_at TIMESTAMP);

read_loop: LOOP
	FETCH key_cursor INTO a;
    
    IF done THEN
		LEAVE read_loop;
	ELSE
		IF @list_of_fields = '' THEN
			SET @list_of_fields = CONCAT('(','`id`',',','`created_at`,','`',a,'`'); 
        ELSE 
			SET @list_of_fields = CONCAT(@list_of_fields,',`',a,'`'); 
        END IF;
		SET @stmt = CONCAT('ALTER TABLE temp ADD ', a  , ' VARCHAR(500)');
		PREPARE statement FROM @stmt;
		EXECUTE statement;
        DEALLOCATE prepare statement;
    END IF;
END LOOP;

SET @list_of_fields = CONCAT(@list_of_fields,')');

CALL insert_data_into_temporary_form_table('temp',form_key_value, @list_of_fields,start_date,end_date);
-- SELECT * FROM temp;
CLOSE key_cursor;
DROP TEMPORARY TABLE temp;
END");
         
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS create_temporary_form_table;DROP PROCEDURE IF EXISTS insert_data_into_temporary_form_table;");
    }
}
