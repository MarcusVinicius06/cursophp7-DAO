<?php

/**
 * classe de Usuários
 */
class Usuario
{
  private $idusuario;
  private $deslogin;
  private $dessenha;
  private $dtcastro;

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

  public function setDtcastro($dtcastro)
  {
    $this->dtcastro = $dtcastro;
  }

  public function getDtcastro()
  {
    return $this->dtcastro;
  }

  public function loadById($id)
  {
    $sql = new Sql();

    $result = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
      ":ID"=>$id
    ));

    if(count($result) > 0){
      $row = $result[0];

      $this->setIdusuario($row['idusuario']);
      $this->setDeslogin($row['deslogin']);
      $this->setDessenha($row['dessenha']);
      $this->setDtcastro(new DateTime($row['dtcadastro']));

    }
  }

  public function __toString()
  {
    return json_encode(array(
      "idusuario"=>$this->getIdusuario(),
      "deslogin"=>$this->getDeslogin(),
      "dessenha"=>$this->getDessenha(),
      "dtcastro"=>$this->getDtcastro()->format("d/m/Y H:s")
    ));
  }

}
