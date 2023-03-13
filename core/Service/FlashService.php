<?php

namespace Core\Service;

/**
 *
 */
class FlashService
{

    /**
     * @param string $type
     * @param string $message
     * @return void
     */
    public function setFlash(string $type, string $message) : void {
        $_SESSION['flash'][] = array(
            'type' => $type,
            'message' => $message
        );
    }

    /**
     * @return array
     */
    public static function flash() : array {
        $data = array();
        if(!empty($_SESSION['flash'])) {
            foreach ($_SESSION['flash'] as $f) {
                $data[] = $f;
            }
            unset($_SESSION['flash']);
        }
        return $data;
    }
}