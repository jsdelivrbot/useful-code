//$ = jQuery.noConflict();
$(document).ready(function(){ 

	//$("#basketItemsWrap li:first").hide();
	
	//add item
	//$(".productPriceWrapRight a img").click(function() {
	$("#addToCart a").click(function() {
		alert('click');
		var productIDValSplitter 	= (this.id).split("_");
		var productIDVal 			= productIDValSplitter[1];
		var qty						= $("#pNum").val();
		
		var m_id					= $('#m_id').val();
	
		//$("#notificationsLoader").html('<div><img src="inc/loading.gif"></div>');
	
		$.ajax({  
		type: "POST",  
		url: "inc/functions.php",  
		data: { productID: productIDVal, qty: qty, action: "addToBasket", m_id: m_id},  
		dataType : 'json',
		success: function(theResponse) {
			
			//alert(theResponse['res']);
			//alert(theResponse['subAllTotal']);
			
			if( $("#productID_" + productIDVal).length > 0){
				$("#productID_" + productIDVal).animate({ opacity: 0 }, 500, function() {
					//$("#productID_" + productIDVal).before(theResponse).remove();
					////$("#productID_" + productIDVal).before(theResponse['res']).remove();
				});				
				$("#productID_" + productIDVal).animate({ opacity: 0 }, 500);
				$("#productID_" + productIDVal).animate({ opacity: 1 }, 500);
				$("#notificationsLoader").empty();			
			} else {
				//$("#basketItemsWrap li:first").before(theResponse);
				////$("#basketItemsWrap li:first").before(theResponse['res']);
				$("#basketItemsWrap li:first").hide();
				$("#basketItemsWrap li:first").show("slow");  
				$("#notificationsLoader").empty();			
			}
			//updateTotalAll(theResponse['subAllTotal'], theResponse['deliverfee'], theResponse['grandTotal'], theResponse['directTotal'], theResponse['collectiveTotal'], theResponse['itemcount'], theResponse['deliverfee']);
			//window.location='order_list.php';
			
		}  
		});  
		
	});
	
	//edit item
	//$("#basketItemsWrap li input[name|='qty[]']").change(function(){
	/*$("#basketItemsWrap li :input").change(function(){
		alert("change");
	});
	$("#basketItemsWrap li").click(function(){
		alert("click");									  
	});*/
	
	$("#basketItemsWrap li :input[name|='qty[]']").change(function(event) { 
		//alert("live change");	
		var productIDValSplitter 	= (this.id).split("_");
		var productIDVal 			= productIDValSplitter[1];
		var m_id					= $('#m_id').val();
		var qty						= $(this).val();
		//alert(qty);
		
		
		if(checkNumber(qty)){
			$("#notificationsLoader").html('<div><img src="inc/loading.gif"></div>');
			$.ajax({  
				type: "POST",  
				url: "inc/functions.php",  
				data: { productID: productIDVal, action: "Update", m_id: m_id, qty: qty},   
				dataType : 'json',
				success: function(theResponse) {
			
					if( $("#productID_" + productIDVal).length > 0){
						$("#productID_" + productIDVal).animate({ opacity: 0 }, 500, function() {
						//$("#productID_" + productIDVal).before(theResponse).remove();
							$("#productID_" + productIDVal).before(theResponse['res']).remove();
						});				
						$("#productID_" + productIDVal).animate({ opacity: 0 }, 500);
						$("#productID_" + productIDVal).animate({ opacity: 1 }, 500);
						$("#notificationsLoader").empty();			
					} else {
						//$("#basketItemsWrap li:first").before(theResponse);
						$("#basketItemsWrap li:first").before(theResponse['res']);
						$("#basketItemsWrap li:first").hide();
						$("#basketItemsWrap li:first").show("slow");  
						$("#notificationsLoader").empty();			
					}
					updateTotalAll(theResponse['subAllTotal'], theResponse['deliverfee'], theResponse['grandTotal']);		
				}  
			});  		
		}else{
			alert('您輸入的不是整數或數字，請輸入整數!!');
			var field = $(this);
			setTimeout(function(){field.focus().select()}, 10);
			//$(this).focus().select();
			//return false;
		}
		
	});
	
	$("#basketItemsWrap li img").click(function(event) { 
														
		var productIDValSplitter 	= (this.id).split("_");
		var productIDVal 			= productIDValSplitter[1];	
		
		var m_id					= $('#m_id').val();
	
		$("#notificationsLoader").html('<div><img src="inc/loading.gif"></div>');
	
		$.ajax({  
		type: "POST",  
		url: "inc/functions.php",  
		data: { productID: productIDVal, action: "deleteFromBasket", m_id: m_id},   
		dataType : 'json',
		success: function(theResponse) {
			
			$("#productID_" + productIDVal).hide("slow",  function() {$(this).remove();});
			$("#notificationsLoader").empty();
			
			updateTotalAll(theResponse['subAllTotal'], theResponse['deliverfee'], theResponse['grandTotal']);
		
		}  
		});  
		
	});
	
	//delet item
	$("#basketItemsWrap li img").click(function(event) { 
														
		var productIDValSplitter 	= (this.id).split("_");
		var productIDVal 			= productIDValSplitter[1];	
		
		var m_id					= $('#m_id').val();
	
		$("#notificationsLoader").html('<div><img src="inc/loading.gif"></div>');
	
		$.ajax({  
		type: "POST",  
		url: "inc/functions.php",  
		data: { productID: productIDVal, action: "deleteFromBasket", m_id: m_id},   
		dataType : 'json',
		success: function(theResponse) {
			
			$("#productID_" + productIDVal).hide("slow",  function() {$(this).remove();});
			$("#notificationsLoader").empty();
			
			updateTotalAll(theResponse['subAllTotal'], theResponse['deliverfee'], theResponse['grandTotal']);
		
		}  
		});  
		
	});

});

function checkNumber(value) {
	//return /^ *[0-9]+ *$/.test(value); //整數
	//value = alltrim(value);
    return /^[-+]?[0-9]+$/.test(value);
	//return /^-?(?:\d+|\d{1,3}(?:,\d{3})+)(?:\.\d+)?$/.test(value);
}

function gen_currency(val) {
 val = val.toString();
 for (var i = 0; i < Math.floor((val.length-(1+i))/3); i++)
  val = val.substring(0,val.length-(4*i+3))+','+val.substring(val.length-(4*i+3));
 return val;
}

function updateTotalAll(SubTotalAll, deliverfee, grandTotal, directTotal, collectiveTotal, itemcount, deliverfee){
	$('.Rightm-w-s .num-b').text(gen_currency(grandTotal));
	
	//$('#directTotal').text('直購'+gen_currency(directTotal));
	//$('#collectiveTotal').text('集購'+gen_currency(collectiveTotal));
	//$('#deliverfee').text('運費'+gen_currency(deliverfee));
	
	$('.Rightm-w-s .num-b-2').text(itemcount);
}