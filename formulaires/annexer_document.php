<?php
/**
 * Plugin Videos Accessibles
 * Licence GPL (c) 2011 Cedric Morin yterium pour Temesis
 *
 */

if (!defined("_ECRIRE_INC_VERSION")) return;

function formulaires_annexer_document_charger_dist($id_document,$mode){
	$mode = preg_replace(',\W,','',$mode);
	include_spip('inc/documents');
	$valeurs = sql_fetsel('id_document,mode,extension','spip_documents','id_document='.intval($id_document));
	if (!$valeurs)
		return array('editable'=>false,'id'=>$id_document);

	$valeurs['id'] = $id_document;
	$valeurs['_hidden'] = "<input name='id_document' value='$id_document' type='hidden' />";
	$valeurs['mode'] = $mode; // pour les id dans le dom
	$annexe = va_annexe($id_document,$mode);
	if ($annexe)
		$valeurs['id_annexe'] = $annexe['id_document'];
	if ($annexe)
		$annexe['type_document'] = sql_getfetsel('titre as type_document','spip_types_documents','extension='.sql_quote($annexe['extension']));
	$valeurs['annexe'] = $annexe;
	$valeurs['_pipeline'] = array('editer_contenu_objet',array('type'=>'annexer_document','mode'=>$mode,'id'=>$id_document));

	return $valeurs;
}

function formulaires_annexer_document_verifier_dist($id_document,$mode){
	$mode = preg_replace(',\W,','',$mode);
	$erreurs = array();
	if (_request('supprimer')){

	}
	else {
		$annexe = va_annexe($id_document,$mode);
		$id = $annexe['id_document'];
		$verifier = charger_fonction('verifier','formulaires/joindre_document');
		$erreurs = $verifier($id,0,'',$mode);
	}
	return $erreurs;
}

function formulaires_annexer_document_traiter_dist($id_document,$mode){
	$mode = preg_replace(',\W,','',$mode);
	$annexe = va_annexe($id_document,$mode);
	$id = $annexe['id_document'];
	$res = array('editable'=>true);
	if (_request('supprimer')){
		$supprimer_document = charger_fonction('supprimer_document','action');
		if ($id)
			$supprimer_document($id);
		$res['message_ok'] = _T('va:document_annexe_'.$mode.'_supprime');
	}
	else {
		$ajouter_documents = charger_fonction('ajouter_documents', 'action');

		include_spip('inc/joindre_document');
		$files = joindre_trouver_fichier_envoye();

		$ajoute = $ajouter_documents($id,$files,'document',$id_document,$mode);

		if (is_numeric(reset($ajoute))
		  AND $id = reset($ajoute)){
			$res['message_ok'] = _T('medias:document_installe_succes');
		}
		else
			$res['message_erreur'] = reset($ajoute);
	}

	return $res;
}

function va_annexe($id_document,$mode){
	return sql_fetsel('*',
		'spip_documents as d JOIN spip_documents_liens as L on L.id_document=d.id_document',
		"L.objet='document' AND L.id_objet=".intval($id_document)." AND d.mode=".sql_quote($mode));
}
?>