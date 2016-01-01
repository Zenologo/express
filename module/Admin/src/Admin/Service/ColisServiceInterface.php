<?php
namespace Admin\Service;

use Admin\Model\ColisInterface;

interface ColisServiceInterface
{
	public function findAllColis();

	public function findColis($id);

	public function saveColis(ColisInterface $colis);
	
	public function deleteColis(ColisInterface $colis);
	
	public function findColisByDate($dateDebut, $dateFin);
	
	public function calculPrixPrevuByDate($dateDebut, $dateFin);
	
	public function calculAssuranceByDate($dateDebut, $dateFin);

	public function findAllCommande();
	
	public function saveColisRef($id, $refColis);
	
}