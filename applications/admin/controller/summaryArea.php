<?php
// defined ('TATARUANG') or exit ( 'Forbidden Access' );

class summaryArea extends Controller {
	
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
		$this->folder=CODEKIR_TEMPLATE.'/contentManagement/summaryArea/';
	}
	public function loadmodule()
	{
		
		$this->contentHelper = $this->loadModel('contentHelper');
	}
	
	public function index(){
		
		return $this->loadView($this->folder."summaryArea");

	}
	public function create(){
		

		return $this->loadView($this->folder."create_summaryArea");

	}
	public function input(){
		pr($_POST);
		exit;

		return $this->loadView($this->folder."create_summaryArea");

	}
	public function search(){
		

		return $this->loadView($this->folder."search_summaryArea");

	}


	
}

?>
