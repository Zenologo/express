<?php
namespace Colis\Service;

interface PrixServiceInterface
{
	public function findAllPrix();

	public function findByKg($kg);

	public function findByMembre($membre);
	
}