<?php 
namespace models;
/**
* 
*/
class Config extends BaseModel
{
	public $tableName = 'configs';

	public $columns = [	'config_value', 'config_name', 'id'];
}

 ?>
