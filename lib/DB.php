<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DB
 *
 * @author Paul
 */

require_once 'DBConnection.php';
require_once 'config.php';

final class DB extends DBConnection {

      public static function Open($database = DB_NAME, $hostname = DB_HOST, $hostport = DB_PORT, $username = DB_USER, $password = DB_PASS) {
            if (!self::$DB_Open) {
                  self::$DB_Open = new self($database, $hostname, $hostport, $username, $password);
            } else {
                  self::$DB_Open = null;
                  self::$DB_Open = new self($database, $hostname, $hostport, $username, $password);
            }
            return self::$DB_Open;
      }

      public function qry($sql, $return_format = 0) {
            $query = mysql_query($sql, self::$DB_Conn) OR die(mysql_error());
            switch ($return_format) {
                   
                  case 4:
                        $query = mysql_fetch_assoc($query);
                        return $query;
                        break;
                    
                  case 1:
                        $query = mysql_fetch_row($query);
                        return $query;
                        break;
                  case 2:
                        $query = mysql_fetch_array($query);
                        return $query;
                        break;
                  case 3:
                        $query = mysql_fetch_row($query);
                        $query = $query[0];
                        return $query;

                  default:
                        return $query;
            }
      }

}

?>
