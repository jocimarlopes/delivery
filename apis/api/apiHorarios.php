<?php

include_once('conexao.php');

$postjson = json_decode(file_get_contents('php://input'), true);

if($postjson['requisicao'] == 'listar-horario'){

    $id_dia = $postjson['id_dia'];

	$query = $pdo->query("SELECT * from horarios WHERE id = '$id_dia'");
  
    $res = $query->fetchAll(PDO::FETCH_ASSOC);

    $dados[] = array(
        'id' => $res[0]['id'],
        'dia' => $res[0]['dia'],
        'horario_inicio' => $res[0]['horario_inicio'],
        'horario_final' => $res[0]['horario_final'],
        'status' => $res[0]['status'],
   );
    
  
          if(count($res) > 0){
                   $result = json_encode(array('success'=>true, 'result'=>$dados));
  
              }else{
                  $result = json_encode(array('success'=>false, 'result'=>'0'));
  
              }
              echo $result;

}
else if($postjson['requisicao'] == 'listar-horarios'){


	$query = $pdo->query("SELECT * from horarios");
  
    $res = $query->fetchAll(PDO::FETCH_ASSOC);

    for ($i=0; $i < count($res); $i++) { 
        foreach ($res[$i] as $key => $value) {
        }
        
         $dados[] = array(
             'id' => $res[$i]['id'],
             'dia' => $res[$i]['dia'],
             'horario_inicio' => $res[$i]['horario_inicio'],
             'horario_final' => $res[$i]['horario_final'],
             'status' => $res[$i]['status'],
        );
  
   }
    
  
          if(count($res) > 0){
                   $result = json_encode(array('success'=>true, 'result'=>$dados));
  
              }else{
                  $result = json_encode(array('success'=>false, 'result'=>'0'));
  
              }
              echo $result;

}