function activeData(rel, href, obj){
		var src = '';
		$.ajax({
		   	type: "POST",
			url: "active_process.php",
			data: { d_id: rel, active: href },
		   	success: function(data){
						obj.attr('href', data);
						if(data==1){
							src = "image/accept.png";
						}else{
							src = "image/delete.png";							
						}
						obj.find('img').attr('src', src);						
					}
		 });
}
function activeDataU(rel, href, obj){
		var src = '';
		$.ajax({
		   	type: "POST",
			url: "activeU_process.php",
			data: { d_id: rel, active: href },
		   	success: function(data){
						obj.attr('href', data);
						if(data==1){
							src = "image/accept.png";
						}else{
							src = "image/delete.png";							
						}
						obj.find('img').attr('src', src);						
					}
		 });
}
function activeMember(rel, href, obj){
		var src = '';
		$.ajax({
		   	type: "POST",
			url: "activeM_process.php",
			data: { m_id: rel, active: href },
		   	success: function(data){
						obj.attr('href', data);
						if(data==1){
							src = "image/accept.png";
						}else{
							src = "image/delete.png";							
						}
						obj.find('img').attr('src', src);						
					}
		 });
}
function activeDataC(rel, href, obj){
		var src = '';
		$.ajax({
		   	type: "POST",
			url: "activeC_process.php",
			data: { c_id: rel, active: href },
		   	success: function(data){
						obj.attr('href', data);
						if(data==1){
							src = "image/accept.png";
						}else{
							src = "image/delete.png";							
						}
						obj.find('img').attr('src', src);						
					}
		 });
}
function activeDataT(rel, href, obj){
		var src = '';
		$.ajax({
		   	type: "POST",
			url: "activeT_process.php",
			data: { term_id: rel, active: href },
		   	success: function(data){
						obj.attr('href', data);
						if(data==1){
							src = "image/accept.png";
						}else{
							src = "image/delete.png";							
						}
						obj.find('img').attr('src', src);						
					}
		 });
}
function activeEpaper(rel, href, obj){
		var src = '';
		$.ajax({
		   	type: "POST",
			url: "activeE_process.php",
			data: { e_id: rel, active: href },
		   	success: function(data){
						obj.attr('href', data);
						if(data==1){
							src = "image/accept.png";
						}else{
							src = "image/delete.png";							
						}
						obj.find('img').attr('src', src);						
					}
		 });
}

function pubData(rel, href, obj){
	var txt = '';
	$.ajax({
	   	type: "POST",
		url: "pub_process.php",
		data: { d_id: rel, pub: href },
	   	success: function(data){
					obj.attr('href', data);
					if(data==1){
						txt = "發佈";
					}else{
						txt = "草稿";							
					}
					//obj.find('img').attr('src', src);						
					obj.html(txt)
				}
	 });
}

$(document).ready(function() {
	
	$('.activeCh').click(function(){		
		activeData($(this).attr('rel'), $(this).attr('href'), $(this));		 
		return false;
	});
	
	$('.activeChU').click(function(){		
		activeDataU($(this).attr('rel'), $(this).attr('href'), $(this));		 
		return false;
	})
	
	$('.activeChM').click(function(){		
		activeMember($(this).attr('rel'), $(this).attr('href'), $(this));		 
		return false;
	})
	
	$('.activeChC').click(function(){		
		activeDataC($(this).attr('rel'), $(this).attr('href'), $(this));		 
		return false;
	});
	
	$('.activeChT').click(function(){		
		activeDataT($(this).attr('rel'), $(this).attr('href'), $(this));		 
		return false;
	});
	
	$('.activeChE').click(function(){		
		activeEpaper($(this).attr('rel'), $(this).attr('href'), $(this));		 
		return false;
	});

	$('.pubD').click(function(){		
		pubData($(this).attr('rel'), $(this).attr('href'), $(this));		 
		return false;
	});
	
	
	
});