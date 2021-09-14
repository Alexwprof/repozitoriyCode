	<?if(empty($arResult["ERROR_MESSAGE"]))
		{
			$arFields = Array(
				"AUTHOR" => $_POST["user_name"],
				"AUTHOR_EMAIL" => $_POST["user_email"],
				"EMAIL_TO" => $arParams["EMAIL_TO"],
				"TEXT" => $_POST["MESSAGE"],
				"CALC_PARAMS" => $_POST["calc_params"]
			);
		
			
			/*Добавляем в шаблон возмодность отправлять несколько файлов на почту .Шаблон компонента main.feedback*/ 
			/**********/

			function reArrayFiles(&$file_post) {

				$file_ary = array();
				$file_count = count($file_post['name']);
				$file_keys = array_keys($file_post);

				for ($i=0; $i<$file_count; $i++) {
					foreach ($file_keys as $key) {
						$file_ary[$i][$key] = $file_post[$key][$i];
					}
				}

				return $file_ary;
			}

				$file_ary = reArrayFiles($_FILES['myfile']);
			
				foreach ($file_ary as $file) {

					$resPhoto[] = CFile::SaveFile($file, 'files');
				}
			
			/**********/
			/**********/
				 

			if(!empty($arParams["EVENT_MESSAGE_ID"]))
			{
				foreach($arParams["EVENT_MESSAGE_ID"] as $v)
					if(IntVal($v) > 0)
					
					/**********/
						CEvent::Send($arParams["EVENT_NAME"], SITE_ID, $arFields, "N", IntVal($v), $resPhoto);
					/**********/
			}
			else
				CEvent::Send($arParams["EVENT_NAME"], SITE_ID, $arFields, "N", "", $imgSend);

			$_SESSION["MF_NAME"] = htmlspecialcharsbx($_POST["user_name"]);
			$_SESSION["MF_EMAIL"] = htmlspecialcharsbx($_POST["user_email"]);
			LocalRedirect($APPLICATION->GetCurPageParam("success=".$arResult["PARAMS_HASH"], Array("success")));
		}
		
