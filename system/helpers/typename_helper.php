<?php

if ( ! function_exists('getTypenamefromType')) {
    function getTypenamefromType($lang, $storetype) {
        $types = array('restaurants', 'boutiques', 'beautyhealths', 'attractions');
        $typename_en = array('Restaurant', 'Boutique', 'Beauty & Health', 'Attraction');
        $typename_fr = array('Restaurant', 'Boutique', 'Beauté et santé', 'Attraction');
        $typename_cn = array('饭店', '精品店', '美容院', '旅游景点');

        for ($i=0; $i<count($types); $i++) {
            if (strcasecmp($storetype, $types[$i]) == 0) {
                if ($lang == 0)
                    return $typename_en[$i];
                else if ($lang == 1)
                    return $typename_fr[$i];
                else if ($lang == 2)
                    return $typename_cn[$i];
            }
        }
    }
}

?>