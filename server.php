<?php

class Direction{

	private $direction;
	private $movements = array();
	public $position_x = 0;
	public $position_y = 0;

	private $report;
	private $new_direction;

	public $turn_left = false;
	public $turn_right = false;
	

	public $turn = array(	'NORTH'=> array('TURN_LEFT'=> 'WEST', 'TURN_RIGHT'=> 'EAST'),
				'SOUTH'=> array('TURN_LEFT'=> 'EAST', 'TURN_RIGHT'=> 'WEST'),
				'EAST'=> array('TURN_LEFT'=> 'NORTH', 'TURN_RIGHT'=> 'SOUTH'),
				'WEST'=> array('TURN_LEFT'=> 'SOUTH', 'TURN_RIGHT'=> 'NORTH'));
	public $arrow = array(	'NORTH'=> 'fas fa-arrow-up',
			 	'SOUTH'=> 'fas fa-arrow-down',
				'EAST'=> 'fas fa-arrow-right',
				'WEST'=> 'fas fa-arrow-left');

	public function get($data){
		$command_lines = explode("\n", $data['direction']);
		return $this->commands($command_lines);
	}


	public function commands($command_lines){
		$array_count = count($command_lines)-1;

		$this->direction = $command_lines[0];

		unset($command_lines[0]);

		$this->report = end($command_lines);
		unset($command_lines[$array_count]);

		foreach($command_lines as $c){
			$this->movements[] = $c;
		}

		if($this->direction()){
			return $this->drow();
		} else {
			return json_encode ( array( 'full_result'=> 'Please insert X,Y and direction' ) );
		}

	}

	public function direction(){
		if(isset($this->direction)){
			$d = explode(" ", $this->direction);
			list($this->position_x, $this->position_y, $this->direction) = explode(",", $d[1]);

			if($this->position_x == "" || $this->position_y == "" || $this->direction == ""){
				return false;
			} else {
				return true;
			}
		}
	}

	public function drow(){
		$first_command = true;		
		foreach($this->movements as $m){
			switch($m){


				case 'TURN_LEFT':	$this->direction = $this->new_direction = $this->turn[$this->direction]['TURN_LEFT'];	
							$this->turn_left = true;
							$first_command = false;
							break;
				case 'TURN_RIGHT':	$this->direction = $this->new_direction = $this->turn[$this->direction]['TURN_RIGHT'];
							$this->turn_right = true;
							$first_command = false;	
							break;


				case 'FORWARD':   

						if($first_command == true){

							if($this->direction == "NORTH"){
								$this->position_y++;
							}

							if($this->direction == "SOUTH"){
								$this->position_y--;
							}

							if($this->direction == "EAST"){
								$this->position_x++;
							}


							if($this->direction == "WEST"){
								$this->position_x--;
							}

						}

						if($this->turn_left==true){

							if($this->new_direction == "NORTH"){
								$this->position_y++;
							}

							if($this->new_direction == "SOUTH"){
								$this->position_y--;
							}

							if($this->new_direction == "EAST"){
								$this->position_x++;
							}


							if($this->new_direction == "WEST"){
								$this->position_x--;
							}
							//$this->turn_left = false;
						}


						if($this->turn_right==true){

							if($this->new_direction == "NORTH"){
								$this->position_y++;
							}

							if($this->new_direction == "SOUTH"){
								$this->position_y--;
							}

							if($this->new_direction == "EAST"){
								$this->position_x++;
							}


							if($this->new_direction == "WEST"){
								$this->position_x--;
							}
							//$this->turn_right = false;
						}

						

 							break;

			}
		}
			
		if($this->position_x < 0){
			$this->position_x = 0;	
		}

		if($this->position_y < 0){
			$this->position_y = 0;	
		}
		$arrow_label = ($this->new_direction=="")? $this->direction : $this->new_direction;

		if( ($this->position_x > 6 || $this->position_x < 0) || ($this->position_y > 6 || $this->position_y < 0) ){
			return json_encode (  array ( 'full_result' => 'cannot exit the grid' ) );		
		}

		return json_encode( array('position'=> $this->position_x . "_". $this->position_y, 'arrow'=> $this->arrow[$arrow_label],  'full_result'=> '('. $this->position_x .','. $this->position_y .'), ' . $arrow_label ) );
	}

}


$o = new Direction();
echo $o->get($_REQUEST);
?>

