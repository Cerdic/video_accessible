jQuery(function(){
	if (dir_jwplayer && jQuery('.video-jwplayer').length){
		/**
		 * Compteur pour affecter un id unique a chaque video
		 */
		var jwpid=0;
		/**
		 * Url de base, qui prend en compre le <base> du document
		 */
		var jwpnetsream='';
		if (jQuery('base').length) {
			jwpnetsream = jQuery('base').eq(-1).attr('href');
			jwpnetsream = jwpnetsream.replace(/^https?:\/\/[^\/]*/,'');
		}

		/**
		 * Fonction d'initialisation de chaque video
		 */
		function init_jwplayers(){
			jQuery('.video-jwplayer').each(function(){
				var me=jQuery(this);
				var options=eval('options='+me.attr('data-player')+';');
				if (options) {
					options = jQuery.extend({flashplayer: dir_jwplayer+"player/player.swf"},options);
					if (jwpnetsream)
						options = jQuery.extend({netstreambasepath: jwpnetsream},options);

					// detecter le besoin du plugin caption ou audiodescription
					var plugins = [];
					if (options['captions.file'])
						// version online du plugin, qui moucharde les visiteurs chez longtail
						plugins.push('captions-2');
						// version locale du plugin, a up avec le player
						// en attente bugfix : http://developer.longtailvideo.com/trac/ticket/1263
						//plugins.push(jwpnetsream+dir_jwplayer+'plugins/captions/captions-h.swf');
					if (options['audiodescription.file'])
						// version online du plugin, qui moucharde les visiteurs chez longtail
						plugins.push('audiodescription-2');
						// version locale du plugin, a up avec le player
						// en attente bugfix : http://developer.longtailvideo.com/trac/ticket/1263
						//plugins.push(jwpnetsream+dir_jwplayer+'plugins/audiodescription/audiodescription-h.swf');

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
