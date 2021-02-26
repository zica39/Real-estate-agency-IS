<?php
 /**
 * Get a connection from database
 * @param type $db_host database hostname
 * @param type $db_user database username
 * @param type $db_password database password
 * @param type $db_name database name
 * @return \PDO
 */
 function get_db_connection($db_host, $db_user, $db_password, $db_name)
{
    $dns = "mysql:host=$db_host;dbname=$db_name";
    try
    {
        return new PDO($dns, $db_user, $db_password);
    } catch (PDOException $ex)
    {
        return null;
    }
}

/**
 * Runs SQL queries from file
 */

 function exec_sql_queries_from_file($script_file, $db_host, $db_user, $db_password, $db_name)
{
    // to increase the default PHP execution time
    set_time_limit ( 60 ); // Max time = 60 seconds

    // Connect to database
    $connection = get_db_connection($db_host, $db_user, $db_password, $db_name);

    // If the connection is acquired
    if($connection != null){

        // Open sql file
        $f = fopen($script_file, 'r');

        // sql query
        $query = '';

        // Default delimiter for queries
        $delimiter = ';';

        // read line by line
        while (!feof($f))
        {           
            $line = str_replace(PHP_EOL, '', fgets($f)); // read a line and remove the end of line character

            /* if the current line contains the key word 'DELIMITER'. Ex: DELIMITER ;; or DELIMITER $$
             * mostly used for TRIGGERS' queries
             */
            if(strpos($line, 'DELIMITER') !== false)
            {
                // change the delimiter and read the next line
                $delimiter = str_replace('DELIMITER ', '', $line);
                continue;
            }   

            // Consider the line as part of a query if it's not empty and it's not a comment line
            if (!empty($line) && !str_starts_with ($line, '/*') && !str_starts_with ($line, '--'))
            {
                // the query hasn't reach its end: concatenate $line to $query if $line is not a delimiter
                $query .= $line !== $delimiter ? $line : '';

                // if the current line ends with $delimiter: end of current query
                if (str_ends_with($line, $delimiter))
                {                
                    // exec the query
                    $connection->exec($query) or die($connection->errorInfo());
                    // start new query
                    $query = '';
                }
            }                    
        }

        fclose($f);
    }
}
?>