// JavaScript Document
window.onload = function demo() {
	oCheckBoxAll = document.getElementById("checkAll");
	oCheck = document.getElementsByClassName("checkCss");

	var totalCount = 0;
	var totalMoney = 0;
	var priceTotal = document.getElementById("priceTotal");
	var sumPrice = document.getElementById("sumPrice");
	var countTotal = document.getElementById("countTotal");
	var oInputCount = document.getElementsByClassName("quantity_input");
	
	var otab = document.getElementById("checkout_table");
	var otr = document.getElementsByTagName("tr");
	var oBtn_del = document.getElementsByClassName("quantity_dec_button");
	var oBtn_add = document.getElementsByClassName("quantity_inc_button");
	var oDel = document.getElementsByClassName("product_plus");
	var orderBtn = document.getElementById("btnOrder");
	
	var flag = 0; 
	function Fcheck() {
		if(oCheckBoxAll.checked == true) {
			for(i = 0; i < oCheck.length; i++) {
				if(!oCheck[i].checked) {
					oCheck[i].checked = true;
					flag+=1;
					totalCount += parseInt(oInputCount[i].value);
					totalMoney += parseFloat(otr[i + 1].cells[5].innerText);
				}
			}
		} else {
			for(i = 0; i < oCheck.length; i++) {
				oCheck[i].checked = false;
				flag = 0;
			}
			totalCount = 0;
			totalMoney = 0;
		}
		Spantotal();
	}

	function Spantotal() {
		countTotal.innerHTML = totalCount;
		priceTotal.innerHTML = totalMoney.toFixed(2);
		sumPrice.innerHTML = totalMoney.toFixed(2);
	}

	function check() {
		for(i = 0; i < oCheck.length; i++) {
			if(this == oCheck[i]) {
				index = i;
				break;
			}
		}
		if(oCheck[index].checked) {
			totalCount += parseInt(oInputCount[index].value);
			totalMoney += parseInt(oInputCount[index].value) * parseFloat(otr[index + 1].cells[3].innerText);
			flag+= 1;
		} else {
			totalCount -= parseInt(oInputCount[index].value);
			totalMoney -= parseInt(oInputCount[index].value) * parseFloat(otr[index + 1].cells[3].innerText);
			flag-= 1;
		}
		if(flag==oCheck.length){
			oCheckBoxAll.checked=true;
		}
		else{
			oCheckBoxAll.checked=false;
		}
		Spantotal();
	}

	function remove() {
		for(i = 0; i < oDel.length; i++) {
			if(this == oDel[i]) {
				index = i;
				break;
			}
		}
		if(oCheck[index].checked == true) {
			totalCount -= parseInt(oInputCount[index].value);
			totalMoney -= parseFloat(otr[index + 1].cells[5].innerText);
		}
		Spantotal();
		demo();
		otr[index + 1].remove();
	}

	function del() {
		for(i = 0; i < oBtn_del.length; i++) {
			if(this == oBtn_del[i]){
				index = i;
				break;
			}
		}
		if(oInputCount[index].value != 0) {
			var value_1 = parseFloat(oInputCount[index].value) * parseFloat(otr[index+1].cells[3].innerText);
			value_1 = value_1.toFixed(2);
			oInputCount[index].value = oInputCount[index].value - 1;
			otr[index+1].cells[5].innerHTML = '<div class="cart_product_total">'+value_1+'</div>';
			if(oCheck[index].checked && oInputCount[index].value != 0) {
				totalCount -= 1;
				totalMoney -= parseFloat(otr[index+1].cells[3].innerText).toFixed(2);
				Spantotal();
			}
		}
	}

	function add() {
		for(i = 0; i < oBtn_del.length; i++) {
			if(this == oBtn_add[i]){
				index = i;
				break;
			}
		}
		oInputCount[index].value = +(oInputCount[index].value) + 1;
		var value_2 = parseFloat(oInputCount[index].value) * parseFloat(otr[index+1].cells[3].innerText);
		value_2 = value_2.toFixed(2);
		otr[index+1].cells[5].innerHTML = '<div class="cart_product_total">'+value_2+'</div>';
		if(oCheck[index].checked) {
			totalCount += 1;
			totalMoney += parseFloat(otr[index+1].cells[3].innerText);
			Spantotal();
		}
	}
	function checkout(){
		if(flag!=0){
			//window.location.href="checkout.php";
		}
		else{
			//alert("Please pick at least one item.");
			//history.go(-1);
		}
	}
	oCheckBoxAll.onclick = Fcheck;
	for(i = 0; i < oCheck.length; i++)
		oCheck.item(i).onclick = check;
	for(i = 0; i < oDel.length; i++)	
	oDel.item(i).onclick = remove;
	for(i = 0; i < oBtn_del.length; i++)
		oBtn_del.item(i).onclick = del;
	for(i = 0; i < oBtn_add.length; i++)
		oBtn_add.item(i).onclick = add;
	orderBtn.onclick=checkout;
}