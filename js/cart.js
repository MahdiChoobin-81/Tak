	function plus(element){
		let plus = element.id.split("_").pop();
		document.getElementById("numberOfProducts" + plus).stepUp(1);
	}
	function minus(element){
	let minus = element.id.split("_").pop();
		document.getElementById("numberOfProducts" + minus).stepDown(1);

	}
	function delete_item(element){
		// alert(element.id);
		document.cookie = "order_id=" + element.id;
		location.reload();
		alert('محصول شما از لیست سبد کالایتان حذف شد.');
		location.reload();
	}
	function numberWithCommas(x) {
		return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	}

	function numberToEnglish(number) {
		const persian = {
			"۰": "0", "۱": "1", "۲": "2", "۳": "3", "۴": "4", "۵": "5", "۶": "6", "۷": "7",
			"۸": "8", "۹": "9", ",": ""
		};
		number = number.toString().split("");
		let persianNumber = ""
		for (let i = 0; i < number.length; i++) {
			number[i] = persian[number[i]];
		}
		for (let i = 0; i < number.length; i++) {
			persianNumber += number[i];
		}
		return persianNumber;
	}
	function numberToPersian(number) {
		const persian = {
			"0": "۰", "1": "۱", "2": "۲", "3": "۳", "4": "۴", "5": "۵", "6": "۶", "7": "۷",
			"8": "۸", "9": "۹", "": ","
		};
		number = number.toString().split("");
		let persianNumber = ""
		for (let i = 0; i < number.length; i++) {
			number[i] = persian[number[i]];
		}
		for (let i = 0; i < number.length; i++) {
			persianNumber += number[i];
		}
		return persianNumber;
	}

	// let itemsIdForSell = "{1"; // [41, 42]
	let dataForSell = [];
	function selectProduct(element){
		// element id
		let item = document.getElementById(element.id);
		// order id
		let item_id = element.id.split("_").pop();

		let product_price_demo = document.getElementById('product_price_tag_' + item_id ).textContent;
		// let product_price = product_price_demo.replace(',', '');
		product_price_demo = product_price_demo.replace(/\s+/g, '')
		let product_price = numberToEnglish(product_price_demo);
		
		// console.log(product_price);
		// check here
		let numberOfProduct = document.getElementById('numberOfProducts' + item_id).value;
		let priceOfSelectedProducts = product_price * numberOfProduct;
		let a = document.getElementById('priceOfSelectedProducts');
			// console.log(a.textContent)

		if(item.checked === true) {

			// let b = a.textContent.replace(',', '');
			let b = a.textContent.replace(/,/g, '');
			// console.log("tick"+b)
			// document.getElementById('plus_' + item_id).removeAttribute('onclick');
			document.getElementById('changeNumber' + item_id).style.display = "none";
			a.textContent = numberWithCommas((parseInt(b) + parseInt(priceOfSelectedProducts.toString())).toString());


			dataForSell.push({order_id: item_id, quantity: numberOfProduct});

			// console.log(dataForSell);


		}

		else if(item.checked === false){

			document.getElementById('changeNumber' + item_id).style.display = "flex";
			let b = (parseInt(a.textContent.replace(/,/g, '')) - parseInt(priceOfSelectedProducts.toString())).toString();
			a.textContent = numberWithCommas(b);
			// console.log("untick : " + a.textContent)

			dataForSell.filter(function(item, idx) {
				return item.order_id === item_id;
			});

			let index = dataForSell.findIndex(x => x.order_id === item_id);
			dataForSell.splice(index, 1)

			// console.log(dataForSell);


		}
		// console.log(JSON.stringify(dataForSell, null, 4));

		// location.reload();

	}

	function sendDataForSell(){

		let productsCheckbox = document.getElementsByClassName("productsCheckbox");
		let checkboxCount = document.querySelectorAll('.productsCheckbox').length;
		let checkedCheckboxes = 0;

		for(let i = 0; i<checkboxCount; i++){

			let checkbox = document.getElementById(productsCheckbox[i].id);
			if(!checkbox.checked){
				// console.log(productsCheckbox[i].id + "not checked")
			}
			else{
				checkedCheckboxes++;
				// console.log(productsCheckbox[i].id + " is not checked")
			}
		}
		if(checkedCheckboxes == 0){
			console.log("خواهشا یک کالا را برای خرید انتخاب کنید.")
		document.cookie = "noProduct=" + "1212";
		}else{
		alert('محصول شما با موفقیت خریداری شد.')
		document.cookie = "idOfOrder=" + JSON.stringify(dataForSell);
		}
		// console.log("checkedCheckboxes : " + checkedCheckboxes)
		// console.log("checkboxCount : " + checkboxCount)
	}

	function priceWithComa(elementId){
		let test = document.getElementById('product_price_tag_' + elementId).textContent;
		let result = numberWithCommas(test)
		document.getElementById("product_price_tag_" + elementId).textContent = result
		// // alert(numberWithCommas(test))
		// alert("product_price_tag_" + elementId)
	}







