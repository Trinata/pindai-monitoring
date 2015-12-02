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
}
?>