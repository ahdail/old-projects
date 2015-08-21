<?php
function getRequests()
{
    //get the default object
    $CI =& get_instance();
    //declare an array of request and add add basic page info
    $requestArray = array();
    $requests = $CI->uri->segment_array();
	foreach ($requests as $request)
    {
        $pos = strrpos($request, ':');
        if($pos >0)
        {
            list($key,$value)=explode(':', $request);
            if(!empty($value) || $value='') $requestArray[$key]=$value;
        }
    }
    return $requestArray ;
} 
?>