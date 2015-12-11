<?php
// defined ('TATARUANG') or exit ( 'Forbidden Access' );

class user extends Controller {
	
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
		$this->folder=CODEKIR_TEMPLATE.'/master/user/';
	}
	public function loadmodule()
	{
		
		$this->contentHelper = $this->loadModel('contentHelper');
	}
	
	public function index()
	{

		$data = $this->contentHelper->getuser();

		if ($data) {
			$this->view->assign('data',$data);
		}
	
		return $this->loadView($this->folder."user");

	}

	
	public function create()
	{
		//buat combobox perusahaan

		$data = $this->contentHelper->getcompany();

		if ($data) {
			$this->view->assign('data',$data);
		}

		return $this->loadView($this->folder."create_user");

	}

	public function input()
	{		
		global $CONFIG;

		$name = $_POST['name'];
		$username = $_POST['username'];
		//$password = $_POST['password'];
		$email = $_POST['email'];
		$hp = serialize(array('phone' => $_POST['phone'], 'mobilephone' => $_POST['mobilephone']));
		$hak_akses = $_POST['role'];
		$n_status = $_POST['status'];
		$institusi = $_POST['perusahaan'];
		$alamat = $_POST['address'];
		$image =$_POST['photo'];
		$salt = 1234567890;

		if($_POST['password']!=''){
			$password = sha1(_P('password').$salt);;
		}
		
		$insert=$this->contentHelper->inputuser($name,$username,$password,$email,$hp,$hak_akses,$n_status,$institusi,$alamat,$image,$salt);

		if($insert == 1){
				echo "<script>alert('Data berhasil di simpan');window.location.href='".$CONFIG['admin']['base_url']."user'</script>";
			}

	}

	public function view()
	{
		global $CONFIG;
			$id = $_GET ['id'];

			$data=$this->contentHelper->selectuser($id);
			
			if($data){					
					
					if ($data['hp']) $data['hp'] = unserialize($data['hp']);
	
				$this->view->assign('data',$data);
			}

			return $this->loadView($this->folder."view_user");
	}

	public function edit(){

		global $CONFIG;
			$id = $_GET ['id'];

			if ($_POST == null){
				$data=$this->contentHelper->selectuser($id);
				
				if($data){

					if ($data['hp']) $data['hp'] = unserialize($data['hp']);

					$this->view->assign('data',$data);
				}		

				
				return $this->loadView($this->folder."edit_user");			
			}

			else {
				$name = $_POST['name'];
				$username = $_POST['username'];
				//$password = $_POST['password'];
				$email = $_POST['email'];
				$hp = serialize(array('phone' => $_POST['phone'], 'mobilephone' => $_POST['mobilephone']));
				$hak_akses = $_POST['role'];
				$n_status = $_POST['status'];
				$institusi = $_POST['perusahaan'];
				$alamat = $_POST['address'];
				$image =$_POST['photo'];
				$salt = 1234567890;

				if($_POST['password']!=''){
					$password = sha1(_P('password').$salt);;
				}

				$update = $this->contentHelper->updateuser($id,$name,$username,$password,$email,$hp,$hak_akses,$n_status,$institusi,$alamat,$image,$salt);
				//pr($data);
					if($update == 1){
						echo "<script>alert('Data berhasil di simpan');window.location.href='".$CONFIG['admin']['base_url']."user'</script>";
				}
			}
	}

	public function delete()
	{
		global $CONFIG;
			$id = $_GET ['id'];

			$data=$this->contentHelper->deleteuser($id);

			if($data == 1){
				echo "<script>alert('Data berhasil di hapus');window.location.href='".$CONFIG['admin']['base_url']."user'</script>";
			}
			else {pr('gagal');}
	}


	
}

?>
