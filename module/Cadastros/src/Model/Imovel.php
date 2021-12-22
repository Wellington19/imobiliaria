<?php

namespace Cadastros\Model;

use Application\Model\ModelInterface;

class Imovel implements ModelInterface
{
  public int $matricula;
  public string $descricao;
  public string $endereco;
  public float $valor;

  public function __construct(array $data)
  {
    $this->exchangeArray($data);
  }

  public function exchangeArray(array $data)
  {
    $this->matricula = (int)($data['matricula'] ?? 0);
    $this->descricao = ($data['descricao'] ?? '');
    $this->endereco = ($data['endereco'] ?? '');
    $this->valor = (float)($data['valor'] ?? 0);
  }

  public function toArray()
  {
    $attributes = get_object_vars($this);
    if ($attributes['matricula'] == 0) {
      unset($attributes['matricula']);
    }
    return $attributes;
  }
}
