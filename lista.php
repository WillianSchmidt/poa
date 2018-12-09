<?php

include('database_functions.php');

$pdo = connect_to_database("falacidadebaixa");

$sql = "SELECT * FROM denuncias";
$result = $pdo->query($sql);
echo "<!DOCTYPE html><html><body><table border='1'>";
?>
<div style="text-align:center;">
		<?php
			while ($row = $result->fetch()) {		
				echo "<h4>Usuario ".$row['nome']."</h4>".
					 "<h4>Falou : ".($row['comments'] == NULL ? "-" : $row['comments'])."</h4>";
				echo "----------------------------------------------------------------------------------------------";	 
					 
			}
		?>
</div>



    <div class="col-sm-7 slideanim" style="text-align:center;">
	 <form class="myform" action="index.html" method="post">
      <div class="row">
        <div class="col-sm-12 form-group"> 
		  <button class="btn btn-default pull-right" id="enviar" type="submit"><a>Voltar a Inicio</a></button>
		</div>
	</div>
	</div>
</div>


<?php
echo "</table></body></html>";
?>
