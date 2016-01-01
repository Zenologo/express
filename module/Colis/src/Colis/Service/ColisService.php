<?php
// Filename: /module/Colis/src/Colis/Service/ColisService.php

namespace Colis\Service;

use Colis\Mapper\ColisMapperInterface;
use Colis\Model\ColisInterface;


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
	
	public function findAllByClient($email)
	{
		return $this->colisMapper->findAllByClient($email);
	}
	
	public function findColisByDate($email, $dateDebut, $dateFin)
	{
		return $this->colisMapper->findColisByDate($email, $dateDebut, $dateFin);
	}
	
	public function findColis($id)
	{	    
		return $this->colisMapper->find($id);
	}
	
	public function saveColisArray($dataArray){
		return $this->colisMapper->saveColisArray($dataArray);
	}
	
	public function saveColis(ColisInterface $colis) 
	{
		return $this->colisMapper->saveColis($colis);
	}
	
	public function deleteColis(ColisInterface $colis)
	{
	   return $this->colisMapper->delete($colis);
	}
	
	public function calculPrixPrevuByDate($email, $dateDebut, $dateFin)
	{
		return $this->colisMapper->calculPrixPrevuByDate($email, $dateDebut, $dateFin);
	}

	                
	public function calculAssuranceByDate($email, $dateDebut, $dateFin)
	{
	    return $this->colisMapper->calculAssuranceByDate($email, $dateDebut, $dateFin);
	}
	
	public function getSolde($email)
	{
		return $this->colisMapper->getSolde($email);
	}
	
	public function udpateRefColis($colisId, $parcelNum, $pdfUrl, $email)
	{
		return $this->colisMapper->udpateRefColis($colisId, $parcelNum, $pdfUrl, $email);
	}
	
	public function findAllPrix()
	{
		return $this->colisMapper->findAllPrix();
	}
	
	public function findAds($id)
	{
		return $this->colisMapper->findAds($id);
	}
	
	
	public function findArticles($id)
	{
	   return $this->colisMapper->findArticles($id);	
	}
	
	public function getClientInfoByEmail($email)
	{
		return $this->colisMapper->getClientInfoByEmail($email);
	}
	
}
