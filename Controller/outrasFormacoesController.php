<?php
if (!isset($_SESSION)) {
    session_start();
}
class OutrasFormacoesController
{
    public function inserir($inicio, $fim, $descricao, $idusuario)
    {
        require_once '../Model/OutrasFormacoes.php';
        $outrasform = new OutrasFormacoes();
        $outrasform->setInicio($inicio);
        $outrasform->setFim($fim);
        $outrasform->setDescricao($descricao);
        $outrasform->setIdUsuario($idusuario);
        $o = $outrasform->inserirBD();
        return $o;
    }

    public function remover($id)
    {
        require_once '../Model/OutrasFormacoes.php';
        $outrasform = new OutrasFormacoes();
        $o = $outrasform->excluirBD($id);
        return $o;
    }

    public function gerarLista($idusuario)
    {
        require_once '../Model/ExperienciaProf.php';
        $expP = new ExperienciaProf();
        return $results = $expP->listaExperiencias($idusuario);
    }
}
