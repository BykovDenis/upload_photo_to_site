		(function(){
			
			var photo_preview = document.querySelector(".upload-photo__preview");
			var counter_photo = document.querySelector(".upload-photo__count");
			var arr_photo = []; // фото товаров

			// Загрузка данных 			

			document.querySelector("#files1").addEventListener("change", function(){

				var files = this.files;
				
				counter_photo.innerText = "Выбрано "+files.length+" файлов";

				for(var i = 0; i < files.length; i++){

					preview(files[i]);

				}

			});

			function preview(file){

				// проверка на то что файлы изображения
				if(file.type.match(/image.*/)){
					
					var reader = new FileReader();

					reader.addEventListener("load", function(){
						
						var divs = document.createElement("div");
						divs.class = "upload-photo__contain";
													
						var img = document.createElement("img");
							img.src = event.target.result; 
							img.alt = file.name;
							img.width = "250";
						
						var span = document.createElement("span");
							span.innerText = file.name;
							
						photo_preview.appendChild(divs);
						divs.appendChild(span);
						divs.appendChild(img);	
						
						arr_photo.push({file: file, img: img});
						

					});	
					
										
						reader.readAsDataURL(file);						
						//console.log(reader);
            console.log(reader.result);
					//	console.log(reader.readAsDataURL(file));						
					

				}

			}
			
			
			//Передача данных на сервер через ajax
			
			var form_upload = document.getElementById("frmUpload");
			
						
			document.getElementById("button1").addEventListener("click", function(){
				
				console.log("Кнопка нажата");
										
				var data = new FormData(form_upload);	
				
				arr_photo.forEach(function(element){
					
					data.append("image", element.file);
					console.log(element);
					
				});
				
				console.log(data);
				console.log(arr_photo);				
				
			});
			
})();   
