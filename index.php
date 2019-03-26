<?php

require_once("config.php");

//Carregando usuarios pelo id
// $usuario = new Usuario();
//
// $usuario->loadById(3);
//
// echo $usuario;

// caregando um lista de ususrio
// $lista = Usuario::getList();
// echo json_encode($lista);

//Carregando usuarios buscando por login
// $search = Usuario::search("u");
// echo json_encode($search);

// Carregandoo Usuario pelo login e senha
// $root = new Usuario();
//
// $root->login("user2", "123");
//
// echo $root;

$aluno = new Usuario("aluno1", "321");

$aluno->insert();

echo $aluno;
