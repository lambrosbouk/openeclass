<script type="text/javascript" src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
$("#auto_judge1").click(function(){
$("tr:last").hide();
});
});

$(document).ready(function(){
$("#auto_judge2").click(function(){
$("tr:last").show();
});
});
</script>

<?php

/* ========================================================================
 * Open eClass 3.0
 * E-learning and Course Management System
 * ========================================================================
 * Copyright 2003-2013  Greek Universities Network - GUnet
 * A full copyright notice can be read in "/info/copyright.txt".
 * For a full list of contributors, see "credits.txt".
 *
 * Open eClass is an open platform distributed in the hope that it will
 * be useful (without any warranty), under the terms of the GNU (General
 * Public License) as published by the Free Software Foundation.
 * The full license can be read in "/info/license/license_gpl.txt".
 *
 * Contact address: GUnet Asynchronous eLearning Group,
 *                  Network Operations Center, University of Athens,
 *                  Panepistimiopolis Ilissia, 15784, Athens, Greece
 *                  e-mail: info@openeclass.org
 * ======================================================================== */


// Check if user is administrator and if yes continue
// Othewise exit with appropriate message
$require_admin = true;
require_once '../../include/baseTheme.php';
require_once 'modules/auth/auth.inc.php';
$nameTools = $langAutoJudge;
$navigation[] = array('url' => 'index.php', 'name' => $langAdmin);

$available_themes = active_subdirs("$webDir/template", 'theme.html');

// Save new auto_judge.php
if (isset($_POST['submit'])) {
   set_config('connector', $_POST['auto_judge']);
   if ($_POST['auto_judge']=='HackerEarth'){ 
    set_config('hackerEarthKey', $_POST['formhackerEarthKey']);
	set_config('connector', $_POST['auto_judge']);

    // Display result message
    $tool_content .= "<div class='alert alert-success'>$langHackerEarthKeyUpdated</div>";
	}
	else
	// Display result message
    $tool_content .= "<div class='alert alert-success'>$langCodePad</div>";
	
} // end of if($submit)
// Display auto_judge.php edit form
else {
    $tool_content .= "<form action='$_SERVER[SCRIPT_NAME]' method='post'>
                <fieldset><legend>$langBasicCfgSetting</legend>
	<table class='tbl' width='100%'>
	 <tr>
		<th width='300' class='left'>Επιλογή επιθυμητού connector:</th></tr>
	
	<tr>
		<td><input type='radio' id='auto_judge1' name='auto_judge' value='Codepad'/> CodePad.org</td>
	</tr> 
	<tr>
	    <td><input type='radio' id='auto_judge2' name='auto_judge' value='HackerEarth' checked/> HackerEarth</td>
	</tr>

	<tr>
	   <th width='300' class='left'><b>$langHackerEarth</b></th>
	   <td><input class='FormData_InputText' type='text' name='formhackerEarthKey' size='40' value='" . q(get_config('hackerEarthKey')) . "'></td>
	</tr>
	
	"	;
    $tool_content .= "</table></fieldset>";
    $tool_content .= "<input class='btn btn-primary' type='submit' name='submit' value='$langModify'> </form>";
    
}

// Display link to index.php
$tool_content .= action_bar(array(
    array('title' => $langBack,
        'url' => "index.php",
        'icon' => 'fa-reply',
        'level' => 'primary-label')));
draw($tool_content, 3, null, $head_content);

