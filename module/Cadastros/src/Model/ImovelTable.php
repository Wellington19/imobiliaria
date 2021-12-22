<?php

namespace Cadastros\Model;

use Laminas\Db\TableGateway\TableGatewayInterface;

class ImovelTable
{
  private TableGatewayInterface $tableGateway;

  public function __construct(TableGatewayInterface $tableGateway)
  {
    $this->tableGateway = $tableGateway;
  }

  public function gravar(Imovel $imovel)
  {
    $set = $imovel->toArray();
    if (isset($set['matricula']) && !empty($set['matricula'])) {
      return $this->tableGateway->update($set, ['matricula' => $set['matricula']]);
    }
    $this->tableGateway->insert($set);
  }

  public function listar()
  {
    return $this->tableGateway->select();
  }

  public function apagar(int $matricula)
  {
    $this->tableGateway->delete(['matricula' => $matricula]);
  }

  public function apagarPorDescricao(string $descricao)
  {
    $this->tableGateway->delete(['descricao' => $descricao]);
  }

  public function buscar(int $matricula): Imovel
  {
    $imoveis = $this->tableGateway->select(['matricula' => $matricula]);
    if ($imoveis->count() != 0) {
      return $imoveis->current();
    }
    return new Imovel([]);
  }

  public function buscarPorDescricao($descricao): Imovel
  {
    $imoveis = $this->tableGateway->select(['descricao' => $descricao]);
    if ($imoveis->count() != 0) {
      return $imoveis->current();
    }
    return new Imovel([]);
  }
}
