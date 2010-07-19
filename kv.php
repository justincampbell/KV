<?php

class KV extends Model {

	function KV()
	{
		parent::Model();
		$this->load->database();
		$this->memcache = new Memcache;
		$this->memcache->connect('localhost', 11211) or die;
		$this->memcache_age = 86400;
		$this->key_prefix = 'myapp:';
		$this->logging = FALSE;
	}
	
	function get($key, $decode=NULL)
	{
		$key = $this->key_prefix.$key;
		$result = $this->memcache->get($key);
		if (!$result) {
			$result = $this->db->query('
				select v
				from kv
				where k = '.$this->db->escape($key)
				)->result_array();
			if ($result) $result = $result[0]['v'];
			$this->memcache->set($key, $result, false, $this->memcache_age);
		}
		if ($result) {
			if ($decode) $result = json_decode($result);
			return $result;
		} else {
			return NULL;
		}
	}
	
	function get_object($key)
	{
		return json_decode($this->get($key));
	}
	
	function set($key, $value, $memcache=TRUE)
	{
		$key = $this->key_prefix.$key;
		if (is_object($value)) $value = json_encode($value);
		if ($this->db->query('
			insert into kv
			(k, v)
			values
			('.$this->db->escape($key).', '.$this->db->escape($value).')
			on duplicate key update
			v = '.$this->db->escape($value).';
		')) {
			if ($memcache) $this->memcache->set($key, $value, false, $this->memcache_age);
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	function del($key)
	{
		if ($this->get($key))
		{
			$key = $this->key_prefix.$key;
			$this->memcache->delete($key);
			$this->db->delete('kv', array('k' => $key));
			return TRUE;
		} else {
			return FALSE;
		}
	}
		
}

?>