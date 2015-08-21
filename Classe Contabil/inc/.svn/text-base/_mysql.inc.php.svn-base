<?php

    class Driver_mysql
    {
        function connect($params)
        {
                 //echo "PARAMS[0]" = $params[0];
                 //echo "PARAMS[0] = $params[0]";
                 //echo $params[1];
                 //host, user, password
                 $id = mysql_connect(current($params),next($params),next($params))
                       or die("Falha na conexao...");
                 //dbname
                 mysql_select_db(next($params)) or die("Falha na conexao com o banco...");
                 return $id;
        }

        function disconnect($conn)
        {
                 return mysql_close($conn);
        }

        function query($sql, $driver)
        {
                 $dbresult = mysql_query($sql);
                 return new ResultSet($dbresult, $driver);
        }

        function fetch_row($resultset)
        {
                 return mysql_fetch_row($resultset->dbresult);
        }

        function fetch_rows(&$resultset, $fline, $nlines)
        {
                 $res = array();
                 $lastrow = $nlines + $fline - 1;
                 $i = $fline;
                 if (mysql_num_rows($resultset->dbresult))
                    mysql_data_seek($resultset->dbresult, $fline);
                 while ($row = $this->fetch_row ($resultset))
                 {
                         if (($i >= $fline) and ($i <= $lastrow))
                            $res[] = $row;
                         else
                            break;

                         $i++;
                 }
                 return $res;
        }

        function fetch_array($resultset)
        {
                 return mysql_fetch_array($resultset->dbresult);
        }

        function fetch_arrays(&$resultset, $fline, $nlines)
        {
                 $res = array();
                 $lastrow = $nlines + $fline - 1;
                 $i = $fline;
                 mysql_data_seek($resultset->dbresult, $fline);
                 while ($row = $this->fetch_array ($resultset))
                 {
                         if (($i >= $fline) and ($i <= $lastrow))
                            $res[] = $row;
                         else
                            break;
                         $i++;
                 }
                 return $res;
        }

        function num_fields($resultset)
        {
                 return mysql_num_fields($resultset->dbresult);
        }

        function field_name($resultset,$index)
        {
                 return mysql_field_name($resultset->dbresult,$index);
        }


        function num_rows($resultset)
        {
                 return mysql_num_rows($resultset->dbresult);
        }

        function field_size($resultset, $index)
        {
                 return mysql_field_len($resultset->dbresult, $index);
        }

        function execute($sql)
        {
                 /*$dbresult = mysql_query($sql);
                 if ($dbresult && mysql_affected_rows())
                 {
                         return true;
                 }
                 else
                 {
                         return false;
                 }*/
                 return mysql_query($sql);
        }

        function free_result($resultset)
        {
                 return mysql_free_result($resultset->dbresult);
        }

        function seek($resultset, $pos = 0)
        {
                 mysql_data_seek($resultset->dbresult, $pos);
                 return mysql_fetch_array($resultset->dbresult);
        }
    }
?>