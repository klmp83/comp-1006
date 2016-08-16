<?php

// URL : http://comp-1006-yu.azurewebsites.net/final-term/index.php

class User {
	private $first_name;
	private $last_name;
	private $date_of_birth;
	private $gross_income;
	
	
	public function get_age() {
		$birth = new DateTime(date("Y-m-d", strtotime($this->date_of_birth)));
		$now = new DateTime();
		$diff = $birth->diff($now);
		return $diff->y;
	}
	
	public function get_net_income() {
		// 7% EI, 8% CPP, 11% Income Tax
		return $this->gross_income * (1 - 0.07) * (1 - 0.08) * (1 - 0.11);
	}
	
	public function object_to_array() {
		return array(
			"full_name"=> $this->first_name . ' ' . $this->last_name,
			"age"=> $this->get_age(),
			"gross_income"=> $this->gross_income,
			"net_income"=> $this->get_net_income()
		);
	}
	
	
	// Setters and Getters
	public function set_first_name (String $first_name) {
		$this->first_name = $first_name;
	}
	public function get_first_name () {
		return $this->first_name;
	}
	public function set_last_name (String $last_name) {
		$this->last_name = $last_name;
	}
	public function get_last_name () {
		return $this->last_name;
	}
	public function set_date_of_birth (String $date_of_birth) {
		$this->date_of_birth = $date_of_birth;
	}
	public function get_date_of_birth () {
		return $this->date_of_birth;
	}
	public function set_gross_income (String $gross_income) {
		$this->gross_income = $gross_income;
	}
	public function get_gross_income () {
		return $this->gross_income;
	}
}