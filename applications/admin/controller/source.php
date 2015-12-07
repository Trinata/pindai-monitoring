<?php
// defined ('TATARUANG') or exit ( 'Forbidden Access' );

class source extends Controller {
	
	var $models = FALSE;
	
	public function __construct()
	{
		parent::__construct();
		global $app_domain;
		global $app_domain;
		$this->loadmodule();
		$this->view = $this->setSmarty();
		$sessionAdmin = new Session;
		$this->admin = $sessionAdmin->get_session();
		// $this->validatePage();
		$this->view->assign('app_domain',$app_domain);
		$this->folder=CODEKIR_TEMPLATE.'/master/source/';
	}
	public function loadmodule()
	{
		
		$this->contentHelper = $this->loadModel('contentHelper');
	}
	
	public function index()
	{
		global $basedomain, $app_domain;

		// 
		$data=$this->contentHelper->getsource();

		if ($data){	
			$this->view->assign('data',$data);
		}

		return $this->loadView($this->folder."source");
	}

	public function create()
	{
		return $this->loadView($this->folder."create_source");
	}

	public function input(){
		global $CONFIG;

		$name = $_POST['name'];
		$position = $_POST['position'];

		$data=$this->contentHelper->inputsource($name,$position);

		if($data == 1){
				echo "<script>alert('Data berhasil di simpan');window.location.href='".$CONFIG['admin']['base_url']."source'</script>";
			}
	}

	public function view(){

		global $CONFIG;
			$id = $_GET ['id'];
			$data=$this->contentHelper->selectsource($id);
				if ($data){	
					$this->view->assign('data',$data);
				}	
			return $this->loadView($this->folder."view_source");
	}

	public function edit(){

		global $CONFIG;
			$id = $_GET ['id'];

			if ($_POST == null){
				$data = $this->contentHelper-> selectsource($id);
				// pr ($data);
				
				if ($data){	
					$this->view->assign('data',$data);
				}	
				return $this->loadView($this->folder."edit_source");
				
			}

			else {
				$name = $_POST['name'];
				$position = $_POST['position'];
				//pr($_POST);

				$data = $this->contentHelper->updatesource($id,$name,$position);
				//pr($data);
					if($data == 1){
						echo "<script>alert('Data berhasil di simpan');window.location.href='".$CONFIG['admin']['base_url']."source'</script>";
				}
			}

		//return $this->loadView($this->folder."journalist/edit_journalist");

	}

	public function delete()
	{
		global $CONFIG;
			$id = $_GET ['id'];

			$data=$this->contentHelper->deletesource($id);

			if($data == 1){
				echo "<script>alert('Data berhasil di hapus');window.location.href='".$CONFIG['admin']['base_url']."source'</script>";
			}
			else {pr('gagal');}
	}
	
}

?>
