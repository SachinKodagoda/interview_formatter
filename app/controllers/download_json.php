<?php
function download_json($file)
{
    header("Content-type: text/json");
    ob_end_clean();
    header("Content-Disposition: attachment; filename=test_customer.json");
    print $file;
}
