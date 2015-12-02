<?php
// defined ('TATARUANG') or exit ( 'Forbidden Access' );

class rubric extends Controller {
	
	var $models = FALSE;
	
	public function __construct()
	{
		parent::__construct();
		global $basedomain;
		global $app_domain;
		$this->loadmodule();
		$this->view = $this->setSmarty();
		$sessionAdmin = new Session;
		$this->admin = $sessionAdmin->get_session();
		// $this->validatePage();
		$this->view->assign('app_domain',$app_domain);
		$this->folder=CODEKIR_TEMPLATE.'/master/rubric/';
	}
	public function loadmodule()
	{
		
		$this->contentHelper = $this->loadModel('contentHelper');
	}
	
	public function index()
	{
		global $basedomain, $app_domain;

		// 
		$data=$this->contentHelper->getrubric();

		if ($data){	
			$this->view->assign('data',$data);
		}

		return $this->loadView($this->folder."rubric");

	}

	public function create()
	{

		return $this->loadView($this->folder."create_rubric");

	}

	public function input()
	{
		global $CONFIG;

		$name = $_POST['name'];

		$data=$this->contentHelper->inputrubric($name);

		if($data == 1){
				echo "<script>alert('Data berhasil di simpan');window.location.href='".$CONFIG['admin']['base_url']."rubric'</script>";
			}
	}

	public function view()
	{

		global $CONFIG;
			$id = $_GET ['id'];
			$data=$this->contentHelper->selectrubric($id);
				if ($data){	
					$this->view->assign('data',$data);
				}	
			return $this->loadView($this->folder."view_rubric"); 
	}

	public function edit(){

		global $CONFIG;
			$id = $_GET ['id'];

			if ($_POST == null){
				$data = $this->contentHelper-> selectrubric($id);
				//pr ($data);
				
				if ($data){	
					$this->view->assign('data',$data);
				}	
				return $this->loadView($this->folder."edit_rubric");
				
			}

			else {
				$name = $_POST['name'];
				//pr($_POST);

				$data = $this->contentHelper->updaterubric($id,$name);
				//pr($data);
					if($data == 1){
						echo "<script>alert('Data berhasil di simpan');window.location.href='".$CONFIG['admin']['base_url']."rubric'</script>";
				}
			}
	}

	public function delete()
	{
		global $CONFIG;
			$id = $_GET ['id'];

			$data=$this->contentHelper->deleterubric($id);

			if($data == 1){
				echo "<script>alert('Data berhasil di hapus');window.location.href='".$CONFIG['admin']['base_url']."rubric'</script>";
			}
			else {pr('gagal');}
	}
	
}

?>
