<?php

namespace Admin\Model;

class Colis implements ColisInterface
{
	protected $id;

	protected $expediteurNom;

	protected $expediteurAdresse;

	protected $expediteurVille;

	protected $expediteurCodePostale;

	protected $expediteurTelephone;

	protected $destinateurNom;

	protected $destinateurAdresse;

	protected $destinateurVille;

	protected $destinateurCodePostale;

	protected $destinateurTelephone;
	
	protected $destinateurPay;

	protected $refColis;

	protected $refST;
	
	protected $colisAssurance;
	
	protected $state;
	
	protected $poidsPrevu;
	
	protected $poidsFinal;
	
	protected $depotTime;
	
	protected $prixPrevu;
	
	protected $prixFinal;
	
	protected $determineTime;
	
	protected $clientId;

	
	
	/**
	 * @return the $state
	 */
	public function getState() {
		return $this->state;
	}

	/**
	 * @return the $poidsPrevu
	 */
	public function getPoidsPrevu() {
		return $this->poidsPrevu;
	}

	/**
	 * @return the $poidsFinal
	 */
	public function getPoidsFinal() {
		return $this->poidsFinal;
	}

	/**
	 * @return the $depotTime
	 */
	public function getDepotTime() {
		return $this->depotTime;
	}

	/**
	 * @return the $prixPrevu
	 */
	public function getPrixPrevu() {
		return $this->prixPrevu;
	}

	/**
	 * @return the $prixFinal
	 */
	public function getPrixFinal() {
		return $this->prixFinal;
	}

	/**
	 * @return the $determineTime
	 */
	public function getDetermineTime() {
		return $this->determineTime;
	}

	/**
	 * @param field_type $state
	 */
	public function setState($state) {
		$this->state = $state;
	}

	/**
	 * @param field_type $poidsPrevu
	 */
	public function setPoidsPrevu($poidsPrevu) {
		$this->poidsPrevu = $poidsPrevu;
	}

	/**
	 * @param field_type $poidsFinal
	 */
	public function setPoidsFinal($poidsFinal) {
		$this->poidsFinal = $poidsFinal;
	}

	/**
	 * @param field_type $depotTime
	 */
	public function setDepotTime($depotTime) {
		$this->depotTime = $depotTime;
	}

	/**
	 * @param field_type $prixPrevu
	 */
	public function setPrixPrevu($prixPrevu) {
		$this->prixPrevu = $prixPrevu;
	}

	/**
	 * @param field_type $prixFinal
	 */
	public function setPrixFinal($prixFinal) {
		$this->prixFinal = $prixFinal;
	}

	/**
	 * @param field_type $determineTime
	 */
	public function setDetermineTime($determineTime) {
		$this->determineTime = $determineTime;
	}

	/**
	 * @return the $id
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @return the $expediteurNom
	 */
	public function getExpediteurNom() {
		return $this->expediteurNom;
	}

	/**
	 * @return the $expediteurAdresse
	 */
	public function getExpediteurAdresse() {
		return $this->expediteurAdresse;
	}

	/**
	 * @return the $expediteurVille
	 */
	public function getExpediteurVille() {
		return $this->expediteurVille;
	}

	/**
	 * @return the $expediteurCodePostale
	 */
	public function getExpediteurCodePostale() {
		return $this->expediteurCodePostale;
	}

	/**
	 * @return the $expediteurTelephone
	 */
	public function getExpediteurTelephone() {
		return $this->expediteurTelephone;
	}

	/**
	 * @return the $destinateurNom
	 */
	public function getDestinateurNom() {
		return $this->destinateurNom;
	}

	/**
	 * @return the $destinateurAdresse
	 */
	public function getDestinateurAdresse() {
		return $this->destinateurAdresse;
	}

	/**
	 * @return the $destinateurVille
	 */
	public function getDestinateurVille() {
		return $this->destinateurVille;
	}

	/**
	 * @return the $destinateurCodePostale
	 */
	public function getDestinateurCodePostale() {
		return $this->destinateurCodePostale;
	}

	/**
	 * @return the $destinateurTelephone
	 */
	public function getDestinateurTelephone() {
		return $this->destinateurTelephone;
	}

	/**
	 * @return the $destinateurPay
	 */
	public function getDestinateurPay() {
		return $this->destinateurPay;
	}

	/**
	 * @return the $refColis
	 */
	public function getRefColis() {
		return $this->refColis;
	}

	/**
	 * @return the $refST
	 */
	public function getRefST() {
		return $this->refST;
	}
	
	/**
	 * @return the $clientId
	 */
	public function getClientId() {
		return $this->clientId;
	}
	

	/**
	 * @param field_type $id
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * @param field_type $expediteurNom
	 */
	public function setExpediteurNom($expediteurNom) {
		$this->expediteurNom = $expediteurNom;
	}

	/**
	 * @param field_type $expediteurAdresse
	 */
	public function setExpediteurAdresse($expediteurAdresse) {
		$this->expediteurAdresse = $expediteurAdresse;
	}

	/**
	 * @param field_type $expediteurVille
	 */
	public function setExpediteurVille($expediteurVille) {
		$this->expediteurVille = $expediteurVille;
	}

	/**
	 * @param field_type $expediteurCodePostale
	 */
	public function setExpediteurCodePostale($expediteurCodePostale) {
		$this->expediteurCodePostale = $expediteurCodePostale;
	}

	/**
	 * @param field_type $expediteurTelephone
	 */
	public function setExpediteurTelephone($expediteurTelephone) {
		$this->expediteurTelephone = $expediteurTelephone;
	}

	/**
	 * @param field_type $destinateurNom
	 */
	public function setDestinateurNom($destinateurNom) {
		$this->destinateurNom = $destinateurNom;
	}

	/**
	 * @param field_type $destinateurAdresse
	 */
	public function setDestinateurAdresse($destinateurAdresse) {
		$this->destinateurAdresse = $destinateurAdresse;
	}

	/**
	 * @param field_type $destinateurVille
	 */
	public function setDestinateurVille($destinateurVille) {
		$this->destinateurVille = $destinateurVille;
	}

	/**
	 * @param field_type $destinateurCodePostale
	 */
	public function setDestinateurCodePostale($destinateurCodePostale) {
		$this->destinateurCodePostale = $destinateurCodePostale;
	}

	/**
	 * @param field_type $destinateurTelephone
	 */
	public function setDestinateurTelephone($destinateurTelephone) {
		$this->destinateurTelephone = $destinateurTelephone;
	}

	/**
	 * @param field_type $destinateurPay
	 */
	public function setDestinateurPay($destinateurPay) {
		$this->destinateurPay = $destinateurPay;
	}

	/**
	 * @param field_type $refColis
	 */
	public function setRefColis($refColis) {
		$this->refColis = $refColis;
	}

	/**
	 * @param field_type $refST
	 */
	public function setRefST($refST) {
		$this->refST = $refST;
	}
	/**
	 * @return the $colisAssurance
	 */
	public function getColisAssurance() {
		return $this->colisAssurance;
	}

	/**
	 * @param field_type $colisAssurance
	 */
	public function setColisAssurance($colisAssurance) {
		$this->colisAssurance = $colisAssurance;
	}
	

	/**
	 * @param field_type $clientId
	 */
	public function setClientId($clientId) {
		$this->clientId = $clientId;
	}



	


}