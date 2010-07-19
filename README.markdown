# CodeIgniter key/value wrapper for MySQL with memcached support

## Table

	create table kv (
		k VARCHAR(255) NOT NULL PRIMARY KEY,
		v LONGTEXT
	);

## Usage

	$this->load->model('kv');

	$this->kv->set('testkey','data');
	// TRUE
	$this->kv->get('testkey');
	// 'data'
	$this->kv->del('testkey');
	// TRUE
	$this->kv->get('testkey');
	// NULL
	

