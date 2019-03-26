<?php

/**
 * classe de Usuários
 */
class Usuario
{
  private $idusuario;
  private $deslogin;
  private $dessenha;
  private $dtcadastro;

  public function setIdusuario($idusuario)
  {
    $this->idusuario = $idusuario;
  }

  public function getIdusuario()
  {
    return $this->idusuario;
  }

  public function setDeslogin($deslogin)
  {
    $this->deslogin = $deslogin;
  }

  public function getDeslogin()
  {
    return $this->deslogin;
  }

  public function setDessenha($dessenha)
  {
    $this->dessenha = $dessenha;
  }

  public function getDessenha()
  {
    return $this->dessenha;
  }

  public function setDtcadastro($dtcadastro)
  {
    $this->dtcadastro = $dtcadastro;
  }

  public function getDtcadastro()
  {
    return $this->dtcadastro;
  }

  public function loadById($id)
  {
    $sql = new Sql();

    $result = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
      ":ID"=>$id
    ));

    if(count($result) > 0){
      $this->setData($result[0]);
    }
  }

  public static function search($deslogin)
  {
      $sql = new Sql();

      return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin",array(
        ':SEARCH' => "%".$deslogin."%"
      ));
  }

  public static function getList()
  {
    $sql = new Sql();

    return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin;");
  }

  public function login($deslogin, $dessenha)
  {
    $sql = new Sql();

    $result = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :DESLOGIN AND dessenha = :DESSENHA", array(
      ":DESLOGIN" => $deslogin,
      ":DESSENHA" => $dessenha
    ));

    if(count($result) > 0){

      $this->setData($result[0]);

    }else {
      throw new \Exception("Login e/ou senha inválidos!");

    }
  }

  public function setData($data)
  {
    $this->setIdusuario($data['idusuario']);
    $this->setDeslogin($data['deslogin']);
    $this->setDessenha($data['dessenha']);
    $this->setDtcadastro(new DateTime($data['dtcadastro']));
  }

  public function __construct($deslogin = "", $dessenha = "")
  {
    $this->setDeslogin($deslogin);
    $this->setDessenha($dessenha);
  }

  public function insert()
  {
    $sql = new Sql();

    $result = $sql->select("CALL sp_usuarios_insert(:DESLOGIN, :DESSENHA);", array(
      ':DESLOGIN' => $this->getDeslogin(),
      ':DESSENHA' => $this->getDessenha()
    ));

    // var_dump($result);

    if(count($result) > 0){
      $this->setData($result[0]);
    }
  }

  public function update($deslogin, $dessenha)
  {
    $this->setDeslogin($deslogin);
    $this->setDessenha($dessenha);

    $sql = new Sql();

    $sql->query("UPDATE tb_usuarios SET deslogin = :DESLOGIN, dessenha = :DESSENHA WHERE idusuario = :ID", array(
      ":DESLOGIN" => $this->getDeslogin(),
      ":DESSENHA" => $this->getDessenha(),
      ":ID" => $this->getIdusuario()
    ));
  }

  public function delete()
  {
    $sql = new Sql();

    $sql->query("DELETE FROM tb_usuarios WHERE idusuario = :ID", array(
      ":ID" => $this->getIdusuario()
    ));

    $this->setData(NULL);
  }

  public function __toString()
  {
    return json_encode(array(
      "idusuario"=>$this->getIdusuario(),
      "deslogin"=>$this->getDeslogin(),
      "dessenha"=>$this->getDessenha(),
      "dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:s")
    ));
  }

}
