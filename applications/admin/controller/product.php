<?php
// defined ('TATARUANG') or exit ( 'Forbidden Access' );

class product extends Controller {
	
	var $models = FALSE;
	
	public function __construct()
	{
		parent::__construct();

		global $app_domain;
		$this->loadmodule();
		$this->view = $this->setSmarty();
		$sessionAdmin = new Session;
		$this->admin = $sessionAdmin->get_session();
		// $this->validatePage();
		$this->view->assign('app_domain',$app_domain);
	}
	public function loadmodule()
	{
		
		$this->contentHelper = $this->loadModel('contentHelper');
		$this->marticle = $this->loadModel('marticle');
		$this->mquiz = $this->loadModel('mquiz');
		$this->mcourse = $this->loadModel('mcourse');
		
		//by akbar
		
		$this->mcategory = $this->loadModel('categoryHelper');
	}
	
	public function index(){
		

		return $this->loadView('product/listProduct');

	}

	public function formAddProduct(){
		

		return $this->loadView('product/addProduct');

	}

	public function formCatProduct(){
		

		return $this->loadView('product/addCategory');

	}
	public function listCatProduct(){
		

		return $this->loadView('product/listCatProduct');

	}
	public function addCatProduct() {
		global $basedomain;
		
		$getCatProduct = $this->mcategory->addCategory();
		
		 if ($getCatProduct){
		 	return $this->loadView('product/listCatProduct');
		 }
	}
	

	
}

?>
