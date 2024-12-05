<?php declare(strict_types=1); ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-witdth, initial-scale=1.0">
	<title>Aula 01</title>
</head>
<body style="background-color:black">
	<form action="index.php" method="post">
		<input type="text" name="valor1"/>
		<input type="text" name="valor2"/>
		<input type="text" name="valor3"/>
		<input type="submit" value="enviar"/>
	</form>
	
	<p1 style="color:yellow">
		
		<?php
			
			//date_default_timezone_set("America/Sao_Paulo");
			//echo "Olá, Mundo!";
			//echo "Hoje é dia " . date("d/M/Y");
			//echo "<br>e a hora atual é " . date("G:i:s");
			//echo "O valor  " . $_POST["valor"];
			//$a = (int) 3e2;
			//var_dump($a);

			/*$dados=array();
			$dados['Nome']='asda';
			$dados['Curso']='Ecomp';
			$dados['Matricula']=12312321;
			var_dump($dados);*/

			//$v=array();
			//$v[]=1;
			//$v[]=2;
			//$v[]=3;
			//$v[]=4;
			//$v['chave']=5;
			//var_dump($v);
			//echo "1: " . $v[0] . "2: " . $v[1] . "3: " . $v[2] . "4: " . $v[3] . "5: " . $v['chave'];  
			//$array = [1, "ola", 1, "mundo", "ola"];
			//var_dump(array_count_values($array));
			//$array = [1, 3, 1, 10, 25];
			//echo array_product($array);
			//echo "   " . array_sum($array);
			//$array = array_fill(5, 6, 'banana');
			//print_r($array);
			//var_dump($array);
			//$cesta = array("laranja", "morango");
			//array_push($cesta, "melancia", "batata");
			//print_r($cesta);	
			//$base = array("laranja", "banana", "maça", "framboesa");
			//$sub = array(0 => "abacaxi", 4 => "cereja");
			//$sub2 = array(0 => "uva");
			//$cesta = array_replace($base, $sub, $sub2);
			//var_dump($cesta);
			//$stack = array("orange", "banana", "aple", "raspberry");
			//$fruit = array_shift($stack);
			//print_r($stack);
			/*$input = array("php", 4.0, array("green", "red"));
			$reversed = array_reverse($input);
			$preserved = array_reverse($input, true);
			echo "<br>";
			print_r($input);
			echo "<br>";
			print_r($reversed);
			echo"<br>";
			print_r($preserved);*/
			/*$frutas = array("d"=>"limao", "a"=>"laranja", "b"=>"banana", "c"=>"maca");
			krsort($frutas);
			foreach($frutas as $chave => $valor){
				echo "$chave = $valor\n";
			}*/
			/*$num=range(1,20);
			shuffle($num);
			foreach($num as $numero){
				echo "$numero ";
			}*/
			/*$fruits = array("lemon", "orange", "banana", "apple");
			sort($fruits);
			foreach($fruits as $key => $val){
				echo "fruits[" . $key . "]" . $val . "<br>";
			}*/
			/*$array = array(0=> 100, "cor" => "vermelho");
			print_r(array_keys($array));
			echo "<br>";

			$array = array("azul", "vermelho", "verde", "azul", "azul");
			print_r(array_keys($array, "azul"));
			echo "<br>";

			$array = array("cor" => array("azul", "vermelho", "verde"), "tamanho" => array("pequeno", "medio", "grande"));
			print_r(array_keys($array));
			echo "<br>";

			print_r(array_values($array));
			echo "<br>";*/
			/*array_is_list([]);
			echo "<br>";
			array_is_list(["maca", 2, 3]);
			echo "<br>";
			array_is_list([0 => "maca", "laranja"]);
			echo "<br>";
			array_is_list([1 => "maca", "laranja"]);
			echo "<br>";
			array_is_list([1 => "maca", 0 => "laranja"]);
			echo "<br>";
			array_is_list([0 => "maca", 'foo' => "bar"]);
			echo "<br>";
			array_is_list([0 => "maca", 2 => "bar"]);*/
			/*$input_array = array("primeiRo" => 1, "segunDo" => 4);
			print_r(array_change_key_case($input_array, CASE_UPPER));*/
			/*$input_array = array('a', 'b', 'c', 'd', 'e');
			print_r(array_chunk($input_array, 2));
			echo "<br>";
			print_r(array_chunk($input_array, 2, true));*/
			/*$a = array('verde', 'vermelho', 'amarelo');
			$b = array('abacate', 'maca', 'banana');
			$c = array_combine($a, $b);
			print_r($c);*/
			/*$array1 = array("a" => "verde", "vermelho", "azul", "vermelho");
			$array2 = array("b" => "verde", "amarelo", "vermelho");
			$result = array_diff($array2, $array1);
			print_r($result);*/
			/*$input = array("orange", "apples", "pears");
			$flipped = array_flip($input);
			print_r($flipped);*/
			/*$array1 = array("cor" => "vemelho", 2,);
			$array2 = array("a", "b", "cor" => "verde", "forma" => "trapezoide", 4);
			$result = array_merge($array2, $array1);
			print_r($result);*/
			/*$input = array("a" => "verde", "vermelho", "b" => "verde", "azul", "vermelho");
			$result = array_unique($input);
			print_r($result);*/
			
			/*ex1
			$a = array($_POST["valor1"], $_POST["valor2"], $_POST["valor3"]);
			//var_dump($a);
			rsort($a);
			print_r($a);*/

			/*ex2
			$prod = range(1, $_POST["valor1"]);
			print_r($prod);
			echo array_product($prod);*/

			/*ex3
			$a1 = range(1, 10);
			$a2 = range(8, 17);
			print_r($a1);
			echo "<br>";
			print_r($a2);
			$a3 = array_diff($a1, $a2);
			echo "<br>";
			print_r($a3);*/

			/*ex4
			$alunos = array("Davi" => 15, "Franca" => 5, "Caio" => 5);
			echo "media: " . array_sum($alunos)/sizeof($alunos) . "<br>";
			echo array_search(max($alunos), $alunos) ." ".max($alunos);
			rsort($alunos);
			echo "<br>";
			print_r($alunos);*/

			//ex5
			/*$a = range(1, 10);
			$b = range(11, 20);

			for($i = 0; $i<10; $i++){
				echo $a[$i]*$b[$i] . "<br>";
			}
			echo "soma1: " . array_sum($a) . "<br>";
			echo "soma2: " . array_sum($b) . "<br>"; 
			echo "prod1: " . array_product($a) . "<br>";
			echo "prod2: " . array_product($b) . "<br>";*/

			/*$valor = 10;
			if($valor > 5){
				echo "<br>eh maior que 5<br>";
			} elseif($valor == 5){
				echo "<br>eh igaul a 5<br>";
			} else{
				echo "<br>eh menor que 5<br>";
			}*/
			//echo "<br>" . $valor <=> 5;
						
			//ex1
			/*$v1 = $_POST["valor1"];
			$v2 = $_POST["valor2"];
			$res = $v1+$v2;
			$res = $res*$v1;
			echo $res;*/

			//ex2
			/*$Val1 = $_POST["valor1"];
			$Val2 = $_POST["valor2"];
			$Val3 = $_POST["valor3"];
			echo ($Val1+$Val2+$Val3)/3;*/

			//ex3
			//$val = $_POST["valor1"];
			//echo $val*0.15;

			//ex4
			/*$val = $_POST["valor1"];
			echo $val*0.05 . "<br>";
			echo $val*0.5 . "<br>";*/

			//ex5
			/*$v1 = $_POST["valor1"];
			$v2 = $_POST["valor2"];
			$v1 = $v1*$v1;
			$v2 = $v2*$v2;
			echo $v2+$v1;*/

			//ex6
			/*$v = $_POST["valor1"];
			if($v%10 == 0){
				echo "eh divisivel por 10 <br>";
			}else{
				echo "nao eh divisivel por 10 <br>";
			}
			if($v%5 == 0){
				echo "eh divisivel por 5 <br>";
			}else{
				echo "nao eh divisivel por 5 <br>";
			}
			if($v%2 == 0){
				echo "eh divisivel por 2 <br>";
			}else{
				echo "nao eh divisivel por 2 <br>";
			}*/

			//ex7
			/*$p1 = array($_POST["valor1"], $_POST["valor2"], $_POST["valor3"]);
			if($p1[1] < 25 && $p1[2] == "feminino"){
				echo "aceita";
			}else{
				echo "nao aceita";
			}*/

			//ex8
			/*$v = $_POST["valor1"];
			echo $v*3.6;*/

			//ex9
			/*$a = $_POST["valor1"];
			$m = $_POST["valor2"];
			echo "IMC = " . ($m/($a**2));*/

			//ex10
			//$v = $_POST["valor1"];
			//echo $v*0.91;
			
			//ex11
			/*$v = $_POST["valor1"];
			$d = $v*0.07;
			echo "Vp " . $v ."  Vd " . $d . "  Vpd " . $v-$d;*/

			//ex12
			/*$c = $_POST["valor1"];
			$a = $_POST["valor2"];
			$l = $_POST["valor3"];
			echo "Volume = " . $c*$a*$l;*/

			//ex13
			//$v = $_POST["valor1"];
			//echo $v*0.73;

			//ex14
			/*$a = $_POST["valor1"];
			$b = $_POST["valor2"];
			$h = $_POST["valor3"];
			echo "area = " . (($a+$b)*$h)/2*/

			//ex15
			/*$n = array(2 => $_POST["valor1"], 3 => $_POST["valor2"], 5 => $_POST["valor3"]);
			$s = 0;
			$p = array_keys($n);
			$i=0;
			foreach($n as $a){
				
				echo $a;
				echo $p[$i];
				$s = $s+$a*$p[$i];
				$i++;
			}
			echo "m = " . $s/array_sum($p);*/

			//ex16
			/*$a = $_POST["valor1"];
			$b = $_POST["valor2"];
			$c = $_POST["valor3"];

			if($a<($b+$c)){
				if($b<($a+$c)){
					if($c<($b+$a)){
						echo "eh triangulo<br>";
						if($a == $b && $a==$c){
							echo "eh equilatero";
						} elseif(($a!=$b && $b!=$c) && $c!=$a){
							echo "eh isoceles";
						}
					}else{
						echo "nao eh triangulo";
					}
				}else{
					echo "nao eh triangulo";
				}
			}else{
				echo "nao eh triangulo";
			}*/

			/*
			ex17
			$mes = array(1 => "janeiro", 2 => "fevereiro", 3 => "março", 4 => "abril", 5 => "maio", 6 => "junho", 7 => "julho", 8 => "agosto", 9 => "setembro", 10 => "outubro", 11 => "novembro", 12 => "dezembro");
			$i = $_POST["valor1"];
			if($i>=1 && $i<=12){
				echo $mes[$i];
			}else{
				echo "nao existe este mes";
			}*/

			/*ex18
			$n = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1);
			$s = 0;
			$neg=0;
			foreach($n as $i){
				if($i > 0){
					$s = $s + $i;
				}else{
					$neg++;
				}
			}
			echo $s . "  " . $neg;
			*/

			//ex19
			/*$mat = array(0 => [1, 2, 3, 4, 5], 1 => [6, 7, 8, 9, 10], 2 => [11, 12, 13, 14, 15], 3 => [16, 17, 18, 19, 20], 4 => [21, 22, 23, 24, 25]);

			for($i=0; $i<5; $i++){
				for($j=0; $j<5; $j++){
					if($i==$j){
						$mat[$i][$j]=0;
					}
				}
			}
			print_r($mat);*/

			//ex20
			/*$km = $_POST["valor1"];
			$c = $_POST["valor2"];
			echo "consumo medio: " . $km/$c;*/

			//ex1 folha
			/*$p = "arara";
			$p2 = strrev($p);
			var_dump($p2);
			if($p==$p2){
				echo "eh palindromo";
			}else{
				echo "nao eh palindromo";
			}*/
			//ex2 folha
			/*$a = $_POST['valor1'];
			$b = $_POST['valor2'];
			$c = $_POST['valor3'];

			$d=($b * $b) -4*$a*$c;
			$x1=(sqrt($d)-$b)/(2*$a);
			$x2=(-sqrt($d)-$b)/(2*$a);
			echo "x1 = " . $x1 . "x2 = " . $x2 . "<br>"; 


			if($a>0){
				echo "cima<br>";
			}else{
				echo "baixo<br>";
			}

			$vm = (-$d)/(4*$a);
			echo "vm = " . $vm;*/

			
			/*function somar(int $a, int $b): int{
				return $a+$b;
			}
			echo somar(5, 5) . "<br>";
			//echo somar("5", "4") . "<br>";
			//echo somar("marques", "davi") . "<br>";
			class dog{
				private $peso = 50;
				private $dog_nome;
				function get_dados(): string{
					return "o nome e $this->dog_nome o peso do dog é $this->peso";
				}

				function set_dog_nome(string $v): bool{
					$mensagem_erro = true;
					(ctype_alpha($v)&&strlen($v)<21) ? $this->dog_nome=$v : $mensagem_erro=false;
					return $mensagem_erro;
				}
			}
			
			$cachorro = new Dog;
			$dog_mensagem_errp = $cachorro->set_dog_nome("doguinho");
			print $dog_mensagem_errp ? "nome atualizado com sucesso <br/>":"nao foi atualizado";
			print($cachorro->get_dados());*/
			
			$servername = "localhost";
			$username = "root";
			$password = "";
			$db_name ="a";
			$connect = mysqli_connect($servername, $username, $password, $db_name);
			if(mysqli_connect_error()):
				echo "falha na conexâo: " . mysqli_connect_error();
			endif; 



		?>
	</p1>
</body>
</html> 