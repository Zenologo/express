<?php

namespace Colis\Model;

interface ColisInterface
{

	public function getId();

	public function getExpediteurNom();

	public function getExpediteurAdresse();

	public function getExpediteurVille();

	public function getExpediteurCodePostale();

	public function getExpediteurTelephone();

	public function getDestinateurNom();

	public function getDestinateurAdresse();

	public function getDestinateurVille();

	public function getDestinateurCodePostale();

	public function getDestinateurTelephone();

	public function getRefColis();

	public function getRefST();
	
	public function getState();
	
	public function getPoidsPrevu();

	public function getPoidsFinal();	

	public function getDepotTime();	

	public function getPrixPrevu();
	
	public function getPrixFinal();
	
	public function getDetermineTime();
	
	public function getColisAssurance();
	
	public function getColisGenre();
	
	public function getPdfUrl();

}