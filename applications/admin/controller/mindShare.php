<?php
// defined ('TATARUANG') or exit ( 'Forbidden Access' );

class mindShare extends Controller {
	
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
		$this->folder=CODEKIR_TEMPLATE.'/master/mindShare/';
	}
	public function loadmodule()
	{
		
		$this->contentHelper = $this->loadModel('contentHelper');
	}
	
	public function index()
	{
		global $basedomain, $app_domain;

		$datamind=$this->contentHelper->getmindshare();
		// pr($datamind);
		if ($datamind){	
			foreach ($datamind as $key => $value) {
				if ($value['data']) $datamind[$key]['color'] = unserialize($value['data']);
			}

			// pr($datamind);
			$this->view->assign('datamind',$datamind);
		}

		return $this->loadView($this->folder."mindShare");
	}

	public function create()
	{
		return $this->loadView($this->folder."create_mindShare");

	}

	public function input()
	{
		global $CONFIG;
		$name = $_POST['name'];
		$description =$_POST['description'];
		$company_id = $_POST['company_id'];
		$sort = $_POST['sort'];
		//$data1 = $_POST['data'];
		$data = serialize(array('color'=>$_POST['data']));

		// pr($_POST);exit;

		$insert=$this->contentHelper->inputmindshare($name,$description,$company_id,$sort,$data);

		if($insert == 1){
				echo "<script>alert('Data berhasil di simpan');window.location.href='".$CONFIG['admin']['base_url']."mindShare'</script>";
			}
	}

	public function view(){

		global $CONFIG;
			$id = $_GET ['id'];

			$datamind=$this->contentHelper->selectmindshare($id);
			//pr($datamind); 

			if($datamind){
					if 	($datamind['data']) $datamind['color'] = unserialize($datamind['data']);
	
				// pr($datamind);
				$this->view->assign('datamind',$datamind);
			}

			return $this->loadView($this->folder."view_mindShare");
	}

	public function edit(){

		global $CONFIG;
			$id = $_GET ['id'];

			if ($_POST == null){
				$datamind=$this->contentHelper->selectmindshare($id);
				// pr ($datamind); 
				
				if($datamind){
					// foreach($datamind as $value){
						if 	($datamind['data']) $datamind['color'] = unserialize($datamind['data']);
					// }
	
					// pr($datamind);
					$this->view->assign('datamind',$datamind);
				}		
				
				return $this->loadView($this->folder."edit_mindShare");			
			}

			else {
				$name = $_POST['name'];
				$description =$_POST['description'];
				$company_id = $_POST['company_id'];
				$sort = $_POST['sort'];
				//$data1 = $_POST['data'];
				$data = serialize(array('color'=>$_POST['data']));
				//pr($_POST);

				$update = $this->contentHelper->updatemindshare($id,$name,$description,$company_id,$sort,$data);
				//pr($data);
					if($update == 1){
						echo "<script>alert('Data berhasil di simpan');window.location.href='".$CONFIG['admin']['base_url']."mindShare'</script>";
				}
			}
	}

	public function delete()
	{
		global $CONFIG;
			$id = $_GET ['id'];

			$datamind=$this->contentHelper->deletemindshare($id);

			if($datamind == 1){
				echo "<script>alert('Data berhasil di hapus');window.location.href='".$CONFIG['admin']['base_url']."mindShare'</script>";
			}
			else {pr('gagal');}
	}
	
}

?>
