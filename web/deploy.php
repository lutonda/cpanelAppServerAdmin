<?php
/**
 * GIT DEPLOYMENT SCRIPT
 *
 * Used for automatically deploying websites via GitHub
 * Based on: https://gist.github.com/oodavid/1809044
 */
/*$key = '235698562135484512123';
if ($_GET['key'] != $key){
    header('Location: ./');
    die();
}
  */
// array of commands
$commands = array(
    'echo $PWD',
    'whoami',
    'git checkout -- .', 
    'git pull',
    'git fetch --tags',
    'git status',
    'git submodule sync',
    'git submodule update',
    'git submodule status',
    'composer install',
    'rm -rf var/',
);

chdir("/home/novanet/apps/admin/");
// exec commands
$output = '';
foreach($commands AS $command){
    $tmp = shell_exec($command);
    
    //$output []= "<span style=\"color: #6BE234;\">\$</span><span style=\"color: #729FCF;\">{$command}\n</span><br />";
    $output []= htmlentities(trim($tmp));
}
?>

    <?php print_r(json_encode( $output)) ?>
    