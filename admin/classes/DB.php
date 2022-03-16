<?php
// Class database
class DB {
	// Các biến kết nối
	private $localhost = 'localhost', $username = 'root', $password = '', $dbname = 'lekhacdong';

	public $cn = NULL;
	
	// Kết nối
	public function connect(){
		$this->cn = mysqli_connect($this->localhost, $this->username, $this->password, $this->dbname);
	}

	// Ngắt kết nối
	public function close(){
		if ($this->cn){
			mysqli_close($this->cn);
		}
	}

	// Truy vấn
	public function query($sql = null){
		if ($this->cn){
			mysqli_query($this->cn, $sql);
		}
	}

	// Đếm số hàng
	public function num_rows($sql = null){
		if ($this->cn){
			$query = mysqli_query($this->cn, $sql);
			if ($query){
				$row = mysqli_num_rows($query);
				return $row;
			}
		}
	}

	// Lấy dữ liệu
	public function fetch_assoc($sql = null, $type){
		if ($this->cn){
			$query = mysqli_query($this->cn, $sql);
			if ($query)
			{
				if ($type == 0){
					while ($row = mysqli_fetch_assoc($query))
					{
						$data[] = $row;
					}
					return $data;
				}else if ($type == 1)
				{
					$data = mysqli_fetch_assoc($query);
					return $data;
				}
			}
		}
	}

	// Lấy id
	public function insert_id(){
		if ($this->cn){
			$count = mysqli_insert_id($this->cn);
			if ($count = 0){
				$count = '1';
			}else {
				$count = $count;
			}
			return $count;
		}
	}

	// Charset database
	public function set_char($uni){
		if ($this->cn){
			mysqli_set_charset($this->cn, $uni);
		}
	}
}
?>