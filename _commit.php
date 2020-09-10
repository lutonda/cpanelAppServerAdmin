<?php

for($i=0;$i<rand(17,51);$i++){

exec("echo ' * ' >> README.md");
exec('git add README.md');
exec("git commit -m 'stash'");
exec("git pull");
}
exec("git push");
