<?php
class LoveData {
	public static $tablename = "love";

	public  function createForm(){
		$form = new lbForm();
	    $form->addField("title",array('type' => new lbInputText(array("label"=>"Nombre")),"validate"=>new lbValidator(array())));
	    $form->addField("content",array('type' => new lbInputText(array("label"=>"Apellido")),"validate"=>new lbValidator(array())));
	    $form->addField("image",array('type' => new lbInputText(array()),"validate"=>new lbValidator(array())));
	    return $form;

	}

	public function LoveData(){
		$this->slide_id = "";
		$this->user_id = "";
		$this->created_at = "NOW()";
	}

	public function add(){
		$sql = "insert into ".self::$tablename." (user_id,slide_id,created_at) ";
		$sql .= "value ($this->user_id,$this->slide_id, $this->created_at)";
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


	public static function getById($id){
		 $sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		$found = null;
		$data = new LoveData();
		while($r = $query[0]->fetch_array()){
			$data->id = $r['id'];
			$data->slide_id = $r['slide_id'];
			$data->user_id = $r['user_id'];
			$data->created_at = $r['created_at'];
			$found = $data;
			break;
		}
		return $found;
	}

	public static function getBySlideId($id){
		 $sql = "select * from ".self::$tablename." where slide_id=$id";
		$query = Executor::doit($sql);
		$found = null;
		$data = new LoveData();
		while($r = $query[0]->fetch_array()){
			$data->id = $r['id'];
			$data->slide_id = $r['slide_id'];
			$data->user_id = $r['user_id'];
			$data->created_at = $r['created_at'];
			$found = $data;
			break;
		}
		return $found;
	}


	public static function LoveId($id){
		$love = false;
		$s = self::getBySlideId($id);
		if($s!=null){ $love=true; }
		return $love;
	}



	public static function getAll(){
		$sql = "select * from ".self::$tablename." order by created_at desc";
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new LoveData();
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->slide_id = $r['slide_id'];
			$array[$cnt]->user_id = $r['user_id'];
			$array[$cnt]->created_at = $r['created_at'];
			$cnt++;
		}
		return $array;
	}

	public static function getAllByUserId($user_id){
		$sql = "select * from ".self::$tablename." where user_id=$user_id order by created_at desc";
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new LoveData();
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->slide_id = $r['slide_id'];
			$array[$cnt]->user_id = $r['user_id'];
			$array[$cnt]->created_at = $r['created_at'];
			$cnt++;
		}
		return $array;
	}

	public static function getAllBySlideId($slide_id){
		$sql = "select * from ".self::$tablename." where slide_id=$slide_id order by created_at desc";
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new LoveData();
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->slide_id = $r['slide_id'];
			$array[$cnt]->user_id = $r['user_id'];
			$array[$cnt]->created_at = $r['created_at'];
			$cnt++;
		}
		return $array;
	}


}

?>