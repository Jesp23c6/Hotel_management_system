<?php
header('Content-Type: text/html; charset=utf-8');
class DB{
    
    public $salt = "this1is2salt";

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

    /**
     * A method to delete an order.
     *
     * @param [int] $order_id
     */
    function cancel_order($order_id){

        $sql = "DELETE FROM room_booking_details WHERE id='$order_id'";

        $query = $this->conn->query($sql);

    }


    function check_user($email){

        $sql = "SELECT * FROM create_account WHERE email='$email'";

        $query = $this->conn->query($sql);

        $result = $query->num_rows;

        return $result;

    }

    /**
     * A method to grab all user info by mail
     *
     * @param [string] $email
     * @return void
     */
    function get_user_info($email){

        $sql = "SELECT * FROM create_account where email='$email'";

        $query = $this->conn->query($sql);

        $result = $query->fetch_assoc();

        return $result;

    }

    /**
     * Method to send feedback
     *
     * @param [string] $name
     * @param [string] $email
     * @param [int] $mobile
     * @param [string] $message
     * @return void
     */
    function send_feedback($name, $email, $mobile, $message){

        $sql = "INSERT INTO feedback VALUES('', '$name', '$email', '$mobile', '$message')";

        $query = $this->conn->query($sql);

        if($query){

            $result = "Feedback sent succesfully";

        }

        return $result;
        
    }

    /**
     * Get all information from rooms
     *
     * @return $query
     */
    function all_rooms(){

        $sql = "SELECT * FROM rooms";

        $query = $this->conn->query($sql);

        return $query;

    }

    /**
     * Get all information from slider
     *
     * @return $query
     */
    function all_sliders(){

        $sql = "SELECT * FROM slider";

        $query = $this->conn->query($sql);

        return $query;

    }

    /**
     * A method to update password.
     *
     * @param [string] $mail
     * @param [string] $password
     * @return void
     */
    function update_password($mail, $password){

        $password = md5($this->salt . $password);

        $sql = "UPDATE create_account SET password='$password' WHERE email='$mail'";

        $query = $this->conn->query($sql);

    }

    /**
     * A method to update profile.
     *
     * @param [string] $name
     * @param [string] $password
     * @param [int] $mobile
     * @param [string] $address
     * @param [string] $mail
     * @return void
     */
    function update_profile($name, $mobile, $address, $mail){

        $sql = "UPDATE create_account SET name='$name', mobile='$mobile', address='$address' where email='$mail'";

        $query = $this->conn->query($sql);

    }

    /**
     * Generates an email key for password reset.
     *
     * @param [string] $mail
     * @return void
     */
    function email_key_gen($mail){

        $salt = "soy is liquid salt";

        $email_key = md5($salt . $mail . rand(1, 100));

        $sql = "UPDATE create_account SET email_key='$email_key' WHERE email='$mail'";

        $query = $this->conn->query($sql);

    }


    function get_email_key($mail){

        $sql = "SELECT * FROM create_account WHERE email='$mail'";

        $query = $this->conn->query($sql);

        $result = "";

        while($res = $query->fetch_assoc()){

            $result = $res['email_key'];

        }

        return $result;

    }

    /**
     * Undocumented function
     *
     * @param [type] $mail
     * @param [type] $mail_key
     * @return void
     */
    function check_password_reset($mail, $get_key){

        $sql = "SELECT * FROM create_account WHERE email='$mail'";

        $query = $this->conn->query($sql);

        $result;

        $mail_key = "";

        while($res = $query->fetch_assoc()){

            $mail_key = $res['email_key'];

        }

        if($mail_key == $get_key){

            $result = true;

        }
        else{

            $result = false;

        }

        return $result;

    }

    /**
     * A method to create a user.
     *
     * @param [string] $name
     * @param [string] $email
     * @param [string] $password
     * @param [int] $mobile
     * @param [string] $address
     * @param [string] $gender
     * @param [string] $country
     * @param [string] $picture
     * 
     */
    function create_user($name, $email, $password, $mobile, $address, $gender, $country, $picture){

        $sql="insert into create_account(name,email,password,mobile,address,gender,country,pictrure) values('$name','$email','$password','$mobile','$address','$gender','$country','$picture')";

        $query = $this->conn->query($sql);

    }

    /**
     * Method that logs in the user.
     *
     * @param [string] $email
     * @param [string] $password
     * @return $result
     */
    function user_login($email, $password){

        $password = md5($this->salt . $password);

        $sql = "SELECT * FROM create_account WHERE email='$email' AND password='$password'";

        $query = $this->conn->query($sql);

        $result = $query->num_rows;

        return $result;

    }

    /**
     * Method to get all orders.
     *
     * @param [string] $email
     * @return [array] $result
     */
    function view_order($email){

        $sql = "SELECT * FROM room_booking_details WHERE email='$email'";

        $query = $this->conn->query($sql);

        $result = $query->fetch_assoc();

    }

    /**
     * A method to get a room's information from room_id
     *
     * @param [type] $room_id
     * @return [array] $result
     */
    function get_room($room_id){

        $sql = "SELECT * FROM rooms WHERE room_id='$room_id'";

        $query = $this->conn->query($sql);

        $result = $query->fetch_assoc();

        return $result;

    }

    /**
     * Admin method for deleting orders.
     *
     * @param [int] $order_id
     * 
     */
    function admin_delete_order($order_id){

        $sql = "DELETE FROM room_booking_details WHERE id='$order_id'";

        $query = $this->conn->query($sql);

    }

    /**
     * A method to get all customer info.
     *
     */
    function all_customer_info(){

        $sql = "SELECT * FROM customer";

        $query = $this->conn->query($sql);

    }

    /**
     * A method to getting feedback by id.
     *
     * @param [int] $id
     * 
     */
    function get_feedback($id){

        $sql = "SELECT * FROM feedback WHERE id='$id'";

        $query = $this->conn->query($sql);

    }

    /**
     * A method to delete feedback
     *
     * @param [int] $id
     * 
     */
    function delete_feedback($id){

        $sql = "DELETE FROM feedback WHERE id='$id'";

        $query = $this->conn->query($sql);

    }

    /**
     * A method to get slider by id.
     *
     * @param [int] $id
     * 
     */
    function get_slider($id){

        $sql = "SELECT * FROM slider WHERE id='$id'";

        $query = $this->conn->query($sql);

    }

    /**
     * A method to delete a slider.
     *
     * @param [int] $id
     * 
     */
    function delete_slider($id){

        $sql = "DELETE FROM slider WHERE id='$id'";

        $query = $this->conn->query($sql);

    }

    /**
     * A method to log in admin users
     *
     * @param [string] $email
     * @param [string] $password
     * @return $result
     */
    function admin_login($email, $password){

        $password = md5($this->salt . $password);

        $sql = "SELECT * FROM admin WHERE username='$email' && password='$password'";

        $query = $this->conn->query($sql);

        $result = $query->num_rows;

        return $result;

    }

    /**
     * A method to check if any room with the number exists
     *
     * @param [int] $room_number
     * @return $result
     */
    function room_by_num($room_number){

        $sql = "SELECT * FROM rooms WHERE room_no='$room_number'";

        $query = $this->conn->query($sql);

        $result = $query->num_rows;

        return $result;

    }

    /**
     * A method to add a room.
     *
     * @param [int] $room_no
     * @param [string] $type
     * @param [int] $price
     * @param [string] $details
     * @param [string] $img
     * 
     */
    function add_room($room_no, $type, $price, $details, $img){

        $sql = "insert into rooms values('','$room_no','$type','$price','$details','$img')";

        $query = $this->conn->query($sql);

    }

    function update_admin_pass($email, $new_password){

        $new_password = md5($this->salt . $new_password);

        $sql = "UPDATE admin SET password='$new_password' WHERE username='$email'";

        $query = $this->conn->query($sql);

    }


    function add_slider($image, $caption){

        $sql = "insert into slider values('','$image','$caption')";

        $query = $this->conn->query($sql);

        $result = $query->num_rows;

        return $result;

    }


    function all_admin_info(){

        $sql = "SELECT * FROM admin";

        $query = $this->conn->query($sql);

        return $query;

    }

    function all_booking_details(){

        $sql = "SELECT * FROM room_booking_details";

        $query = $this->conn->query($sql);

        return $query;

    }

    function delete_room($id){

        $sql = "DELETE FROM rooms WHERE room_id='$id'";

        $query = $this->conn->query($sql);

    }

    function all_feedback(){

        $sql = "SELECT * FROM feedback";

        $query = $this->conn->query($sql);

        return $query;

    }

    function update_room($room_number, $type, $price, $details, $id){

        $sql = "UPDATE rooms SET room_no='$room_number', type='$type', price='$price', details='$details' WHERE room_id='$id'";

        $query = $this->conn->query($sql);

    }

}