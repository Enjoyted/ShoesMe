<h1> Sport Femme </h1>

<?php 
	foreach($chaussures as $chaussure)
	{
		$image = $chaussure['Chaussure']['path'];
		$id = $chaussure['Chaussure']['ref'];
		 echo $this->Html->image("Chaussures/$image", array(
	          'url' => "/chaussures/produit/$id",
	          'class' => 'img-responsive img-produit'
	          ));
	          
		echo 'nom : ' . $chaussure['Chaussure']['nom']. '<br />';
		echo 'ref : ' . $chaussure['Chaussure']['ref']. '<br />';
		echo 'prix : ' . $chaussure['Chaussure']['prix'] .'€';
	}
?>