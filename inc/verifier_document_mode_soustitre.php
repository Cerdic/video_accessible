<?php
/**
 * Plugin Videos Accessibles
 * Licence GPL (c) 2011 Cedric Morin yterium pour Temesis
 *
 */

if (!defined("_ECRIRE_INC_VERSION")) return;

function inc_verifier_document_mode_soustitre_dist($infos){

	if (!in_array($infos['extension'],array('srt','xml')))
	  return _T('va:format_soustitre_incorrect');

	return true;
}