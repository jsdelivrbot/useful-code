<script src="https://www.gstatic.com/firebasejs/4.11.0/firebase.js"></script>

<script>
	var config = {
		apiKey: "AIzaSyAIjCC-Ol5bKw93keMr9hYB3uYWKrvecZg",
		authDomain: "tang-c4521.firebaseapp.com",
		databaseURL: "https://tang-c4521.firebaseio.com",
		projectId: "tang-c4521",
		storageBucket: "",
		messagingSenderId: "117903481680"
	};
	firebase.initializeApp(config);

	var _col = firebase.database().ref('sort')

	_col.on("value", (_sorts) => {
		// remove
		$("#main section[data-id]").each((i, e) => {
			if (_sorts.val().indexOf(e.dataset.id) == -1) {
				$(e).hide()
			}else{
				$(e).show()
			}
		})

		// resort
		for(v of _sorts.val()){
			$("#main section[data-id='"+ v +"']").appendTo($("#main"))
		}
	})

	_col.once("value", (_sorts) => {
		console.log(_sorts.val())
	})
</script>