<?php
namespace Colis\Service;

use Colis\Model\ColisInterface;

interface ColisServiceInterface
{
	public function findAllColis();

	public function findColis($id);
	
	public function findAllByClient($email);

	public function saveColis(ColisInterface $colis);

	public function saveColisArray($dataArray);
	
	public function deleteColis(ColisInterface $colis);
	
	public function calculPrixPrevuByDate($email, $dateDebut, $dateFin);
	
	public function calculAssuranceByDate($email, $dateDebut, $dateFin);
	
	public function findColisByDate($email, $dateDebut, $dateFin);
	
	public function getSolde($email);
	
	public function udpateRefColis($colisId, $parcelNum, $pdfUrl, $email);
	
    public function getClientInfoByEmail($email);
	
	// 以后要移除
	public function findAllPrix();
	
	public function findAds($id);
	
	public function findArticles($id);
	
}