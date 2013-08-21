<?php

class AppConfig extends Eloquent {

	public $timestamps = false;

    protected $guarded = array();

   /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'config';

	public static function get(){
		
		$data = array();

		$config = static::all();

		foreach($config as $_config){

			$data[camel_case($_config->key)] = $_config['value'];
			
		}

		if($data)
			return (object) $data;
		else
			return $data;

	}

}