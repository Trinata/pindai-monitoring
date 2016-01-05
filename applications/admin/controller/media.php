<?php
// defined ('TATARUANG') or exit ( 'Forbidden Access' );

class media extends Controller {
	
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
		$this->folder=CODEKIR_TEMPLATE.'/master/media/';
	}
	public function loadmodule()
	{
		$this->contentHelper = $this->loadModel('contentHelper');
	}
	
	public function index(){
		global $basedomain, $app_domain;

		$datamedia=$this->contentHelper->getmedia();
		
		// pr($datamedia);
		if ($datamedia){	
			foreach ($datamedia as $key => $value) {
				// pr(unserialize($value['data']));
				if ($value['data']) {
					$unserial = unserialize($value['data']);
					$datamedia[$key]['color'] = $unserial['color'];
					$datamedia[$key]['advprice'] = $unserial['advprice'];
				}

				// pr($datamedia);
			}

			$this->view->assign('datamedia',$datamedia);
		}


		return $this->loadView($this->folder."media");
	}

	public function create()
	{
		// ambil data cat media
		$datacatmedia=$this->contentHelper->getcatmedia();

		// pr($datacatmedia);
		if ($datacatmedia){	
			$this->view->assign('datacatmedia',$datacatmedia);
		}

		return $this->loadView($this->folder."create_media");

	}

	public function input()
	{
		global $CONFIG;
		$name = $_POST['name'];
		$media_category =$_POST['media_category'];
		$pic = $_POST['pic'];

		$data = serialize(array('color'=>$_POST['datacol'], 'advprice'=>$_POST['dataadv']));		

		// pr($_POST);exit;
		$insert=$this->contentHelper->inputmedia($name,$media_category,$pic,$data);

		if($insert == 1){
				echo "<script>alert('Data berhasil di simpan');window.location.href='".$CONFIG['admin']['base_url']."media'</script>";
			}
	}

	public function view()
	{
		global $CONFIG;
			$id = $_GET ['id'];

			$datamedia=$this->contentHelper->selectmedia($id);
			
			pr($datamedia); 

			if ($datamedia){	
				foreach ($datamedia as $key => $value) {
					// pr(unserialize($value['data']));
					if ($value['data']) {
						$unserial = unserialize($value['data']);
						$datamedia[$key]['color'] = $unserial['color'];
						$datamedia[$key]['advprice'] = $unserial['advprice'];
					}

					pr($datamedia);
				}

				$this->view->assign('datamedia',$datamedia[0]);
			}

			return $this->loadView($this->folder."view_media");
	}

	public function edit()
	{
		global $CONFIG;
			$id = $_GET ['id'];

			if ($_POST == null){
				$datamedia=$this->contentHelper->selectmedia($id);
				$datacatmedia=$this->contentHelper->getcatmedia();

				// pr($datacatmedia);
				if ($datacatmedia){	
					$this->view->assign('datacatmedia',$datacatmedia);
				}

				// pr ($datamedia); 
				
				if($datamedia){
						if 	($datamedia['data']){
							$datamedia['color'] = unserialize($datamedia['data']);
							$datamedia['advprice'] = unserialize($datamedia['data']);
					}
	
					// pr($datamedia);
					$this->view->assign('datamedia',$datamedia);
				}		
				
				return $this->loadView($this->folder."edit_media");			
			}

			else {
				$name = $_POST['name'];
				$media_category =$_POST['media_category'];
				$pic = $_POST['pic'];

				// pr($_POST);exit;
				$data = serialize(array('color'=>$_POST['datacol'], 'advprice'=>$_POST['dataadv']));
				
				$update = $this->contentHelper->updatemedia($id,$name,$media_category,$pic,$data);
				//pr($data);
					if($update == 1){
						echo "<script>alert('Data berhasil di simpan');window.location.href='".$CONFIG['admin']['base_url']."media'</script>";
				}
			}
	}

	public function delete()
	{
		global $CONFIG;
			$id = $_GET ['id'];

			$datamedia=$this->contentHelper->deletemedia($id);

			if($datamedia == 1){
				echo "<script>alert('Data berhasil di hapus');window.location.href='".$CONFIG['admin']['base_url']."media'</script>";
			}
			else {pr('gagal');}
	}
	
}

?>
