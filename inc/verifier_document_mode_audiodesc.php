<?php
/**
 * Plugin Videos Accessibles
 * Licence GPL (c) 2011 Cedric Morin yterium pour Temesis
 *
 */

if (!defined("_ECRIRE_INC_VERSION")) return;

function inc_verifier_document_mode_audiodesc_dist($infos){

	$media = sql_getfetsel('media','spip_types_documents','extension='.sql_quote($infos['extension']));
	if ($media!=='audio')
	  return _T('va:format_audiodesc_incorrect');

	return true;
}