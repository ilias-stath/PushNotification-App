<?php

class Departements{
	
	private $titles;
	private $dates;
	private $links;
	private $feedLink;
	private $feed;
	private $tableName;
	private $segment;

	public function __construct($feedLink,$feed,$table,$seg){
		$this->titles = array();
		$this->dates = array();
		$this->links = array();
		$this->feedLink = $feedLink;
		$this->feed = $feed;
		$this->tableName = $table;
		$this->segment = $seg;
		
	}

	//For titles
	public function addTitles($titles){
		$this->titles = $titles;
	}

	public function getTitles(){
		return $this->titles;
	}
	
	public function getTitleValue($index){
		return $this->titles[$index];
	}

	//For dates
	public function addDates($date){
		$this->dates = $date;
	}

	public function getDates(){
		return $this->dates;
	}

	public function getDateValue($index){
		return $this->dates[$index];
	}

	//For links
	public function addLinks($link){
		$this->links = $link;
	}

	public function getLinks(){
		return $this->links;
	}

	public function getLinkValue($index){
		return $this->links[$index];
	}

	//For feedLink
	/*
	public function setFeedLink($feedLink){
		$this->feedLink = $feedLink;
	}*/

	public function getFeedLink(){
		return $this->feedLink;
	}

	//For feed.txt
	/*
	public function setFeed($feed){
		$this->feed = $feed;
	}*/

	public function getFeed(){
		return $this->feed;
	}

	//For Table name
	/*
	public function setTable($table){
		$this->tableName = $table;
	}*/

	public function getTable(){
		return $this->tableName;
	}

	//For Segment
	/*
	public function setSegment($seg){
		$this->segment = $seg;
	}*/

	public function getSegment(){
		return $this->segment;
	}



}


?>