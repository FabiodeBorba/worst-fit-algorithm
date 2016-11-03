<?php 
	require('SegMemory.class.php');
	
	(int)$process	= $_POST['process']; 
	(int)$memory 	= $_POST['memory'];



	$tamProcess[] = $process;
	$segMemory[] = $memory;

	
 	(int) $i;
 

 	echo  'Processo: ';


	for ($i = 0; $i < $process; $i++) {
		
		$tamProcess[$i] = mt_rand(1,13);

	}


	echo json_encode($tamProcess);
	echo '<br> Tamanho segmento de memoria: ';
	
	for ($i = 1; $i <= $memory; $i++) { 	
		$seg = new SegMemory();
		$seg->id = $i;
		$seg->size = mt_rand(1,30);
		$segMemory[$i-1] = $seg;
	}

	echo json_encode($segMemory);
	echo '<br />';

	$j;

	

	for ($i = 0; $i < $process; $i++) { 
			
		$atual = 0;

		for ($j = 0; $j < $memory; $j++) {
		

			for ($id=0; $id < count($segMemory); $id++) { 
				if($segMemory[$id]->size >= $atual){
					$atual = $segMemory[$id]->size;
				}else{
					continue;
				}
			}


			if ($segMemory[$j]->size >= $atual) {
				$segMemory[$j]->size -= $tamProcess[$i];

				echo ("Processo ". ($i + 1). ' alocado no espaco de memoria '. $segMemory[$j]->id. '<br/>');

				echo ('Espaco restante apos alocacao '. $segMemory[$j]->size.'<br>');

				break;
			}
		}

		if ($j == $memory)
		{
			echo ('Nao ha mais espaco '. $i. '<br>');
			break;
		}
	}



	
	


	
