<!DOCTYPE html>
<html>
<head>
	<meta charstet="utf-8">
	<title>Загрузка фото на сервер</title>
	<link href="css/styles.css" rel="stylesheet">
</head>
<body>
	<main class="upload-photo">
		<div class="upload-photo__layout clearfix">			
			<div class="upload-photo__form">
				<h1 class="upload-photo__header">Добавить фото на сайт</h1>
				<form action="index.php" name="frmForm1" method="post" id="frmUpload" enctype="multipart/form-data">		
				  <input  type="hidden" name="MAX_FILE_SIZE" value="50000000"  />		
					<input class="btn"  type="submit" id="button1" name="sbmUpload" value="Загрузить фото">					
					<label for="files1" class="upload-photo__file-label">Выбрать файлы</label>
					<input class="btn btn--upload" type="file" name="file[]" id="files1" multiple>
					<h3 class="upload-photo__count"></h3>
					<div class="upload-photo__preview">
					</div>
				</form>	
			</div>
		</div>
	</main>
	
	<script src="js/script.js">
	</script>	
</body>
</html>

<?php

  require_once("lib/TransferFiles.php");

  if(isset($_POST["sbmUpload"]))
  {
    $objTransfer = new TransferFiles();    
    if($res = $objTransfer->moveToServer($_FILES,"file"))
    {
      echo "<h2>На сервер загружено ".$res["count"]." изображений";    
      require("lib/FormatImages.php");
      
      // Проход по каталогу для форматирования изображений
      
      $objImage = new FormatImages();

      // Проход по каталогу
      if(!opendir($objImage->filepath_res))
        die('Каталог не найден');
      else
        $files = scandir($objImage->filepath_res);

      if(count($files) == 0)
      {
        die("Нет файлов для форматирования");
      }
      $i=0;
      foreach($files as $file){
        if(in_array($file, array('.','..'))) {    
          continue;
        }

        $img = $objImage->resizeImages($objImage->filepath_res.$file);  

        if(imagejpeg($img,$objImage->filepath_dest.$file,80))
          $i++;
        //imagedestroy($file); 

      }  
      
       echo "<h2>На сервер обработано ".$i." изображений";   
      
    }
    
  }
    
