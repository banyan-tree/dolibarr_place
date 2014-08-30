<?php
//var_dump($linked_resources);

$form= new Form($db);


if( (array) $linked_resources && count($linked_resources) > 0)
{
	$var=false;

	// TODO: DEBUT DU TPL
	if($mode == 'edit' )
	{

		print '<div class="tagtable centpercent noborder allwidth">';
		print '<form class="tagtr liste_titre">';
		print '<div class="tagtd">'.$langs->trans('Place').'</div>';
		print '<div class="tagtd">'.$langs->trans('Busy').'</div>';
		print '<div class="tagtd">'.$langs->trans('Mandatory').'</div>';
		print '<div class="tagtd">'.$langs->trans('Edit').'</div>';
		print '</form>';
		//print '</div>';

	}
	else
	{

		print '<div class="tagtable centpercent noborder allwidth">';
		print '<form class="tagtr liste_titre">';
		print '<div class="tagtd">'.$langs->trans('Place').'</div>';
		print '<div class="tagtd">'.$langs->trans('Busy').'</div>';
		print '<div class="tagtd">'.$langs->trans('Mandatory').'</div>';
		print '<div class="tagtd">'.$langs->trans('Edit').'</div>';
		print '</form>';
		//print '</div>';

	}


	foreach ($linked_resources as $linked_resource)
	{
		$var=!$var;
		$object_resource = fetchObjectByElement($linked_resource['resource_id'],$linked_resource['resource_type']);
		if($mode == 'edit' && $linked_resource['rowid'] == GETPOST('lineid'))
		{

			print '<form class="tagtr '.($var==true?'pair':'impair').'" action="'.$_SERVER["PHP_SELF"].'?element='.$element.'&element_id='.$element_id.'" method="POST">';
			print '<input type="hidden" name="token" value="'.$_SESSION['newtoken'].'" />';
			print '<input type="hidden" name="id" value="'.$object->id.'" />';
			print '<input type="hidden" name="action" value="update_linked_resource" />';
			print '<input type="hidden" name="resource_type" value="'.$resource_type.'" />';
			print '<input type="hidden" name="lineid" value="'.$linked_resource['rowid'].'" />';

			print '<div class="tagtd">'.$object_resource->getNomUrl(1).'</div>';
			print '<div class="tagtd">'.$form->selectyesno('busy',$linked_resource['busy']?1:0,1).'</div>';
			print '<div class="tagtd">'.$form->selectyesno('mandatory',$linked_resource['mandatory']?1:0,1).'</div>';
			print '<div class="tagtd"><input type="submit" class="button" value="'.$langs->trans("Update").'"></div>';
			print '</form>';

		}
		else
		{
			$style='';
			if($linked_resource['rowid'] == GETPOST('lineid'))
				$style='style="background: orange;"';

			print '<div class="tagtr '.($var==true?"pair":"impair").'" '.$style.'>';

			print '<div class="tagtd">';
			print $object_resource->getNomUrl(1);
			print '</div class="tagtd">';

			print '<div class="tagtd">';
			print $linked_resource['busy']?1:0;
			print '</div>';

			print '<div class="tagtd">';
			print $linked_resource['mandatory']?1:0;
			print '</div>';

			print '<div class="tagtd">';
			print '<a href="'.$_SERVER['PHP_SELF'].'?action=delete_resource&element='.$element.'&element_id='.$element_id.'&lineid='.$linked_resource['rowid'].'">'.$langs->trans('Delete').'</a>';
			print '<a href="'.$_SERVER['PHP_SELF'].'?mode=edit&resource_type='.$linked_resource['resource_type'].'&element='.$element.'&element_id='.$element_id.'&lineid='.$linked_resource['rowid'].'">'.$langs->trans('Edit').'</a>';
			print '</div>';

			print '</div>';
		}


	}
	print '</div>';




}
else {
	print '<div class="warning">'.$langs->trans('NoResourceLinked').'</div>';

}
// FIN DU TPL
