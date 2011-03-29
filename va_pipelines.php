<?php
/**
 * Plugin Videos Accessibles
 * Licence GPL (c) 2011 Cedric Morin yterium pour Temesis
 *
 */

/**
 * Completer la page d'edition d'un document
 * pour joindre sous-titrage, audio-desc et transcript sur les videos
 * 
 * @param array $flux
 * @return array
 */
function va_affiche_milieu($flux){
	if (in_array($flux['args']['exec'],array('document_edit','documents_edit'))
	  AND $id_document=$flux['args']['id_document']){
		$flux['data'] .= recuperer_fond('prive/squelettes/inclure/enrichir-video',array('id_document'=>$id_document));
	}
	return $flux;
}

/**
 * Insertion dynamique du js en pied de page,
 * uniquement en presence de video sur la page
 * 
 * @param string $flux
 * @return string
 */
function va_affichage_final($flux){
	if (stripos($flux,'video-jwplayer')){
		$script = find_in_path('javascript/jwplayer.init.js');
		include_spip('filtres/compresseur');
		if (function_exists('compacte'))
			$script = compacte($script,'js');
	  lire_fichier($script, $js);
	  $js = "var dir_jwplayer='"._DIR_PLUGIN_VA."jwplayer/';".$js;
	  $js = '<script type="text/javascript">/*<![CDATA[*/'.$js.'/*]]>*/</script>';
	  if ($p=stripos($flux,'</body>'))
		  $flux = substr_replace($flux,$js,$p,0);
	  else
		  $flux .= $js;
	}
	return $flux;
}

/**
 * Insertion statique dans l'espace prive, car on ne sait pas faire mieux pour le moment,
 *
 * @param string $flux
 * @return string
 */
function va_header_prive($flux){
	$js = "var dir_jwplayer='"._DIR_PLUGIN_VA."jwplayer/';";
	$js = '<script type="text/javascript">/*<![CDATA[*/'.$js.'/*]]>*/</script>';
	$js .= "<script type='text/javascript' src='".find_in_path('javascript/jwplayer.init.js')."'></script>";
	$flux .= $js;
	return $flux;
}