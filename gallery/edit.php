<!doctype html>
<html lang="cs-CZ">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="author" content="Petr Tůma">
<title>Nastavení</title>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/gallery/gallery.css?v=0">

<?php
$gallery_dir = 'album';
$app_dir = '/home/www/ppvcup.cz/www/ppvcup.cz/gallery'; 
$dir = '/home/www/ppvcup.cz/www/ppvcup.cz/gallery/'.$gallery_dir;
$login_result = '&nbsp;';
$login = false;
$post_psw = $_POST['psw'] ?? false;
$post_save = $_POST['save'] ?? false;

function scan_dir($dir) {
    $ignored = array('.', '..', '.svn', '.htaccess');
    $files = array();    
    foreach (scandir($dir) as $file) {
        $folder_path = $dir.'/'.$file;
        if (!is_dir($folder_path)) continue; 
        if (in_array($file, $ignored)) continue;
        $files[$file] = filemtime($dir . '/' . $file);
    }
    arsort($files);
    $files = array_keys($files);
    return ($files) ? $files : false;
    }    

function get_data($path) {
    if (($handle = fopen($path, 'r')) !== FALSE) {
        $database = array();
        while(!feof($handle)) {
            $row = fgetcsv($handle, 1000, ';');
            if ($row) { $database[] = $row; }
            }
        fclose($handle);
        }
    return ($database) ? $database : false;
    }

function save_data($data, $path) {
    if ($data) {
        $rows = array();
        foreach ($data as $row) { $rows[] = '"'.implode('";"', $row).'"'; }  
        $handle = fopen($path, 'w');
        foreach ($rows as $row) { fwrite($handle, $row.PHP_EOL); }  
        fclose($handle);
        }
    }
    
function check_data($data, $dir) {
    $header[] = array_shift($data);
    $folders = scan_dir($dir);
    $search = false;
    $row = array();

    foreach($folders as $folder) { 
        foreach($data as $row) {
            if ($folder == $row[0]) { $search = true; break; }
            $search = false;
            }
        if ($search) { continue; }
        $row = array_fill(0, count($row), '');
        $row[0] = $folder;
        $data[] = $row;
        }

    if ($data) {
        foreach ($data as $row) { $key[] = $row[0]; }
        array_multisort($key, $data); 
        }
    $data = array_merge($header, $data);

    if ($data) {
        $key = array();
        foreach ($data as $row) { $key[] = $row[0]; }
        array_multisort($key, SORT_DESC, $data); 
        }
    return ($data) ? $data : false;
    }
?>

</head>
<body class="gallery-edit">
<div class="align-center">

    <?php
    if ($post_psw) { 
        $psw = $_POST['psw']; 
        $login_result = 'Nesprávné heslo!'; 
        } else { $psw = ''; }

    if ($psw == '256352') { $login = true; } else { $psw = ''; }
    if ($login) {
        if ($post_save == true) { save_data($_POST['data'], 'param.csv'); }
        $data = get_data('param.csv'); 
        $data = check_data($data, $dir);
        ?>

    <form method="POST">
        <div class="imputs">
            <?php
            for($i = 0; $i < Count($data); $i++) {
                $row = $data[$i];
                echo '<div class="row">';
                for($j = 0; $j < Count($row); $j++) { echo '<div><input type="text" name="data['.$i.']['.$j.']" value="'.$row[$j].'"></div>'; }
                if ($i > 0) { echo '<div><button class="btn-del fa fa-times" type="button"></button></div>'; }
                echo '</div>';
                }
            ?>
            </div>

        <input type="hidden" name="psw" value="<?php echo $psw; ?>">
        <input type="hidden" name="save" value="true">
        <button class="btn-send" type="submit">Uložit</button>
        </form>
    <?php } else { ?>
    <form class="login_window" method="POST">
        <h2>Zadej heslo</h2>
        <p><input class="psw" type="password" name="psw" placeholder="heslo"></p>
        <p class="login-result"><?php echo $login_result; ?></p>
        <button class="btn-send" type="submit">Přihlásit</button>
        </form>
    <?php } ?>
    </div>

</body></html>
