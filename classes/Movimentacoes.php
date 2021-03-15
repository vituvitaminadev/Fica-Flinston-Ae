<?php
require_once "Conexao.php";
session_start();

class Movimentacoes{
	public $ID;
	public $ID_USUARIO;
	public $VALOR;
	public $TIPO;
	public $ID_CATEGORIA;
	public $DATA;

	public function Entrada(){
		try{
			if ($_SESSION["id_usu"]) {
				$this->ID_USUARIO = $_SESSION["id_usu"][0][0];
				$this->VALOR = $_POST["valorentrada"];
				$this->TIPO = 'R';
				$this->ID_CATEGORIA = $_POST["categoriaentrada"];
				$this->DATA = $_POST["dataentrada"];

				$bd = new Conexao();
				$con = $bd->conectar();
				$sql = $con->prepare("insert into movimentacoes(id,id_usuario,valor,tipo,id_categoria,data) values(null,?,?,?,?,?);");
				$sql->execute(array(
					$this->ID_USUARIO,
					$this->VALOR,
					$this->TIPO,
					$this->ID_CATEGORIA,
					$this->DATA
				));
				if ($sql->rowCount() > 0) {
					header("location: dashboard.php");
				}
				}else{
					header("location: index.php");
				}
			}catch(PDOException $msg){
			echo "Não foi possível adicionar a movimentação. {$msg->getMessage()}";
		}
	}

	public function mostrarEntrada(){
		try{
			$this->ID_USUARIO = $_SESSION["id_usu"][0][0];
			$mostraentrada = $this->VALOR = 0;
			$bd = new Conexao();
    		$con = $bd->conectar();
   			$sql = $con->prepare("select sum(valor) from movimentacoes where id_usuario = ? and tipo='R';");
    		$sql->execute(array($this->ID_USUARIO));

    		if ($sql->rowCount() > 0) {
    			return $result = $sql->fetchAll();
    		}
		}catch(PDOException $msg){
			echo "Não foi possível pegar o valor das entradas. {$msg->getMessage()}";
		}
	}

	public function Gastos(){
		try{
			if ($_SESSION["id_usu"]) {
				$this->ID_USUARIO = $_SESSION["id_usu"][0][0];
				$this->VALOR = $_POST["valorgasto"];
				$this->TIPO = 'D';
				$this->ID_CATEGORIA = $_POST["categoriagasto"];
				$this->DATA = $_POST["datagasto"];

				$bd = new Conexao();
				$con = $bd->conectar();
				$sql = $con->prepare("insert into movimentacoes(id,id_usuario,valor,tipo,id_categoria,data) values(null,?,?,?,?,?);");
				$sql->execute(array(
					$this->ID_USUARIO,
					$this->VALOR,
					$this->TIPO,
					$this->ID_CATEGORIA,
					$this->DATA
				));
				if ($sql->rowCount() > 0) {
					header("location: dashboard.php");
				}
				}else{
					header("location: index.php");
				}
			}catch(PDOException $msg){
			echo "Não foi possível adicionar a movimentação. {$msg->getMessage()}";
		}
	}

	public function mostrarGasto(){
		try{
			$this->ID_USUARIO = $_SESSION["id_usu"][0][0];
			$mostraentrada = $this->VALOR = 0;
			$bd = new Conexao();
    		$con = $bd->conectar();
   			$sql = $con->prepare("select sum(valor) from movimentacoes where id_usuario = ? and tipo='D';");
    		$sql->execute(array($this->ID_USUARIO));

    		if ($sql->rowCount() > 0) {
    			return $result = $sql->fetchAll();
    		}
		}catch(PDOException $msg){
			echo "Não foi possível pegar o valor das entradas. {$msg->getMessage()}";
		}
	}

	public function mostrarMovimentacao(){
    	try{
    		$this->ID_USUARIO = $_SESSION["id_usu"][0][0];
    		$valor = $this->VALOR = "";
    		$id_categoria = $this->ID_CATEGORIA = "";

	  		$bd = new Conexao();
    		$con = $bd->conectar();
   			$sql = $con->prepare("select valor from movimentacoes where id_usuario = ?;");
    		$sql->execute(array($this->ID_USUARIO));

    		if ($sql->rowCount() > 0) {
    			return $result = $sql->fetchAll();
    		}
    	}catch(PDOException $msg){
    		echo "Não foi possível mostrar o valor da movimentação. {$msg->getMessage()}";
    	}
    }

    public function mostrarData(){
    	try{
    		$this->ID_USUARIO = $_SESSION["id_usu"][0][0];
    		$data = $this->DATA = "";

	  		$bd = new Conexao();
    		$con = $bd->conectar();
   			$sql = $con->prepare("select data from movimentacoes where id_usuario = ?;");
    		$sql->execute(array($this->ID_USUARIO));

    		if ($sql->rowCount() > 0) {
    			return $result = $sql->fetchAll();
    		}
    	}catch(PDOException $msg){
    		echo "Não foi possível mostrar a data da movimentação. {$msg->getMessage()}";
    	}
    }

    public function teste(){
    	try{
    		$this->ID_USUARIO = $_SESSION["id_usu"][0][0];
    	$id_categoria = $this->ID_CATEGORIA = "";

    	$bd = new Conexao();
    		$con = $bd->conectar();
   			$sql = $con->prepare("select id_categoria from movimentacoes where id_usuario = ?;");
    		$sql->execute(array($this->ID_USUARIO));

    		if ($sql->rowCount() > 0) {
    			return $result = $sql->fetchAll();
    		}
    	}catch(PDOException $msg){
    		echo "Não foi possível mostrar a data da movimentação. {$msg->getMessage()}";
    	}
    }
}