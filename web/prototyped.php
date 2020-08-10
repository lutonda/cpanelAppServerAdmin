<?php


function toJson($r){
    $s=json_encode((array)$r);
    $s=str_replace("\\\\",'',$s);
    return str_replace("\u0000AppBundleEntityPlan\u0000",'',$s);
}
function toObject($r){
    return json_decode(is_string($r) ? $r : toJson($r));
}

function toArray($r){
    return (array)toObject($r);
}

function cast($destination, $sourceObject)
{
    if (is_string($destination)) {
        $destination = new $destination();
    }
    $sourceReflection = new ReflectionObject($sourceObject);
    $destinationReflection = new ReflectionObject($destination);
    $sourceProperties = $sourceReflection->getProperties();
    foreach ($sourceProperties as $sourceProperty) {
        $sourceProperty->setAccessible(true);
        $name = $sourceProperty->getName();
        $value = $sourceProperty->getValue($sourceObject);
        if ($destinationReflection->hasProperty($name)) {
            $propDest = $destinationReflection->getProperty($name);
            $propDest->setAccessible(true);
            $propDest->setValue($destination,$value);
        } else {
            $destination->$name = $value;
        }
    }
    return $destination;
}