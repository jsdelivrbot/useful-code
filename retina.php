http://rettamkrad.blogspot.tw/2013/04/retina-device-and-web-develop.html


<!-- use css -->
<style>
	/*Note, if you try this using Mindscape Web Workbench's compiler (for us Visual Studio users), it will most likely fail. To fix it, put the media query value into a variable like this:*/

	@mediaRetina: ~"(min-resolution: 124dpi), (-webkit-min-device-pixel-ratio: 1.3), (min--moz-device-pixel-ratio: 1.3), (-o-min-device-pixel-ratio: 4/3), (min-device-pixel-ratio: 1.3), (min-resolution: 1.3dppx)";

	.image-2x(@image:'no.png', @bg-width:0, @bg-height:0, @repeat: no-repeat) {
		@filename  : ~`/(.*)\.(jpg|jpeg|png|gif)/.exec(@{image})[1]`;
		@extension : ~`/(.*)\.(jpg|jpeg|png|gif)/.exec(@{image})[2]`;
		background-image: ~`"url(@{filename}.@{extension})"`;
		background-repeat: @repeat;

		img:nth-child(1){display:inline; }
		img:nth-child(2){display:none; }
		img:nth-child(3){display:none; }
		img:nth-child(4){display:none; }

		&.css_mover{
			cursor: pointer;
			img:nth-child(1){display:inline; }
			img:nth-child(2){display:none; }
			img:nth-child(3){display:none; }
			img:nth-child(4){display:none; }
		}
		&.css_mover:hover{
			img:nth-child(1){display:none; }
			img:nth-child(2){display:none; }
			img:nth-child(3){display:inline; }
			img:nth-child(4){display:none; }
		}

		@media @mediaRetina{
			/* on retina, use image that's scaled by 2 */
			background-image: ~`"url(@{filename}@2x.@{extension})"`;
			background-size: @bg-width @bg-height;

			img:nth-child(1){display:none; }
			img:nth-child(2){display:inline; }
			img:nth-child(3){display:none; }
			img:nth-child(4){display:none; }

			&.css_mover{
				cursor: pointer;
				img:nth-child(1){display:none; }
				img:nth-child(2){display:inline; }
				img:nth-child(3){display:none; }
				img:nth-child(4){display:none; }
			}
			&.css_mover:hover{
				img:nth-child(1){display:none; }
				img:nth-child(2){display:none; }
				img:nth-child(3){display:none; }
				img:nth-child(4){display:inline; }
			}
		}
	}

	.topmenuList li {
		.image-2x('image.png', 200px, 20px);
	}

</style>










<!-- use js -->
<script type="text/javascript" src="js/retina.js"></script>

<img src="images/m4.png" data-at2x="images/m4@2x.png" >

<!-- 另存retina.js -->
<script>
	(function() {
		var root = (typeof exports === 'undefined' ? window : exports);
		var config = {
			// An option to choose a suffix for 2x images
			retinaImageSuffix : '@2x',

			// Ensure Content-Type is an image before trying to load @2x image
			// https://github.com/imulus/retinajs/pull/45)
			check_mime_type: true,

			// Resize high-resolution images to original image's pixel dimensions
			// https://github.com/imulus/retinajs/issues/8
			force_original_dimensions: true
		};

		function Retina() {}

		root.Retina = Retina;

		Retina.configure = function(options) {
			if (options === null) {
				options = {};
			}

			for (var prop in options) {
				if (options.hasOwnProperty(prop)) {
					config[prop] = options[prop];
				}
			}
		};

		Retina.init = function(context) {
			if (context === null) {
				context = root;
			}
			context.addEventListener('load', function (){
				var images = document.getElementsByTagName('img'), imagesLength = images.length, retinaImages = [], i, image;
				for (i = 0; i < imagesLength; i += 1) {
					image = images[i];

					if (!!!image.getAttributeNode('data-no-retina')) {
						if (image.src) {
							retinaImages.push(new RetinaImage(image));
						}
					}
				}
			});
		};

		Retina.isRetina = function(){
			var mediaQuery = '(-webkit-min-device-pixel-ratio: 1.5), (min--moz-device-pixel-ratio: 1.5), (-o-min-device-pixel-ratio: 3/2), (min-resolution: 1.5dppx)';

			if (root.devicePixelRatio > 1) {
				return true;
			}

			if (root.matchMedia && root.matchMedia(mediaQuery).matches) {
				return true;
			}

			return false;
		};


		var regexMatch = /\.[\w\?=]+$/;
		function suffixReplace (match) {
			return config.retinaImageSuffix + match;
		}

		function RetinaImagePath(path, at_2x_path) {
			this.path = path || '';
			if (typeof at_2x_path !== 'undefined' && at_2x_path !== null) {
				this.at_2x_path = at_2x_path;
				this.perform_check = false;
			} else {
				if (undefined !== document.createElement) {
					var locationObject = document.createElement('a');
					locationObject.href = this.path;
					locationObject.pathname = locationObject.pathname.replace(regexMatch, suffixReplace);
					this.at_2x_path = locationObject.href;
				} else {
					var parts = this.path.split('?');
					parts[0] = parts[0].replace(regexMatch, suffixReplace);
					this.at_2x_path = parts.join('?');
				}
				this.perform_check = true;
			}
		}

		root.RetinaImagePath = RetinaImagePath;

		RetinaImagePath.confirmed_paths = [];

		RetinaImagePath.prototype.is_external = function() {
			return !!(this.path.match(/^https?\:/i) && !this.path.match('//' + document.domain) );
		};

		RetinaImagePath.prototype.check_2x_variant = function(callback) {
			var http, that = this;
			if (!this.perform_check && typeof this.at_2x_path !== 'undefined' && this.at_2x_path !== null) {
				return callback(true);
			} else if (this.at_2x_path in RetinaImagePath.confirmed_paths) {
				return callback(true);
			} else if (this.is_external()) {
				return callback(false);
			} else {
				http = new XMLHttpRequest();
				http.open('HEAD', this.at_2x_path);
				http.onreadystatechange = function() {
					if (http.readyState !== 4) {
						return callback(false);
					}

					if (http.status >= 200 && http.status <= 399) {
						if (config.check_mime_type) {
							var type = http.getResponseHeader('Content-Type');
							if (type === null || !type.match(/^image/i)) {
								return callback(false);
							}
						}

						RetinaImagePath.confirmed_paths.push(that.at_2x_path);
						return callback(true);
					} else {
						return callback(false);
					}
				};
				http.send();
			}
		};

		function RetinaImage(el) {
			this.el = el;
			this.path = new RetinaImagePath(this.el.getAttribute('src'), this.el.getAttribute('data-at2x'));
			var that = this;
			this.path.check_2x_variant(function(hasVariant) {
				if (hasVariant) {
					that.swap();
				}
			});
		}

		root.RetinaImage = RetinaImage;

		RetinaImage.prototype.swap = function(path) {
			if (typeof path === 'undefined') {
				path = this.path.at_2x_path;
			}

			var that = this;
			function load() {
				if (! that.el.complete) {
					setTimeout(load, 5);
				} else {
					if (config.force_original_dimensions) {
						if (that.el.offsetWidth == 0 && that.el.offsetHeight == 0) {
							that.el.setAttribute('width', that.el.naturalWidth);
							that.el.setAttribute('height', that.el.naturalHeight);
						} else {
							that.el.setAttribute('width', that.el.offsetWidth);
							that.el.setAttribute('height', that.el.offsetHeight);
						}
					}

					that.el.setAttribute('src', path);
				}
			}
			load();
		};


		if (Retina.isRetina()) {
			Retina.init(root);
		}
	})();
</script>