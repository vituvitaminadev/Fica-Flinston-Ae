<?php

class Categorias{
	public $ID;
	public $ID_USUARIO;
	public $NOME;

	public function criarCategoria(){
		try{
			if ($_SESSION["id_usu"]) {
				$this->ID_USUARIO = $_SESSION["id_usu"][0][0];
				$this->NOME = $_POST["nomecat"];
				$bd = new Conexao();
				$con = $bd->conectar();
				$sql = $con->prepare("insert into categorias(id,id_usuario,nome) values(null,?,?);");
				$sql->execute(array(
					$this->ID_USUARIO,
					$this->NOME
				));
				if ($sql->rowCount() > 0) {
					header("location: cadcategoria.php");
				}
			}else{
				header("location: dashboard.php");
			}
		}catch(PDOException $msg){
			echo "Não foi possível adicionar a categoria. {$msg->getMessage()}";
		}
	}

	public function mostrarCategoria(){
    	try{
    		$this->ID_USUARIO = $_SESSION["id_usu"][0][0];
    		$nome = $this->NOME = "";

	  		$bd = new Conexao();
    		$con = $bd->conectar();
   			$sql = $con->prepare("select nome from categorias where id_usuario = ?;");
    		$sql->execute(array($this->ID_USUARIO));

    		if ($sql->rowCount() > 0) {
    			return $result = $sql->fetchAll();
    		}
    	}catch(PDOException $msg){
    		echo "Não foi possível mostrar o nome da categoria. {$msg->getMessage()}";
    	}
    }

    public function mostrarIdCat(){
    	try{
    		$this->ID_USUARIO = $_SESSION["id_usu"][0][0];
    		$id = $this->ID = "";

	  		$bd = new Conexao();
    		$con = $bd->conectar();
   			$sql = $con->prepare("select id from categorias where id_usuario = ?;");
    		$sql->execute(array($this->ID_USUARIO));

    		if ($sql->rowCount() > 0) {
    			return $result = $sql->fetchAll();
    		}
    	}catch(PDOException $msg){
    		echo "Não foi possível pegar o ID da categoria. {$msg->getMessage()}";
    	}
    }

    public function excluir($id){
    	try{
    		if (isset($id)) {
    			$this->ID = $id;

    			$bd = new Conexao();
                $con = $bd->conectar();
                $sql = $con->prepare("delete from categorias where id = ?");
                $sql->execute(array($this->ID));
                if ($sql->rowCount() > 0) {
                    header("location: cadcategoria.php");
                }
    		}else{
                header("location: dashboard.php");
            }
    	}catch(PDOException $msg){
    		echo "Não foi possível excluir a categoria. {$msg->getMessage()}";
    	}
    }

    public function alterar(){
        try{
            if(isset($_POST['trocar'])){
                $this->ID = $_GET["id"];
                $this->ID_USUARIO = $_SESSION["id_usu"];
                $this->NOME = $_POST["nomecat"];

                $bd = new Conexao();
                $con = $bd->conectar();
                $sql = $con->prepare("update categorias set nome = ? where id = ?");
                $sql->execute(array(
                    $this->NOME,
                    $this->ID
                ));
                if ($sql->rowCount() > 0) {
                    header("location: cadcategoria.php");
                }
            }else{
                header("location: dashboard.php");
            }
        }catch(PDOException $msg){
            echo "Não foi possível alterar a categoria. {$msg->getMessage()}";
        }
    }

    public function nomeCategoria($id){
    	try{
    		$this->ID = $_GET["id"];
    		$nome = $this->NOME = "";

	  		$bd = new Conexao();
    		$con = $bd->conectar();
   			$sql = $con->prepare("select nome from categorias where id = ?;");
    		$sql->execute(array($this->ID));

    		if ($sql->rowCount() > 0) {
    			return $result = $sql->fetchAll();
    		}
    	}catch(PDOException $msg){
    		echo "Não foi possível mostrar o nome da categoria. {$msg->getMessage()}";
    	}
    }

    public function nomeCategoriaMov(){
    	try{
    		$this->ID = $_SESSION["var_que_tem_o_id"];
    		$nome = $this->NOME = "";
    		$bd = new Conexao();
    		$con = $bd->conectar();
   			$sql = $con->prepare("select nome from categorias where id = ?;");
    		$sql->execute(array($this->ID));

    		if ($sql->rowCount() > 0) {
    			return $result = $sql->fetchAll();
    		}
    	}catch(PDOException $msg){
    		echo "Não foi possível mostrar o nome da categoria. {$msg->getMessage()}";
    	}
    }

    public function excluirCatMov($id){
    	try{
    		if (isset($id)) {
    			$this->ID = $id;

    			$bd = new Conexao();
                $con = $bd->conectar();
                $sql = $con->prepare("delete from movimentacoes where id_categoria = ?");
                $sql->execute(array($this->ID));
                if ($sql->rowCount() > 0) {
                    header("location: cadcategoria.php");
                }
    		}else{
                header("location: dashboard.php");
            }
    	}catch(PDOException $msg){
    		echo "Não foi possível excluir a categoria. {$msg->getMessage()}";
    	}
    }
}