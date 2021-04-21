<?php
  include('./class/Student.php');
  $method = $_SERVER["REQUEST_METHOD"];
  $student = new Student();

  switch($method) {
    case 'GET': 
      $id = $_GET['id'];
      if (isset($id))
      {
        $student = $student->find($id);
        $js_encode = json_encode(array('state'=>TRUE, 'student'=>$student),true);
      }else
      {
        $students = $student->all();
        $js_encode = json_encode(array('state'=>TRUE, 'students'=>$students),true);
      }
      header("Content-Type: application/json");
      echo($js_encode);
      break;

    case 'POST':
      $studentLength = count($student->all());
      $result = $student->all();

      $student->_id = $result[$studentLength-1]['id'] + 1;
      $student->_name = $_POST["name"];
      $student->_surname = $_POST["surname"];
      $student->_sidiCode = $_POST["sidi_code"];
      $student->_taxCode = $_POST["tax_code"];
      $student->add($student);
      echo "Row added to db";
      break;

    case 'DELETE':
      $uri = explode('/', $_SERVER["REQUEST_URI"]);
      if(count($uri) != 0) 
      {
        $student->delete($uri[count($uri)-1]);
        echo "Row deleted";
      }
      else echo "ID missing";
      break;

    case 'PUT':
      $uri = explode('/', $_SERVER["REQUEST_URI"]);
      if(count($uri) != 0)
      {
        $body = file_get_contents("php://input");
        $decodeBody = json_decode($body);

        $student->_id = $uri[count($uri)-1];
        $student->_name = $decodeBody->name;
        $student->_surname = $decodeBody->surname;
        $student->_sidiCode = $decodeBody->sidiCode;
        $student->_taxCode = $decodeBody->taxCode;
  
        $student->update($student);
        echo "Row updated";
      }
      else echo "ID missing";
      break;

    default: 
      echo "Error"; 
      break;
  }
?>