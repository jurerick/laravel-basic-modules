<?php

class Role extends Eloquent {

	public $timestamps = false;

    protected $guarded = array();


    public function user(){

    	return $this->hasMany('User');

    }

}