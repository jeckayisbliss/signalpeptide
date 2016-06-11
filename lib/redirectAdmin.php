<?php
include_once 'config.php';

// This set the default controller to invoke
if (!isset($redirect)) {
    $redirect = "User";
}


// This contain the path of controller and action to invoke
if (isset($_SERVER['PATH_INFO'])) {
    $PATHINFO = explode('/', substr($_SERVER['PATH_INFO'], 1));
    if($PATHINFO[0] == "") {
        $PATHINFO = array($redirect);
        if (isset($action)) {
            $PATHINFO[] = $action;
        }
    }
} else {
    $PATHINFO = array($redirect);
    if (isset($action)) {
        $PATHINFO[] = $action;
    }
}

//include all core platform's
foreach (glob(APPATH."/lib/core/*.php") as $filename)
{
    include $filename;
}

$libs = array( "DBConnection.php","DB.php",  "ModelInterface.php", "Model.php", 'Component.php');

//include all lib's
foreach ($libs as $filename)
{
    
    include APPATH."/lib/".$filename;
}

//include all helper's
foreach (glob(APPATH."/helper/*.php") as $filename)
{   
    include $filename;
}

//include all models's
foreach (glob(APPATH."/model/*.php") as $filename)
{   
    include $filename;
}

//include all controller's
foreach (glob(APPATH."/controller/admin/*.php") as $filename)
{   
  
    include $filename;
}

//include all component's
foreach (glob(APPATH."/controller/component/*.php") as $filename)
{   
  
    include $filename;
}



//redirection is taken in place here
$controllerName = ucfirst($PATHINFO[0])."Controller";
if(is_file(APPATH."/controller/admin/$controllerName.php")) {
    $controller = new $controllerName();
   
    if(isset ($PATHINFO[1])) {
        $actionInvoke = $PATHINFO[1];
        if(method_exists($controllerName, $actionInvoke)){
           
            $controller->$actionInvoke();
            $controller->invokeFunction($actionInvoke);
            
        }else{ 
            echo "Page not found";
        }
    }
}else{
    echo "Page not found";
   
}

//include all component's controller
foreach (glob(APPATH."/view/helper/*.php") as $filename)
{   
  
    include $filename;
}

?>