<?php
namespace Colis\Mapper;

use Colis\Model\ColisInterface;

interface ColisMapperInterface
{
    public function find($id);

    public function findAllByClient($email);
    
    public function findColisByDate($email, $dateDebut, $dateFin);
    
    public function findAll();
    
    public function saveColis(ColisInterface $colis);
    
    public function saveColisArray($dataArray);
    
    public function deleteColis(ColisInterface $colis);
    
    public function calculPrixPrevuByDate($email, $dateDebut, $dateFin);
    
    public function calculAssuranceByDate($email, $dateDebut, $dateFin);
    
    public function getSolde($email);
    
    public function udpateRefColis($id, $parcelNum, $pdfUrl, $email);
    
    public function getClientInfoByEmail($email);
    
    // 以后要移除
    public function findAllPrix();
    
    public function findAds($id);
    
    public function findArticles($id);
    
}