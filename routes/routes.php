<?php
$rutasArray = explode("/",$_SERVER['REQUEST_URI']);
$inputs = array();
$inputs['raw_inputs'] = @file_get_contents('php://input');
$_POST = json_decode($inputs['raw_inputs'],true);

if (count(array_filter($rutasArray))<2) {
    $json = array(
        "ruta" => "not found"
    );
    echo json_encode($json,true);
    return;
}else{
    //Endpoint correctos
    $endPoint = (array_filter($rutasArray)[2]);
    $complement = (array_key_exists(3,$rutasArray)) ? ($rutasArray)[3] : 0;
    $add = (array_key_exists(4,$rutasArray)) ? ($rutasArray)[4] : "";
    if($add != ""){
        $complement .= "/" . $add; // Si $add no esta vacia se guarda el complement se adicion un "/" y se adiciona lo de la variable $add
    } 
    $method = $_SERVER['REQUEST_METHOD'];
    switch ($endPoint) {
        case 'create':
            if (isset($_POST)) {
                $user =  new UserController($method,$complement,$_POST);
            }else{
                $user =  new UserController($method,$complement,0);
            }
            $user->index();
            return;
        case 'login':
            if (isset($_POST) && $method == 'POST') {
                $user = new loginController($method, $_POST);
                $user->index();
            }else{
                $json = array(
                    "ruta" => "not found",
                );
                echo json_encode($json,true);
                return;
            }
        case 'update':
            if (isset($_POST)) {
                if (!empty($_POST['use_id'])) {
                    $user = new UserController($method, $complement, $_POST);
                    $updatedUser = UserModel::updateUser($_POST['use_id'], $_POST);
                    $json = array(
                        "response:" => $updatedUser
                    );
                    echo json_encode($json, true);
                }
            } else {
                $json = array(
                    "ruta:" => "not found"
                );
                echo json_encode($json, true);
            }
            return;
        case 'delete':
            if (isset($_POST)) {
                if (!empty($_POST['use_id'])) {
                    $user = new UserController($method, $complement, $_POST);
                    $deletedUser = UserModel::deleteUser($_POST['use_id']);
                    $json = array(
                        "response:" => $deletedUser
                    );
                    echo json_encode($json, true);
                } else {
                    $json = array(
                        "response:" => "ID del usuario no proporcionado para la eliminación."
                    );
                    echo json_encode($json, true);
                }
            } else {
                $json = array(
                    "response:" => "Datos de usuario no proporcionados para la eliminación."
                );
                echo json_encode($json, true);
            }
            return;
        case 'authorize':
            if (isset($_POST)) {
                if (!empty($_POST['use_id'])) {
                    $user = new UserController($method, $complement, $_POST);
                    $authorizedUser = UserModel::authorizeUser($_POST['use_id']);
                    $json = array(
                        "response:" => $authorizedUser
                    );
                    echo json_encode($json, true);
                    } else {
                        $json = array(
                            "response:" => "ID del usuario no proporcionado para la autorización."
                        );
                    echo json_encode($json, true);
                    }
            } else {
                $json = array(
                    "response:" => "Datos de usuario no proporcionados para la autorización."
                );
                echo json_encode($json, true);
            }
            return;
        default:
            $json = array(
                "ruta" => "not found",
            );
            echo json_encode($json,true);
            return;
    }
}
?>