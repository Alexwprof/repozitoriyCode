<?include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');
CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");
?>
<?/*Сделаем что бы 404 шла без 302 редиректа напрямую*/?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
    $APPLICATION->SetPageProperty("description", "Страница не найдена");
    $APPLICATION->SetPageProperty("keywords", "Страница не найдена");

    $APPLICATION->SetTitle("Страница не найдена");?>

        <?if(false/*$page !== '/404.php'*/):?>
    <?LocalRedirect("/404/", "404 Not Found");?>
<?else:?>
		<div class="height-80vh">
			<main class="block-404">
				<div class="abs-round">
				<div class="round">
					<div class="round-padding"></div>
					<div class="round-big">
						<div class="mini-title">Ошибка</div>
						<div class="error-title">404</div>
						<div class="round-title">Страница не найдена</div>
						<p>
							Возможно, Вы пытаетесь загрузить несуществующую 
							или удалённую страницу.
						</p>
                        <a href="/" class="app-btn">На главную </a>
					</div>
				</div>
				</div>
				<div class="blue-line">
					<div class="line-padding"></div>
				</div>
			</main>
		</div>
<?endif?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
