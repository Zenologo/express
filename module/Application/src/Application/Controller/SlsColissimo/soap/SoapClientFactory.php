<?php

namespace Application\Controller\SlsColissimo\soap;

use Application\Controller\SlsColissimo\Soap\TypeConverter\DateTimeTypeConverter;
use Application\Controller\SlsColissimo\Soap\TypeConverter\TypeConverterCollection;


class SoapClientFactory
{
	/**
	 * Default classmap
	 *
	 * @var array
	 */
	protected $classmap = array(
	    'generateLabel'                  => 'Application\Controller\SlsColissimo\generateLabel',
	    'generateLabelRequest'           => 'Application\Controller\SlsColissimo\generateLabelRequest',
	    'outputFormat'                   => 'Application\Controller\SlsColissimo\outputFormat',
	    'service'                        => 'Application\Controller\SlsColissimo\service',
	    'letter'                         => 'Application\Controller\SlsColissimo\letter',
	    'parcel'                         => 'Application\Controller\SlsColissimo\parcel',
	    'customsDeclarations'            => 'Application\Controller\SlsColissimo\customsDeclarations',
	    'contents'                       => 'Application\Controller\SlsColissimo\contents',
	    'article'                        => 'Application\Controller\SlsColissimo\article',
	    'category'                       => 'Application\Controller\SlsColissimo\category',
	    'sender'                         => 'Application\Controller\SlsColissimo\sender',
	    'address'                        => 'Application\Controller\SlsColissimo\address',
	    'addressee'                      => 'Application\Controller\SlsColissimo\addressee',
	    
	);
	
	/**
	 * Type converters collection
	 *
	 * @var TypeConverterCollection
	*/
	protected $typeConverters;
	/**
	 * @param string $wsdl Some argument description
	 *
	 * @return \SoapClient
	 */
	public function create($wsdl)
	{	    
	    
	    
	    $phpClient = new doClient($wsdl, array(
				'trace'     => 1,
// 		        'features'  => SOAP_SINGLE_ELEMENT_ARRAYS,
//				'classmap'  => $this->classmap,
   //			'typemap'   => $this->getTypeConverters()->getTypemap(),
 		        //'cache_wsdl' => WSDL_CACHE_MEMORY,
	            'exception' => 0
		));
 		return $phpClient; 
	}
	/**
	 * test
	 *
	 * @param string $soap SOAP class
	 * @param string $php  PHP class
	 */
	public function setClassmapping($soap, $php)
	{
		$this->classmap[$soap] = $php;
	}
	/**
	 * Get type converter collection that will be used for the \SoapClient
	 *
	 * @return TypeConverterCollection
	 */
	public function getTypeConverters()
	{
		if (null === $this->typeConverters) {
			$this->typeConverters = new TypeConverterCollection(
					array(
							new DateTimeTypeConverter()
					)
			);
		}
		return $this->typeConverters;
	}
	/**
	 * Set type converter collection
	 *
	 * @param type $typeConverters Type converter collection
	 *
	 * @return SoapClientFactory
	 */
	public function setTypeConverters(TypeConverterCollection $typeConverters)
	{
		$this->typeConverters = $typeConverters;
		return $this;
	}
}