<?php
class Student {
	public $name;
	public $street;
	public $town;
	public $phone;
	public $email_address;
}

class DojoRepo {
	public function addStudent(Student $s) {
		echo "INSERT INTO person (name, street, town, phone, email_address) VALUES (:name, street, town, phone, email_address) RETURNING id\n";
		echo "INSERT INTO student (id) VALUE (:student_id)\n";

	}

	public function findStudentById($id) {
		$student = new Student();
		return $student;
	}

	public function findStudentByEmail($email_address) {
		$student = new Student();
		return $student;
	}

	public function updateStudentInfo(Student $s) {
		echo "UPDATE person SEt name=:name, street=:street, town=:town, phone=:phone, email_address=:email_address\n";
	}
	public function dropStudent(Student $s) {
		echo "UPDATE student SET drop_date=NOW() WHERE id = :student_id\n";
	}
	public function acceptPayment(Student $s, $amount, $payment_type) {
		echo "INSERT INTO payment (amount, payment_type_id, person_id) VALUES (:amount, :payment_type_id, person_id)\n";
	}
}

class Dojo {
	public function __construct() {
		$this->dojo_repo = new DojoRepo();
	}
	public function addStudent(Student $s) { $this->dojo_repo->addStudent($s); }
	public function findStudentById($id) { return $this->dojo_repo->findStudentById($id); }
	public function findStudentByEmail($email) { return $this->dojo_repo->findStudentById($email); }
	public function dropStudent(Student $s) { $this->dojo_repo->dropStudent($s); }
	public function acceptPayment(Student $s, $amount, $payment_type) { 
		$this->dojo_repo->acceptPayment($s, $amount, $payment_type); 
	}
}


$john = new Student();
$john->name = "John Smith";
$john->street = "123 Main Rd";
$john->town = "Detroit";
$john->phone = "3132228888";
$john->email_address = "john@test.net";

$dojo = new Dojo();
$dojo->addStudent($john);
var_dump($dojo->findStudentById(1));
var_dump($dojo->findStudentByEmail("john@test.net"));
$dojo->dropStudent($john);
$dojo->acceptPayment($john, 30.00, 'VISA');
