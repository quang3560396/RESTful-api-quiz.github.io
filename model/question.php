<?php
class Question{
  private $conn;

  // Question properties
  public $id_cauhoi;
  public $title;
  public $cau_a;
  public $cau_b;
  public $cau_c;
  public $cau_d;
  public $cau_dung;

  // Connect db
  public function __construct($db){
    $this->conn = $db;
  }

  // Read data
  public function read(){
    $query = "SELECT * FROM cauhoi ORDER BY id_cauhoi";
    $statement = $this->conn->prepare($query);
    $statement->execute();
    return $statement;
  }

  // Show data
  public function show(){
    $query = "SELECT * FROM cauhoi WHERE id_cauhoi=? LIMIT 1";
    $statement = $this->conn->prepare($query);
    $statement->bindParam(1, $this->id_cauhoi);
    $statement->execute();

    $row = $statement->fetch(PDO::FETCH_ASSOC);
    $this->title = $row['title'];
    $this->cau_a = $row['cau_a'];
    $this->cau_b = $row['cau_b'];
    $this->cau_c = $row['cau_c'];
    $this->cau_d = $row['cau_d'];
    $this->cau_dung = $row['cau_dung'];
  }

  // Create data
  public function create(){
    $query = "INSERT INTO cauhoi SET 
    title=:title,
    cau_a=:cau_a,
    cau_b=:cau_b,
    cau_c=:cau_c,
    cau_d=:cau_d,
    cau_dung=:cau_dung";
    $statement = $this->conn->prepare($query);

    // clear data
    $this->title = htmlspecialchars(strip_tags($this->title));
    $this->cau_a = htmlspecialchars(strip_tags($this->cau_a));
    $this->cau_b = htmlspecialchars(strip_tags($this->cau_b));
    $this->cau_c = htmlspecialchars(strip_tags($this->cau_c));
    $this->cau_d = htmlspecialchars(strip_tags($this->cau_d));
    $this->cau_dung = htmlspecialchars(strip_tags($this->cau_dung));
    
    $statement-> bindParam(':title',$this->title);
    $statement-> bindParam(':cau_a',$this->cau_a);
    $statement-> bindParam(':cau_b',$this->cau_b);
    $statement-> bindParam(':cau_c',$this->cau_c);
    $statement-> bindParam(':cau_d',$this->cau_d);
    $statement-> bindParam(':cau_dung',$this->cau_dung);
    
    if($statement->execute()){
      return true;
    }
    printf("Error %.\n",$statement->error);
    return false;
  }

  // Update data
  public function update(){
    $query = "UPDATE cauhoi SET 
    title=:title,
    cau_a=:cau_a,
    cau_b=:cau_b,
    cau_c=:cau_c,
    cau_d=:cau_d,
    cau_dung=:cau_dung
    WHERE id_cauhoi=:id_cauhoi";
    $statement = $this->conn->prepare($query);

    // clear data
    $this->title = htmlspecialchars(strip_tags($this->title));
    $this->cau_a = htmlspecialchars(strip_tags($this->cau_a));
    $this->cau_b = htmlspecialchars(strip_tags($this->cau_b));
    $this->cau_c = htmlspecialchars(strip_tags($this->cau_c));
    $this->cau_d = htmlspecialchars(strip_tags($this->cau_d));
    $this->cau_dung = htmlspecialchars(strip_tags($this->cau_dung));
    $this->id_cauhoi = htmlspecialchars(strip_tags($this->id_cauhoi));

    // bind data
    $statement-> bindParam(':title',$this->title);
    $statement-> bindParam(':cau_a',$this->cau_a);
    $statement-> bindParam(':cau_b',$this->cau_b);
    $statement-> bindParam(':cau_c',$this->cau_c);
    $statement-> bindParam(':cau_d',$this->cau_d);
    $statement-> bindParam(':cau_dung',$this->cau_dung);
    $statement-> bindParam(':id_cauhoi',$this->id_cauhoi);
    
    if($statement->execute()){
      return true;
    }
    printf("Error %.\n",$statement->error);
    return false;
  }

  // Delete data
  public function delete(){
    $query = "DELETE FROM cauhoi
    WHERE id_cauhoi=:id_cauhoi";
    $statement = $this->conn->prepare($query);

    // clear data
    $this->id_cauhoi = htmlspecialchars(strip_tags($this->id_cauhoi));

    // bind data
    $statement-> bindParam(':id_cauhoi',$this->id_cauhoi);
    
    if($statement->execute()){
      return true;
    }
    printf("Error %.\n",$statement->error);
    return false;
  }




}
?>