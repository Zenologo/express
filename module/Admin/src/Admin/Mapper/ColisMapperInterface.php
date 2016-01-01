<?php
namespace Admin\Mapper;

use Admin\Model\ColisInterface;

interface ColisMapperInterface
{
    public function find($id);
		
    public function findAll();
    
    public function saveColis(ColisInterface $colis);
    
    public function deleteColis(ColisInterface $colis);
    
    public function findColisByDate($dateDebut, $dateFin);
    
    public function calculPrixPrevuByDate($dateDebut, $dateFin);
    
    public function calculAssuranceByDate($dateDebut, $dateFin);
    
    public function findAllCommande();
    
    public function saveColisRef($id, $refColis);
}