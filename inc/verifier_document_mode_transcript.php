<?php
/**
 * Plugin Videos Accessibles
 * Licence GPL (c) 2011 Cedric Morin yterium pour Temesis
 *
 */

if (!defined("_ECRIRE_INC_VERSION")) return;

function inc_verifier_document_mode_transcript_dist($infos){

	$media = sql_getfetsel('media','spip_types_documents','extension='.sql_quote($infos['extension']));
	if (in_array($media,array('audio','video','image')))
	  return _T('va:format_transcript_incorrect');

	return true;
}