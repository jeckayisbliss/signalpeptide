<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MyConnection
 *
 * @author Paul
 */

abstract class DBConnection {

      //put your code here
      protected static $DB_Name;
      protected static $DB_Open;
      protected static $DB_Conn;

      protected function __construct($database, $hostname, $hostport, $username, $password) {
            self::$DB_Name = $database;
            //$hostname . ":" . $hostport //first param remove
            self::$DB_Conn = mysql_connect($hostname , $username, $password);
            if (!self::$DB_Conn) {
                  die('Critical Stop Error: Database Error<br />' . mysql_error());
            }
            $db_selected = mysql_select_db(self::$DB_Name, self::$DB_Conn);
            if (!$db_selected) {
                die ('Can\'t use db : ' .mysql_error());
            }
      }

      private function __clone() {

      }

      public function __destruct() {
//            mysql_close(self::$DB_Conn);  <-- commented out due to current shared-link close 'feature'.  If left in, causes a warning that this is not a valid link resource.
      }

}

?>
