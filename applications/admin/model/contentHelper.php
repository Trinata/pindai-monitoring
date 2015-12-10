<?php
class contentHelper extends Database {
	
	var $prefix = "ck";	
	function getData()
	{
		$sql = "SELECT * FROM code_activity";
		$res = $this->fetch($sql,1);
		if ($res) return $res;
		return false;
	}
	
	function test()
	{

		$sql = "SHOW COLUMNS FROM {$this->prefix}_user";
		$res = $this->fetch($sql);
		pr($res);
	}

	function getMessage() 
	{
		$sql = "SELECT m.*, um.name,um.email FROM my_message m LEFT JOIN user_member um ON m.receive = um.id ";
		$res = $this->fetch($sql,1);
		if ($res) return $res;
		return false;
	}
	
	function saveMessage($data)
	{
		foreach ($data as $key => $val){
			$tmpfield[] = $key;
			$tmpdata[] = "'$val'";
		}
		// from,to,subject,content,createdate,n_status
		$tmpfield[] = 'fromwho';
		$tmpfield[] = 'createdate';
		$tmpfield[] = 'n_status';
		
		$date = date('Y-m-d H:i:s');
		$tmpdata[] = 0;
		$tmpdata[] = "'{$date}'";
		$tmpdata[] = 1;
		
		$field = implode(',',$tmpfield);
		$data = implode(',',$tmpdata);
		
		$sql = "INSERT INTO my_message ({$field}) 
				VALUES ({$data})";
		// pr($sql);
		// exit;
		$res = $this->query($sql);
		if ($res) return true;
		return false;
	}
	
	function get_user($data)
	{
		$query = "SELECT * FROM user_member WHERE email = '{$data}'";
		
		$result = $this->fetch($query,1);
		
		return $result;
	}
	
	function importData($name=null)
	{
		$query = "INSERT INTO import (name,n_status) VALUES ('{$name}', 1)";
		// pr($query);
		$result = $this->query($query);
		
		return $result;
	}

	function saveData($data=array(), $table="_event", $debug=0)
    {
        
        $id = " id = {$data['id']}";
        if ($id){
            $run = $this->save("update", "{$this->prefix}{$table}", $data, $id, $debug);
        }else{
            $data['createDate'] = date('Y-m-d H:i;s');
            $run = $this->save("insert", "{$this->prefix}{$table}", $data, false, $debug);
    
        }
        if ($run) return true;
        return false;
    }

    function fetchData($data=array(),$debug=false)
    {
        $table = $data['table'];
        $condition = $data['condition'];
        $orderby = $data['orderby'];
        $fetch = $this->fetchSingleTable($table, $condition, $orderby, $debug);
        if ($fetch) return $fetch;
        return false;
    }


    //Media
    function getmedia()
	{
		$query = "SELECT * FROM pindai_ref_media WHERE n_status = 1";
		$result = $this->fetch($query,1); 
		return $result;
	}

	function inputmedia($name,$media_category,$pic,$data)
    {
     	$query = "INSERT INTO pindai_ref_media (
    											name,
    											media_category,
    											pic,
    											data) 
										VALUES ('".$name."',
												'".$media_category."',
												'".$pic."',
												'".$data."')";
    	$exec = $this->query($query);	
		if($exec) return 1; else pr('query gagal');
    }

    function selectmedia($id)
    {
    	$query = "SELECT * FROM pindai_ref_media WHERE id ='".$id."'";
		$result = $this->fetch($query,0,0);
		return $result;
    }

    function updatemedia($id,$name,$media_category,$pic,$data)
    {
	   	$query = "UPDATE pindai_ref_media SET 
	   											name='".$name."',
	   											media_category='".$media_category."',
	   											pic='".$pic."',
	   											data='".$data."'
	   										WHERE id = '".$id."' LIMIT 1";
    	$exec = $this->query($query,0);	
    	if($exec) return 1; else pr('query gagal');
    }

    function deletemedia($id)
    {
    	$query = "UPDATE pindai_ref_media SET n_status='2' WHERE id = '".$id."'";
    	$exec = $this->query($query,0);	
    	if($exec) return 1; else pr('query gagal');
	}


	// Category Media
	function getcatmedia()
	{
		$query = "SELECT * FROM pindai_ref_media_category WHERE n_status = 1";
		$result = $this->fetch($query,1); 
		return $result;
	}

	function inputcatmedia($name,$description,$data)
    {
     	$query = "INSERT INTO pindai_ref_media_category (
    											name,
    											description,
    											data) 
										VALUES ('".$name."',
												'".$description."',
												'".$data."')";
    	$exec = $this->query($query);	
		if($exec) return 1; else pr('query gagal');
    }

    function selectcatmedia($id)
    {
    	$query = "SELECT * FROM pindai_ref_media_category WHERE id ='".$id."'";
		$result = $this->fetch($query,0,0);
		return $result;
    }

    function updatecatmedia($id,$name,$description,$data)
    {
	   	$query = "UPDATE pindai_ref_media_category SET 
	   											name='".$name."',
	   											description='".$description."',
	   											data='".$data."'
	   										WHERE id = '".$id."' LIMIT 1";
    	$exec = $this->query($query,0);	
    	if($exec) return 1; else pr('query gagal');
    }

    function deletecatmedia($id)
    {
    	$query = "UPDATE pindai_ref_media_category SET n_status='2' WHERE id = '".$id."'";
    	$exec = $this->query($query,0);	
    	if($exec) return 1; else pr('query gagal');
	}


    //Journalist

	function getjournalist()
	{
		$query = "SELECT * FROM pindai_ref_journalist WHERE n_status = 1";

		$result = $this->fetch($query,1); 
		return $result;
	}

    function inputjournalist($name)
    {
    	$query = "INSERT INTO pindai_ref_journalist (name) VALUES ('".$name."')";
    	$exec = $this->query($query);	
		if($exec) return 1; else pr('query gagal');
    }

    
    function selectjournalist($id)
    {
    	$query = "SELECT * FROM pindai_ref_journalist WHERE id ='".$id."'";
		$result = $this->fetch($query,0,0);
		return $result;
    }

    function updatejournalist($id,$name)
    {
	   	$query = "UPDATE pindai_ref_journalist SET name='".$name."' WHERE id = '".$id."' LIMIT 1";
    	$exec = $this->query($query,0);	
    	if($exec) return 1; else pr('query gagal');
    }

    function deletejournalist($id)
    {
    	$query = "UPDATE pindai_ref_journalist SET n_status='2' WHERE id = '".$id."'";
    	$exec = $this->query($query,0);	
    	if($exec) return 1; else pr('query gagal');
    }


    // Mind Share
    function getmindshare()
	{
		$query = "SELECT * FROM pindai_ref_mindshare WHERE n_status = 1";
		$result = $this->fetch($query,1); 
		return $result;
	}

	function inputmindshare($name,$description,$company_id,$sort,$data)
    {
    	$date = date("Y-m-d H:i:s");
    	$query = "INSERT INTO pindai_ref_mindshare (
    											name,
    											description,
    											data,
    											company_id,
    											sort,
    											create_date
    											update_date) 
										VALUES ('".$name."',
												'".$description."',
												'".$data."',
												'".$company_id."',
												'".$sort."',
												'{$date}')";
    	$exec = $this->query($query);	
		if($exec) return 1; else pr('query gagal');
    }

    function selectmindshare($id)
    {
    	$query = "SELECT * FROM pindai_ref_mindshare WHERE id ='".$id."'";
		$result = $this->fetch($query,0,0);
		return $result;
    }

    function updatemindshare($id,$name,$description,$company_id,$sort,$data)
    {
	   	$date = date("Y-m-d H:i:s");
	   	$query = "UPDATE pindai_ref_mindshare SET 
	   											name='".$name."',
	   											description='".$description."',
	   											company_id='".$company_id."',
	   											sort='".$sort."',
	   											data='".$data."',
	   											update_date='{$date}'
	   										WHERE id = '".$id."' LIMIT 1";
    	$exec = $this->query($query,0);	
    	if($exec) return 1; else pr('query gagal');
    }

    function deletemindshare($id)
    {
    	$query = "UPDATE pindai_ref_mindshare SET n_status='2' WHERE id = '".$id."'";
    	$exec = $this->query($query,0);	
    	if($exec) return 1; else pr('query gagal');
	}

    
    // Rubric

	function getrubric()
	{
		$query = "SELECT * FROM pindai_ref_rubrik WHERE n_status = 1";

		$result = $this->fetch($query,1); 
		return $result;
	}

	function inputrubric($name)
    {
    	$query = "INSERT INTO pindai_ref_rubrik (name) VALUES ('".$name."')";
    	$exec = $this->query($query);	
		if($exec) return 1; else pr('query gagal');
    }

    function selectrubric($id)
    {
    	$query = "SELECT * FROM pindai_ref_rubrik WHERE id ='".$id."'";
		$result = $this->fetch($query,0,0);
		return $result;
    }

    function updaterubric($id,$name)
    {
	   	$query = "UPDATE pindai_ref_rubrik SET name='".$name."' WHERE id = '".$id."' LIMIT 1";
    	$exec = $this->query($query,0);	
    	if($exec) return 1; else pr('query gagal');
    }

    function deleterubric($id)
    {
    	$query = "UPDATE pindai_ref_rubrik SET n_status='2' WHERE id = '".$id."'";
    	$exec = $this->query($query,0);	
    	if($exec) return 1; else pr('query gagal');
	}


	// Source

	function getsource()
	{
		$query = "SELECT * FROM pindai_ref_source WHERE n_status = 1";

		$result = $this->fetch($query,1); 
		return $result;
	}

	function inputsource($name,$position)
    {
    	$query = "INSERT INTO pindai_ref_source (name, position) VALUES ('".$name."', '".$position."')";
    	$exec = $this->query($query);	
		if($exec) return 1; else pr('query gagal');
    }

    function selectsource($id)
    {
    	$query = "SELECT * FROM pindai_ref_source WHERE id ='".$id."'";
		$result = $this->fetch($query,0,0);
		return $result;
    }

    function updatesource($id,$name,$position)
    {
	   	$query = "UPDATE pindai_ref_source SET name='".$name."', position='".$position."' WHERE id = '".$id."' LIMIT 1";
    	$exec = $this->query($query,0);	
    	if($exec) return 1; else pr('query gagal');
    }

    function deletesource($id)
    {
    	$query = "UPDATE pindai_ref_source SET n_status='2' WHERE id = '".$id."'";
    	$exec = $this->query($query,0);	
    	if($exec) return 1; else pr('query gagal');
	}


	// Topik

	function gettopik()
	{
		$query = "SELECT * FROM pindai_ref_topic WHERE n_status = 1";

		$result = $this->fetch($query,1); 
		return $result;
	}

	function inputtopik($name)
    {
    	$query = "INSERT INTO pindai_ref_topic (name) VALUES ('".$name."')";
    	$exec = $this->query($query);	
		if($exec) return 1; else pr('query gagal');
    }

    function selecttopik($id)
    {
    	$query = "SELECT * FROM pindai_ref_topic WHERE id ='".$id."'";
		$result = $this->fetch($query,0,0);
		return $result;
    }

    function updatetopik($id,$name)
    {
	   	$query = "UPDATE pindai_ref_topic SET name='".$name."' WHERE id = '".$id."' LIMIT 1";
    	$exec = $this->query($query,0);	
    	if($exec) return 1; else pr('query gagal');
    }

    function deletetopik($id)
    {
    	$query = "UPDATE pindai_ref_topic SET n_status='2' WHERE id = '".$id."'";
    	$exec = $this->query($query,0);	
    	if($exec) return 1; else pr('query gagal');
	}

	function coba2()
	{
		$sql = array(
                'table'=>"ck_user_member",
                'field'=>"*",
                'condition' => "n_status = 1",
                );
        $res = $this->lazyQuery($sql,$debug);
        if ($res) return $res;
        return false;
	}

	//Industry

	function getindustry()
	{
		$query = "SELECT * FROM pindai_ref_industry WHERE n_status = 1";

		$result = $this->fetch($query,1); 
		return $result;
	}

	function inputindustry($name)
    {
    	$query = "INSERT INTO pindai_ref_industry (name) VALUES ('".$name."')";
    	$exec = $this->query($query);	
		if($exec) return 1; else pr('query gagal');
    }

     function selectindustry($id)
    {
    	$query = "SELECT * FROM pindai_ref_industry WHERE id ='".$id."'";
		$result = $this->fetch($query,0,0);
		return $result;
    }

    function updateindustry($id,$name)
    {
	   	$query = "UPDATE pindai_ref_industry SET name='".$name."' WHERE id = '".$id."' LIMIT 1";
    	$exec = $this->query($query,0,2);	
    	if($exec) return 1; else pr('query gagal');
    }

    function deleteindustry($id)
    {
    	$query = "UPDATE pindai_ref_industry SET n_status='2' WHERE id = '".$id."'";
    	$exec = $this->query($query,0,2);	
    	if($exec) return 1; else pr('query gagal');
	}

	//Company

	function getcompany()
	{
		$query = "SELECT * FROM pindai_ref_company WHERE n_status = 1";

		$result = $this->fetch($query,1); 
		return $result;
	}

	function gettemplate(){
		$query = "SELECT * FROM ck_template WHERE n_status = 1";

		$result = $this->fetch($query,1); 
		return $result;
	}

	function inputcompany($name,$id_industry,$template,$color,$email,$logo,$description)
    {
    	$date = date("Y-m-d H:i:s");
    	$query = "INSERT INTO pindai_ref_company (
    											name,
    											id_industry,
    											template,
    											color,
    											email,
    											logo,
    											description,
    											create_date
    											update_date) 
										VALUES ('".$name."',
												'".$id_industry."',
												'".$template."',
												'".$color."',
												'".$email."',
												'".$logo."',
												'".$description."',
												'{$date}')";
    	$exec = $this->query($query);	
		if($exec) return 1; else pr('query gagal');
    }



}
?>