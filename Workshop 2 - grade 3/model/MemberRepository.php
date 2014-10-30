<?php

namespace model;

require_once("model/Repository.php");
require_once("model/Member.php");
require_once("model/Boat.php");
require_once("model/Members.php");
require_once("model/Boats.php");


class MemberRepository extends Repository{

	private $db;
	private $members;
	
	private static $memberId = "memberId";
	private static $firstname = "firstname";
	private static $lastname = "lastname";
	private static $persId = "persId";

	private static $boattype = "boattype";
	private static $length = "length";
	private static $boatId = "boatId";


	public function __construct(){
		$this->members = new Members();
	}


	public function addMember(Member $member){
		$this->dbTable = "member";

		try{
			$db = $this->connection();

        	$sql = "INSERT INTO $this->dbTable (" . self::$memberId . ", " . self::$firstname . ", " . self::$lastname . ", " . self::$persId . ") VALUES (?, ?, ?, ?)";

			$params = array($member->getMemberId(), $member->getFirstname(), $member->getLastname(), $member->getPersId());

			$query = $db->prepare($sql);
		
			$query->execute($params);

		} catch (\Exception $e) {
			echo $e;
			die("An error occured in the database!");
		}
	}

		public function deleteMember($id) {
			$this->dbTable = "member";
					
			try{
				$db = $this -> connection();

				$sql = "DELETE FROM $this->dbTable
						WHERE " . self::$memberId . " = ?";
				$params = array($id);

				$query = $db -> prepare($sql);
				$query -> execute($params);

			} catch (\Exception $e) {
				echo $e;
				die("An error occured in the database!");
			}
		}


		public function updateMember(Member $member) {
			$this->dbTable = "member";
					

			try{
				$db = $this -> connection();

				$sql = "UPDATE $this->dbTable SET " . self::$firstname . "=?, " . self::$lastname . "=?, " . self::$persId . "=? WHERE " . self::$memberId ."=?";

				$params = array($member->getFirstname(), $member->getLastname(), $member->getPersId(), $member->getMemberId());

				$query = $db -> prepare($sql);
				$query -> execute($params);

			} catch (\Exception $e) {
				echo $e;
				die("An error occured in the database!");
			}
		}
		

	public function getMemberById($id){
		$this->dbTable = "member";

		try{
			$db = $this->connection();

        	$sql = "SELECT * FROM $this->dbTable WHERE " . self::$memberId . " = ?";

			$params = array($id);

			$query = $db->prepare($sql);

			$query->execute($params);
			
			foreach ($query->fetchAll() as $m) {
						$mId = $m[self::$memberId];
						$f = $m[self::$firstname];
						$l = $m[self::$lastname];
						$pId = $m[self::$persId];

						$member = new Member($mId, $f, $l, $pId);

			}

			return $member;

		} catch (\Exception $e) {
			die("An error occured in the database!");
		}
	}


	public function getMembers(){
		$this->dbTable = "member";
		
		try {
			$db = $this->connection();

			$sql = "SELECT * FROM $this->dbTable";

			$query = $db->prepare($sql);
			$query->execute();
			foreach ($query->fetchAll() as $m) {
				$mId = $m[self::$memberId];
				$f = $m[self::$firstname];
				$l = $m[self::$lastname];
				$pId = $m[self::$persId];

				$member = new Member($mId, $f, $l, $pId);

				$this->members->addMembers($member);
			}
			return $this->members;
		} catch (\PDOException $e) {
			echo $e;
			die('Error while connection to database.');
		}
	}
}