<?php 

class FormatImages {

  public $filepath_res;
  public $filepath_dest;  
  
  function FormatImages()
  {
    $this->filepath_res = 'image_source/';  
    $this->filepath_dest = 'images/';
  }
  
  /**
   * Форматирование изображений на сервер
   * 
   * @param  [[Type]] $imgname путь к файлу
   * @return bool изображение
   */
  public function resizeImages($imgname)
  {
      /* Пытаемся открыть */
      $im = @imagecreatefromjpeg($imgname);
      list($width, $height) = getimagesize($imgname);       

      /* Если не удалось */
      if(!$im)
      {
          /* Создаем пустое изображение */
          $im  = imagecreatetruecolor(150, 30);
          $bgc = imagecolorallocate($im, 255, 255, 255);
          $tc  = imagecolorallocate($im, 0, 0, 0);

          imagefilledrectangle($im, 0, 0, 150, 30, $bgc);

          /* Выводим сообщение об ошибке */
          imagestring($im, 1, 5, 5, 'Error loading ' . $imgname, $tc);
      }         
     // echo $width.'<br>';
     //echo $height;

  /* Создаем новое изображение */
      $new_width = 800;
      $new_height = 800;

      if($width > 800 || $height > 800){
        if($width >= $height){      
          $new_height = floor($height*$new_height/$width);      
        }
        else{
          $new_width = ceil($width*$new_width/$height);      
        }
        $im_new = imagecreatetruecolor($new_width, $new_height); 

        imagecopyresampled($im_new, $im,0, 0, 0, 0, $new_width, $new_height, $width, $height);
       // echo 'file ='.$imagname.' new_width ='.$new_width.'new_height ='.$new_height.' width='.$width.' height'.$height;
        return $im_new;
      }
      else{    
        return $im;
      }      
  }
  
}

?>