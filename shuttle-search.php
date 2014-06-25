<?php
/**
 * Search the Shuttle.app configuration file.
*/
$search_term   = $argv[1];// The search term passed in from Alfred
$user_folder   = $_SERVER['HOME'];// Get the current users home directory
$file_contents = file_get_contents($user_folder.'/.shuttle.json');// Get the contents of the .shuttle.json file
$connections   = json_decode($file_contents, true);// Put the connections from the file into an array
$cnt           = 0;
$results       = array();
$all_hosts     = array();

foreach($connections['hosts'] as $groups){// Loop over all of the hosts
    foreach($groups as $group){// Loop over all of the host groups (e.g. home, work, etc.)
        $all_hosts = array_merge($all_hosts, $group);// Merge the groups into a single array
    }
}

foreach($all_hosts as $host){// Loop over all of the merged hosts and look for matches
    if(stristr($host['name'], $search_term)){
        $results[$cnt]['title']    = $host['name'];
        $results[$cnt]['subtitle'] = $host['cmd'];
        $results[$cnt]['uid']      = $host['name'];
        $results[$cnt]['arg']      = $host['cmd'];
        $results[$cnt]['valid']    = 'yes';

        $cnt++;
    }
}

if(count($results) > 0){
    // Create the XML output
    $xmlObject = new SimpleXMLElement("<items></items>");
    foreach($results as $rows){
    	$node_object = $xmlObject->addChild('item');
    	$node_keys   = array_keys($rows);

    	foreach($node_keys as $key){
            switch($key){
                case 'uid':
                    $node_object->{'addAttribute'}($key, $rows[$key]);
                break;

                case 'arg':
                    $node_object->{'addAttribute'}($key, $rows[$key]);
                break;
                
                case 'valid':
                    $node_object->{'addAttribute'}($key, $rows[$key]);
                break;
                
                case 'title':
                    $node_object->{'addChild'}($key, $rows[$key]);
                break;

                case 'subtitle':
                    $node_object->{'addChild'}($key, $rows[$key]);
                break;
            }
        }
    }

    // Print the XML output
    print $xmlObject->asXML();  
}