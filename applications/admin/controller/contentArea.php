<?php
// defined ('TATARUANG') or exit ( 'Forbidden Access' );

class contentArea extends Controller {
	
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
		$this->folder=CODEKIR_TEMPLATE.'/contentManagement/contentArea/';
	}
	public function loadmodule()
	{
		
		// $this->contentHelper = $this->loadModel('contentHelper');
	}
	
	public function index(){
		

		return $this->loadView($this->folder."contentArea");

	}
	public function search(){
		

		return $this->loadView($this->folder."search_contentArea");

	}
	public function create(){
		

		return $this->loadView($this->folder."create_contentArea");

	}


	
}

?>
