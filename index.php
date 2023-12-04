<?php
require_once "controller/routesController.php";
require_once "controller/userController.php";
require_once "controller/loginController.php";
require_once "model/userModel.php";

header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
header('Access-Control-Allow-Headers: Authorization');
$rutasArray = explode("/",$_SERVER['REQUEST_URI']);
$endPoint = (array_filter($rutasArray)[2]);
// var_dump($_SERVER['PHP_AUTH_USER']); //captura el usuario
// var_dump($_SERVER['PHP_AUTH_PW']); //captura la password

// if ($endPoint!='login') {
//     if (isset($_SERVER['PHP_AUTH_USER']) && (isset($_SERVER['PHP_AUTH_PW']))) {
//         $ok = false;
//         $identifier = $_SERVER['PHP_AUTH_USER'];
//         $key = $_SERVER['PHP_AUTH_PW'];
//         $users = UserModel::getUserAuth(); 
//         foreach($users as $u){
//             if ($identifier. ":".$key == $u["us_identifier"].":".$u["us_key"]) {
//                 $ok=true;
//             }
//         }
//         if($ok){
//             $routes = new RoutesController();
//             $routes->index();
//         }else{
//             $result["mensaje"] = "USTED NO TIENE ACCESO";
//             echo json_encode($result,true);
//             return;
//         }
//     }else{
//         $result["mensaje"] = "ERROR EN CREDENCIALES";
//         echo json_encode($result,true);
//         return;
//     } 
// }else{
//     $routes = new RoutesController();
//     $routes->index();
// }
$routes = new RoutesController();
$routes->index();
?>