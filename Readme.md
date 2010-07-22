# CodeIgniter key/value wrapper for MySQL with memcached support

## Table

	create table kv (
		k VARCHAR(255) NOT NULL PRIMARY KEY,
		v LONGTEXT
	);

## Installation
Copy kv.php to your application/models directory:
	cd myapp/system/applications/models
	wget http://github.com/justincampbell/KV/raw/master/kv.php

## Usage

### Load the model
	$this->load->model('kv');

### Typical commands and responses

	$this->kv->set('testkey','test'); // TRUE
	$this->kv->set('testkey','test'); // TRUE
	$this->kv->set('testkey','data'); // TRUE
	
	$this->kv->get('testkey'); // string('data')
	
	$this->kv->del('testkey'); // TRUE
	$this->kv->del('testkey'); // FALSE
	
	$this->kv->get('testkey'); // NULL

### Objects and JSON

	$object->name = "Test name";
	$object->type = "Awesome";
	$object->test = "Yabba dabba do";
	
	$this->kv->set('testkey', $object); //TRUE
	
	$json = $this->kv->get('testkey'); // string({"name":"Test name","type":"Awesome","test":"Yabba dabba do"})
	
	$object = $this->kv->get_object('testkey'); // object({"name":"Test name","type":"Awesome","test":"Yabba dabba do"})
	
	$object->name = $this->kv->get_object('testkey')->name; // string('Test name')
