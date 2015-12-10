<?php
// defined ('TATARUANG') or exit ( 'Forbidden Access' );

class journalist extends Controller {
	
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
		$this->folder=CODEKIR_TEMPLATE.'/master/journalist/';
	}
	public function loadmodule()
	{
		
		$this->contentHelper = $this->loadModel('contentHelper');

	}
	
	public function index(){
		
		global $basedomain, $app_domain;

		// 
		$data=$this->contentHelper->getjournalist();

		//kirim data dari controler ke template
		if ($data){	
			$this->view->assign('data',$data);
		}

		// $data['table'] = "pindai_ref";
		// $data['condition'] = array('n_status'=>1);

		// $fetchData = $this->contentHelper->fetchData($data);

		// pr($data);
		return $this->loadView($this->folder."journalist");

	}
	
	public function create(){
		
		return $this->loadView($this->folder."create_journalist");

	}

	public function input(){
		global $CONFIG;

		$name = $_POST['name'];

		$data=$this->contentHelper->inputjournalist($name);

		// pr($data);exit;

		//$data=$this->contentHelper->saveData($_POST);

		//return $this->loadView($this->folder."journalist");

		if($data == 1){
				echo "<script>alert('Data berhasil di simpan');window.location.href='".$CONFIG['admin']['base_url']."journalist'</script>";
			}
	}

	public function view(){

		global $CONFIG;
			$id = $_GET ['id'];
			$data=$this->contentHelper->selectjournalist($id);
				if ($data){	
					$this->view->assign('data',$data);
				}	
			return $this->loadView($this->folder."view_journalist");
	}

	public function edit(){

		global $CONFIG;
			$id = $_GET ['id'];

			if ($_POST == null){
				$data = $this->contentHelper-> selectjournalist($id);
				// pr ($data);
				
				if ($data){	
					$this->view->assign('data',$data);
				}	
				return $this->loadView($this->folder."edit_journalist");
				
			}

			else {
				$name = $_POST['name'];
				//pr($_POST);

				$data = $this->contentHelper->updatejournalist($id,$name);
				//pr($data);
					if($data == 1){
						echo "<script>alert('Data berhasil di simpan');window.location.href='".$CONFIG['admin']['base_url']."journalist'</script>";
				}
			}

		//return $this->loadView($this->folder."journalist/edit_journalist");

	}

	public function delete()
	{
		global $CONFIG;
			$id = $_GET ['id'];

			$data=$this->contentHelper->deletejournalist($id);

			if($data == 1){
				echo "<script>alert('Data berhasil di hapus');window.location.href='".$CONFIG['admin']['base_url']."journalist'</script>";
			}
			else {pr('gagal');}
	}

	
}

?>
