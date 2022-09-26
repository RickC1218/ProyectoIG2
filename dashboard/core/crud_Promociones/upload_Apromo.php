<?php
function upload_promo_img($data){
	if($_SERVER['REQUEST_METHOD'] == "POST"){
		$folder = __DIR__."/uploads/images";
		if(!file_exists($folder)){
			$dir=mkdir($folder,0777,true);
			file_put_contents($folder."/index.php","");
		}
		$allowed = ['image/jpeg','image/png','image/jpg'];
		if(!empty($_FILES['Archivo_Promo'])){
			if($_FILES['Archivo_Promo']['error'] == 0){
				if(in_array($_FILES['Archivo_Promo']['type'],$allowed)){
					$destino = $folder."/".$_FILES['Archivo_Promo']['name'];
					move_uploaded_file($_FILES['Archivo_Promo']['tmp_name'],$destino);
					resize_image($destino);
					$_POST['Archivo_Promo'] = $destino;
					if(file_exists($data->Archivo_Promo)){
						unlink($data->Archivo_Promo);
					}
				}else{
					echo "El tipo de archivo no esta permitido";
					
				}
			}else{
				echo "No se pudo cargar la imagen";
			}
		}
	}
}
