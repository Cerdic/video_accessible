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