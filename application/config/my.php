<?php

return array(
    
    // NOTE: Keys muessen lower-case sein!
    
    /**
     * Physischer Pfad zum Images-Verzeichnis.
     * Relativ zu DOCUMENT_ROOT (z.B. 'public_html' in XAMPP).
     * Beispiel: '../apps/marks-images'
     */
    'images#path' => '@img.path@',
    
    /**
     * Base URL, unter welcher die Images erreichbar sind.
     * Der Host-Name (z.B. http://localhost/) wird automatisch ermittelt.
     * Beispiel: 'marks-images'.
     *           Ein einzelnes Bild muss dann z.B. so
     *           erreichbar sein: 'http://localhost/marks-images/123-thumb.jpg'
     */
    'images#url' => '@img.url@',
    
    'bookmarks#per_page' => 10,
    'favorites#per_page' => 15,
    
    'build#version' => '@project.version@',
    'build#timestamp' => '@timestamp@',
);
