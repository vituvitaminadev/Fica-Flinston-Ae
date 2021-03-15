<?php
require_once "Conexao.php";

class Usuarios{
	public $ID;
	public $USUARIO;
	public $SENHA;
	public $EMAIL;
	public $SALDO;
	

	public function inserir(){
		try{
			if (isset($_POST["email"]) && isset($_POST["senha"])) {
					$this->USUARIO = $_POST["usuario"];
					$this->EMAIL = $_POST["email"];
					$this->SENHA = $_POST["senha"];
					$this->SALDO = 0;
					$bd = new Conexao();
					$con = $bd->conectar();
					$sql = $con->prepare("insert into usuarios(id,usuario,senha,email,saldo) values(null,?,?,?,?);");
					$sql->execute(array(
						$this->USUARIO,
						$this->SENHA,
						$this->EMAIL,
						$this->SALDO
					));
					if ($sql->rowCount() > 0) {
						header("location: index.php");
					}
				}else{
					header("location: registrar.php");
				}
			}catch(PDOException $msg){
			echo "Não foi possível criar o usuario. {$msg->getMessage()}";
		}
	}


	public function login(){
		try{
			if(isset($_POST["email"]) && isset($_POST["senha"])){
				session_start();
				$this->EMAIL = $_POST["email"];
				$this->SENHA = $_POST["senha"];
				$id = $_SESSION["id_usu"][0][0];

				$bd = new Conexao();
				$con = $bd->conectar();
				$sql = $con->prepare("select * from usuarios where email = ? and senha = ?;");
				$sql->execute(array($this->EMAIL, $this->SENHA));

				if ($sql->rowCount() > 0) {
					header("location: dashboard.php");
				}else{
					header("location: index.php");
				}
			}else{
				header("location: index.php");
			}
		}
		catch(PDOException $msg){
			echo "Não foi possível efetuar o login. {$msg->getMessage()}";
		}
	}

	public function listarID(){
        try{
            if (isset($_POST["email"])) {
            	$this->EMAIL = $_POST["email"];
				$this->SENHA = $_POST["senha"];
                $this->ID = "";

                $bd = new Conexao();
                $con = $bd->conectar();
                $sql = $con->prepare("select ID from usuarios where email = ? and senha = ?;");
                $sql->execute(array($this->EMAIL,
                	$this->SENHA));

                if ($sql->rowCount() > 0) {
                    return $result = $sql->fetchAll();
                }
            }
        }catch(PDOException $msg){
            echo "Não foi possível listar o usuário. {$msg->getMessage()}";
        }
    }

    public function mostrarSaldo(){
    	try{
    		$this->ID = $_SESSION["id_usu"][0][0];
    		$saldo = $this->SALDO = 0;

	  		$bd = new Conexao();
    		$con = $bd->conectar();
   			$sql = $con->prepare("select saldo from usuarios where id = ?;");
    		$sql->execute(array($this->ID));

    		if ($sql->rowCount() > 0) {
    			return $result = $sql->fetchAll();
    		}
    	}catch(PDOException $msg){
    		echo "Não foi possível pegar o saldo do usuário. {$msg->getMessage()}";
    	}
    }

    public function mostrarNome(){
    	try{
    		$this->ID = $_SESSION["id_usu"][0][0];
    		$nome = $this->USUARIO = "";

	  		$bd = new Conexao();
    		$con = $bd->conectar();
   			$sql = $con->prepare("select usuario from usuarios where id = ?;");
    		$sql->execute(array($this->ID));

    		if ($sql->rowCount() > 0) {
    			return $result = $sql->fetchAll();
    		}
    	}catch(PDOException $msg){
    		echo "Não foi possível pegar o saldo do usuário. {$msg->getMessage()}";
    	}
    }

    public function alterarSaldo(){
		try{
			$this->ID = $_SESSION["id_usu"][0][0];
			$this->SALDO = $_SESSION["mandaprobanco"];

			$bd = new Conexao();
	    	$con = $bd->conectar();
	    	$sql = $con->prepare("update usuarios set saldo = ? where id = ?;");
		    $sql->execute(array(
			  	$this->SALDO,
				$this->ID
	 		));

		    if ($sql->rowCount() > 0) {
		    	header("location: entradas.php");
		   	}else{
		   		header("location: dashboard.php");
		   	}
		}catch(PDOException $msg){
			echo "Não foi possível alterar o saldo. {$msg->getMessage()}";
		}
	}

	public function alterarSaldoG(){
		try{
			$this->ID = $_SESSION["id_usu"][0][0];
			$this->SALDO = $_SESSION["mandaprobanco"];

			$bd = new Conexao();
	    	$con = $bd->conectar();
	    	$sql = $con->prepare("update usuarios set saldo = ? where id = ?;");
		    $sql->execute(array(
			  	$this->SALDO,
				$this->ID
	 		));

		    if ($sql->rowCount() > 0) {
		    	header("location: entradas.php");
		   	}else{
		   		header("location: dashboard.php");
		   	}
		}catch(PDOException $msg){
			echo "Não foi possível alterar o saldo. {$msg->getMessage()}";
		}
	}

	public function excluirMov($id){
		try{
			if (isset($id)) {
				$this->ID = $id;

				$bd = new Conexao();
                $con = $bd->conectar();
                $sql = $con->prepare("delete from movimentacoes where id_usuario = ?");
                $sql->execute(array($this->ID));
                if ($sql->rowCount() > 0) {
                    header("location: index.php");
                }
			}else{
				header("location: dashboard.php");
			}
		}catch(PDOException $msg){
			echo "Não foi possível excluir o usuário. {$msg->getMessage()}";
		}
	}

	public function excluirCat($id){
		try{
			if (isset($id)) {
				$this->ID = $id;

				$bd = new Conexao();
                $con = $bd->conectar();
                $sql = $con->prepare("delete from categorias where id_usuario = ?");
                $sql->execute(array($this->ID));
                if ($sql->rowCount() > 0) {
                    header("location: index.php");
                }
			}else{
				header("location: dashboard.php");
			}
		}catch(PDOException $msg){
			echo "Não foi possível excluir o usuário. {$msg->getMessage()}";
		}
	}

	public function excluirUsu($id){
		try{
			if (isset($id)) {
				$this->ID = $id;

				$bd = new Conexao();
                $con = $bd->conectar();
                $sql = $con->prepare("delete from usuarios where id = ?");
                $sql->execute(array($this->ID));
                if ($sql->rowCount() > 0) {
                    header("location: index.php");
                }
			}else{
				header("location: dashboard.php");
			}
		}catch(PDOException $msg){
			echo "Não foi possível excluir o usuário. {$msg->getMessage()}";
		}
	}
}