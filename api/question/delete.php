<?php
  header('Access-Control-Allow-Origin:*');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-with');

  include_once('../../config/db.php');
  include_once('../../model/question.php');

  $db = new db();
  $connect = $db->connect();

  $question = new Question($connect);

  $data = json_decode(file_get_contents("php://input"));

  $question->id_cauhoi = $data->id_cauhoi;


  if($question->delete()){
    echo json_encode(array('message','Question deleted'));
  }else{
    echo json_encode(array('message','Question no deleted'));

  }

?>