<?php 
class AuthController extends AppController{
	public function login(){
		if (Input::hasPost("login","password")){
            $pwd = Load::model("usuario")->crearPassword(Input::post("password"));
            $usuario=Input::post("login");
 
            $auth = new Auth("model", "class: usuario", "usuario_nombre: $usuario", "usuario_password: $pwd");
            if ($auth->authenticate()) {
                Router::redirect("auth/welcome");
            } else {
                Flash::error("Usuario o contraseña inválidos!");
            }
        }
	}
	public function logout(){
		Auth::destroy_identity();
		Router::redirect("auth/bye");
	}
	public function welcome(){
		Flash::valid("Bienvenido");
	}
	public function bye(){
		Flash::valid("Sesión terminada!");
	}
}



 ?>
