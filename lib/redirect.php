<?php

class Redirect {
    
    public function redirectToUrl($url) {
        header("Location: " . $url);
        die;
    }
    
    public function redirect($controlerName, $actionName = DEFAULT_METHOD, $params = null) {
        if (empty($controlerName)) {
            $controlerName = $this->viewFolder;
        }
        $url = '/' . urldecode($controlerName) . '/'
                . urldecode($actionName);
        if ($params != null) {
            $encodedParams = urlencode( $params );
            $url .= '/' . $encodedParams;
        }
        $this->redirectToUrl($url);
    }
}
