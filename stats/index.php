<?php
/*
 * @version $Id$
 ----------------------------------------------------------------------
 GLPI - Gestionnaire Libre de Parc Informatique
 Copyright (C) 2003-2006 by the INDEPNET Development Team.
 
 http://indepnet.net/   http://glpi.indepnet.org
 ----------------------------------------------------------------------

 LICENSE

	This file is part of GLPI.

    GLPI is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    GLPI is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with GLPI; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 ------------------------------------------------------------------------
*/

// ----------------------------------------------------------------------
// Original Author of file: 
// Purpose of file:
// ----------------------------------------------------------------------
 
include ("_relpos.php");
include ($phproot . "/glpi/includes.php");

checkAuthentication("normal");

commonHeader($lang["title"][11],$_SERVER["PHP_SELF"]);

// titre
        echo "<div align='center'><table border='0'><tr><td>";
        echo "<img src=\"".$HTMLRel."pics/statistiques.png\" alt='".$lang["Menu"][13]."' title='".$lang["Menu"][13]."'></td><td><span class='icon_sous_nav'><b>".$lang["Menu"][13]."</b></span>";
        echo "</td></tr></table></div>";


//Affichage du tableau de présentation des stats
echo "<div align='center'><table class='tab_cadre' cellpadding='5'>";
echo "<tr><th>".$lang["stats"][0].":</th></tr>";


	echo  "<tr class='tab_bg_1'><td align='center'><a href=\"stat_global.php\"><b>".$lang["stats"][1]."</b></a></td></tr>";
	echo  "<tr class='tab_bg_1'><td align='center'><a href=\"stat_technicien.php\"><b>".$lang["stats"][2]."</b></a></td></tr>";
	echo  "<tr class='tab_bg_1'><td align='center'><a href=\"stat_enterprise.php\"><b>".$lang["stats"][42]."</b></a></td></tr>";
	echo  "<tr class='tab_bg_1'><td align='center'><a href=\"stat_lieux.php\"><b>".$lang["stats"][3]."</b></a><br> (".$lang["common"][15]
	.", ".$lang["common"][17]	= "Type".", ".$lang["computers"][9]	= "OS".", ".$lang["computers"][21].", ".$lang["computers"][36]
	.", ".$lang["devices"][2].", ".$lang["devices"][5].")</td></tr>";
	echo  "<tr class='tab_bg_1'><td align='center'><a href=\"stat_user.php\"><b>".$lang["stats"][4]."</b></a></td></tr>";
	echo  "<tr class='tab_bg_1'><td align='center'><a href=\"stat_category.php\"><b>".$lang["stats"][36]."</b></a></td></tr>";
	echo  "<tr class='tab_bg_1'><td align='center'><a href=\"stat_priority.php\"><b>".$lang["stats"][39]."</b></a></td></tr>";


echo "</table></div>";

commonFooter();
?>
