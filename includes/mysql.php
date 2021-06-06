<?php

class DBCAPT {

    private $servername, $username, $password, $dbname, $conn;

    public function __construct() {
        $this->servername = DBSERVER;
        $this->username = DBUSER;
        $this->password = DBPW;
        $this->dbname = DBNAME;
    }

    public function __destruct() {
        $this->conn->close();
    }

    public function connect() {

        //Create connection
        $this->conn = new mysqli($this->servername, $this->username, $this->password);

        //Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: ". $this->conn->connect_error);
        }
        echo "<p>Connected Successfully</p>";
        /******************/
        $sql = "Use ". $this->dbname;
        if ($this->conn->query($sql) === TRUE) {
			echo "<p>Table MyGuests used successfully</p>";
		} else {
			echo "<p>Error using table: " . $this->conn->error . "</p>";
		}
    }
//This function singleqoutes adds the qoutes and commas
private function singleQuote($val = "", $comma = ",") {
    return "'" . $val . "'" . $comma;
}

public function addMyGuest($fname, $lname, $email, $password) {
    $sql = "INSERT INTO MyGuests (firstname, lastname, email, password)
    VALUES (" . 
        $this->singleQuote($fname) .
        $this->singleQuote($lname) .
        $this->singleQuote($email) .
        $this->singleQuote($password, "") . ")";

    echo "<p>$sql</p>";
    if ($this->conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $this->conn->error;
    }
}


public function readMyGuest() {
    $sql = "SELECT id, firstname, lastname, email, password, reg_date FROM MyGuests order by firstname desc";
    $result = $this->conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. 
                    ", Email: " . $row["email"].
                    ", Password: " . $row["password"].
                    ", Reg Date: " . $row["reg_date"].
            "<br>";
        }
    } else {
        echo "0 results";
    }
}

    public function runSQL($sql) { 
    return $this->conn->query($sql); 
   } 
      

}