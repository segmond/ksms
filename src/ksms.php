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
		$student = new Student(); return $student;
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
		echo "INSERT INTO payment (amount, payment_type_id, person_id) ( SELECT :amount, id, :person_id FROM payment_type WHERE description = :payment_type))\n";
	}

	public function promoteToHigherBelt(Student $s, $belt) {
		echo "UPDATE ksms.student SET belt_id=(SELECT FROM ksms.belt WHERE description=:belt)\n";
	}

	public function inviteForGrading(Student $s, $grading_date) {
		echo "UPDATE student SET grading_date = :grading_date\n";
	}

	public function emailMembership(Student $s) {
		$membership_info = $this->getMembershipInfo($s);
		$email_addr = $s->email_address;
		$this->dispatchEmail($email_addr, $membership_info);
	}

	public function printMembership(Student $s) {
		$membership_info = $this->getMembershipInfo($s);
		$this->printer($membership_info);
	}

	public function getMembershipInfo() {
		return array(
			'name' => 'Name',
			'belt' => 'Belt',
			'enroll_date' => 'Enroll Date');
	}

	public function dispatchEmail($email, $membership_info) { echo "sending email\n"; }
	public function printer($membership_info) { echo "printing membership info\n"; }
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
	public function promoteToHigherBelt(Student $s, $belt) {
		$this->dojo_repo->promoteToHigherBelt($s, $belt);
	}
	public function inviteForGrading(Student $s, $date) {
		$this->dojo_repo->inviteForGrading($s, $date);
	}
	public function emailMembership(Student $s) {
		$this->dojo_repo->emailMembership($s);
	}
	public function printMembership(Student $s) {
		$this->dojo_repo->printMembership($s);
	}
	public function scheduleGrading(Student $s) { }
	public function printCertificate(Student $s) { }
	public function holdMembership(Student $s) { }
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
$dojo->promoteToHigherBelt($john, 'RED');
$dojo->emailMembership($john);
$dojo->printMembership($john);
$dojo->inviteForGrading($john, '12-12-2016');
