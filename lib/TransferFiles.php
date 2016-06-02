<?php 

/**
Загрузка изображений на сервер
*/

class TransferFiles {
  
  
  public $filepath_dest; // путь к файлу
    
  
  function TransferFiles(){
    
    $this->filepath_dest = "image_source/";
    
  }

  /**
   * Перемещение фото на сервер
   * @param array $files     Массив с изображениями
   * @param string $file_name Название массива с файлами
   */  
  
  public function moveToServer($files, $file_name)
  {
    $i = 0;
 //   print_r($files);

    while($i<count($files[$file_name]["tmp_name"]))
    {

      if (is_uploaded_file($files[$file_name]["tmp_name"][$i]))
      {

        $pathinfo = pathinfo($files[$file_name]["name"][$i]);

        $filename = $pathinfo["basename"];    

        if(!move_uploaded_file($files[$file_name]["tmp_name"][$i], $this->filepath_dest.$filename))
        {      
          die("Данные на сервер не переданы");     
        }

      }
      else
      {
        die("Файл не загружен");
      } 

      $i++;

    }
    
    $arr=array();
    $arr["result"] = true;
    $arr["count"] =  count($files[$file_name]["tmp_name"])." файлов";

    return $arr;
   
  }
  
}
 

?>