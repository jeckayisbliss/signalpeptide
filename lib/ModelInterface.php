<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Rico
 */
interface ModelInterface {
    //put your code here
    public function save();
    public function delete();
    public function update();
    public function findBy($condition = null, $limit=10, $offset=0);

}
?>
