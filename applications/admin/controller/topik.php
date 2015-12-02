<?php
// defined ('TATARUANG') or exit ( 'Forbidden Access' );

class topik extends Controller {
	
	var $models = FALSE;
	
	public function __construct()
	{
		parent::__construct();

		global $app_domain;
		global $basedomain;
		$this->loadmodule();
		$this->view = $this->setSmarty();
		$sessionAdmin = new Session;
		$this->admin = $sessionAdmin->get_session();
		// $this->validatePage();
		$this->view->assign('app_domain',$app_domain);
		$this->folder=CODEKIR_TEMPLATE.'/master/topik/';
	}
	public function loadmodule()
	{
		global $basedomain, $app_domain;

		// 
		$this->contentHelper = $this->loadModel('contentHelper');
	}
	
	public function index(){
		
		$data=$this->contentHelper->gettopik();

		if ($data){	
			$this->view->assign('data',$data);
		}

		return $this->loadView($this->folder."topik");

	}
	public function create(){
		

		return $this->loadView($this->folder."create_topik");

	}

	public function input(){
		global $CONFIG;

		$name = $_POST['name'];

		$data=$this->contentHelper->inputtopik($name);

		if($data == 1){
				echo "<script>alert('Data berhasil di simpan');window.location.href='".$CONFIG['admin']['base_url']."topik'</script>";
			}
	}

	public function view(){

		global $CONFIG;
			$id = $_GET ['id'];
			$data=$this->contentHelper->selecttopik($id);
				if ($data){	
					$this->view->assign('data',$data);
				}	
			return $this->loadView($this->folder."view_topik");
	}

	public function edit(){

		global $CONFIG;
			$id = $_GET ['id'];

			if ($_POST == null){
				$data = $this->contentHelper-> selecttopik($id);
				//pr ($data);
				
				if ($data){	
					$this->view->assign('data',$data);
				}	
				return $this->loadView($this->folder."edit_topik");
				
			}

			else {
				$name = $_POST['name'];
				//pr($_POST);

				$data = $this->contentHelper->updatetopik($id,$name);
				//pr($data);
					if($data == 1){
						echo "<script>alert('Data berhasil di simpan');window.location.href='".$CONFIG['admin']['base_url']."topik'</script>";
				}
			}

	}

	public function delete()
	{
		global $CONFIG;
			$id = $_GET ['id'];

			$data=$this->contentHelper->deletetopik($id);

			if($data == 1){
				echo "<script>alert('Data berhasil di hapus');window.location.href='".$CONFIG['admin']['base_url']."topik'</script>";
			}
			else {pr('gagal');}
	}
	
}

?>
