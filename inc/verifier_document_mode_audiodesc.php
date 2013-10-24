<?php
/**
 * Plugin Videos Accessibles
 * Licence GPL (c) 2011 Cedric Morin yterium pour Temesis
 *
 */

if (!defined("_ECRIRE_INC_VERSION")) return;

function inc_verifier_document_mode_audiodesc_dist($infos){

	$row = sql_fetsel('*','spip_types_documents','extension='.sql_quote($infos['extension']));
	$media = (isset($row['media_defaut'])?$row['media_defaut']:$row['media']);
	if ($media!=='audio')
	  return _T('va:format_audiodesc_incorrect');

	return true;
}