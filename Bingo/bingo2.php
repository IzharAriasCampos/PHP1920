<HTML>
	<HEAD> <TITLE> Bingo </TITLE> </HEAD>
	<BODY>
	<?php
	
	//Para realizar este ejercicio, hemos usado Arrays asociativos.
	//El juego comienza con la funcion rellenarArrays() con la que generamos el array ($rellenar), que nos servirá posteriormente para poder hacer todos los cartones de cada jugador.
	//A continuacion tenemos la funcion rellenarBolas($numb) que nos devuelve un array de ($numb) bolas que no se repiten entre si.
	//Lo siguiente que hacemos es rellenar los 3 cartones de los 4 jugadores con 15 bolas cada carton.
	//Por último generamos los contadores de los jugadores, incrementamos el contador de un jugador cuando una bola del array de bolas coincide con un numero del array de cartones de ese jugador, y comprobamos qué jugador ha llegado antes a 15 aciertos.
	//Al haber usado una estructura con arrays asociativos el manejo es mucho mas cómodo y compacto, ya que nos permite modificar con una sola variable tanto los jugadores como los contadores.
	
	//CSS:
	echo "<style type='text/css'>
	*{background:#34495E;color:#fff;}
	
	table{border-color:#3498DB;color:#fff;}
	
	.button{
		background:yellow;
		color:black;
		border-radius: 15px;
		font-weight:bold;
	}
	.bolas{background-color: white;}
	
	.bolas img{width:50px;}
	
	.bolas td{background-color: white;}
	
	h1{text-decoration:underline;}
	
	h3{color:yellow;}
	
	</style>";
	
	echo "<h1 align='center'>Bingo con funciones</h1>";
	
	//Variables:
	$njug=["Izhar","Ruben","Irene","Ana"];
	//$jugador=[""][0];
	//$contador=[""][0];
	$a=0;
	$fin=false;
	
	//Funciones:
	
	//Funcion rellenar:
	//Esta funcion rellena un carton vacío, lo rellena, lo ordena y nos lo devuelve.
	//No recibe parámetros.
	function rellenarArrays(){
		$rellenar[0]=rand(1,60);
		for ($i=1;$i<15;$i++){
			$comprobar=rand(1,60);
			while(in_array($comprobar,$rellenar)){
			$comprobar=rand(1,60);}
			$rellenar[$i]=$comprobar;
		}
		sort($rellenar);
		return $rellenar;
	}
	
	//Funcion de rellenar bolas:
	
	//Recibe como parámetro ($numb) que es el numero de bolas que se van a usar.
	$numb=60;//<---Aqui puedes poner el numero de bolas que quieras.
	function rellenarBolas($numb){
		$bolas[0]=rand(0,$numb);											
		for ($i=0;$i<$numb;$i++){
			do{$comprobar=rand(1,$numb);
			}while(in_array($comprobar,$bolas));
			$bolas[$i]=$comprobar;
		}
	return $bolas;
	}
	
	//Rellenamos todos los arrays de todos los jugadores:
	for($r=0;$r<count($njug);$r++){
	echo "<h4 align='center'>$njug[$r]</h4>";
	echo "<table border='1' align='center'>";
		for($x=0;$x<3;$x++){
			$jugador [$njug[$r]][$x]=rellenarArrays();
			
			//Mostramos por pantalla:
			echo "<tr><td align='center' colspan='15'>".($x+1)." carton </td></tr>";
			echo "<tr>";
			for ($i=1;$i<15;$i++){
				echo "<td align='center'>";
				echo $jugador[$njug[$r]][$x][$i];
				echo "</td>";
			}
			echo"</tr>";
		}
		echo "</table>";
	}
	
		//Jugar:
	//Generar contadores:
	for($r=0;$r<count($njug);$r++){		
		for ($x=0;$x<3;$x++){
			$contador[$njug[$r]][$x]=0;
		}
	}
	
	$bolas=rellenarBolas($numb);
	echo "<table class='bolas' align='center'><tr>";
	while($a<count($bolas) && $fin==false){
	//Incrementar contadores:
	echo "<td><img src='Imagenes/$bolas[$a].png'></td>";
		for($i=0;$i<15;$i++){
			for($r=0;$r<count($njug);$r++){
				for ($x=0;$x<3;$x++){
					if($jugador[$njug[$r]][$x][$i]==$bolas[$a])
						$contador[$njug[$r]][$x]+=1;
				}
				//Comprobar quien llega primero a 15:
				for ($x=0;$x<3;$x++){
					if ($contador[$njug[$r]][$x]==15){
						$win=$r;
						$fin=true;
					
					}
				}
			}
		}
		
		if($fin){
		echo "<br/><div align='center'><button class='button' align='center'>".$njug[$win]." ha ganado</button></div><br/>";
		}
		$a++;
		if ($a%6==0){echo "</tr><tr>";}
	}
	
	echo "</tr></table>";
	
?>
	</BODY>
	</HTML>
