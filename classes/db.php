<?php
header('Content-Type: text/html; charset=utf-8');
class Db{
    
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

    /**
     * Checks if email and password are correct
     * 
     * @param [string] $email
     * @param [string] $pass
     */
    function check_login($email, $pass){

        $sql = "select * from create_account where email='$email' && password='$pass'";

        $result = $this->conn->query($sql);

    }

    /**
     * Gets a user's pass from their mail
     * 
     * @param [string] $email
     * 
     * @return $pass
     */
    function password_from_email($email){

        $sql = "select * from create_account where email='$email'";

        $result = $this->conn->query($sql);

        $pass = "";

        while($row = $result->fetch_assoc()){
            $pass = $row['password'];
        }

        return $pass;

    }

    /**
     * Updates a profile's info
     * 
     * @param [string] $name
     * @param [string] $pass
     * @param [int] $mob
     * @param [string] $add
     * @param [string] $eid
     */
    function update_profile($name, $pass, $mob, $add, $eid){

        $sql = "update create_account set name='$name',password='$pass',mobile='$mob',address='$add' where email='$eid'";

        $result = $this->conn->query($sql);

    }

    /**
     * Creates user account
     */
    function create_account($fname, $email, $pass, $phone, $address, $gender, $country, $picture){

        $sql = "insert into create_account(name,email,password,mobile,address,gender,country,pictrure) values('$fname','$email','$pass','$phone','$address','$gender','$country','$picture')";

        $result = $this->conn->query($sql);

    }

    /**
     * Checks if an order already exists.
     * 
     * @param [string] $email
     * @param [string] $room_type
     * 
     * @return $result
     */
    function check_order($email, $room_type){

        $sql = "select * from room_booking_details where email='$email' and room_type='$room_type'";

        $result = $this->conn->query($sql);

        return $result;

    }

    /**
     * Gets currently placed orders for users to view.
     * 
     * @param mixed $eid
     * 
     * @return $result
     */
    function get_order($eid){

        $sql = "select * from room_booking_details where email='$eid'";

        $result = $this->conn->query($sql);

    }

    /**
     * Places an order
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
     * @param [string] $occupancy
     * @param [date] $cdate
     * @param [string] $ctime
     * @param [date] $codate
     */
    function place_order($name, $email, $phone, $address, $city, $state, $zip, $country, $room_type, $occupancy, $cdate, $ctime, $codate){

        $sql="insert into room_booking_details(name,email,phone,address,city,state,zip,contry,room_type,Occupancy,check_in_date,check_in_time,check_out_date) 
        values('$name','$email','$phone','$address','$city','$state','$zip','$country','$room_type','$occupancy','$cdate','$ctime','$codate')";

        $result = $this->conn->query($sql);

    }
    
    /**
     * Deletes an order
     * 
     * @param mixed $oid
     */
    function delete_order($oid){

        $sql = "delete from  room_booking_details where id='$oid' ";

        $result = $this->conn->query($sql);

    }

    /**
     * Gets all pictures for slide on index.php
     * 
     * @return $result
     */
    function all_slide_pictures(){

        $sql = "select * from slider";

        $result = $this->conn->query($sql);

        return $result;

    }

    /**
     * Gets all rooms to display on index.php
     * 
     * @return $result
     */
    function all_rooms(){

        $sql = "select * from rooms";

        $result = $this->conn->query($sql);

        return $result;

    }


    /**  METHODS FOR THE ADMIN FOLDER.  **/

    /**
     * Gets all customer info
     *
     * @return $result
     */
    function get_all_customers(){

        $sql = "select * from customer";

        $result = $this->conn->query($sql);

        return $result;

    }


    

}