<?php

class analysisArea extends Controller {
	
	var $models = FALSE;
	
	public function __construct()
	{
		parent::__construct();

		global $app_domain;
		$this->loadmodule();
		$this->view = $this->setSmarty();
		$sessionAdmin = new Session;
		$this->admin = $sessionAdmin->get_session();
		$this->view->assign('app_domain',$app_domain);
		$this->folder=CODEKIR_TEMPLATE.'/contentManagement/analysisArea/';
	}
	public function loadmodule()
	{
		
	}
	
	public function index(){

		return $this->loadView($this->folder."analysisArea");

	}
	public function search(){

		return $this->loadView($this->folder."search_analysisArea");

	}


	
}

?>
