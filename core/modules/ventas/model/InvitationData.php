<?php
class InvitationData {
	public static $tablename = "invitation";


	public function InvitationData(){
		$this->the_key = "";
		$this->is_used = "";
		$this->email = "";
		$this->user_id = "";
		$this->created_at = "NOW()";
	}

	public function add(){
		$sql = "insert into ".self::$tablename." (the_key,email,user_id,created_at) ";
		$sql .= "value (\"$this->the_key\",\"$this->email\",\"$this->user_id\",$this->created_at)";
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

// partiendo de que ya tenemos creado un objecto InvitationData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set is_used=$this->is_used where id=$this->id";
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		$found = null;
		$data = new InvitationData();
		while($r = $query[0]->fetch_array()){
			$data->id = $r['id'];
			$data->the_key = $r['the_key'];
			$data->is_used = $r['is_used'];
			$data->email = $r['email'];
			$data->user_id = $r['user_id'];
			$data->created_at = $r['created_at'];
			$found = $data;
			break;
		}
		return $found;
	}


	public static function getByEK($email,$the_key){
		$sql = "select * from ".self::$tablename." where email=\"$email\" and the_key=\"$the_key\"";
		$query = Executor::doit($sql);
		$found = null;
		$data = new InvitationData();
		while($r = $query[0]->fetch_array()){
			$data->id = $r['id'];
			$data->the_key = $r['the_key'];
			$data->is_used = $r['is_used'];
			$data->email = $r['email'];
			$data->user_id = $r['user_id'];
			$data->created_at = $r['created_at'];
			$found = $data;
			break;
		}
		return $found;
	}


	public static function getByMail($mail){
		echo $sql = "select * from ".self::$tablename." where email=\"$mail\"";
		$query = Executor::doit($sql);
		$found = null;
		$data = new InvitationData();
		while($r = $query[0]->fetch_array()){
			$data->id = $r['id'];
			$data->the_key = $r['the_key'];
			$data->email = $r['email'];
			$data->is_used = $r['is_used'];
			$data->user_id = $r['user_id'];
			$data->created_at = $r['created_at'];
			$found = $data;
			break;
		}
		return $found;
	}


	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new InvitationData();
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->the_key = $r['the_key'];
			$array[$cnt]->is_used = $r['is_used'];
			$array[$cnt]->email = $r['email'];
			$array[$cnt]->user_id = $r['user_id'];
			$array[$cnt]->created_at = $r['created_at'];
			$cnt++;
		}
		return $array;
	}

	public static function getAllByUserId($user_id){
		$sql = "select * from ".self::$tablename." where user_id=$user_id";
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new InvitationData();
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->the_key = $r['the_key'];
			$array[$cnt]->is_used = $r['is_used'];
			$array[$cnt]->email = $r['email'];
			$array[$cnt]->user_id = $r['user_id'];
			$array[$cnt]->created_at = $r['created_at'];
			$cnt++;
		}
		return $array;
	}



}

?>