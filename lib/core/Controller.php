<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Controller
 *
 * @author stackslabs
 */
class Controller {

    //put your code here

    protected $controllerName;
    protected $data;
    protected $noView = false;

    public function getControllerName() {
        return $this->controllerName;
    }

    public function setControllerName($controllerName) {
        $this->controllerName = $controllerName;
    }

    public function invokeFunction($actionInvoke) {

        if (is_file(APPATH . "/view/" . $this->getControllerName() . "/$actionInvoke.php")) {
            include_once APPATH . "/view/" . $this->getControllerName() . "/$actionInvoke.php";
            $this->renderComponents();
        } else {
            if (!$this->noView) {
                echo "/view/" . $this->getControllerName() . "/$actionInvoke.php view not found";
            }
        }
    }

    private function renderComponents() {
        //include all component's controller
        foreach (glob(APPATH . "/view/helper/*.php") as $filename) {

            include $filename;
        }
    }

    /**
     * This is to check if the user's login if not redirect to login function
     */
    public function islogin($redirect=true) {

        // check if the session data greather than zero
        if (count(UserSession::getInstance('admin')->all_userData()) > 0) {
            return true;
        } else {
            if ($redirect) {
                // redirect to login function
                redirect("admin", "login");
            } else {
                return false;
            }
        }
    }

}

?>
