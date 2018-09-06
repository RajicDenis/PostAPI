<?php

class Post {

	// DB properties
	private $conn;
	private $table = 'posts';

	// Blog post properties
	public $id;
	public $title;
	public $body;
	public $author;
	public $category_id;

	public function __construct($db) {

		$this->conn = $db;

	}

	public function read() {

		// Query
		$sql = 'SELECT * FROM ' . $this->table . ' p LEFT JOIN categories c ON p.category_id = c.id';

		$stmt = $this->conn->prepare($sql);

		$stmt->execute();

		return $stmt;

	}

	public function single($id) {

		// Query
		$sql = 'SELECT * FROM ' . $this->table . ' p LEFT JOIN categories c ON p.category_id = c.id WHERE p.id = :id';

		$stmt = $this->conn->prepare($sql);

		$stmt->bindValue(':id', $id);

		$stmt->execute();

		return $stmt;

	}

	public function create() {

		// Query
		$sql = 'INSERT INTO ' . $this->table . ' (title, author, body, category_id) VALUES (:title, :author, :body, :category_id)';

		$stmt = $this->conn->prepare($sql);

		$stmt->bindValue(':title', $this->title);
		$stmt->bindValue(':author', $this->author);
		$stmt->bindValue(':body', $this->body);
		$stmt->bindValue(':category_id', $this->category_id);

		$stmt->execute();

		return $stmt;

	}

	public function update() {

		// Query
		$sql = 'UPDATE ' . $this->table . ' SET title = :title, author = :author, body = :body, category_id = :category_id WHERE id = :id';

		$stmt = $this->conn->prepare($sql);

		$stmt->bindValue(':title', $this->title);
		$stmt->bindValue(':author', $this->author);
		$stmt->bindValue(':body', $this->body);
		$stmt->bindValue(':category_id', $this->category_id);
		$stmt->bindValue(':id', $this->id);

		$stmt->execute();

		return $stmt;

	}

	public function delete() {

		// Query
		$sql = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

		$stmt = $this->conn->prepare($sql);

		$stmt->bindValue(':id', $this->id);

		$stmt->execute();

		return $stmt;

	}

}