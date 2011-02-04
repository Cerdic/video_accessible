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
	if ($flux['args']['exec']=='document_edit'
	  AND $id_document=$flux['args']['id_document']){
		$flux['data'] .= "<div>Editer document $id_document</div>";
	}
	return $flux;
}