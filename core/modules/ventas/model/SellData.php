<?php
class SellData {
	public static $tablename = "sell";

	public function SellData(){
		$this->created_at = "NOW()";
	}

	public function add(){
		$sql = "insert into ".self::$tablename." (mesa,mesero_id,created_at) ";
		$sql .= "value (\"$this->mesa\",$this->mesero_id,$this->created_at)";
		return Executor::doit($sql);
	}

	public function apply(){
		$sql = "update ".self::$tablename." set is_applied=1,cajero_id=$this->cajero_id where id=$this->id";
		return Executor::doit($sql);
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
		$data = new SellData();
		while($r = $query[0]->fetch_array()){
			$data->id = $r['id'];
			$data->mesero_id = $r['mesero_id'];
			$data->cajero_id = $r['cajero_id'];
			$data->mesa = $r['mesa'];
			$data->is_applied = $r['is_applied'];
			$data->created_at = $r['created_at'];
			$found = $data;
			break;
		}
		return $found;
	}



	public static function getAll(){
		$sql = "select * from ".self::$tablename." order by created_at desc";
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new SellData();
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->mesero_id = $r['mesero_id'];
			$array[$cnt]->cajero_id = $r['cajero_id'];
			$array[$cnt]->mesa = $r['mesa'];
			$array[$cnt]->is_applied = $r['is_applied'];
			$array[$cnt]->created_at = $r['created_at'];
			$cnt++;
		}
		return $array;
	}

	public static function getAllUnApplied(){
		$sql = "select * from ".self::$tablename." where is_applied=0 order by created_at desc";
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new SellData();
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->mesero_id = $r['mesero_id'];
			$array[$cnt]->cajero_id = $r['cajero_id'];
			$array[$cnt]->mesa = $r['mesa'];
			$array[$cnt]->is_applied = $r['is_applied'];
			$array[$cnt]->created_at = $r['created_at'];
			$cnt++;
		}
		return $array;
	}

	public static function getAllTotalByMesero($mesero_id){
		$sql = "select mesero_id,product.name,q,price_out,q*price_out as total,operation.created_at as c from operation inner join sell on (sell.id=operation.sell_id) inner join product on (product.id=operation.product_id) where mesero_id=$mesero_id";
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new SellData();
			$array[$cnt]->mesero_id = $r['mesero_id'];
			$array[$cnt]->name = $r['name'];
			$array[$cnt]->q = $r['q'];
			$array[$cnt]->price_out = $r['price_out'];
			$array[$cnt]->total = $r['total'];
			$array[$cnt]->c = $r['c'];
			$cnt++;
		}
		return $array;
	}


	public static function getAllMonthlyByMesero($mesero_id){
		$sql = "select mesero_id,product.name,q,price_out,q*price_out as total,operation.created_at as c from operation inner join sell on (sell.id=operation.sell_id) inner join product on (product.id=operation.product_id) where month(operation.created_at)=month(now()) and year(operation.created_at)=year(now()) and mesero_id=$mesero_id";
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new SellData();
			$array[$cnt]->mesero_id = $r['mesero_id'];
			$array[$cnt]->name = $r['name'];
			$array[$cnt]->q = $r['q'];
			$array[$cnt]->price_out = $r['price_out'];
			$array[$cnt]->total = $r['total'];
			$array[$cnt]->c = $r['c'];
			$cnt++;
		}
		return $array;
	}

	public static function getAllDayliByMesero($mesero_id){
		$sql = "select mesero_id,product.name,q,price_out,q*price_out as total,operation.created_at as c from operation inner join sell on (sell.id=operation.sell_id) inner join product on (product.id=operation.product_id) where month(operation.created_at)=month(now()) and year(operation.created_at)=year(now()) and day(operation.created_at)=day(now()) and mesero_id=$mesero_id";
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new SellData();
			$array[$cnt]->mesero_id = $r['mesero_id'];
			$array[$cnt]->name = $r['name'];
			$array[$cnt]->q = $r['q'];
			$array[$cnt]->price_out = $r['price_out'];
			$array[$cnt]->total = $r['total'];
			$array[$cnt]->c = $r['c'];
			$cnt++;
		}
		return $array;
	}


	public static function getAllApplied(){
		$sql = "select * from ".self::$tablename." where is_applied=1 order by created_at desc";
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new SellData();
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->mesero_id = $r['mesero_id'];
			$array[$cnt]->cajero_id = $r['cajero_id'];
			$array[$cnt]->mesa = $r['mesa'];
			$array[$cnt]->is_applied = $r['is_applied'];
			$array[$cnt]->created_at = $r['created_at'];
			$cnt++;
		}
		return $array;
	}

	public static function getAllByPage($start_from,$limit){
		$sql = "select * from ".self::$tablename." where id<=$start_from limit $limit";
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new SellData();
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->mesero_id = $r['mesero_id'];
			$array[$cnt]->cajero_id = $r['cajero_id'];
			$array[$cnt]->mesa = $r['mesa'];
			$array[$cnt]->is_applied = $r['is_applied'];
			$array[$cnt]->created_at = $r['created_at'];
			$cnt++;
		}
		return $array;
	}

	public static function getAllUnAppliedByPage($start_from,$limit){
		$sql = "select * from ".self::$tablename." where id<=$start_from and is_applied=0 limit $limit";
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new SellData();
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->mesero_id = $r['mesero_id'];
			$array[$cnt]->cajero_id = $r['cajero_id'];
			$array[$cnt]->mesa = $r['mesa'];
			$array[$cnt]->is_applied = $r['is_applied'];
			$array[$cnt]->created_at = $r['created_at'];
			$cnt++;
		}
		return $array;
	}

	public static function getAllAppliedByPage($start_from,$limit){
		$sql = "select * from ".self::$tablename." where id<=$start_from and is_applied=1 limit $limit";
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new SellData();
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->mesero_id = $r['mesero_id'];
			$array[$cnt]->cajero_id = $r['cajero_id'];
			$array[$cnt]->mesa = $r['mesa'];
			$array[$cnt]->is_applied = $r['is_applied'];
			$array[$cnt]->created_at = $r['created_at'];
			$cnt++;
		}
		return $array;
	}


}

?>