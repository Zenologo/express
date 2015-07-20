<?php

namespace Colis\Service;

use Colis\Model\ColisInterface;

interface ColisServiceInterface
{
  public function findAllColis();
  
  public function findColis($id);

}

