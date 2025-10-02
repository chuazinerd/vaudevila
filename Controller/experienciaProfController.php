<?php
if (!isset($_SESSION)) {
    session_start();
}
class ExperienciaProfController
{
    public function inserir($inicio, $fim, $empresa, $descricao, $idusuario)
    {
        require_once '../Model/ExperienciaProf.php';
        $experiencia = new ExperienciaProf();
        $experiencia->setInicio($inicio);
        $experiencia->setFim($fim);
        $experiencia->setEmpresa($empresa);
        $experiencia->setDescricao($descricao);
        $experiencia->setIdUsuario($idusuario);
        $e = $experiencia->inserirBD();
        return $e;
    }

    public function remover($id)
    {
        require_once '../Model/ExperienciaProf.php';
        $experiencia = new ExperienciaProf();
        $e = $experiencia->excluirBD($id);
        return $e;
    }

    public function gerarLista($idusuario)
    {
        require_once '../Model/experienciaProf.php';
        $experiencia = new ExperienciaProf();
        return $results = $experiencia->listaExperiencias($idusuario);
    }
}
