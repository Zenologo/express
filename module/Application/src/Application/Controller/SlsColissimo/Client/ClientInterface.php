<?php

namespace Application\Controller\SlsColissimo\Client;

use Application\Controller\SlsColissimo\generateLabel;
use Application\Controller\SlsColissimo\response\generateLabelResponse;

/**
 * ClientInterface for the WSColiPosteLetterService
 */
interface ClientInterface
{
	/**
	 * Ask for the generation of a colissimo letter
	 *
	 * @param generateLabelRequest $request
	 *
	 * @return generateLabelResponse
	 */
	public function generateLabel(generateLabel $request);
	
	
	
//	public function getProductInter($request);
	
	
	
}