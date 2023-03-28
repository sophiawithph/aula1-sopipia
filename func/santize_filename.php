<?php
function santize_filename($filename)
{
    $filename = preg_replace('/[^a-zA-Z0-9.]/', '', $filename);
    return $filename;
}


?>