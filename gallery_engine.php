<?php
$gallery_dir = 'album';
$root = '/home/www/ppvcup.cz/www/ppvcup.cz/'.$gallery_dir;
$app_root = '/home/www/ppvcup.cz/www/ppvcup.cz'; 
// $root = '/home/www/ppvcup.cz/www/2022.ppvcup.cz/'.$gallery_dir;
// $app_root = '/home/www/ppvcup.cz/www/2022.ppvcup.cz'; 


$post_dir = $_POST['dir'] ?? false;
$psw = $_POST['psw'] ?? '';


function login_form($login_result) {
	$html = '<form class="login_window" method="POST" onsubmit="return form_submit(this)">';
	$html.= '<h2>Zadej heslo</h2>';
	$html.= '<p><input class="psw" type="password" name="psw" placeholder="heslo"></p>';
	$html.= '<p class="login-result">'.$login_result.'</p>';
	$html.= '<button class="btn-send" type="submit">Přihlásit</button>';
	$html.= '</form>';
	return $html;
	}
// test na typ souboru *.jpg
function is_jpg($dir, $file) {
	if (!is_dir($dir."/".$file) && preg_match('~\\.jp[e]?g$~', $file) && $file != "." && $file != "..") { return true; } 
		else { return false; }
	}


// jméno galerie
function gallery_name($database, $folder) {
	if (isset($database) && isset($database[$folder]) && isset($database[$folder]['LABEL'])) { 
		if (isset($database[$folder]['DESCRIPTION'])) { 
			return $database[$folder]['LABEL'].' - <small>'.$database[$folder]['DESCRIPTION'].'</small>';
		}
		return $database[$folder]['LABEL'];
	}
	return $folder;
}

// jméno galerie s popisem
function gallery_label($database, $folder) {

	if (isset($database) && isset($database[$folder]) && isset($database[$folder]['LABEL'])) {
		if (isset($database[$folder]['DESCRIPTION'])) { 
			return $database[$folder]['LABEL'].'<br><small>' . $database[$folder]['DESCRIPTION'] .'</small>';
		}
		return $database[$folder]['LABEL'];
	}
	return $folder; // if everything else fails, label is equal to folder name
}

// ověří heslo do chráněné galerie
// true - heslo není požadováno nebo je zadané platné heslo
// false - heslo je požadováno a nesedí se zadaným
function gallery_psw($database, $folder, $psw) {
	// if ($database == false) { return true; }
	// if (isset($database) && isset($database[$folder]) && isset($database[$folder]['PSW']) && !empty($database[$folder]['PSW'])) {
	// 	if ($database[$folder]['PSW'] === $psw) {
	// 		return true;
	// 	} 
	// } else { return true; }
	// return false;
	if (isset($database) && isset($database[$folder]) && isset($database[$folder]['PSW']) && !empty($database[$folder]['PSW'])) {
		if ($database[$folder]['PSW'] !== $psw) {
			return false;
		}
	}
	return true;
}


// scan dir seřazený podle času
function scan_dir($dir) {
	$ignored = array('.', '..', '.svn', '.htaccess');
	$files = array();    
	foreach (scandir($dir) as $file) {
		if (in_array($file, $ignored)) continue;
		$files[$file] = filemtime($dir . '/' . $file);
		}
	arsort($files);
	$files = array_keys($files);
	return ($files) ? $files : false;
}

// see https://www.php.net/manual/en/function.array-combine.php
function combine_arr($a, $b) {
	if (is_array($a) && is_array($b)) {
		$acount = count($a);
		$bcount = count($b);
		$size = ($acount > $bcount) ? $bcount : $acount;
		$a = array_slice($a, 0, $size);
		$b = array_slice($b, 0, $size);
		return array_combine($a, $b);
	} else {
		return null;
	}
}

// načtení dat ze souboru
function get_data($path) {
	if (($handle = fopen($path, 'r')) !== FALSE) {
		$keys = fgetcsv($handle, 1000, ',');
		$database = array();
		while(!feof($handle)) {
			$row = fgetcsv($handle, 1000, ',');
			// if (!$row) { continue; }
			$row = combine_arr($keys, $row);
			if ($row != null) {
				$database[$row['DIR']] = $row;
			}
		}
		fclose($handle);
	}
	return ($database) ? $database : false;
}



$html = '<!-- OUTPUT -->';
$database = get_data($app_root.'/param.csv');
// $html .= '<br><hr><pre>1. ' . $app_root . ' --- ' .  json_encode($database) . '</pre>';

if ($post_dir) {

	$gallery = $post_dir;
	if (!gallery_psw($database, $gallery, $post_dir)) {
		echo login_form('&nbsp');
		exit;
	}
	$html .= '<ol class="images-grid" data-name="'.gallery_name($database, $gallery).'">';
	$files = scan_dir($root.'/'.$gallery);
	foreach($files as $file) { 
		if (!is_jpg($root.'/'.$gallery, $file)) continue; 
		$html .= '<li class="click"><a href="'.$gallery_dir.'/'.$gallery.'/'.$file.'" class="swipebox" title="'.$file.'">';
		$html .= '<img src="thmb.php?filename='.$root.'/'.$gallery.'/'.$file.'&amp;width=200&amp;height=200" alt="'.$file.'"></a></li>';
	}
	$html .= '</ol>';

} else {
	$html .= '<ol class="gallery-grid">';
	$folders = scan_dir($root);

	foreach($folders as $folder) {
		$folder_path = $root.'/'.$folder;
		if (!is_dir($folder_path)) continue; 

		$label = gallery_label($database, $folder); 

		$files = scan_dir($folder_path);
		if ($files === false) { continue; }
		foreach($files as $file) {
			if (is_jpg($folder_path, $file)) {
				$img = $folder_path.'/'.$file; break;
			} 
		}

		$html .= '<li class="click" title="galerie '.$folder.'" data-folder="'.$folder.'">';
		$html .= '<img src="thmb.php?filename='.$img.'&amp;width=200&amp;height=150" alt="'.$folder.'">';
		$html .= '<div class="gallery-item-label">'.$label.'</div>';
		$html .= '</li>';
	}
	$html.= '</ol>';
	
}
echo $html;

?>