<?php

class categoryHelper extends Database 
{
	function __construct() {
        global $basedomain;
	}
	
	function addCategory() {
		$parent = _p('parent');
		$name = _p('name');
		$description = _p('description');
		$meta_description = _p('meta_description');
		$meta_keywords = _p('meta_keywords');
		$top = _p('top');
		$column = _p('column');
		$sort_order = _p('sort_order');
		$status = _p('status');
		$image = _p('image');
		$date_added = date('Y-m-d H:i:s');
		
		$query = "INSERT INTO ck_category (image, parent_id, top, `column`, status, sort_order, date_added) VALUES ('{$image}', {$parent}, {$top}, {$column}, {$status}, {$sort_order}, '{$date_added}')";
		
		//echo "<br />".$query;
		
		$result_query = $this->query($query);
		
		$id = $this->insert_id(); 
		
		$query_desc = "INSERT INTO ck_category_description (category_id, name, description, meta_description, meta_keyword) VALUES ({$id}, '{$name}', '{$description}', '{$meta_description}', '{$meta_keywords}')";
		
		$result_desc = $this->query($query_desc);
		
		return $result_desc && $result_query;
	}
}

?>