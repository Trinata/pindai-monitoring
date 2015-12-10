<?php
// defined ('TATARUANG') or exit ( 'Forbidden Access' );

class industry extends Controller {
	
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
		$this->folder=CODEKIR_TEMPLATE.'/master/industry/';
	}

	public function loadmodule()
	{
		
		$this->contentHelper = $this->loadModel('contentHelper');
	}
	
	public function index(){
		
		$data=$this->contentHelper->getindustry();

		if ($data){	
			$this->view->assign('data',$data);
		}

		return $this->loadView($this->folder."industry");

	}

	public function create(){
		

		return $this->loadView($this->folder."create_industry");

	}

	public function input(){
		global $CONFIG;

		$name = $_POST['name'];

		if($name==''){
			
			echo "<script>alert('Data belum terisi');window.location.href='".$CONFIG['admin']['base_url']."industry/create'</script>";

		}else{

			$data=$this->contentHelper->inputindustry($name);

			if($data == 1){
					echo "<script>alert('Data berhasil di simpan');window.location.href='".$CONFIG['admin']['base_url']."industry'</script>";
				}
		}
	}

	public function view(){

		global $CONFIG;
			$id = $_GET ['id'];
			$data=$this->contentHelper->selectindustry($id);
				if ($data){	
					$this->view->assign('data',$data);
				}	
			return $this->loadView($this->folder."view_industry");
	}

	public function edit(){

		global $CONFIG;
			$id = $_GET ['id'];

			if ($_POST == null){
				$data = $this->contentHelper-> selectindustry($id);
				//pr ($data);

				if ($data){	
					$this->view->assign('data',$data);
				}	
				return $this->loadView($this->folder."edit_industry");
				
			}

			else {
				$name = $_POST['name'];
				//pr($_POST);

				$data = $this->contentHelper->updateindustry($id,$name);
				//pr($data);
					if($data == 1){
						echo "<script>alert('Data berhasil di simpan');window.location.href='".$CONFIG['admin']['base_url']."industry'</script>";
				}
			}

	}

	public function delete()
	{
		global $CONFIG;
			$id = $_GET ['id'];

			$data=$this->contentHelper->deleteindustry($id);

			if($data == 1){
				echo "<script>alert('Data berhasil di hapus');window.location.href='".$CONFIG['admin']['base_url']."industry'</script>";
			}
			else {pr('gagal');}
	}



	
}

?>
