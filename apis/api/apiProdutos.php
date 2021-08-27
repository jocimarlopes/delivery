<?php

$totalEntrega = 0;

include_once('conexao.php');

$postjson = json_decode(file_get_contents('php://input'), true);


if($postjson['requisicao'] == 'listar-produtos'){

  $id_cat = $postjson['id_cat'];

	$query = $pdo->query("SELECT * from produtos where produto_categoria_id = '$id_cat' and estoque != 0 order by id asc limit $postjson[start], $postjson[limit]");
  
  $res = $query->fetchAll(PDO::FETCH_ASSOC);
  $total = count($res);

 	for ($i=0; $i < count($res); $i++) { 
      foreach ($res[$i] as $key => $value) {
      }
 			$dados[] = array(
 			'id' => $res[$i]['id'],
 			'nome' => $res[$i]['nome'],
 			'descricao_longa' => $res[$i]['descricao_longa'],
			'produto_categoria_id' => $res[$i]['produto_categoria_id'],
			'estoque' => $res[$i]['estoque'],
			'valor' => $res[$i]['valor'],
      'image' => $res[$i]['image'],
            
            
        
 		);

 }

        if(count($res) > 0){
                 $result = json_encode(array('success'=>true, 'result'=>$dados, 'total'=>$total));

            }else{
                $result = json_encode(array('success'=>false, 'result'=>'0'));

            }
            echo $result;





}else if($postjson['requisicao'] == 'listar-tempo'){


      //recuperar valor do frete
      $res_f = $pdo->query("SELECT * from config where id = 1 ");
      $dados_f = $res_f->fetchAll(PDO::FETCH_ASSOC);
      $previsao = $dados_f[0]['previsao_minutos'];
      $contato = $dados_f[0]['contato'];
      $status = $dados_f[0]['status'];

      $result = json_encode(array('success'=>true, 'previsao'=>$previsao, 'status'=>$status, 'contato'=>$contato));

      echo $result;




}else if($postjson['requisicao'] == 'listar-cat'){

    $query = $pdo->query("SELECT * from produto_categorias order by id desc");
   
   
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    $total = count($res);

 	for ($i=0; $i < count($res); $i++) { 
      foreach ($res[$i] as $key => $value) {
      }
 			$dados[] = array(
 			'id' => $res[$i]['id'],
 			'name' => $res[$i]['name'],
 		);

 }

        if(count($res) > 0){
                $result = json_encode(array('success'=>true, 'result'=>$dados, 'total'=>$total));

            }else{
                $result = json_encode(array('success'=>false, 'result'=>'0'));

            }
            echo $result;





}else if($postjson['requisicao'] == 'add-carrinho'){

$id_produto = $postjson['id_produto'];
$cpf_cliente = $postjson['cpf'];


//VERIRICAR SE O PRODUTO JÁ EXISTE NO CARRINHO
$res_p = $pdo->query("SELECT * from carrinho where id_produto = '$id_produto' and id_venda = 0 and cpf = '$cpf_cliente' ");
$dados_p = $res_p->fetchAll(PDO::FETCH_ASSOC);
$linhas_p = count($dados_p);
if($linhas_p > 0){
  $quant_p = $dados_p[0]['quantidade'];
  $quant_p = $quant_p + 1;

  $res = $pdo->query("UPDATE carrinho set quantidade = '$quant_p' where id_produto = '$id_produto'");
 $result = json_encode(array('success'=>true));
 echo $result;

  exit();


}


if($cpf_cliente != ''){


$quantidade = 1;

$res = $pdo->query("INSERT into carrinho (id_venda, id_produto, cpf, quantidade) values ('0', '$id_produto', '$cpf_cliente', '$quantidade')");

  
} 


  
      if(count($res) > 0){
        $result = json_encode(array('success'=>true));


        }else{
        $result = json_encode(array('success'=>false));
    
        }
     echo $result;





   }else if($postjson['requisicao'] == 'listar-carrinho'){

     $cpf_usuario = $postjson['cpf'];
     $valorEntrega = $postjson['valorEntrega'];
     $res = $pdo->query("SELECT * from carrinho where cpf = '$cpf_usuario' and id_venda = 0 order by id asc");
     $dados = $res->fetchAll(PDO::FETCH_ASSOC);
     $linhas = count($dados);

   if($linhas == 0){
      $linhas = 0;
      $total = 0;
    }

    $total = 0;
    for ($i=0; $i < count($dados); $i++) { 
      foreach ($dados[$i] as $key => $value) {
      }

      $id_produto = $dados[$i]['id_produto']; 
      $quantidade = $dados[$i]['quantidade'];
      $id_carrinho = $dados[$i]['id'];


      $res_p = $pdo->query("SELECT * from produtos where id = '$id_produto' ");
      $dados_p = $res_p->fetchAll(PDO::FETCH_ASSOC);
      $nome_produto = $dados_p[0]['nome'];  
      $valor = $dados_p[0]['valor'];
      $image = $dados_p[0]['image'];


      $total_item = $valor * $quantidade;
      @$total = @$total + $total_item;


      $valor = number_format( $valor , 2, ',', '.');
                            //$total = number_format( $total , 2, ',', '.');
      $total_item = number_format( $total_item , 2, ',', '.');


      //recuperar valor do frete
      $res_f = $pdo->query("SELECT * from config where id = 1 ");
      $dados_f = $res_f->fetchAll(PDO::FETCH_ASSOC);
      $frete = $dados_f[0]['taxa_entrega'];  
      $previsao = $dados_f[0]['previsao_minutos'];



      $subtotal = @$total + $valorEntrega;
      $subtotal2 = number_format( $subtotal , 2, ',', '.');

       $dados_carrinho[] = array(
      'id' => $id_produto,
      'quantidade' => $quantidade,
      'valor' =>  $valor,
      'image' => $image,
      'nome' => $nome_produto,
                
       );

    }




    
    $total_final = number_format( $total , 2, ',', '.');


    if($linhas > 0){
      $result = json_encode(array('success'=>true, 'result'=>$dados_carrinho, 'total'=>$total_final, 'frete'=>$frete, 'subtotal'=>$subtotal, 'subtotal2'=>$subtotal2, 'totalItens'=>$linhas, 'previsao'=>$previsao));
      }
      else{
      $result = json_encode(array('success'=>false, 'result'=>0));
  
      }
   echo $result;
    





}else if($postjson['requisicao'] == 'add-item'){

$id = $postjson['id'];
$cpf_cliente = $postjson['cpf'];


//VERIRICAR SE O PRODUTO JÁ EXISTE NO CARRINHO
$res_p = $pdo->query("SELECT * from carrinho where id_produto = '$id' and id_venda = 0 and cpf = '$cpf_cliente' ");
$dados_p = $res_p->fetchAll(PDO::FETCH_ASSOC);
$quant = $dados_p[0]['quantidade'];
$quant = $quant + 1;



$res = $pdo->query("UPDATE carrinho set quantidade = '$quant' where id_produto = '$id' and id_venda = 0 and cpf = '$cpf_cliente' ");



  
      if(count($res) > 0){
        $result = json_encode(array('success'=>true));


        }else{
        $result = json_encode(array('success'=>false));
    
        }
     echo $result;


  }else if($postjson['requisicao'] == 'remove-item'){

$id = $postjson['id'];
$cpf_cliente = $postjson['cpf'];


//VERIRICAR SE O PRODUTO JÁ EXISTE NO CARRINHO
$res_p = $pdo->query("SELECT * from carrinho where id_produto = '$id' and id_venda = 0 and cpf = '$cpf_cliente' ");
$dados_p = $res_p->fetchAll(PDO::FETCH_ASSOC);
$quant = $dados_p[0]['quantidade'];
$quant = $quant - 1;

$res = $pdo->query("UPDATE carrinho set quantidade = '$quant' where id_produto = '$id' and id_venda = 0 and cpf = '$cpf_cliente' ");

if ($quant == 0) {
  $res = $pdo->query("DELETE FROM carrinho where id_produto = '$id' and id_venda = 0 and cpf = '$cpf_cliente' ");

}



  
      if(count($res) >= 0){
        $result = json_encode(array('success'=>true));


        }else{
        $result = json_encode(array('success'=>false));
    
        }
     echo $result;






  }else if($postjson['requisicao'] == 'listar-clientes'){

  $cpf = $postjson['cpf'];

  
     $query = $pdo->query("SELECT * from clientes where cpf  = '$cpf' ");
  
   
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    $nome = $res[0]['nome'];
    $rua = $res[0]['rua'];
    $numero = $res[0]['numero'];
    $bairro = $res[0]['bairro'];

  

        if(count($res) > 0){
                 $result = json_encode(array('success'=>true, 'rua'=>$rua, 'numero'=>$numero, 'bairro'=>$bairro));

            }else{
                $result = json_encode(array('success'=>false, 'result'=>'0'));

            }
            echo $result;





}else if($postjson['requisicao'] == 'finalizar-pedido'){


$tipo = $postjson['tipo'];
$rua = $postjson['rua'];
$hora = $postjson['hora'];
$numero = $postjson['numero'];
$bairro = $postjson['bairro'];
$nome_cliente = $postjson['nome_cliente'];
$telefone = $postjson['telefone'];

$obs = $postjson['obs'];
$total = $postjson['total'];
$cpf_cliente = $postjson['cpf'];
$total_pago = $postjson['troco'];

if ($total_pago == ''){
  $total_pago = 0;
}

if($tipo == ''){
  $texto = 'Preencha o Tipo de Pagamento';
  $result = json_encode(array('success'=>true, 'texto'=>$texto));
  echo $result;
  exit();
}


if($total_pago != ''){
  
  $troco = $total_pago - $total;

  if($troco < 0){
    $texto = "O valor a pagar não pode ser menor que o valor total da compra!!";
    $result = json_encode(array('success'=>true, 'texto'=>$texto));
    echo $result;
    exit();
  }
}else{
  $troco = 0;
}


if($cpf_cliente != ''){


$res = $pdo->prepare("INSERT into vendas (cliente, total, total_pago, troco, tipo_pgto, data, hora, status, pago, obs, nome_cliente, telefone, bairro, rua, numero) values (:cliente, :total, :total_pago, :troco, :tipo_pgto, curDate(), :hora, :status, :pago, :obs, :nome_cliente, :telefone, :bairro, :rua, :numero)");

$res->bindValue(":cliente", $cpf_cliente);
$res->bindValue(":total", $total);
$res->bindValue(":total_pago", $total_pago);
$res->bindValue(":troco", $troco);
$res->bindValue(":tipo_pgto", $tipo);
$res->bindValue(":status", 'Iniciado');
$res->bindValue(":pago", 'Não');
$res->bindValue(":obs", $obs);
$res->bindValue(":nome_cliente", $nome_cliente);
$res->bindValue(":telefone", $telefone);
$res->bindValue(":bairro", $bairro);
$res->bindValue(":rua", $rua);
$res->bindValue(":hora", $hora);
$res->bindValue(":numero", $numero);

$res->execute();

$id_venda = $pdo->lastInsertId();


$res = $pdo->prepare("INSERT into bkp_vendas (cliente, total, total_pago, troco, tipo_pgto, data, hora, status, pago, obs, nome_cliente, telefone, bairro, rua, numero) values (:cliente, :total, :total_pago, :troco, :tipo_pgto, curDate(), :hora, :status, :pago, :obs, :nome_cliente, :telefone, :bairro, :rua, :numero)");

$res->bindValue(":cliente", $cpf_cliente);
$res->bindValue(":total", $total);
$res->bindValue(":total_pago", $total_pago);
$res->bindValue(":troco", $troco);
$res->bindValue(":tipo_pgto", $tipo);
$res->bindValue(":status", 'Iniciado');
$res->bindValue(":pago", 'Não');
$res->bindValue(":obs", $obs);
$res->bindValue(":nome_cliente", $nome_cliente);
$res->bindValue(":telefone", $telefone);
$res->bindValue(":bairro", $bairro);
$res->bindValue(":rua", $rua);
$res->bindValue(":hora", $hora);
$res->bindValue(":numero", $numero);

$res->execute();

  
} 




//TRAZER O TOTAL DE CARTÕES QUE O CLIENTE TEM
$res = $pdo->query("SELECT * from clientes where cpf = '$cpf_cliente'");
$dados = $res->fetchAll(PDO::FETCH_ASSOC);
$cartoes = $dados[0]['cartao'];
$cartoes = $cartoes + 1;

//ATUALIZAR OS DADOS DE ENDEREÇO DO CLIENTE
$res = $pdo->prepare("UPDATE clientes SET rua = :rua, numero = :numero, bairro = :bairro, cartao = :cartao where cpf = '$cpf_cliente'");

$res->bindValue(":rua", $rua);
$res->bindValue(":numero", $numero);
$res->bindValue(":bairro", $bairro);
$res->bindValue(":cartao", $cartoes);

$res->execute();



//INCREMENTAR UMA VENDA NOS PRODUTOS VENDIDOS
$res = $pdo->query("SELECT * from carrinho where id_venda = 0 and cpf = '$cpf_cliente'");
$dados = $res->fetchAll(PDO::FETCH_ASSOC);
for ($i=0; $i < count($dados); $i++) { 
      foreach ($dados[$i] as $key => $value) {
      }

      $id_produto = $dados[$i]['id_produto']; 
      $quant = $dados[$i]['quantidade'];  
      
      //BUSCAR O PRODUTO NA TABELA PRODUTOS PARA ATUALIZAR VENDA
      $res_p = $pdo->query("SELECT * from produtos where id = '$id_produto'");
      $dados_p = $res_p->fetchAll(PDO::FETCH_ASSOC);
      $vendas_p = $dados_p[0]['vendas'];
      $vendas_p = $vendas_p + $quant;

      $pdo->query("UPDATE produtos set vendas = '$vendas_p' where id = '$id_produto'"); 

}




//ATUALIZAR O ID DA VENDA DOS ITENS DA TABELA CARRINHO PARA NOVA VENDA
$pdo->query("UPDATE carrinho SET id_venda = '$id_venda' where id_venda = 0 and cpf = '$cpf_cliente'");  




      $texto = 'Pedido Concluído!';
      if(count($res) > 0){
        $result = json_encode(array('success'=>true, 'texto'=>$texto));


        }else{
        $result = json_encode(array('success'=>false));
    
        }
     echo $result;






  }
else if($postjson['requisicao'] == 'listar-locais'){

  $query = $pdo->query("SELECT * from locais order by nome asc");
 
 
  $res = $query->fetchAll(PDO::FETCH_ASSOC);
  $total = count($res);

 for ($i=0; $i < count($res); $i++) { 
    foreach ($res[$i] as $key => $value) {
    }
     $dados[] = array(
     'name' => 'locais',
     'type' => 'radio',
     'label' => $res[$i]['nome'],
     'value' => $res[$i]['id'],
     'price' => $res[$i]['valor'],
   );

}

      if(count($res) > 0){
              $result = json_encode(array('success'=>true, 'result'=>$dados, 'total'=>$total));

          }else{
              $result = json_encode(array('success'=>false, 'result'=>'0'));

          }
          echo $result;





}

else if($postjson['requisicao'] == 'listar-local'){

  $id = $postjson['id'];

  $query = $pdo->query("SELECT * from locais WHERE id = '$id'");
 
 
  $res = $query->fetchAll(PDO::FETCH_ASSOC);
  $total = count($res);

 for ($i=0; $i < count($res); $i++) { 
    foreach ($res[$i] as $key => $value) {
    }
     $dados[] = array(
     'name' => 'locais',
     'type' => 'radio',
     'label' => $res[$i]['nome'],
     'value' => $res[$i]['id'],
     'price' => $res[$i]['valor'],
   );

}

      if(count($res) > 0){
              $result = json_encode(array('success'=>true, 'result'=>$dados, 'total'=>$total));

          }else{
              $result = json_encode(array('success'=>false, 'result'=>'0'));

          }
          echo $result;





}
else if($postjson['requisicao'] == 'soma-total'){

  $frete = $postjson['frete'];
  $carrinho = $postjson['carrinho'];
  
  $totalEntrega = $frete + $carrinho;
  
  
  
  
  
}
else if($postjson['requisicao'] == 'listar-paes'){

  $query = $pdo->query("SELECT * from tipo_paes order by id asc");
 
 
  $res = $query->fetchAll(PDO::FETCH_ASSOC);
  $total = count($res);

 for ($i=0; $i < count($res); $i++) { 
    foreach ($res[$i] as $key => $value) {
    }
     $dados[] = array(
     'nome' => $res[$i]['nome'],
     'foto' => $res[$i]['foto'],
     'quantidade' => $res[$i]['quantidade'],
   );

}

      if(count($res) > 0){
              $result = json_encode(array('success'=>true, 'result'=>$dados, 'total'=>$total));

          }else{
              $result = json_encode(array('success'=>false, 'result'=>'0'));

          }
          echo $result;





}






?>