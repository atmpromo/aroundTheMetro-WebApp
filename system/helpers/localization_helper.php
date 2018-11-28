<?php 
if ( ! function_exists('getLocalizedString')) {
    function getLocalizedString($lang, $name) {

		$strings = array(
			"Title" => 				array("Around The Metro", "Autour Du Métro", "蒙特利尔尔地下城"), 
			"Home" => 				array("Home", "Accueil", "家园"),
			"Malls" => 				array("Malls", "Tours", "商场"),
			"Stores" => 			array("Stores", "Magasins", "商店"),
			"Jobs" => 				array("Jobs", "Emplois", "工作"),
			"Hotels" => 			array("Hotels", "Hotels", "旅馆"),
			"Events" => 			array("Events", "Événements", "活动"),
			"Promotions" => 		array("Promotions", "Promotions", "促销活动"),
			"About" => 				array("About", "À propos", "关于"),
			"Contact" => 			array("Contact", "Contact", "联系"),
			"world" =>				array( 	"World" , "Monde", "世界"),
			"Places" =>				array(	"Places" , "Endroits" , "地方"),
			
			"world_phrase_1"=>		array(	"Around the metro - Coming Soon !" , "Un monde à découvrir autour du métro" , "的世界，发现周围的地铁"),
			"world_phrase_2"=>		array(	"Choose your city :" , "Choissez votre ville :" , "选择你的城市"),
			"Metros" => 			array("Metro", "Métro", "地铁"),
			"Featured" => 			array("Featured", "En vedette", "特色"),
			"Next" => 				array("Next", "Prochain", "下一个"),
			"Previous" => 			array("Previous", "Précédent", "上一个"),
			"Readmore" => 			array("Read More", "Lire la suite", "阅读更多"),
			"Map" => 				array("Map", "Carte", "地图"),
			"Details" => 			array("Details", "Détails", "细节"),
			"Loadingdata" =>		array("Loading Data...", "Chargement des données ...", "加载数据中..."),

			"English" => 			array("English", "English", "English"),
			"French" => 			array("Français", "Français", "Français"),
			"Chinese" => 			array("汉语", "汉语", "汉语"),

			"Type" =>				array("Type", "Type", "类型"),
			"Mall" =>				array("Mall", "Tours", "商场"),
			"Metro" =>	 			array("Metro", "Métro", "地铁"),
			"Facebook" =>	 		array("Facebook", "Facebook", "地铁"),
			"Website" =>	 		array("Website", "Métro", "地铁"),

			"WelcomePos" =>			array("150,355", "150,348", "150,388"),
			"TitlePos" =>			array("210,125", "210,217", "210,270"),
			"BannerPos" =>			array("270,82", "270,55", "270,140"),
			"ButtonPos" =>			array("340,425", "340,417", "340,439"),

			"Welcometo" => 			array("Welcome to", "Bienvenue à", "欢迎来到"),
			"BannerText1" => 		array(
					"Montreal Underground city is the best place for shopping where you can see most of the famous brands <br/>from all over the world. Enjoy the Shopping World!", 
					"La ville souterraine de Montréal est le meilleur endroit pour faire du shopping où vous pouvez voir la plupart des <br/>marques célèbres du monde entier. Profitez du monde des achats!", 
					"蒙特利尔地下城是购物的最佳场所，您可以从世界各地看到大多数知名品牌。 享受购物世界！"),
			"BannerText2" => 		array(
					"Montreal Underground city is the best place for shopping where you can see most of the famous brands <br/>from all over the world. Enjoy the Shopping World!", 
					"La ville souterraine de Montréal est le meilleur endroit pour faire du shopping où vous pouvez voir la plupart des <br/>marques célèbres du monde entier. Profitez du monde des achats!",
					"蒙特利尔地下城是购物的最佳场所，您可以从世界各地看到大多数知名品牌。 享受购物世界！"),
			"BannerText3" => 		array(
					"Montreal Underground city is the best place for shopping where you can see most of the famous brands <br/>from all over the world. Enjoy the Shopping World!", 
					"La ville souterraine de Montréal est le meilleur endroit pour faire du shopping où vous pouvez voir la plupart des <br/>marques célèbres du monde entier. Profitez du monde des achats!",
					"蒙特利尔地下城是购物的最佳场所，您可以从世界各地看到大多数知名品牌。 享受购物世界！"),
			"View3dmap" =>			array("View Map", "Voir la carte", "查看地图"), 

			"SearchPlaceholder" => 	array("Find Restaurants, Boutiques, Beauty & Healths, Attractions, etc.", 
								 	 "Trouver des Restaurants, Boutiques, Beauté et Santé, Attractions, etc.",
								 	 "查找餐馆，精品店，美容与健康，景点等"),
			"Search" => 			array("Search", "Chercher", "搜索"),
			"home_event_phrase" =>	array(	"Featured events in the Underground City" , "Evènements vedettes dans la ville souterraine" , "地下城特色活动" ),

			"Restaurants" => 		array("Restaurants", "Restaurants", "餐厅"),
			"Boutiques" => 			array("Boutiques", "Boutiques", "精品店"),
			"BeautyHealths" => 		array("Beauty & Health", "Beauté et Santé", "美容与健康"),
			"Attractions" => 		array("Attractions", "Attractions", "景点"),
			"restaurant" => 			array("Restaurants", "Restaurants", "餐厅"),
			"boutique" => 			array("Boutiques", "Boutiques", "精品店"),
			"beautyhealth" => 		array("Beauty & Health", "Beauté et Santé", "美容与健康"),
			"attraction" => 			array("Attractions", "Attractions", "景点"),
			"MallsMood" => 			array("Montréal’s Underground City connects to 14 malls, making it the largest underground shopping complex in the world!", 
								 	 "La ville souterraine de Montréal se connecte à 14 centres commerciaux, ce qui en fait le plus grand complexe commercial souterrain du monde!", 
								 	 "蒙特利尔的地下城连接到14个购物中心，使其成为世界上最大的地下购物中心！"),

			"Workinghours" => 		array("Working Hours", "Heures de Travail", "工作时间"),
			"Aboutus" => 			array("About Us", "À propos de nous", "关于我们"),
			"footer_phrase" =>      	array(	" Improving the Underground City of Montréal experience for Montréalers and tourists.", 
											"Améliorer l’expérience Montréal souterrain pour les Montréalais et les touristes", 
											"共同为当地人和游客提供蒙特利尔地下城的经验。"),
			"footer_address" =>		array(	"Postal Address: 1250 René-Levesques West Suite 2200, Montréal Qc, H3B 4W8",
											"Adresse postale: 1250 René-Levesques Ouest Suite 2200, Montréal Qc, H3B 4W8",
											"邮寄地址：1250勒内Levesques西套房2200蒙特利尔QC H3B4W8"),
			"footer_about" =>		array(	"About us" , "À Propos" , "关于"),
			"footer_media" => 		array(	"Media exposure" , "Media exposure" , "在媒体"),
			"footer_Platforms" =>	array( 	"Our Platforms" , "Nos plateformes" , "演示平台"),
			"footer_Media_Kit" =>	array(	"Media Kit" , "Kit Média" , "媒体套件"),
			"footer_Publicity" => 	array( 	"Advertise with us" , "Annoncez sur nos plateformes" , "广告"),
			"footer_Followus" => 	array(	"Follow us" , "Suivez-Nous" , "关注我们"),
			"footer_Onlinestores"=>	array(	"Online stores" , "Boutique en ligne" , "在线商店"),
			"footer_CityMap" =>		array( 	"Montréal Underground City Map" , "Carte du Montréal souterrain" , "地图地下蒙特利尔"),
			"footer_Tourist" =>		array(	"Official Guide to Montréal’s Underground City" , "Guide officiel du Montréal Souterrain" , "导游"),
			"footer_CoffeeMug" =>	array(	"Coffee Mug" , "Tasses à Café" , "咖啡杯"),
			"footer_T-Shirt" =>		array(	"T-Shirt" , "T-Shirt" , "T恤"),
			"footer_Mousepads" =>	array(	"Mousepads" , "Tapis de Souris" , "滑鼠垫"),
			"footer_ads"=>			array(	"Advertising" , "Publicité" , "广告"),
			"footer_copyright" =>	array(	"Copyright Augmented Discovery 2017. All right reserved" , "Droits d'auteur Augmented Discovery 2017. Tous droits réservés" , "版权增强发现2017.保留所有权利"),
			"in" =>					array(	"in" , "dans" , "在"),
			"contact" =>				array(	"Contact us" , "Contactez-nous" , "联系我们"),
			"contact_phrase"=>		array(	"For any questions or inquiries about Montréal Underground City or our plateformes, contact us at <a href='mailto:info@montrealsouterrain.ca'>info@montrealsouterrain.ca</a> or fill out the form." ,
											"Pour toute question concernant la ville souterraine ou nos plateformes, contactez nous à <a href='mailto:info@montrealsouterrain.ca'>info@montrealsouterrain.ca</a> ou remplissez le formulaire." , 
											"有关地下城或我们的平台的问题，请与我们联系<a href='mailto:info@montrealsouterrain.ca'>info@montrealsouterrain.ca</a>或填写下面的表格。"),
			"contact_header" =>		array(	"Contact" , "Contact" , "接触" ),
			"contact_name" =>		array( 	"Your name" , "Votre nom" , "你的名字"),
			"contact_email" =>		array(	"Your Email" , "Votre email" , "你的邮件"),
			"contact_phone" =>		array(	"Phone" , "Téléphone" , "电话" ),
			"contact_subject"	=>	array(	"subject" , "Sujet" , "学科"),
			"contact_message" =>		array(	"Your Message" , "Votre Message" , "你的信息"),
			"contact_submit" =>		array(	"Submit" , "Envoyez" , "提交"),
			"claim_page" =>			array(	"Claim this page" , "Demander cette page" , "声称此页"),
			"linkadd"=>				array(	"-en" , "-fr" , "-cn"),
			"Address"=>				array(	"Address" , "Adresse" , "Address"),
			"Opening_Hour"=>		array(	"Opening Hours" , "Heures d'ouvertures" , "Opening Hours"),

			
		);

    	if ($lang >= 0 && $lang <= 2) {
    		return $strings[$name][$lang];
    	} else {
    		return $strings[$name][$lang];
    	}
    }
}
?>