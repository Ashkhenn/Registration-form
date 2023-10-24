 $("#RegistrationForm").on("submit", function(e){
	e.preventDefault();
	let FirstName = $("#FirstName").val();
	let LastName = $("#LastName").val();
	let Email = $("#Email").val();
	let Password1 = $("#Password1").val();
	let Password2 = $("#Password2").val();
	let regexp = /^[a-zA-Z0-9\s]+$/;
	if(regexp.test(FirstName) || regexp.test(LastName)){
		if(Password1 === Password2){
			$.ajax({
				url: "SignInServer.php",
				method: "post",
				dataType: "html",
    			data: {FirstName:FirstName,LastName:LastName,Email:Email, Password:Password1, action:"Registration"},
    			success:function(r){
    				if(r === "Այս Էլ․ Հասցեն արդեն օգտագործվել է"){
    					$("#Error").html(r);
    				}
    				else{
    					window.location.href = "index.php";
    				}
    			}
			})
		}
		else{
			$("#Error").html("Գաղտնաբառերը չեն համապատասխանում");
		}
	}
	else if(FirstName === "" || LastName === ""){
		$("#Error").html("Լրացրե՛ք բոլոր դաշտերը");
	}
	else{
		$("#Error").html("Դուք կարող եք օգտագործել միայն թվեր և լատիներեն տառեր");
	}
})

$("#LogIn").on("submit", function(e){
	e.preventDefault();
	let EmailForLogIn = $("#EmailForLogIn").val();
	let PasswordForLogIn = $("#PasswordForLogIn").val();
	$.ajax({
		url: "SignInServer.php",
		method: "post",
		dataType: "html",
		data: {EmailForLogIn: EmailForLogIn, PasswordForLogIn:PasswordForLogIn, action: "LogIn"},
		success:function(r){
			console.log(r);
			if(r === "Incorrect password or email"){
				$("#Error").html("Սխալ էլ․ Հասցե կամ և գաղտնաբառ"); 
			}
			else if(r === "Correct password and email"){
				window.location.href = "index.php";
			}
			else{
				$("#Error").html("Լրացրեք բոլոր դաշտերը");
			}
		}
	})
})
$("#LogOut").on("click", function(){
	$.ajax({
		url: "SignInServer.php",
		method: "post",
		dataType: "html",
		data: {action: "LogOut"},
		success:function(r){
			window.location.href = "index.php";
		}
	})
})
$("#LogOutForAdmin").on("click", function(){
	$.ajax({
		url: "SignInServer.php",
		method: "post",
		dataType: "html",
		data: {action: "LogOut"},
		success:function(r){
			window.location.href = "index.php";
		}
	})
})
let DeletAdmin = document.getElementsByClassName("DeletAdmin");
let AdminImgSrc = document.getElementsByClassName("AdminImgSrc");
for(let i = 0; i < DeletAdmin.length; i++){
	DeletAdmin[i].addEventListener("click", function(){
		let AdminImgSrcDelete = AdminImgSrc[i].value;
		// console.log(AdminImgSrcDelete);
		$.ajax({
			url: "SignInServer.php",
			method: "post",
			dataType: "html",
			data: {AdminImgSrcDelete: AdminImgSrcDelete, action: "DeletImageFromAdmin"},
			success: function(r){
				location.reload();
				// console.log(r);
			}
		})
	})
}
let ChangeAdmin = document.getElementsByClassName("ChangeAdmin");
let GetTypeForChange = document.getElementsByClassName("GetTypeForChange");
let GetPriceForChange = document.getElementsByClassName("GetPriceForChange");
let GetCountsForChange = document.getElementsByClassName("GetCountsForChange");
let GetCountsForSaleForChange = document.getElementsByClassName("GetCountsForSaleForChange");
for(let i = 0; i < ChangeAdmin.length; i++){
	ChangeAdmin[i].addEventListener("click", function(){
		let AdminImgSrcChange = AdminImgSrc[i].value;
		let GetTypeForChangeForOne = GetTypeForChange[i].value;
		let GetPriceForChangeForOne = GetPriceForChange[i].value;
		let GetCountForChangeForOne = GetCountsForChange[i].value;
		let GetCountForSaleForChangeForOne = GetCountsForSaleForChange[i].value;
		$.ajax({
			url: "SignInServer.php",
			method: "post",
			dataType: "html",
			data: {GetCountForSaleForChangeForOne:GetCountForSaleForChangeForOne,GetCountForChangeForOne: GetCountForChangeForOne, AdminImgSrcChange: AdminImgSrcChange, GetTypeForChangeForOne:GetTypeForChangeForOne, GetPriceForChangeForOne:GetPriceForChangeForOne, action: "ChangeInfoForAdmin"},
			success:function(r){
				location.reload();
			}
		})

	})
}
let CheckUser = document.getElementById("CheckUser");
let LikeOrUnlike = document.getElementsByClassName("LikeOrUnlike");
let LikeOrUnlike1 = document.getElementsByClassName("LikeOrUnlike1");
let GetInfoAboutLikedImg = document.getElementsByClassName("GetInfoAboutLikedImg");
let GetInfoAboutLikedType = document.getElementsByClassName("GetInfoAboutLikedType");
let GetInfoAboutLikedPrice = document.getElementsByClassName("GetInfoAboutLikedPrice");
let GetInfoAboutLikedCountForSale = document.getElementsByClassName("GetInfoAboutLikedCountForSale");
for(let i = 0; i < LikeOrUnlike.length; i++){
	LikeOrUnlike[i].addEventListener("click", function(){
		let CheckUserValue = CheckUser.value;
		let GetInfoAboutLikedImgValue = GetInfoAboutLikedImg[i].value;
		let GetInfoAboutLikedTypeValue = GetInfoAboutLikedType[i].value;
		let GetInfoAboutLikedPriceValue = GetInfoAboutLikedPrice[i].value;
		let GetInfoAboutLikedCountForSaleValue = GetInfoAboutLikedCountForSale[i].value;
		if(CheckUserValue === "Chgrancvac"){
			alert("Մուտք գործեք ձեր էջ, որպեսզի կարողանաք հավանել կամ ավելացնել զամբյուղում ձեր նախընտրած զարդը");
		}
		else{
			// console.log(CheckUserValue);
			$.ajax({
				url: "SignInServer.php",
				method: "post",
				dataType: "html",
				data: {GetInfoAboutLikedCountForSaleValue:GetInfoAboutLikedCountForSaleValue, CheckUserValue:CheckUserValue, GetInfoAboutLikedTypeValue:GetInfoAboutLikedTypeValue, GetInfoAboutLikedImgValue: GetInfoAboutLikedImgValue, GetInfoAboutLikedPriceValue:GetInfoAboutLikedPriceValue, action: "LikeOrUnlike"},
				success:function(r){
					if(r === "Chlikec"){
						LikeOrUnlike[i].src = "img/Unlike.png";
					}
					else if(r === "Likec"){
						LikeOrUnlike[i].src = "img/Like.png";
					}
					else{
						console.log(r);
					}
				}
			})
		}	
	})
}
for(let i=0; i<LikeOrUnlike1.length; i++){
LikeOrUnlike1[i].addEventListener("click", function(){
		let CheckUserValue = CheckUser.value;
		let GetInfoAboutLikedImgValue = GetInfoAboutLikedImg[i].value;
		let GetInfoAboutLikedTypeValue = GetInfoAboutLikedType[i].value;
		let GetInfoAboutLikedPriceValue = GetInfoAboutLikedPrice[i].value;
		let GetInfoAboutLikedCountForSaleValue = GetInfoAboutLikedCountForSale[i].value;
		if(CheckUserValue === "Chgrancvac"){
			alert("Մուտք գործեք ձեր էջ, որպեսզի կարողանաք հավանել կամ ավելացնել զամբյուղում ձեր նախընտրած զարդը");
		}
		else{
			$.ajax({
				url: "SignInServer.php",
				method: "post",
				dataType: "html",
				data: {GetInfoAboutLikedCountForSaleValue:GetInfoAboutLikedCountForSaleValue, CheckUserValue:CheckUserValue, GetInfoAboutLikedTypeValue:GetInfoAboutLikedTypeValue, GetInfoAboutLikedImgValue: GetInfoAboutLikedImgValue, GetInfoAboutLikedPriceValue:GetInfoAboutLikedPriceValue, action: "LikeOrUnlike"},
				success:function(r){
					if(r === "Chlikec"){
						LikeOrUnlike1[i].src = "img/Unlike1.png";
					}
					else if(r === "Likec"){
						LikeOrUnlike1[i].src = "img/Like1.png";
					}
					else{
						console.log(r);
					}
				}
			})
		}	
	})
}
$("#SeeAllLikes").on("click", function(){
	$.ajax({
		url: "SignInServer.php",
		method: "post",
		dataType: "html",
		data: {action:"SeeAllLikes"},
		success:function(r){
			window.location.href = "AllLikes.php";
		}
	})
})
let LikeOrUnlikeInLike = document.getElementsByClassName("LikeOrUnlikeInLike");
let GetAlreadyLikedImage = document.getElementsByClassName("GetAlreadyLikedImage");
for(let i = 0; i < LikeOrUnlikeInLike.length; i++){
	LikeOrUnlikeInLike[i].addEventListener("click", function(){
		let GetAlreadyLikedImage1 = GetAlreadyLikedImage[i].value;
		$.ajax({
			url: "SignInServer.php",
			method: "post",
			dataType: "html",
			data: {GetAlreadyLikedImage: GetAlreadyLikedImage1, action: "AlreadyLiked"},
			success:function(r){
				location.reload();
			}
		})
	})
}
let AddToCart = document.getElementsByClassName("AddToCart");
for(let i = 0; i < AddToCart.length; i++){
	AddToCart[i].addEventListener("click", function(){
		let AddToCartImg = GetInfoAboutLikedImg[i].value;
		let AddToCartType = GetInfoAboutLikedType[i].value;
		let AddToCartPrice = GetInfoAboutLikedPrice[i].value;
		$.ajax({
			url: "SignInServer.php",
			method: "post",
			dataType: "html",
			data: {AddToCartImg:AddToCartImg, AddToCartType:AddToCartType, AddToCartPrice:AddToCartPrice, action:"AddToCart"},
			success:function(r){
				if(r==="Chgrancvac"){
					alert("Մուտք գործեք ձեր էջ, որպեսզի կարողանաք հավանել կամ ավելացնել զամբյուղում ձեր նախընտրած զարդը");
				}
				else{
					location.reload();
				}
			}
		})
	})
}
let AddToCartFromLikes = document.getElementsByClassName("AddToCartFromLikes");
let GetAlreadyLikedType = document.getElementsByClassName("GetAlreadyLikedType");
let GetAlreadyLikedPrice = document.getElementsByClassName("GetAlreadyLikedPrice");
for(let i = 0; i<AddToCartFromLikes.length;i++){
	AddToCartFromLikes[i].addEventListener("click", function(){
		let GetAlreadyLikedImage1 = GetAlreadyLikedImage[i].value;
		let GetAlreadyLikedType1 = GetAlreadyLikedType[i].value;
		let GetAlreadyLikedPrice1 = GetAlreadyLikedPrice[i].value;
		$.ajax({
			url: "SignInServer.php",
			method: "post",
			dataType: "html",
			data: {GetAlreadyLikedImageToCart1: GetAlreadyLikedImage1, GetAlreadyLikedType1:GetAlreadyLikedType1, GetAlreadyLikedPrice1:GetAlreadyLikedPrice1, action: "FromLikeToCart"},
			success:function(r){
				location.reload();
			}
		})
	})
}
let AddCountInCart = document.getElementsByClassName("AddCountInCart");
let GetAlreadyCartImage = document.getElementsByClassName("GetAlreadyCartImage");
let GetAlreadyCartType = document.getElementsByClassName("GetAlreadyCartType");
let GetAlreadyCartPrice = document.getElementsByClassName("GetAlreadyCartPrice");
let GetAlreadyCartCounts = document.getElementsByClassName("GetAlreadyCartCounts");
for(let i=0; i<AddCountInCart.length;i++){
	AddCountInCart[i].addEventListener("click", function(){
		let GetAlreadyCartImageForOne = GetAlreadyCartImage[i].value;
		let GetAlreadyCartTypeForOne = GetAlreadyCartType[i].value;
		let GetAlreadyCartPriceForOne = GetAlreadyCartPrice[i].value;
		let GetAlreadyCartCountsForOne = GetAlreadyCartCounts[i].value;
		$.ajax({
			url: "SignInServer.php",
			method: "post",
			dataType: "html",
			data: {GetAlreadyCartImageForOne, GetAlreadyCartImageForOne, GetAlreadyCartTypeForOne:GetAlreadyCartTypeForOne, GetAlreadyCartPriceForOne:GetAlreadyCartPriceForOne, GetAlreadyCartCountsForOne:GetAlreadyCartCountsForOne, action:"AddCartCounts"},
			success:function(r){
				location.reload();
			}
		})
	})
}
let RemoveCountInCart = document.getElementsByClassName("RemoveCountInCart");
for(let i=0; i<RemoveCountInCart.length;i++){
	RemoveCountInCart[i].addEventListener("click", function(){
		let GetAlreadyCartImageForOne = GetAlreadyCartImage[i].value;
		let GetAlreadyCartTypeForOne = GetAlreadyCartType[i].value;
		let GetAlreadyCartPriceForOne = GetAlreadyCartPrice[i].value;
		let GetAlreadyCartCountsForOne = GetAlreadyCartCounts[i].value;
		$.ajax({
			url: "SignInServer.php",
			method: "post",
			dataType: "html",
			data: {GetAlreadyCartImageForOne, GetAlreadyCartImageForOne, GetAlreadyCartTypeForOne:GetAlreadyCartTypeForOne, GetAlreadyCartPriceForOne:GetAlreadyCartPriceForOne, GetAlreadyCartCountsForOne:GetAlreadyCartCountsForOne, action:"RemoveCartCounts"},
			success:function(r){
				location.reload();
			}
		})
	})
}
let RemoveFromCartFromCart = document.getElementsByClassName("RemoveFromCartFromCart");
for(let i=0; i<RemoveFromCartFromCart.length;i++){
	RemoveFromCartFromCart[i].addEventListener("click", function(){
		let GetAlreadyCartImageForOne = GetAlreadyCartImage[i].value;
		let GetAlreadyCartTypeForOne = GetAlreadyCartType[i].value;
		let GetAlreadyCartPriceForOne = GetAlreadyCartPrice[i].value;
		let GetAlreadyCartCountsForOne = GetAlreadyCartCounts[i].value;
		$.ajax({
			url: "SignInServer.php",
			method: "post",
			dataType: "html",
			data: {GetAlreadyCartImageForOne, GetAlreadyCartImageForOne, action:"RemoveFromCartFromCart"},
			success:function(r){
				location.reload();
			}
		})
	})
}
let Checkbox = document.getElementsByClassName("Checkbox1");
$('#select-all').click(function(event) { 
	let TrueOrFalse = "";
    if(this.checked) {
        $(':checkbox').each(function() {
            this.checked = true;                        
        });
        TrueOrFalse = "true"; 
    } else {
        $(':checkbox').each(function() {
            this.checked = false;                      
        });
        TrueOrFalse = "false"; 
    }
    	$.ajax({
    		url: "SignInServer.php",
    		method: "post",
    		dataType: 'html',
    		data:{TrueOrFalse: TrueOrFalse, action:"TrueOrFalseTrue"},
    		success:function(r){
    			location.reload();
    		}
    	})
});
for(let i = 0; i < Checkbox.length; i++){
	Checkbox[i].addEventListener("change", function(){
		let GetAlreadyCartImageForOne = GetAlreadyCartImage[i].value;
		let TrueOrFalse = "";
		console.log(GetAlreadyCartImageForOne);
		if(Checkbox[i].checked === true) {
			TrueOrFalse = "true";
    	}
    	else{
    		TrueOrFalse = "false";
    	}
    	$.ajax({
    		url: "SignInServer.php",
    		method: "post",
    		dataType: 'html',
    		data:{TrueOrFalse: TrueOrFalse, GetAlreadyCartImageForOne: GetAlreadyCartImageForOne, action:"TrueOrFalse"},
    		success:function(r){
    			location.reload();
    		}
    	})
	})
}
let SeeImgInfo = document.getElementsByClassName("SeeImgInfo");
for(let i = 0; i < SeeImgInfo.length; i++){
	SeeImgInfo[i].addEventListener("click", function(){
		let GetInfoAboutLikedImgValue = GetInfoAboutLikedImg[i].value;
		// let GetInfoAboutLikedImgValue = SeeImgInfo[i].src;
		let GetInfoAboutLikedTypeValue = GetInfoAboutLikedType[i].value;
		let GetInfoAboutLikedPriceValue = GetInfoAboutLikedPrice[i].value;
		let GetInfoAboutLikedCountForSaleValue = GetInfoAboutLikedCountForSale[i].value;
		$.ajax({
			url: "SignInServer.php",
			method: "post",
			dataType: "html",
			data: {GetInfoAboutLikedCountForSaleValue:GetInfoAboutLikedCountForSaleValue,GetInfoAboutLikedTypeValue:GetInfoAboutLikedTypeValue, GetInfoAboutLikedImgValue: GetInfoAboutLikedImgValue, GetInfoAboutLikedPriceValue:GetInfoAboutLikedPriceValue, action: "SeeImgInfo"},
			success:function(r){
				window.location.href = "SeeAboutInfo.php";
			}
		})	
	})
}