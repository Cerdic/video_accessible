jQuery(function(){
	if (dir_jwplayer && jQuery('.video-jwplayer').length){
		/**
		 * Compteur pour affecter un id unique a chaque video
		 */
		var jwpid=0;
		/**
		 * Url de base, qui prend en compre le <base> du document
		 */
		var jwpnetsream=jQuery('base').length?jQuery('base').eq(-1).attr('href'):window.location.href;

		/**
		 * Fonction d'initialisation de chaque video
		 */
		function init_jwplayers(){
			jQuery('.video-jwplayer').each(function(){
				var me=jQuery(this);
				var options=eval('options='+me.attr('data-player')+';');
				if (options) {
					options = jQuery.extend({netstreambasepath: jwpnetsream,flashplayer: dir_jwplayer+"player/player.swf"},options);

					// detecter le besoin du plugin caption ou audiodescription
					var plugins = [];
					if (options['captions.file'])
						plugins.push(dir_jwplayer+'plugins/captions/captions-2.swf');
					if (options['audiodescription.file'])
						plugins.push(dir_jwplayer+'plugins/audiodescription/audiodescription-2.swf');

					options['plugins'] = plugins.join(",");
					if (!me.attr('id'))
						me.attr('id','jwpid'+jwpid++);
					jwplayer(me.attr('id')).setup(options);
				}
			});
		}
		jQuery.getScript(dir_jwplayer+"player/jwplayer.js",function(){
			init_jwplayers();
			onAjaxLoad(init_jwplayers);
		});
	}
});
