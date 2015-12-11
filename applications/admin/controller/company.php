<?php

class company extends Controller {
	
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
		$this->folder=CODEKIR_TEMPLATE.'/master/company/';
	}

	public function loadmodule()
	{		
		$this->contentHelper = $this->loadModel('contentHelper');
	}
	
	public function index(){

		global $basedomain, $app_domain;
		
		$data=$this->contentHelper->getcompany();

		if ($data){	
			foreach ($data as $key => $value) {
				if ($value['color']) $data[$key]['color'] = unserialize($value['color']);				
				if ($value['data']) $data[$key]['file'] = unserialize($value['data']);
				//print_r($data[$key]['seri2']);				
			}

			$this->view->assign('data',$data);
		}		

		return $this->loadView($this->folder."company");

	}

	public function create(){

		$data_industry=$this->contentHelper->getindustry();
		$data_template=$this->contentHelper->gettemplate();

		if ($data_industry){	
			$this->view->assign('data_industry',$data_industry);
		}
		if ($data_template) {
			$this->view->assign('data_template',$data_template);
		}


		return $this->loadView($this->folder."create_company");

	}

	public function input()
	{
		global $CONFIG;
		$name = $_POST['name'];
		$id_industry = $_POST['id_industry'];
		$template = $_POST['template'];
		$color = serialize(array('bg_color'=>$_POST['bg_color'],'header_color'=>$_POST['header_color'],
			'stack_color'=>$_POST['stack_color'],'menu_color'=>$_POST['menu_color'],'menu_sel_color'=>$_POST['menu_sel_color']));
		$email = $_POST['email'];
		$logo = $_POST['logo'];
		$data = serialize(array('login_page'=> $_POST['login_page'],'login' => $_POST['login'],'logo_pdf' => $_POST['logo_pdf']));
		$description =$_POST['description'];
		//$data1 = $_POST['data'];
		//$data = serialize(array('color'=>$_POST['data']));

		// pr($_POST);exit;

		$insert=$this->contentHelper->inputcompany($name,$id_industry,$template,$color,$email,$logo,$data,$description);

		if($insert == 1){
				echo "<script>alert('Data berhasil di simpan');window.location.href='".$CONFIG['admin']['base_url']."company'</script>";
			}
	}

	public function view()
	{
		global $CONFIG;
			$id = $_GET ['id'];

			$data=$this->contentHelper->selectcompany($id);
			
			if($data){					
					
					if ($data['data']) $data['file'] = unserialize($data['data']);
					if ($data['color']) $data['color'] = unserialize($data['color']);
	
				$this->view->assign('data',$data);
			}

			return $this->loadView($this->folder."view_company");
	}

	public function edit(){

		global $CONFIG;
			$id = $_GET ['id'];

			if ($_POST == null){
				$data=$this->contentHelper->selectcompany($id);
				
				if($data){

					if ($data['data']) $data['file'] = unserialize($data['data']);
					if ($data['color']) $data['color'] = unserialize($data['color']);

					$this->view->assign('data',$data);
				}		
				
				return $this->loadView($this->folder."edit_company");			
			}

			else {
				$name = $_POST['name'];
				$id_industry = $_POST['id_industry'];
				$template = $_POST['template'];
				$color = serialize(array('bg_color'=>$_POST['bg_color'],'header_color'=>$_POST['header_color'],
					'stack_color'=>$_POST['stack_color'],'menu_color'=>$_POST['menu_color'],'menu_sel_color'=>$_POST['menu_sel_color']));
				$email = $_POST['email'];
				$logo = $_POST['logo'];
				$data = serialize(array('login_page'=> $_POST['login_page'],'login' => $_POST['login'],'logo_pdf' => $_POST['logo_pdf']));
				$description =$_POST['description'];
				$update = $this->contentHelper->updatecompany($id,$name,$id_industry,$template,$color,$email,$logo,$data,$description);
				//pr($data);
					if($update == 1){
						echo "<script>alert('Data berhasil di simpan');window.location.href='".$CONFIG['admin']['base_url']."company'</script>";
				}
			}
	}

	public function delete()
	{
		global $CONFIG;
			$id = $_GET ['id'];

			$data=$this->contentHelper->deletecompany($id);

			if($data == 1){
				echo "<script>alert('Data berhasil di hapus');window.location.href='".$CONFIG['admin']['base_url']."company'</script>";
			}
			else {pr('gagal');}
	}


	
}

?>
