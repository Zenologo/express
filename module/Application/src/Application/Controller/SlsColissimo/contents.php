<?php
namespace Application\Controller\SlsColissimo;


class contents{
	/**
	 * 
	 * @var article
	 */
    protected $article;
    
    
    /**
     * 
     * @var category
     */
    protected $category;
    
    
    public function __contents(){
    	$this->article = array();
        
    }
    
    
    /**
	 * @return the $article
	 */
	public function getArticle() {
		return $this->article;
	}

	/**
	 * @return the $category
	 */
	public function getCategory() {
		return $this->category;
	}

	/**
	 * @param \Application\Controller\SlsColissimo\article $article
	 */
	public function setArticle(article $article) {
	    $length = count($this->article);
	    
	    if ($length < 10){
	        $this->article[$length] = $article;
	    }
	}

	/**
	 * @param \Application\Controller\SlsColissimo\category $category
	 */
	public function setCategory(category $category) {
		$this->category = $category;
	}

	/**
     * Getter
     *
     * @param string $name
     */
    public function __get($name)
    {
    	$method = 'get' . ucfirst($name);
    	if (method_exists($this, $method)) {
    		return $this->$method();
    	}
    }
    
    
}