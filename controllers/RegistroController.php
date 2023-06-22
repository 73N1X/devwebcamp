<?php

namespace Controllers;

use MVC\Router;
use Model\Paquete;
use Model\Usuario;
use Model\Registro;

class RegistroController {
    public static function crear(Router $router) {
        if(!isAuth()){
            header('Location: /');
        }
        $registro = Registro::where('usuario_id', $_SESSION['id']);
        if(isset($registro) && $registro->paquete_id === '3') {
            header('Location: /boleto?id=' . urldecode($registro->token));
        }

        $router->render('registro/crear', [
            'titulo' => 'Finalizar Registro'
        ]);
    }

    public static function gratis() {
            if($_SERVER['REQUEST_METHOD'] === 'POST') {
                if(!isAuth()){
                    header('Location: /login');
                }
                $registro = Registro::where('usuario_id', $_SESSION['id']);
                if(isset($registro) && $registro->paquete_id === '3') {
                    header('Location: /boleto?id=' . urldecode($registro->token));
                }
                $token =substr(md5(uniqid(rand(), true)), 0, 8);
                $datos = [
                    'paquete_id' => 3,
                    'pago_id' => '',
                    'token' => $token,
                    'usuario_id' => $_SESSION['id']
                ];
                $registro = new Registro($datos);
                $resultado = $registro->guardar();
                if($resultado) {
                    header('Location: /boleto?id=' . urldecode($registro->token));
                }
            }
        }

    public static function boleto(Router $router) {
        $id = $_GET['id'];
        if(!$id || !strlen($id) === 8) {
            header('Location: /');
        }
        $registro = Registro::where('token', $id);
        if(!$registro) {
            header('Location: /');
        }
        //Llenar las tablas de referencia
        $registro->usuario = Usuario::find($registro->usuario_id);
        $registro->paquete = Paquete::find($registro->paquete_id);
        

            $router->render('registro/boleto', [
                'titulo' => 'Asistencia a DevWebCamp!',
                'registro' => $registro,
            ]);
    }
}