<?php
// Filename: /module/Colis/src/Colis/Service/ColisService.php

namespace Admin\Service;

use Admin\Mapper\ColisMapperInterface;
use Admin\Model\ColisInterface;


class ColisService implements ColisServiceInterface
{
	
	protected $colisMapper;
	
 	public function __construct(ColisMapperInterface $colisMapper)
	{
		$this->colisMapper = $colisMapper;
	} 
	
	public function findAllColis()
	{	    
		 return $this->colisMapper->findAll();
	}
	
	
	public function findColis($id)
	{	    
		return $this->colisMapper->find($id);
	}
	
	
	public function saveColis(ColisInterface $colis) 
	{
		return $this->colisMapper->save($colis);
	}
	
	public function deleteColis(ColisInterface $colis)
	{
	   return $this->colisMapper->deleteColis($colis);
	     
	}
	
	public function findColisByDate($dateDebut, $dateFin)
	{
		return $this->colisMapper->findColisByDate($dateDebut, $dateFin);
	}
	
	public function calculPrixPrevuByDate($dateDebut, $dateFin)
	{
		return $this->colisMapper->calculPrixPrevuByDate($dateDebut, $dateFin);
	}
	
	public function calculAssuranceByDate($dateDebut, $dateFin)
	{
	    return $this->colisMapper->calculAssuranceByDate($dateDebut, $dateFin);
	}
	
	public function findAllCommande()
	{
	    return $this->colisMapper->findAllCommande();
	}
	
	
	public function saveColisRef($id, $refColis)
	{
		return $this->colisMapper->saveColisRef($id, $refColis);
	}
}
