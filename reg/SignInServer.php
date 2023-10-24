<?php 

session_start();
class Model {
private $db;
	public function __construct(){
		$this->db = new mysqli("localhost", "root", "", "younique");
		if($_POST["action"]){
			call_user_func([$this,$_POST["action"]]);
		}
	}
	public function Registration(){
		$FirstName = $_POST['FirstName'];
		$LastName = $_POST['LastName'];
		$Email = $_POST['Email'];
		$Password = md5($_POST['Password']);
		$_SESSION["FirstName"] = $FirstName;
		$_SESSION["LastName"] = $LastName;
		$_SESSION["Email"] = $Email;
		$_SESSION["Password"] = $Password;
		foreach (($this->db->query("SELECT Email FROM Users")->fetch_all(true)) as $value) {
			if ($Email === $value['Email']) {
				echo "Այս Էլ․ Հասցեն արդեն օգտագործվել է";
				die();
			}
		}
		$this->db->query("INSERT INTO Users(FirstName, LastName, Email, Password) VALUES ('$FirstName','$LastName', '$Email', '$Password')");
		if($Email === "annabrahamyan050103@gmail.com"){
			$ArrType = [];
			$ArrPrice = [];
			$ArrImage = [];
			$ArrCount = [];
			$ArrCountForSale = [];
			foreach(($this->db->query("SELECT * FROM JewInfo")->fetch_all(true)) as $value){
				array_push($ArrType, $value["Type"]);
				array_push($ArrPrice, $value["Price"]);
				array_push($ArrImage, $value["Image"]);
				array_push($ArrCount, $value["Counts"]);
				array_push($ArrCountForSale, $value["CountForSale"]);
			}
			$_SESSION["ArrType"] = $ArrType;
			$_SESSION["ArrPrice"] = $ArrPrice;
			$_SESSION["ArrImage"] = $ArrImage;
			$_SESSION["ArrCount"] = $ArrCount;
			$_SESSION["ArrCountForSale"] = $ArrCountForSale;
		}
	}
	public function LogOut(){
		session_unset();
	}
	public function LogIn(){
		$EmailForLogIn = $_POST['EmailForLogIn'];
		$PasswordForLogIn = $_POST['PasswordForLogIn'];
		$CheckEmail = $this->db->query("SELECT Email FROM Users WHERE Email = '$EmailForLogIn'")->fetch_all(true);
		if($CheckEmail === []){
			echo "Incorrect password or email";
			die();
		}
		elseif($CheckEmail[0]["Email"] === "$EmailForLogIn"){
			$CheckPassword = $this->db->query("SELECT Password FROM Users WHERE Email = '$EmailForLogIn'")->fetch_all(true);
			if($CheckPassword[0]["Password"] !== md5($PasswordForLogIn)){
				echo "Incorrect password or email";
			}
			elseif($CheckPassword[0]["Password"] === md5($PasswordForLogIn)){
				echo "Correct password and email";
				if($EmailForLogIn === "annabrahamyan050103@gmail.com"){
					$ArrType = [];
					$ArrPrice = [];
					$ArrImage = [];
					$ArrCount = [];
					$ArrCountForSale = [];
					foreach(($this->db->query("SELECT * FROM JewInfo")->fetch_all(true)) as $value){
						array_push($ArrType, $value["Type"]);
						array_push($ArrPrice, $value["Price"]);
						array_push($ArrImage, $value["Image"]);
						array_push($ArrCount, $value["Counts"]);
						array_push($ArrCountForSale, $value["CountForSale"]);
					}
					$_SESSION["ArrType"] = $ArrType;
					$_SESSION["ArrPrice"] = $ArrPrice;
					$_SESSION["ArrImage"] = $ArrImage;
					$_SESSION["ArrCount"] = $ArrCount;
					$_SESSION["ArrCountForSale"] = $ArrCountForSale;
				}
			}
		}
		else{
			echo "Incorrect password or email";
		}
		$SignInName = $this->db->query("SELECT FirstName FROM Users WHERE Email = '$EmailForLogIn'")->fetch_all(true);
		$SignInLastName = $this->db->query("SELECT LastName FROM Users WHERE Email = '$EmailForLogIn'")->fetch_all(true);
		$_SESSION['FirstName'] = $SignInName[0]["FirstName"];
		$_SESSION['LastName'] = $SignInLastName[0]["LastName"];
		$_SESSION['Email'] = $EmailForLogIn;
		$_SESSION['Password'] = $PasswordForLogIn;
	}
	public function JewInfo(){
		$Type = $_POST["Type"];
		$Price = $_POST["Price"];
		$Image = $_POST["Image"];
		$Count = $_POST["Count"];
		$CountForSale = $_POST["CountForSale"];
		$ArrType = [];
		$ArrPrice = [];
		$ArrImage = [];
		$ArrCount = [];
		$ArrCountForSale = [];
		$this->db->query("INSERT INTO JewInfo(Type, Image, Price, Counts, CountForSale) VALUES ('$Type','$Image', '$Price', '$Count',$CountForSale)");
		foreach(($this->db->query("SELECT * FROM JewInfo")->fetch_all(true)) as $value){
			array_push($ArrType, $value["Type"]);
			array_push($ArrPrice, $value["Price"]);
			array_push($ArrImage, $value["Image"]);
			array_push($ArrCount, $value["Counts"]);
			array_push($ArrCountForSale, $value["CountForSale"]);
		}
		$_SESSION["ArrType"] = $ArrType;
		$_SESSION["ArrPrice"] = $ArrPrice;
		$_SESSION["ArrImage"] = $ArrImage;
		$_SESSION["ArrCount"] = $ArrCount;
		$_SESSION["ArrCountForSale"] = $ArrCountForSale;
		echo 1;
	}
	public function DeletImageFromAdmin(){
		$AdminImgSrcDelete = $_POST["AdminImgSrcDelete"];
		$this->db->query("DELETE FROM JewInfo WHERE Image = '$AdminImgSrcDelete'");
		$ArrType = [];
		$ArrPrice = [];
		$ArrImage = [];
		$ArrCount = [];
		$ArrCountForSale = [];
		foreach(($this->db->query("SELECT * FROM JewInfo")->fetch_all(true)) as $value){
			array_push($ArrType, $value["Type"]);
			array_push($ArrPrice, $value["Price"]);
			array_push($ArrImage, $value["Image"]);
			array_push($ArrCount, $value["Counts"]);
			array_push($ArrCountForSale, $value["CountForSale"]);
		}
		$_SESSION["ArrType"] = $ArrType;
		$_SESSION["ArrPrice"] = $ArrPrice;
		$_SESSION["ArrImage"] = $ArrImage;
		$_SESSION["ArrCount"] = $ArrCount;
		$_SESSION["ArrCountForSale"] = $ArrCountForSale;
	}
	public function ChangeInfoForAdmin(){
		$AdminImgSrcChange = $_POST["AdminImgSrcChange"];
		$GetTypeForChangeForOne = $_POST["GetTypeForChangeForOne"];
		$GetPriceForChangeForOne = $_POST["GetPriceForChangeForOne"];
		$GetCountForChangeForOne = $_POST["GetCountForChangeForOne"];
		$GetCountForSaleForChangeForOne = $_POST["GetCountForSaleForChangeForOne"];
		$this->db->query("UPDATE JewInfo SET Type='$GetTypeForChangeForOne ',Price='$GetPriceForChangeForOne', Counts='$GetCountForChangeForOne' , CountForSale='$GetCountForSaleForChangeForOne' WHERE Image = '$AdminImgSrcChange'");
		$ArrType = [];
		$ArrPrice = [];
		$ArrImage = [];
		$ArrCount = [];
		$ArrCountForSale = [];
		foreach(($this->db->query("SELECT * FROM JewInfo")->fetch_all(true)) as $value){
			array_push($ArrType, $value["Type"]);
			array_push($ArrPrice, $value["Price"]);
			array_push($ArrImage, $value["Image"]);
			array_push($ArrCount, $value["Counts"]);
			array_push($ArrCountForSale, $value["CountForSale"]);
		}
		$_SESSION["ArrType"] = $ArrType;
		$_SESSION["ArrPrice"] = $ArrPrice;
		$_SESSION["ArrImage"] = $ArrImage;
		$_SESSION["ArrCount"] = $ArrCount;
		$_SESSION["ArrCountForSale"] = $ArrCountForSale;
	}
	public function Akanjox(){
		$_SESSION["ArrTypeLike"] = [];
		$_SESSION["ArrPriceLike"] = [];
		$_SESSION["ArrImageLike"] = [];
		$ArrTypeTevnoc = [];
		$ArrPriceTevnoc = [];
		$ArrImageTevnoc = [];
		$ArrCountTevnoc = [];
		$ArrCountForSaleTevnoc = [];
		foreach(($this->db->query("SELECT * FROM JewInfo WHERE Type = 'Ականջօղ'")->fetch_all(true)) as $value){
			array_push($ArrTypeTevnoc, $value["Type"]);
			array_push($ArrPriceTevnoc, $value["Price"]);
			array_push($ArrImageTevnoc, $value["Image"]);
			array_push($ArrCountTevnoc, $value["Counts"]);
			array_push($ArrCountForSaleTevnoc, $value["CountForSale"]);
		}
		$_SESSION["ArrTypeTevnoc"] = $ArrTypeTevnoc;
		$_SESSION["ArrPriceTevnoc"] = $ArrPriceTevnoc;
		$_SESSION["ArrImageTevnoc"] = $ArrImageTevnoc;
		$_SESSION["ArrCountTevnoc"] = $ArrCountTevnoc;
		$_SESSION["ArrCountForSaleTevnoc"] = $ArrCountForSaleTevnoc;
		$ArrTypeLike = [];
		$ArrPriceLike = [];
		$ArrImageLike = [];
		if (isset($_SESSION['Email'])) {
			$Email = $_SESSION['Email'];
			$UserId = ($this->db->query("SELECT UserId FROM Users WHERE Email = '$Email'")->fetch_all(true))[0]["UserId"];
			foreach(($this->db->query("SELECT * FROM Likes WHERE UserId = '$UserId' ORDER BY LikeID DESC")->fetch_all(true)) as $value){
				// var_dump($value);
				array_push($ArrTypeLike, $value["LikeType"]);
				array_push($ArrPriceLike, $value["LikePrice"]);
				array_push($ArrImageLike, $value["LikeImg"]);
			}
			$_SESSION["ArrTypeLike"] = $ArrTypeLike;
			$_SESSION["ArrPriceLike"] = $ArrPriceLike;
			$_SESSION["ArrImageLike"] = $ArrImageLike;
		}
		$ArrTypeCart = [];
		$ArrPriceCart = [];
		$ArrImageCart = [];
		$ArrCountsCart = [];
		$ArrCheckedCart = [];
		foreach(($this->db->query("SELECT * FROM CartItems WHERE UserId = '$UserId' ORDER BY CartID DESC")->fetch_all(true)) as $value){
				array_push($ArrTypeCart, $value["CartType"]);
				array_push($ArrPriceCart, $value["CartPrice"]);
				array_push($ArrImageCart, $value["CartImg"]);
				array_push($ArrCountsCart, $value["Counts"]);
				array_push($ArrCheckedCart, $value["Checked"]);
			}
		$_SESSION["ArrTypeCart"] = $ArrTypeCart;
		$_SESSION["ArrPriceCart"] = $ArrPriceCart;
		$_SESSION["ArrImageCart"] = $ArrImageCart;
		$_SESSION["ArrCountsCart"] = $ArrCountsCart;
		$_SESSION["ArrCheckedCart"] = $ArrCheckedCart;
		$TrueImg = [];
		$TrueImgPrice = [];
		foreach(($this->db->query("SELECT * FROM CartItems WHERE UserId = '$UserId'")->fetch_all(true)) as $value){
				if($value["Checked"] === 'true'){
					array_push($TrueImg, $value["CartImg"]);
					array_push($TrueImgPrice, $value['CartPrice']);
				}
		}
		$_SESSION['TrueImg'] = $TrueImg;
		$_SESSION['TrueImgPrice'] = $TrueImgPrice;
	}
	public function Matani(){
		$_SESSION["ArrTypeLike"] = [];
		$_SESSION["ArrPriceLike"] = [];
		$_SESSION["ArrImageLike"] = [];
		$ArrTypeTevnoc = [];
		$ArrPriceTevnoc = [];
		$ArrImageTevnoc = [];
		$ArrCountTevnoc = [];
		$ArrCountForSaleTevnoc = [];
		foreach(($this->db->query("SELECT * FROM JewInfo WHERE Type = 'Մատանաի'")->fetch_all(true)) as $value){
			array_push($ArrTypeTevnoc, $value["Type"]);
			array_push($ArrPriceTevnoc, $value["Price"]);
			array_push($ArrImageTevnoc, $value["Image"]);
			array_push($ArrCountTevnoc, $value["Counts"]);
			array_push($ArrCountForSaleTevnoc, $value["CountForSale"]);
		}
		$_SESSION["ArrTypeTevnoc"] = $ArrTypeTevnoc;
		$_SESSION["ArrPriceTevnoc"] = $ArrPriceTevnoc;
		$_SESSION["ArrImageTevnoc"] = $ArrImageTevnoc;
		$_SESSION["ArrCountTevnoc"] = $ArrCountTevnoc;
		$_SESSION["ArrCountForSaleTevnoc"] = $ArrCountForSaleTevnoc;
		$ArrTypeLike = [];
		$ArrPriceLike = [];
		$ArrImageLike = [];
		if (isset($_SESSION['Email'])) {
			$Email = $_SESSION['Email'];
			$UserId = ($this->db->query("SELECT UserId FROM Users WHERE Email = '$Email'")->fetch_all(true))[0]["UserId"];
			foreach(($this->db->query("SELECT * FROM Likes WHERE UserId = '$UserId' ORDER BY LikeID DESC")->fetch_all(true)) as $value){
				// var_dump($value);
				array_push($ArrTypeLike, $value["LikeType"]);
				array_push($ArrPriceLike, $value["LikePrice"]);
				array_push($ArrImageLike, $value["LikeImg"]);
			}
			$_SESSION["ArrTypeLike"] = $ArrTypeLike;
			$_SESSION["ArrPriceLike"] = $ArrPriceLike;
			$_SESSION["ArrImageLike"] = $ArrImageLike;
		}
		$ArrTypeCart = [];
		$ArrPriceCart = [];
		$ArrImageCart = [];
		$ArrCountsCart = [];
		$ArrCheckedCart = [];
		foreach(($this->db->query("SELECT * FROM CartItems WHERE UserId = '$UserId' ORDER BY CartID DESC")->fetch_all(true)) as $value){
				array_push($ArrTypeCart, $value["CartType"]);
				array_push($ArrPriceCart, $value["CartPrice"]);
				array_push($ArrImageCart, $value["CartImg"]);
				array_push($ArrCountsCart, $value["Counts"]);
				array_push($ArrCheckedCart, $value["Checked"]);
			}
		$_SESSION["ArrTypeCart"] = $ArrTypeCart;
		$_SESSION["ArrPriceCart"] = $ArrPriceCart;
		$_SESSION["ArrImageCart"] = $ArrImageCart;
		$_SESSION["ArrCountsCart"] = $ArrCountsCart;
		$_SESSION["ArrCheckedCart"] = $ArrCheckedCart;
		$TrueImg = [];
		$TrueImgPrice = [];
		foreach(($this->db->query("SELECT * FROM CartItems WHERE UserId = '$UserId'")->fetch_all(true)) as $value){
				if($value["Checked"] === 'true'){
					array_push($TrueImg, $value["CartImg"]);
					array_push($TrueImgPrice, $value['CartPrice']);
				}
		}
		$_SESSION['TrueImg'] = $TrueImg;
		$_SESSION['TrueImgPrice'] = $TrueImgPrice;
	}
	public function Vznoc(){
		$_SESSION["ArrTypeLike"] = [];
		$_SESSION["ArrPriceLike"] = [];
		$_SESSION["ArrImageLike"] = [];
		$ArrTypeTevnoc = [];
		$ArrPriceTevnoc = [];
		$ArrImageTevnoc = [];
		$ArrCountTevnoc = [];
		$ArrCountForSaleTevnoc = [];
		foreach(($this->db->query("SELECT * FROM JewInfo WHERE Type = 'Վզնոց'")->fetch_all(true)) as $value){
			array_push($ArrTypeTevnoc, $value["Type"]);
			array_push($ArrPriceTevnoc, $value["Price"]);
			array_push($ArrImageTevnoc, $value["Image"]);
			array_push($ArrCountTevnoc, $value["Counts"]);
			array_push($ArrCountForSaleTevnoc, $value["CountForSale"]);
		}
		$_SESSION["ArrTypeTevnoc"] = $ArrTypeTevnoc;
		$_SESSION["ArrPriceTevnoc"] = $ArrPriceTevnoc;
		$_SESSION["ArrImageTevnoc"] = $ArrImageTevnoc;
		$_SESSION["ArrCountTevnoc"] = $ArrCountTevnoc;
		$_SESSION["ArrCountForSaleTevnoc"] = $ArrCountForSaleTevnoc;
		$ArrTypeLike = [];
		$ArrPriceLike = [];
		$ArrImageLike = [];
		if (isset($_SESSION['Email'])) {
			$Email = $_SESSION['Email'];
			$UserId = ($this->db->query("SELECT UserId FROM Users WHERE Email = '$Email'")->fetch_all(true))[0]["UserId"];
			foreach(($this->db->query("SELECT * FROM Likes WHERE UserId = '$UserId' ORDER BY LikeID DESC")->fetch_all(true)) as $value){
				// var_dump($value);
				array_push($ArrTypeLike, $value["LikeType"]);
				array_push($ArrPriceLike, $value["LikePrice"]);
				array_push($ArrImageLike, $value["LikeImg"]);
			}
			$_SESSION["ArrTypeLike"] = $ArrTypeLike;
			$_SESSION["ArrPriceLike"] = $ArrPriceLike;
			$_SESSION["ArrImageLike"] = $ArrImageLike;
		}
		$ArrTypeCart = [];
		$ArrPriceCart = [];
		$ArrImageCart = [];
		$ArrCountsCart = [];
		$ArrCheckedCart = [];
		foreach(($this->db->query("SELECT * FROM CartItems WHERE UserId = '$UserId' ORDER BY CartID DESC")->fetch_all(true)) as $value){
				array_push($ArrTypeCart, $value["CartType"]);
				array_push($ArrPriceCart, $value["CartPrice"]);
				array_push($ArrImageCart, $value["CartImg"]);
				array_push($ArrCountsCart, $value["Counts"]);
				array_push($ArrCheckedCart, $value["Checked"]);
			}
		$_SESSION["ArrTypeCart"] = $ArrTypeCart;
		$_SESSION["ArrPriceCart"] = $ArrPriceCart;
		$_SESSION["ArrImageCart"] = $ArrImageCart;
		$_SESSION["ArrCountsCart"] = $ArrCountsCart;
		$_SESSION["ArrCheckedCart"] = $ArrCheckedCart;
		$TrueImg = [];
		$TrueImgPrice = [];
		foreach(($this->db->query("SELECT * FROM CartItems WHERE UserId = '$UserId'")->fetch_all(true)) as $value){
				if($value["Checked"] === 'true'){
					array_push($TrueImg, $value["CartImg"]);
					array_push($TrueImgPrice, $value['CartPrice']);
				}
		}
		$_SESSION['TrueImg'] = $TrueImg;
		$_SESSION['TrueImgPrice'] = $TrueImgPrice;
	}
	public function Tevnoc(){
		$_SESSION["ArrTypeLike"] = [];
		$_SESSION["ArrPriceLike"] = [];
		$_SESSION["ArrImageLike"] = [];
		$ArrTypeTevnoc = [];
		$ArrPriceTevnoc = [];
		$ArrImageTevnoc = [];
		$ArrCountTevnoc = [];
		$ArrCountForSaleTevnoc = [];
		foreach(($this->db->query("SELECT * FROM JewInfo WHERE Type = 'Թևնոց'")->fetch_all(true)) as $value){
			array_push($ArrTypeTevnoc, $value["Type"]);
			array_push($ArrPriceTevnoc, $value["Price"]);
			array_push($ArrImageTevnoc, $value["Image"]);
			array_push($ArrCountTevnoc, $value["Counts"]);
			array_push($ArrCountForSaleTevnoc, $value["CountForSale"]);
		}
		$_SESSION["ArrTypeTevnoc"] = $ArrTypeTevnoc;
		$_SESSION["ArrPriceTevnoc"] = $ArrPriceTevnoc;
		$_SESSION["ArrImageTevnoc"] = $ArrImageTevnoc;
		$_SESSION["ArrCountTevnoc"] = $ArrCountTevnoc;
		$_SESSION["ArrCountForSaleTevnoc"] = $ArrCountForSaleTevnoc;
		$ArrTypeLike = [];
		$ArrPriceLike = [];
		$ArrImageLike = [];
		if (isset($_SESSION['Email'])) {
			$Email = $_SESSION['Email'];
			$UserId = ($this->db->query("SELECT UserId FROM Users WHERE Email = '$Email'")->fetch_all(true))[0]["UserId"];
			foreach(($this->db->query("SELECT * FROM Likes WHERE UserId = '$UserId' ORDER BY LikeID DESC")->fetch_all(true)) as $value){
				// var_dump($value);
				array_push($ArrTypeLike, $value["LikeType"]);
				array_push($ArrPriceLike, $value["LikePrice"]);
				array_push($ArrImageLike, $value["LikeImg"]);
			}
			$_SESSION["ArrTypeLike"] = $ArrTypeLike;
			$_SESSION["ArrPriceLike"] = $ArrPriceLike;
			$_SESSION["ArrImageLike"] = $ArrImageLike;
		}
		$ArrTypeCart = [];
		$ArrPriceCart = [];
		$ArrImageCart = [];
		$ArrCountsCart = [];
		$ArrCheckedCart = [];
		foreach(($this->db->query("SELECT * FROM CartItems WHERE UserId = '$UserId' ORDER BY CartID DESC")->fetch_all(true)) as $value){
				array_push($ArrTypeCart, $value["CartType"]);
				array_push($ArrPriceCart, $value["CartPrice"]);
				array_push($ArrImageCart, $value["CartImg"]);
				array_push($ArrCountsCart, $value["Counts"]);
				array_push($ArrCheckedCart, $value["Checked"]);
			}
		$_SESSION["ArrTypeCart"] = $ArrTypeCart;
		$_SESSION["ArrPriceCart"] = $ArrPriceCart;
		$_SESSION["ArrImageCart"] = $ArrImageCart;
		$_SESSION["ArrCountsCart"] = $ArrCountsCart;
		$_SESSION["ArrCheckedCart"] = $ArrCheckedCart;
		$TrueImg = [];
		$TrueImgPrice = [];
		foreach(($this->db->query("SELECT * FROM CartItems WHERE UserId = '$UserId'")->fetch_all(true)) as $value){
				if($value["Checked"] === 'true'){
					array_push($TrueImg, $value["CartImg"]);
					array_push($TrueImgPrice, $value['CartPrice']);
				}
		}
		$_SESSION['TrueImg'] = $TrueImg;
		$_SESSION['TrueImgPrice'] = $TrueImgPrice;
	}
	public function LikeOrUnlike(){
		$GetInfoAboutLikedTypeValue = $_POST['GetInfoAboutLikedTypeValue'];
		$GetInfoAboutLikedImgValue = $_POST['GetInfoAboutLikedImgValue'];
		$GetInfoAboutLikedPriceValue = $_POST['GetInfoAboutLikedPriceValue'];
		$GetInfoAboutLikedCountForSaleValue = $_POST['GetInfoAboutLikedCountForSaleValue'];
		$CheckUserValue = $_POST['CheckUserValue'];
		$ArrTypeLike = [];
		$ArrPriceLike = [];
		$ArrImageLike = [];
		$ArrCountForSaleLike = [];
		$UserId = ($this->db->query("SELECT UserId FROM Users WHERE Email = '$CheckUserValue'")->fetch_all(true))[0]["UserId"];
		foreach(($this->db->query("SELECT LikeImg FROM Likes WHERE UserId = '$UserId'")->fetch_all(true)) as $value){
			$lkimg = $value["LikeImg"];
			if($GetInfoAboutLikedImgValue === $value["LikeImg"]){
				echo "Chlikec";
				$_SESSION["ArrTypeLike"] = $ArrTypeLike;
				$_SESSION["ArrPriceLike"] = $ArrPriceLike;
				$_SESSION["ArrImageLike"] = $ArrImageLike;
				$_SESSION["ArrCountForSaleLike"] = $ArrCountForSaleLike;
				$this->db->query("DELETE FROM Likes WHERE UserId = '$UserId' AND LikeImg = '$lkimg'");
				foreach(($this->db->query("SELECT * FROM Likes WHERE UserId = '$UserId' ORDER BY LikeID DESC")->fetch_all(true)) as $value){
					array_push($ArrTypeLike, $value["LikeType"]);
					array_push($ArrPriceLike, $value["LikePrice"]);
					array_push($ArrImageLike, $value["LikeImg"]);
					array_push($ArrCountForSaleLike, $value["CountForSale"]);
				}
				$_SESSION["ArrTypeLike"] = $ArrTypeLike;
				$_SESSION["ArrPriceLike"] = $ArrPriceLike;
				$_SESSION["ArrImageLike"] = $ArrImageLike;
				$_SESSION["ArrCountForSaleLike"] = $ArrCountForSaleLike;
				die();
			}
		}
		$this->db->query("INSERT INTO Likes(UserId, LikeType, LikeImg, LikePrice, CountForSale) VALUES ('$UserId','$GetInfoAboutLikedTypeValue','$GetInfoAboutLikedImgValue', '$GetInfoAboutLikedPriceValue', '$GetInfoAboutLikedCountForSaleValue')");
		echo "Likec";
		foreach(($this->db->query("SELECT * FROM Likes WHERE UserId = '$UserId' ORDER BY LikeID DESC")->fetch_all(true)) as $value){
			array_push($ArrTypeLike, $value["LikeType"]);
			array_push($ArrPriceLike, $value["LikePrice"]);
			array_push($ArrImageLike, $value["LikeImg"]);
			array_push($ArrCountForSaleLike, $value["CountForSale"]);
		}
		$_SESSION["ArrTypeLike"] = $ArrTypeLike;
		$_SESSION["ArrPriceLike"] = $ArrPriceLike;
		$_SESSION["ArrImageLike"] = $ArrImageLike;
		$_SESSION["ArrCountForSaleLike"] = $ArrCountForSaleLike;
	}
	public function SeeAllLikes(){
		if (isset( $_SESSION['Email'])){
			$_SESSION["CheckRegistration"] = "Yes";
			$AllLikesArrTypeLike = [];
			$AllLikesArrPriceLike = [];
			$AllLikesArrImageLike = [];
			$AllLikesArrCountForSaleLike = [];
			$Email = $_SESSION['Email'];
			$UserId = ($this->db->query("SELECT UserId FROM Users WHERE Email = '$Email'")->fetch_all(true))[0]["UserId"];
			foreach(($this->db->query("SELECT * FROM Likes WHERE UserId = '$UserId' ORDER BY LikeID DESC")->fetch_all(true)) as $value){
				array_push($AllLikesArrTypeLike, $value["LikeType"]);
				array_push($AllLikesArrPriceLike, $value["LikePrice"]);
				array_push($AllLikesArrImageLike, $value["LikeImg"]);
				array_push($AllLikesArrCountForSaleLike, $value["CountForSale"]);
			}
			$_SESSION["AllLikesArrTypeLike"] = $AllLikesArrTypeLike;
			$_SESSION["AllLikesArrPriceLike"] = $AllLikesArrPriceLike;
			$_SESSION["AllLikesArrImageLike"] = $AllLikesArrImageLike;
			$_SESSION["AllLikesArrCountForSaleLike"] = $AllLikesArrCountForSaleLike;
		}
		else{
			echo "Grancvac chi";
			$_SESSION["CheckRegistration"] = "No";
		}
			$ArrTypeCart = [];
			$ArrPriceCart = [];
			$ArrImageCart = [];
			$ArrCountsCart = [];
			$ArrCheckedCart = [];
			foreach(($this->db->query("SELECT * FROM CartItems WHERE UserId = '$UserId' ORDER BY CartID DESC")->fetch_all(true)) as $value){
				array_push($ArrTypeCart, $value["CartType"]);
				array_push($ArrPriceCart, $value["CartPrice"]);
				array_push($ArrImageCart, $value["CartImg"]);
				array_push($ArrCountsCart, $value["Counts"]);
				array_push($ArrCheckedCart, $value["Checked"]);
			}
			$_SESSION["ArrTypeCart"] = $ArrTypeCart;
			$_SESSION["ArrPriceCart"] = $ArrPriceCart;
			$_SESSION["ArrImageCart"] = $ArrImageCart;
			$_SESSION["ArrCountsCart"] = $ArrCountsCart;
			$_SESSION["ArrCheckedCart"] = $ArrCheckedCart;
	}
	public function AddToCart(){
		if(isset($_SESSION["Email"])){
			$AddToCartImg = $_POST["AddToCartImg"];
			$AddToCartType  = $_POST["AddToCartType"];
			$AddToCartPrice = $_POST["AddToCartPrice"];
			$AddToCartCountForSale = $_POST["AddToCartCountForSale"];

			$Email = $_SESSION["Email"];
			$ArrTypeCart = [];
			$ArrPriceCart = [];
			$ArrImageCart = [];
			$ArrCountsCart = [];
			$ArrCheckedCart = [];
			$UserId = ($this->db->query("SELECT UserId FROM Users WHERE Email = '$Email'")->fetch_all(true))[0]["UserId"];
			foreach(($this->db->query("SELECT CartImg FROM CartItems WHERE UserId = '$UserId'")->fetch_all(true)) as $value){
				$lkimg = $value["CartImg"];
				if($AddToCartImg === $value["CartImg"]){
					die();
				}
			}
			$this->db->query("INSERT INTO CartItems(UserId, CartType, CartImg, CartPrice, Counts, Checked) VALUES ('$UserId','$AddToCartType','$AddToCartImg', '$AddToCartPrice', '1', 'false')");
			echo "Likec";
			foreach(($this->db->query("SELECT * FROM CartItems WHERE UserId = '$UserId' ORDER BY CartID DESC")->fetch_all(true)) as $value){
				array_push($ArrTypeCart, $value["CartType"]);
				array_push($ArrPriceCart, $value["CartPrice"]);
				array_push($ArrImageCart, $value["CartImg"]);
				array_push($ArrCountsCart, $value["Counts"]);
				array_push($ArrCheckedCart, $value["Checked"]);
			}
			$_SESSION["ArrTypeCart"] = $ArrTypeCart;
			$_SESSION["ArrPriceCart"] = $ArrPriceCart;
			$_SESSION["ArrImageCart"] = $ArrImageCart;
			$_SESSION["ArrCountsCart"] = $ArrCountsCart;
			$_SESSION["ArrCheckedCart"] = $ArrCheckedCart;
			$TrueImg = [];
		$TrueImgPrice = [];
		foreach(($this->db->query("SELECT * FROM CartItems WHERE UserId = '$UserId'")->fetch_all(true)) as $value){
				if($value["Checked"] === 'true'){
					array_push($TrueImg, $value["CartImg"]);
					array_push($TrueImgPrice, $value['CartPrice']);
				}
		}
		$_SESSION['TrueImg'] = $TrueImg;
		$_SESSION['TrueImgPrice'] = $TrueImgPrice;
		}
		else {
			echo "Chgrancvac";
		}
	}
	public function AlreadyLiked(){
		$GetAlreadyLikedImage = $_POST["GetAlreadyLikedImage"];
		$Email = $_SESSION["Email"];
		$UserId = ($this->db->query("SELECT UserId FROM Users WHERE Email = '$Email'")->fetch_all(true))[0]["UserId"];
		$this->db->query("DELETE FROM Likes WHERE UserId = '$UserId' AND LikeImg = '$GetAlreadyLikedImage'");
		$AllLikesArrTypeLike = [];
		$AllLikesArrPriceLike = [];
		$AllLikesArrImageLike = [];
		foreach(($this->db->query("SELECT * FROM Likes WHERE UserId = '$UserId' ORDER BY LikeID DESC")->fetch_all(true)) as $value){
			array_push($AllLikesArrTypeLike, $value["LikeType"]);
			array_push($AllLikesArrPriceLike, $value["LikePrice"]);
			array_push($AllLikesArrImageLike, $value["LikeImg"]);
		}
		$_SESSION["AllLikesArrTypeLike"] = $AllLikesArrTypeLike;
		$_SESSION["AllLikesArrPriceLike"] = $AllLikesArrPriceLike;
		$_SESSION["AllLikesArrImageLike"] = $AllLikesArrImageLike;
	}
	public function FromLikeToCart(){
		$GetAlreadyLikedImageToCart = $_POST["GetAlreadyLikedImageToCart1"];
		$GetAlreadyLikedType = $_POST["GetAlreadyLikedType1"];
		$GetAlreadyLikedPrice = $_POST["GetAlreadyLikedPrice1"];
		$Email = $_SESSION["Email"];
		$UserId = ($this->db->query("SELECT UserId FROM Users WHERE Email = '$Email'")->fetch_all(true))[0]["UserId"];
		$ArrTypeCart = [];
		$ArrPriceCart = [];
		$ArrImageCart = [];
		$ArrCountsCart = [];
		$ArrCheckedCart = [];
		foreach(($this->db->query("SELECT CartImg FROM CartItems WHERE UserId = '$UserId'")->fetch_all(true)) as $value){
				$lkimg = $value["CartImg"];
				if($GetAlreadyLikedImageToCart === $value["CartImg"]){
					$CartCount = ($this->db->query("SELECT Counts FROM CartItems WHERE UserId = '$UserId' AND CartImg = '$lkimg'")->fetch_all(true))[0]["Counts"];
					$CartCount++;
					$this->db->query("UPDATE CartItems SET Counts ='$CartCount' WHERE CartImg = '$GetAlreadyLikedImageToCart' AND UserId = '$UserId'");
					die();
				}
			}
			$this->db->query("INSERT INTO CartItems(UserId, CartType, CartImg, CartPrice, Counts) VALUES ('$UserId','$GetAlreadyLikedType','$GetAlreadyLikedImageToCart', '$GetAlreadyLikedPrice', '1')");
			echo "Likec";
			foreach(($this->db->query("SELECT * FROM CartItems WHERE UserId = '$UserId' ORDER BY CartID DESC")->fetch_all(true)) as $value){
				array_push($ArrTypeCart, $value["CartType"]);
				array_push($ArrPriceCart, $value["CartPrice"]);
				array_push($ArrImageCart, $value["CartImg"]);
				array_push($ArrCountsCart, $value["Counts"]);
				array_push($ArrCheckedCart, $value["Checked"]);
			}
			$_SESSION["ArrTypeCart"] = $ArrTypeCart;
			$_SESSION["ArrPriceCart"] = $ArrPriceCart;
			$_SESSION["ArrImageCart"] = $ArrImageCart;
			$_SESSION["ArrCountsCart"] = $ArrCountsCart;
			$_SESSION["ArrCheckedCart"] = $ArrCheckedCart;
			$TrueImg = [];
		$TrueImgPrice = [];
		foreach(($this->db->query("SELECT * FROM CartItems WHERE UserId = '$UserId'")->fetch_all(true)) as $value){
				if($value["Checked"] === 'true'){
					array_push($TrueImg, $value["CartImg"]);
					array_push($TrueImgPrice, $value['CartPrice']);
				}
		}
		$_SESSION['TrueImg'] = $TrueImg;
		$_SESSION['TrueImgPrice'] = $TrueImgPrice;

	}
	public function SeeAllCartItems(){
		$ArrTypeCart = [];
		$ArrPriceCart = [];
		$ArrImageCart = [];
		$ArrCountsCart = [];
		$ArrCheckedCart = [];
		$Email = $_SESSION["Email"];
		$UserId = ($this->db->query("SELECT UserId FROM Users WHERE Email = '$Email'")->fetch_all(true))[0]["UserId"];
		foreach(($this->db->query("SELECT * FROM CartItems WHERE UserId = '$UserId' ORDER BY CartID DESC")->fetch_all(true)) as $value){
			array_push($ArrTypeCart, $value["CartType"]);
			array_push($ArrPriceCart, $value["CartPrice"]);
			array_push($ArrImageCart, $value["CartImg"]);
			array_push($ArrCountsCart, $value["Counts"]);
			array_push($ArrCheckedCart, $value["Checked"]);
		}
		$_SESSION["ArrTypeCart"] = $ArrTypeCart;
		$_SESSION["ArrPriceCart"] = $ArrPriceCart;
		$_SESSION["ArrImageCart"] = $ArrImageCart;
		$_SESSION["ArrCountsCart"] = $ArrCountsCart;
		$_SESSION["ArrCheckedCart"] = $ArrCheckedCart;
		$TrueImg = [];
		$TrueImgPrice = [];
		foreach(($this->db->query("SELECT * FROM CartItems WHERE UserId = '$UserId'")->fetch_all(true)) as $value){
				if($value["Checked"] === 'true'){
					array_push($TrueImg, $value["CartImg"]);
					array_push($TrueImgPrice, $value['CartPrice']);
				}
		}
		$_SESSION['TrueImg'] = $TrueImg;
		$_SESSION['TrueImgPrice'] = $TrueImgPrice;

	}
	public function AddCartCounts(){
		$GetAlreadyCartImageForOne = $_POST["GetAlreadyCartImageForOne"];
		$GetAlreadyCartCountsForOne = $_POST["GetAlreadyCartCountsForOne"];
		$Email = $_SESSION["Email"];
		$UserId = ($this->db->query("SELECT UserId FROM Users WHERE Email = '$Email'")->fetch_all(true))[0]["UserId"];
		$CheckOrignalCounts = ($this->db->query("SELECT Counts FROM JewInfo WHERE Image ='$GetAlreadyCartImageForOne'")->fetch_all(true))[0]["Counts"];
		$CheckOrignalPrice = ($this->db->query("SELECT Price FROM JewInfo  WHERE Image ='$GetAlreadyCartImageForOne'")->fetch_all(true))[0]["Price"];
		if($GetAlreadyCartCountsForOne <= $CheckOrignalCounts){
			$GetAlreadyCartCountsForOne++;
			$UpdateForPrice = ($GetAlreadyCartCountsForOne * $CheckOrignalPrice);
			// echo $GetAlreadyCartCountsForOne;
			echo $UpdateForPrice;
			$this->db->query("UPDATE CartItems SET CartPrice='$UpdateForPrice',Counts='$GetAlreadyCartCountsForOne' WHERE UserId='$UserId' AND CartImg='$GetAlreadyCartImageForOne'");
		}
		$ArrTypeCart = [];
		$ArrPriceCart = [];
		$ArrImageCart = [];
		$ArrCountsCart = [];
		$ArrCheckedCart = [];
		foreach(($this->db->query("SELECT * FROM CartItems WHERE UserId = '$UserId' ORDER BY CartID DESC")->fetch_all(true)) as $value){
				array_push($ArrTypeCart, $value["CartType"]);
				array_push($ArrPriceCart, $value["CartPrice"]);
				array_push($ArrImageCart, $value["CartImg"]);
				array_push($ArrCountsCart, $value["Counts"]);
				array_push($ArrCheckedCart, $value["Checked"]);
			}
		$_SESSION["ArrTypeCart"] = $ArrTypeCart;
		$_SESSION["ArrPriceCart"] = $ArrPriceCart;
		$_SESSION["ArrImageCart"] = $ArrImageCart;
		$_SESSION["ArrCountsCart"] = $ArrCountsCart;
		$_SESSION["ArrCheckedCart"] = $ArrCheckedCart;
		$TrueImg = [];
		$TrueImgPrice = [];
		foreach(($this->db->query("SELECT * FROM CartItems WHERE UserId = '$UserId'")->fetch_all(true)) as $value){
				if($value["Checked"] === 'true'){
					array_push($TrueImg, $value["CartImg"]);
					array_push($TrueImgPrice, $value['CartPrice']);
				}
		}
		$_SESSION['TrueImg'] = $TrueImg;
		$_SESSION['TrueImgPrice'] = $TrueImgPrice;
	}
	public function RemoveCartCounts(){
		$GetAlreadyCartImageForOne = $_POST["GetAlreadyCartImageForOne"];
		$GetAlreadyCartCountsForOne = $_POST["GetAlreadyCartCountsForOne"];
		$Email = $_SESSION["Email"];
		$UserId = ($this->db->query("SELECT UserId FROM Users WHERE Email = '$Email'")->fetch_all(true))[0]["UserId"];
		$CheckOrignalCounts = ($this->db->query("SELECT Counts FROM JewInfo WHERE Image ='$GetAlreadyCartImageForOne'")->fetch_all(true))[0]["Counts"];
		$CheckOrignalPrice = ($this->db->query("SELECT Price FROM JewInfo  WHERE Image ='$GetAlreadyCartImageForOne'")->fetch_all(true))[0]["Price"];
		if($GetAlreadyCartCountsForOne > 1){
			$GetAlreadyCartCountsForOne--;
			$UpdateForPrice = ($GetAlreadyCartCountsForOne * $CheckOrignalPrice);
			echo $UpdateForPrice;
			$this->db->query("UPDATE CartItems SET CartPrice='$UpdateForPrice',Counts='$GetAlreadyCartCountsForOne' WHERE UserId='$UserId' AND CartImg='$GetAlreadyCartImageForOne'");
		}
		$ArrTypeCart = [];
		$ArrPriceCart = [];
		$ArrImageCart = [];
		$ArrCountsCart = [];
		$ArrCheckedCart = [];
		foreach(($this->db->query("SELECT * FROM CartItems WHERE UserId = '$UserId'")->fetch_all(true)) as $value){
				array_push($ArrTypeCart, $value["CartType"]);
				array_push($ArrPriceCart, $value["CartPrice"]);
				array_push($ArrImageCart, $value["CartImg"]);
				array_push($ArrCountsCart, $value["Counts"]);
				array_push($ArrCheckedCart, $value["Checked"]);
			}
		$_SESSION["ArrTypeCart"] = $ArrTypeCart;
		$_SESSION["ArrPriceCart"] = $ArrPriceCart;
		$_SESSION["ArrImageCart"] = $ArrImageCart;
		$_SESSION["ArrCountsCart"] = $ArrCountsCart;
		$_SESSION["ArrCheckedCart"] = $ArrCheckedCart;
		$TrueImg = [];
		$TrueImgPrice = [];
		foreach(($this->db->query("SELECT * FROM CartItems WHERE UserId = '$UserId'")->fetch_all(true)) as $value){
				if($value["Checked"] === 'true'){
					array_push($TrueImg, $value["CartImg"]);
					array_push($TrueImgPrice, $value['CartPrice']);
				}
		}
		$_SESSION['TrueImg'] = $TrueImg;
		$_SESSION['TrueImgPrice'] = $TrueImgPrice;
	}
	public function RemoveFromCartFromCart(){
		$GetAlreadyCartImageForOne = $_POST["GetAlreadyCartImageForOne"];
		$Email = $_SESSION["Email"];
		$UserId = ($this->db->query("SELECT UserId FROM Users WHERE Email = '$Email'")->fetch_all(true))[0]["UserId"];
		$this->db->query("DELETE FROM CartItems WHERE UserId = '$UserId' AND CartImg = '$GetAlreadyCartImageForOne'");
		$ArrTypeCart = [];
		$ArrPriceCart = [];
		$ArrImageCart = [];
		$ArrCountsCart = [];
		$ArrCheckedCart = [];
		foreach(($this->db->query("SELECT * FROM CartItems WHERE UserId = '$UserId'")->fetch_all(true)) as $value){
				array_push($ArrTypeCart, $value["CartType"]);
				array_push($ArrPriceCart, $value["CartPrice"]);
				array_push($ArrImageCart, $value["CartImg"]);
				array_push($ArrCountsCart, $value["Counts"]);
				array_push($ArrCheckedCart, $value["Checked"]);
			}
		$_SESSION["ArrTypeCart"] = $ArrTypeCart;
		$_SESSION["ArrPriceCart"] = $ArrPriceCart;
		$_SESSION["ArrImageCart"] = $ArrImageCart;
		$_SESSION["ArrCountsCart"] = $ArrCountsCart;
		$_SESSION["ArrCheckedCart"] = $ArrCheckedCart;
		$TrueImg = [];
		$TrueImgPrice = [];
		foreach(($this->db->query("SELECT * FROM CartItems WHERE UserId = '$UserId'")->fetch_all(true)) as $value){
				if($value["Checked"] === 'true'){
					array_push($TrueImg, $value["CartImg"]);
					array_push($TrueImgPrice, $value['CartPrice']);
				}
		}
		$_SESSION['TrueImg'] = $TrueImg;
		$_SESSION['TrueImgPrice'] = $TrueImgPrice;
	}
	public function TrueOrFalse(){
		$TrueOrFalse = $_POST["TrueOrFalse"];
		$GetAlreadyCartImageForOne = $_POST["GetAlreadyCartImageForOne"];
		$Email = $_SESSION["Email"];
		$TrueImg = [];
		$TrueImgPrice = [];
		$UserId = ($this->db->query("SELECT UserId FROM Users WHERE Email = '$Email'")->fetch_all(true))[0]["UserId"];
		$this->db->query("UPDATE CartItems SET Checked ='$TrueOrFalse' WHERE UserId='$UserId' AND CartImg='$GetAlreadyCartImageForOne'");
		foreach(($this->db->query("SELECT * FROM CartItems WHERE UserId = '$UserId'")->fetch_all(true)) as $value){
				if($value["Checked"] === 'true'){
					array_push($TrueImg, $value["CartImg"]);
					array_push($TrueImgPrice, $value['CartPrice']);
				}
		}
		$_SESSION['TrueImg'] = $TrueImg;
		$_SESSION['TrueImgPrice'] = $TrueImgPrice;
	}
	public function TrueOrFalseTrue(){
		$TrueOrFalse = $_POST["TrueOrFalse"];
		$_SESSION['TrueOrFalse']=$TrueOrFalse;
		$Email = $_SESSION["Email"];
		$UserId = ($this->db->query("SELECT UserId FROM Users WHERE Email = '$Email'")->fetch_all(true))[0]["UserId"];
		$this->db->query("UPDATE CartItems SET Checked ='$TrueOrFalse' WHERE UserId='$UserId'");
		$TrueImg = [];
		$TrueImgPrice = [];
		foreach(($this->db->query("SELECT * FROM CartItems WHERE UserId = '$UserId'")->fetch_all(true)) as $value){
				if($value["Checked"] === 'true'){
					array_push($TrueImg, $value["CartImg"]);
					array_push($TrueImgPrice, $value['CartPrice']);
				}
		}
		$_SESSION['TrueImg'] = $TrueImg;
		$_SESSION['TrueImgPrice'] = $TrueImgPrice;
	}
	public function BuyNow(){
		$TrueImg = [];
		$TrueImgPrice = [];
		$TrueImgType = [];
		$TrueImgCounts = [];
		$Email = $_SESSION["Email"];
		$UserId = ($this->db->query("SELECT UserId FROM Users WHERE Email = '$Email'")->fetch_all(true))[0]["UserId"];
		foreach(($this->db->query("SELECT * FROM CartItems WHERE UserId = '$UserId'")->fetch_all(true)) as $value){
				if($value["Checked"] === 'true'){
					array_push($TrueImg, $value["CartImg"]);
					array_push($TrueImgPrice, $value['CartPrice']);
					array_push($TrueImgType, $value['CartType']);
					array_push($TrueImgCounts, $value['Counts']);
				}
		}
		$_SESSION['TrueImg'] = $TrueImg;
		$_SESSION['TrueImgPrice'] = $TrueImgPrice;
		$_SESSION['TrueImgType'] = $TrueImgType;
		$_SESSION['TrueImgCounts'] = $TrueImgCounts;
		$_SESSION["BuyNowPrice"]=$_POST["BuyNowPrice"];
	}
	public function LowToHighForAkanjox(){
		if($_POST['Type']==="LowToHigh"){
			$_SESSION["ArrTypeLike"] = [];
			$_SESSION["ArrPriceLike"] = [];
			$_SESSION["ArrImageLike"] = [];
			$ArrTypeTevnoc = [];
			$ArrPriceTevnoc = [];
			$ArrImageTevnoc = [];
			$ArrCountTevnoc = [];
			foreach(($this->db->query("SELECT * FROM JewInfo WHERE Type = 'Ականջօղ' ORDER BY Price ASC ")->fetch_all(true)) as $value){
				array_push($ArrTypeTevnoc, $value["Type"]);
				array_push($ArrPriceTevnoc, $value["Price"]);
				array_push($ArrImageTevnoc, $value["Image"]);
				array_push($ArrCountTevnoc, $value["Counts"]);
			}
			$_SESSION["ArrTypeTevnoc"] = $ArrTypeTevnoc;
			$_SESSION["ArrPriceTevnoc"] = $ArrPriceTevnoc;
			$_SESSION["ArrImageTevnoc"] = $ArrImageTevnoc;
			$_SESSION["ArrCountTevnoc"] = $ArrCountTevnoc;
		}
		elseif($_POST['Type']==='HighToLow'){
			$_SESSION["ArrTypeLike"] = [];
			$_SESSION["ArrPriceLike"] = [];
			$_SESSION["ArrImageLike"] = [];
			$ArrTypeTevnoc = [];
			$ArrPriceTevnoc = [];
			$ArrImageTevnoc = [];
			$ArrCountTevnoc = [];
			foreach(($this->db->query("SELECT * FROM JewInfo WHERE Type = 'Ականջօղ' ORDER BY Price DESC ")->fetch_all(true)) as $value){
				array_push($ArrTypeTevnoc, $value["Type"]);
				array_push($ArrPriceTevnoc, $value["Price"]);
				array_push($ArrImageTevnoc, $value["Image"]);
				array_push($ArrCountTevnoc, $value["Counts"]);
			}
			$_SESSION["ArrTypeTevnoc"] = $ArrTypeTevnoc;
			$_SESSION["ArrPriceTevnoc"] = $ArrPriceTevnoc;
			$_SESSION["ArrImageTevnoc"] = $ArrImageTevnoc;
			$_SESSION["ArrCountTevnoc"] = $ArrCountTevnoc;
		}
	}
	public function LowToHighForVznoc(){
		if($_POST['Type']==="LowToHigh"){
			$_SESSION["ArrTypeLike"] = [];
			$_SESSION["ArrPriceLike"] = [];
			$_SESSION["ArrImageLike"] = [];
			$ArrTypeTevnoc = [];
			$ArrPriceTevnoc = [];
			$ArrImageTevnoc = [];
			$ArrCountTevnoc = [];
			foreach(($this->db->query("SELECT * FROM JewInfo WHERE Type = 'Վզնոց' ORDER BY Price ASC ")->fetch_all(true)) as $value){
				array_push($ArrTypeTevnoc, $value["Type"]);
				array_push($ArrPriceTevnoc, $value["Price"]);
				array_push($ArrImageTevnoc, $value["Image"]);
				array_push($ArrCountTevnoc, $value["Counts"]);
			}
			$_SESSION["ArrTypeTevnoc"] = $ArrTypeTevnoc;
			$_SESSION["ArrPriceTevnoc"] = $ArrPriceTevnoc;
			$_SESSION["ArrImageTevnoc"] = $ArrImageTevnoc;
			$_SESSION["ArrCountTevnoc"] = $ArrCountTevnoc;
		}
		elseif($_POST['Type']==='HighToLow'){
			$_SESSION["ArrTypeLike"] = [];
			$_SESSION["ArrPriceLike"] = [];
			$_SESSION["ArrImageLike"] = [];
			$ArrTypeTevnoc = [];
			$ArrPriceTevnoc = [];
			$ArrImageTevnoc = [];
			$ArrCountTevnoc = [];
			foreach(($this->db->query("SELECT * FROM JewInfo WHERE Type = 'Վզնոց' ORDER BY Price DESC ")->fetch_all(true)) as $value){
				array_push($ArrTypeTevnoc, $value["Type"]);
				array_push($ArrPriceTevnoc, $value["Price"]);
				array_push($ArrImageTevnoc, $value["Image"]);
				array_push($ArrCountTevnoc, $value["Counts"]);
			}
			$_SESSION["ArrTypeTevnoc"] = $ArrTypeTevnoc;
			$_SESSION["ArrPriceTevnoc"] = $ArrPriceTevnoc;
			$_SESSION["ArrImageTevnoc"] = $ArrImageTevnoc;
			$_SESSION["ArrCountTevnoc"] = $ArrCountTevnoc;
		}
	}
	public function LowToHighForMatani(){
		if($_POST['Type']==="LowToHigh"){
			$_SESSION["ArrTypeLike"] = [];
			$_SESSION["ArrPriceLike"] = [];
			$_SESSION["ArrImageLike"] = [];
			$ArrTypeTevnoc = [];
			$ArrPriceTevnoc = [];
			$ArrImageTevnoc = [];
			$ArrCountTevnoc = [];
			foreach(($this->db->query("SELECT * FROM JewInfo WHERE Type = 'Մատանաի' ORDER BY Price ASC ")->fetch_all(true)) as $value){
				array_push($ArrTypeTevnoc, $value["Type"]);
				array_push($ArrPriceTevnoc, $value["Price"]);
				array_push($ArrImageTevnoc, $value["Image"]);
				array_push($ArrCountTevnoc, $value["Counts"]);
			}
			$_SESSION["ArrTypeTevnoc"] = $ArrTypeTevnoc;
			$_SESSION["ArrPriceTevnoc"] = $ArrPriceTevnoc;
			$_SESSION["ArrImageTevnoc"] = $ArrImageTevnoc;
			$_SESSION["ArrCountTevnoc"] = $ArrCountTevnoc;
		}
		elseif($_POST['Type']==='HighToLow'){
			$_SESSION["ArrTypeLike"] = [];
			$_SESSION["ArrPriceLike"] = [];
			$_SESSION["ArrImageLike"] = [];
			$ArrTypeTevnoc = [];
			$ArrPriceTevnoc = [];
			$ArrImageTevnoc = [];
			$ArrCountTevnoc = [];
			foreach(($this->db->query("SELECT * FROM JewInfo WHERE Type = 'Մատանաի' ORDER BY Price DESC ")->fetch_all(true)) as $value){
				array_push($ArrTypeTevnoc, $value["Type"]);
				array_push($ArrPriceTevnoc, $value["Price"]);
				array_push($ArrImageTevnoc, $value["Image"]);
				array_push($ArrCountTevnoc, $value["Counts"]);
			}
			$_SESSION["ArrTypeTevnoc"] = $ArrTypeTevnoc;
			$_SESSION["ArrPriceTevnoc"] = $ArrPriceTevnoc;
			$_SESSION["ArrImageTevnoc"] = $ArrImageTevnoc;
			$_SESSION["ArrCountTevnoc"] = $ArrCountTevnoc;
		}
	}
	public function LowToHighForTevnoc(){
		if($_POST['Type']==="LowToHigh"){
			$_SESSION["ArrTypeLike"] = [];
			$_SESSION["ArrPriceLike"] = [];
			$_SESSION["ArrImageLike"] = [];
			$ArrTypeTevnoc = [];
			$ArrPriceTevnoc = [];
			$ArrImageTevnoc = [];
			$ArrCountTevnoc = [];
			foreach(($this->db->query("SELECT * FROM JewInfo WHERE Type = 'Թևնոց' ORDER BY Price ASC ")->fetch_all(true)) as $value){
				array_push($ArrTypeTevnoc, $value["Type"]);
				array_push($ArrPriceTevnoc, $value["Price"]);
				array_push($ArrImageTevnoc, $value["Image"]);
				array_push($ArrCountTevnoc, $value["Counts"]);
			}
			$_SESSION["ArrTypeTevnoc"] = $ArrTypeTevnoc;
			$_SESSION["ArrPriceTevnoc"] = $ArrPriceTevnoc;
			$_SESSION["ArrImageTevnoc"] = $ArrImageTevnoc;
			$_SESSION["ArrCountTevnoc"] = $ArrCountTevnoc;
		}
		elseif($_POST['Type']==='HighToLow'){
			$_SESSION["ArrTypeLike"] = [];
			$_SESSION["ArrPriceLike"] = [];
			$_SESSION["ArrImageLike"] = [];
			$ArrTypeTevnoc = [];
			$ArrPriceTevnoc = [];
			$ArrImageTevnoc = [];
			$ArrCountTevnoc = [];
			foreach(($this->db->query("SELECT * FROM JewInfo WHERE Type = 'Թևնոց' ORDER BY Price DESC ")->fetch_all(true)) as $value){
				array_push($ArrTypeTevnoc, $value["Type"]);
				array_push($ArrPriceTevnoc, $value["Price"]);
				array_push($ArrImageTevnoc, $value["Image"]);
				array_push($ArrCountTevnoc, $value["Counts"]);
			}
			$_SESSION["ArrTypeTevnoc"] = $ArrTypeTevnoc;
			$_SESSION["ArrPriceTevnoc"] = $ArrPriceTevnoc;
			$_SESSION["ArrImageTevnoc"] = $ArrImageTevnoc;
			$_SESSION["ArrCountTevnoc"] = $ArrCountTevnoc;
		}
	}
	public function SeeImgInfo(){
		$_SESSION["SeeInfoAboutImage"] = $_POST['GetInfoAboutLikedImgValue'];
		$img = $_POST['GetInfoAboutLikedImgValue'];
		$_SESSION["SeeInfoAboutType"] =( $this->db->query("SELECT Type FROM JewInfo WHERE Image = '$img'")->fetch_all(true))[0]["Type"];
		$_SESSION["SeeInfoAboutPrice"] = ($this->db->query("SELECT Price FROM JewInfo WHERE Image = '$img'")->fetch_all(true))[0]["Price"];
		$_SESSION["SeeInfoAboutCoutnForSale"] = ($this->db->query("SELECT Counts FROM JewInfo WHERE Image = '$img'")->fetch_all(true))[0]["Counts"];
	}
	public function Orders(){
		// $City = $_POST["City"];
		// $Address = $_POST['Address'];
		// $Post = $_POST["Post"];
		// $Email = $_SESSION["Email"];
		// $UserId = ($this->db->query("SELECT UserId FROM Users WHERE Email = '$Email'")->fetch_all(true))[0]["UserId"];
		// $Image = [];
		// $Type = [];
		// $Price = [];
		// $Count = [];
		// foreach(($this->db->query("SELECT * FROM CartItems WHERE Checked = 'true' AND UserId ='$UserId'")->fetch_all(true)) as $value){
		// 	array_push($Image, $value["CartImg"]);
		// 	array_push($Type, $value["CartType"]);
		// 	array_push($Price, $value["CartPrice"]);
		// 	array_push($Count, $value["Counts"]);
		// };
		// for($i=0;$i<count($Image),$i++){
		// 	$this->db->query("INSERT INTO Orders(UserId, City, Address, Post, Img, Type, Price, Counts) VALUES ('$UserId','$City', '$Address', '$Post',$Image[$i],$Type[$i],$Price[$i],$Count[$i])");
		// }
		echo "VA";
	}
}
$obj = new Model;

?>