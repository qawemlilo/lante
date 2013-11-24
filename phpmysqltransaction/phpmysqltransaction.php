<?php
class TransactionDemo{
	const DB_HOST = 'localhost';
	const DB_NAME = 'classicmodels';
	const DB_USER = 'root';
	const DB_PASSWORD = '';

	private $conn = null;
	
	private $message = '';

	/**
	 * get message
	 * @return string the message of transfering process
	 */
	public function getMessage() {
		return $this->message;
	}
	
	/**
	 * transfer money from the $from account to $to account
	 * @param int $from
	 * @param int $to
	 * @param float $amount
	 * @return true on success or false on failure. The messages are logged in the
	 * $messages
	 */
	public function transfer($from,$to,$amount) {
		
		try {
			$this->conn->beginTransaction();
			
			// get available amount of the transferer account
			$sql = 'SELECT amount FROM accounts WHERE id=:from';
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(array(":from" => $from));
			$availableAmount = (int)$stmt->fetchColumn();
			$stmt->closeCursor();
			
			if($availableAmount < $amount){
				$this->message = 'Insufficient amount to transfer';
				return false;
			}
			// deduct from the transferred account
			$sql_update_from = 'UPDATE accounts
								SET amount = amount - :amount
								WHERE id = :from';
			$stmt = $this->conn->prepare($sql_update_from);
			$stmt->execute(array(":from"=> $from, ":amount" => $amount));
			$stmt->closeCursor();
				
			// add to the receiving account
			$sql_update_to  = 'UPDATE accounts
							   SET amount = amount + :amount
							   WHERE id = :to';
			$stmt = $this->conn->prepare($sql_update_to);
			$stmt->execute(array(":to" => $to, ":amount" => $amount));

			// commit the transaction
			$this->conn->commit();
			
			$this->message = 'The amount has been transferred successfully';

			return true;
		} catch (Exception $e) {
			$this->message = $e->getMessage();
			$this->conn->rollBack();
		}
	}

	/**
	 * Open the database connection
	 */
	public function __construct(){
		// open database connection
		$connectionString = sprintf("mysql:host=%s;dbname=%s",
				TransactionDemo::DB_HOST,
				TransactionDemo::DB_NAME);
		try {
			$this->conn = new PDO($connectionString,
					TransactionDemo::DB_USER,
					TransactionDemo::DB_PASSWORD);

		} catch (PDOException $pe) {
			die($pe->getMessage());
		}
	}

	/**
	 * close the database connection
	 */
	public function __destruct() {
		// close the database connection
		$this->conn = null;
	}
}

// test the transfer method
$obj = new TransactionDemo();

// transfer 30K from from account 1 to 2
$obj->transfer(1, 2, 30000);
echo $obj->getMessage() . "<br/>";

// transfer 5K from from account 1 to 2
$obj->transfer(1, 2, 5000);
 echo $obj->getMessage() . "<br/>";









