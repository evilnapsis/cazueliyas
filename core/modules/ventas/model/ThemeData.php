<?php
class ThemeData {
	public static $tablename = "theme";

	public  function createForm(){
		$form = new lbForm();
	    $form->addField("header_background_color",array('type' => new lbInputText(array("label"=>"Nombre")),"validate"=>new lbValidator(array())));
	    $form->addField("header_text_color",array('type' => new lbInputText(array("label"=>"Apellido")),"validate"=>new lbValidator(array())));
	    $form->addField("body_background_color",array('type' => new lbInputText(array()),"validate"=>new lbValidator(array())));
	    return $form;

	}

	public function ThemeData(){
		$this->header_background_color = "";
		$this->header_text_color = "";
		$this->body_background_color = "";
		$this->user_id = "";
		$this->body_text_color = "";
		$this->created_at = "NOW()";
	}

	public function add(){
		$sql = "insert into ".self::$tablename." (header_background_color,header_text_color,body_background_color,user_id,body_text_color,created_at) ";
		$sql .= "value (\"$this->header_background_color\",\"$this->header_text_color\",\"$this->body_background_color\",$this->user_id,$this->body_text_color,$this->created_at)";
		Executor::doit($sql);
	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where id=$id";
		Executor::doit($sql);
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id=$this->id";
		Executor::doit($sql);
	}

// partiendo de que ya tenemos creado un objecto ThemeData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set header_background_color=\"$this->header_background_color\",header_text_color=\"$this->header_text_color\",body_background_color=\"$this->body_background_color\",body_text_color=\"$this->body_text_color\" where id=$this->id";
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		$found = null;
		$data = new ThemeData();
		while($r = $query[0]->fetch_array()){
			$data->id = $r['id'];
			$data->header_background_color = $r['header_background_color'];
			$data->header_text_color = $r['header_text_color'];
			$data->body_background_color = $r['body_background_color'];
			$data->body_text_color = $r['body_text_color'];
			$found = $data;
			break;
		}
		return $found;
	}



	public static function getAll(){
		$sql = "select * from ".self::$tablename."";
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new ThemeData();
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->name = $r['name'];
			$array[$cnt]->header_background_color = $r['header_background_color'];
			$array[$cnt]->header_text_color = $r['header_text_color'];
			$array[$cnt]->body_background_color = $r['body_background_color'];
			$array[$cnt]->body_text_color = $r['body_text_color'];
			$cnt++;
		}
		return $array;
	}


	


}

?>