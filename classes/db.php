<?php
header('Content-Type: text/html; charset=utf-8');
class DB{
    
    public $conn;

    /**
     * Connection to the database through the parameters below.
     *
     * @param [string] $dbhost
     * @param [string] $dbuser
     * @param [string] $dbpass
     * @param [string] $dbname
     * @param [string] $charset
     */
	public function __construct() {

		$this->conn = new mysqli("localhost", "root", "", "hotel");
		if ($this->conn->connect_error) {
			die('Error connecting to database: ' . $this->conn->connect_error);
		}
		$this->conn->set_charset("utf-8");
    
    }

    function check_login(){



    }

    /**
     * Checks if an order already exists.
     * 
     * @param [string] $email
     * @param [string] $room_type
     * @return $result
     */
    private function check_order($email, $room_type){

        $sql = "select * from room_booking_details where email='$email' and room_type='$room_type'";

        $query = $this->conn->query($sql);

        $result = $query->num_rows;

        return $result;
    }

    /**
     * Places an order in the database with used parameters.
     *
     * @param [string] $name
     * @param [string] $email
     * @param [int] $phone
     * @param [string] $address
     * @param [string] $city
     * @param [string] $state
     * @param [int] $zip
     * @param [string] $country
     * @param [string] $room_type
     * @param [string] $Occupancy
     * @param [date] $cdate
     * @param [string] $ctime
     * @param [date] $codate
     */
    private function place_order($name, $email, $phone, $address, $city, $state, $zip, $country, $room_type, $Occupancy, $cdate, $ctime, $codate){

        $sql="insert into room_booking_details(name,email,phone,address,city,state,zip,contry,room_type,Occupancy,check_in_date,check_in_time,check_out_date) 
        values('$name','$email','$phone','$address','$city','$state','$zip','$country','$room_type','$Occupancy','$cdate','$ctime','$codate')";

        $this->conn->query($sql);

    }
    
    /**
     * This method combines check_order() and place_order() for one easily implemented feature.
     *
     * @param [string] $name
     * @param [string] $email
     * @param [int] $phone
     * @param [string] $address
     * @param [string] $city
     * @param [string] $state
     * @param [int] $zip
     * @param [string] $country
     * @param [string] $room_type
     * @param [string] $Occupancy
     * @param [date] $cdate
     * @param [string] $ctime
     * @param [date] $codate
     * @return $message
     */
    public function new_order($name, $email, $phone, $address, $city, $state, $zip, $country, $room_type, $Occupancy, $cdate, $ctime, $codate){

        $response = $this->check_order($email, $room_type);

        if($response < 1){

            $this->place_order($name, $email, $phone, $address, $city, $state, $zip, $country, $room_type, $Occupancy, $cdate, $ctime, $codate);

        }
        else{

            $message = "You have already booked this room";

        }

        if(!isset($message)){

            $message = "You have succesfully booked this room";

        }

        return $message;

    }

    function get_user_info($email){

        $sql = "SELECT * FROM create_account where email='$email'";

        $query = $this->conn->query($sql);

        $result = $query->fetch_assoc();

        return $result;

    }



}