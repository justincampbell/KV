# CodeIgniter key/value wrapper for MySQL with memcached support

## Table

	create table kv (
		k VARCHAR(255) NOT NULL PRIMARY KEY,
		v LONGTEXT
	);

## Usage

### Load the model
	$this->load->model('kv');

### Typical commands and responses
	$this->kv->set('testkey','data');
	TRUE
	$this->kv->get('testkey');
	'data'
	$this->kv->del('testkey');
	TRUE
	$this->kv->get('testkey');
	NULL

### Objects and JSON

TODO

