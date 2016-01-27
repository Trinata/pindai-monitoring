<?php

class catMedia extends Controller {
	
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
		$this->view->assign('app_domain',$app_domain);
		$this->folder=CODEKIR_TEMPLATE.'/master/catMedia/';
	}
	public function loadmodule()
	{
		$this->contentHelper = $this->loadModel('contentHelper');
	}
	
	public function index(){
		global $basedomain, $app_domain;

		$datacatmedia=$this->contentHelper->getcatmedia();
		if ($datacatmedia){	
			foreach ($datacatmedia as $key => $value) {
				if ($value['data']) $datacatmedia[$key]['color'] = unserialize($value['data']);
			}

			$this->view->assign('datacatmedia',$datacatmedia);
		}

		return $this->loadView($this->folder."catMedia");

	}
	public function create()
	{
		return $this->loadView($this->folder."create_catMedia");

	}

	public function input()
	{
		global $CONFIG;
		$name = $_POST['name'];
		$description =$_POST['description'];
		$data = serialize(array('color'=>$_POST['data']));

		$insert=$this->contentHelper->inputcatmedia($name,$description,$data);

		if($insert == 1){
				echo "<script>alert('Data berhasil di simpan');window.location.href='".$CONFIG['admin']['base_url']."catMedia'</script>";
			}
	}

	public function view()
	{
		global $CONFIG;
			$id = $_GET ['id'];

			$datacatmedia=$this->contentHelper->selectcatmedia($id);
			
			if($datacatmedia){
					if 	($datacatmedia['data']) $datacatmedia['color'] = unserialize($datacatmedia['data']);
	
				$this->view->assign('datacatmedia',$datacatmedia);
			}

			return $this->loadView($this->folder."view_catMedia");
	}

	public function edit()
	{
		global $CONFIG;
			$id = $_GET ['id'];


			if ($_POST == null){
				$datacatmedia=$this->contentHelper->selectcatmedia($id);
				
				// pr($datacatmedia);
				if($datacatmedia){
						if 	($datacatmedia['data']) $datacatmedia['color'] = unserialize($datacatmedia['data']);
	
					$this->view->assign('datacatmedia',$datacatmedia);
				}		
				
				return $this->loadView($this->folder."edit_catMedia");			
			}

			else {
				$name = $_POST['name'];
				$description =$_POST['description'];
				$data = serialize(array('color'=>$_POST['data']));

				$update = $this->contentHelper->updatecatmedia($id,$name,$description,$data);
					if($update == 1){
						echo "<script>alert('Data berhasil di simpan');window.location.href='".$CONFIG['admin']['base_url']."catMedia'</script>";
				}
			}
	}

	public function delete()
	{
		global $CONFIG;
			$id = $_GET ['id'];

			$datacatmedia=$this->contentHelper->deletecatmedia($id);

			if($datacatmedia == 1){
				echo "<script>alert('Data berhasil di hapus');window.location.href='".$CONFIG['admin']['base_url']."catMedia'</script>";
			}
			else {pr('gagal');}
	}
	
}

?>
