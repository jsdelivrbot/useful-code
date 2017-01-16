<script src="https://cdnjs.cloudflare.com/ajax/libs/pixi.js/4.2.3/pixi.min.js"></script>

<script>
	PIXI.loader
		.add("house", "images/pixi/is1-house-1.png")
		.add("cookie_man", "images/pixi/cookie-man.png")
		.add("rabbit", "images/pixi/rabbit.png")
		.add("poker", "images/pixi/poker.png")
		.add("lion", "images/pixi/lion.png")
		.add("left_tree_1", "images/pixi/left-tree-1.png")
		.add("left_tree_2", "images/pixi/left-tree-2.png")
		.add("left_tree_3", "images/pixi/left-tree-3.png")
		.add("bird", "images/pixi/bird.png")
		.add("left_house_1", "images/pixi/left-house-1.png")
		.add("left_house_2", "images/pixi/left-house-2.png")
		.add("cat", "images/pixi/cat.png")
		.add("right_tree_1", "images/pixi/right-tree-1.png")
		.add("right_tree_2", "images/pixi/right-tree-2.png")
		.add("right_house_1", "images/pixi/right-house-1.png")
		.add("right_house_2", "images/pixi/right-house-2.png")
		.add("women", "images/pixi/women.png")
		.load(init)
		.once('complete',render);

	var house;
	var cookie_man;
	var rabbit;
	var poker;
	var lion;
	var left_tree_1;
	var left_tree_2;
	var left_tree_3;
	var bird;
	var left_house_1;
	var left_house_2;
	var cat;
	var right_tree_1;
	var right_tree_2;
	var right_house_1;
	var right_house_2;
	var women;

	function init(loader, res) {
		house = new PIXI.Sprite(PIXI.loader.resources.house.texture);
		house.anchor.x=0.5;
		house.anchor.y=1;
		house.x=getPos(PI/2).x;
		house.y=getPos(PI/2).y+20;

		cookie_man = new PIXI.Sprite(PIXI.loader.resources.cookie_man.texture);
		cookie_man.anchor.x=0.5;
		cookie_man.anchor.y=1;
		cookie_man.x=getPos(PI/1.7).x;
		cookie_man.y=getPos(PI/1.7).y+70;

		rabbit = new PIXI.Sprite(PIXI.loader.resources.rabbit.texture);
		rabbit.anchor.x=0.5;
		rabbit.anchor.y=1;
		rabbit.x=getPos(PI/2.2).x;
		rabbit.y=getPos(PI/2.2).y+60;

		poker = new PIXI.Sprite(PIXI.loader.resources.poker.texture);
		poker.anchor.x=0.5;
		poker.anchor.y=1;
		poker.x=getPos(PI/2).x+204;
		poker.y=getPos(PI/2).y-240;

		lion = new PIXI.Sprite(PIXI.loader.resources.lion.texture);
		lion.anchor.x=0.5;
		lion.anchor.y=1;
		lion.x=getPos(PI/2.5).x;
		lion.y=getPos(PI/2.5).y+20;

		left_tree_1 = new PIXI.Sprite(PIXI.loader.resources.left_tree_1.texture);
		left_tree_1.anchor.x=0.5;
		left_tree_1.anchor.y=1;
		left_tree_1.x=getPos(PI/1.62).x;
		left_tree_1.y=getPos(PI/1.62).y;

		left_tree_2 = new PIXI.Sprite(PIXI.loader.resources.left_tree_2.texture);
		left_tree_2.anchor.x=0.5;
		left_tree_2.anchor.y=1;
		left_tree_2.x=getPos(PI/1.48).x;
		left_tree_2.y=getPos(PI/1.48).y;

		left_tree_3 = new PIXI.Sprite(PIXI.loader.resources.left_tree_3.texture);
		left_tree_3.anchor.x=0.5;
		left_tree_3.anchor.y=1;
		left_tree_3.x=getPos(PI/1.32).x;
		left_tree_3.y=getPos(PI/1.32).y;


		bird = new PIXI.Sprite(PIXI.loader.resources.bird.texture);
		bird.anchor.x=0.5;
		bird.anchor.y=1;
		bird.x=getPos(PI/1.55).x;
		bird.y=getPos(PI/1.55).y+50;

		left_house_1 = new PIXI.Sprite(PIXI.loader.resources.left_house_1.texture);
		left_house_1.anchor.x=0.5;
		left_house_1.anchor.y=1;
		left_house_1.x=getPos(PI/1.58).x;
		left_house_1.y=getPos(PI/1.58).y+20;

		left_house_2 = new PIXI.Sprite(PIXI.loader.resources.left_house_2.texture);
		left_house_2.anchor.x=0.5;
		left_house_2.anchor.y=1;
		left_house_2.x=getPos(PI/1.36).x;
		left_house_2.y=getPos(PI/1.36).y+10;

		cat = new PIXI.Sprite(PIXI.loader.resources.cat.texture);
		cat.anchor.x=0.5;
		cat.anchor.y=1;
		cat.x=getPos(PI/1.46).x;
		cat.y=getPos(PI/1.46).y+20;

		right_tree_1 = new PIXI.Sprite(PIXI.loader.resources.right_tree_1.texture);
		right_tree_1.anchor.x=0.5;
		right_tree_1.anchor.y=1;
		right_tree_1.x=getPos(PI/2.8).x;
		right_tree_1.y=getPos(PI/2.8).y;

		right_tree_2 = new PIXI.Sprite(PIXI.loader.resources.right_tree_2.texture);
		right_tree_2.anchor.x=0.5;
		right_tree_2.anchor.y=1;
		right_tree_2.x=getPos(PI/3.3).x;
		right_tree_2.y=getPos(PI/3.3).y;

		right_house_1 = new PIXI.Sprite(PIXI.loader.resources.right_house_1.texture);
		right_house_1.anchor.x=0.5;
		right_house_1.anchor.y=1;
		right_house_1.x=getPos(PI/3).x;
		right_house_1.y=getPos(PI/3).y+20;

		right_house_2 = new PIXI.Sprite(PIXI.loader.resources.right_house_2.texture);
		right_house_2.anchor.x=0.5;
		right_house_2.anchor.y=1;
		right_house_2.x=getPos(PI/3.8).x;
		right_house_2.y=getPos(PI/3.8).y;

		women = new PIXI.Sprite(PIXI.loader.resources.women.texture);
		women.anchor.x=0.5;
		women.anchor.y=1;
		women.x=getPos(PI/3.6).x;
		women.y=getPos(PI/3.6).y+50;

		// add to stage
		stage.addChild(bgContainer);
		stage.addChild(house);
		stage.addChild(cookie_man);
		stage.addChild(rabbit);
		stage.addChild(poker);
		stage.addChild(lion);
		stage.addChild(left_tree_1);
		stage.addChild(left_tree_2);
		stage.addChild(left_tree_3);
		stage.addChild(left_house_1);
		stage.addChild(left_house_2);
		stage.addChild(bird);
		stage.addChild(cat);
		stage.addChild(right_tree_1);
		stage.addChild(right_tree_2);
		stage.addChild(right_house_1);
		stage.addChild(right_house_2);
		stage.addChild(women);
	}

	function render() {
		renderer.render(stage);
		requestAnimationFrame(render);
	}
</script>