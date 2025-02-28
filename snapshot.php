<?php

require("config.inc.php");

$camera = intval( $_GET['camera'] );

if (!isset($cameraInfo) || !is_array($cameraInfo) ) {
    print "Error: No camera requested.";
    exit;
}


/**
 * @param $cameraInfo
 * @return bool|string
 * @throws Exception
 */
function getCameraImage($cameraInfo) {

    if (!isset($cameraInfo)) {
        throw new Exception("Camera not found");
    }

    $curl_handle=curl_init();
    curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($curl_handle,CURLOPT_URL,$cameraInfo['url']);
    curl_setopt($curl_handle, CURLOPT_USERPWD, $cameraInfo['user'] . ":" . $cameraInfo['pass']);

    $buffer = curl_exec($curl_handle);
    curl_close($curl_handle);
    return $buffer;
}

function displayCameraError()
{
    if (file_exists(__DIR__ . '/images/no-photo-alt.png')) {
        $buffer = fopen(__DIR__ . '/images/no-photo-alt.png', 'rb');
        header("Content-Type: image/jpeg");
        return fpassthru($buffer);
    }
    return false;
}

try {

    /**
     * Since each camera might have a different URL pattern, we need to handle each one differently
     * Note: The "case" is the camera position in the grid layout:
     * ┌───┬───┐
     * │ 1 │ 2 │
     * ├───┼───┤
     * │ 3 │ 4 │
     * └───┴───┘
     */

    switch ($camera) {
        case 1:
            if ($cameraInfo[1]['url']) {
                $cameraInfo[1]['url'] = 'http://'. $cameraInfo[1]['user'] . ':' . $cameraInfo[1]['pass'] . '@' . $cameraInfo[1]['url'];
            } else {
                return displayCameraError();
            }
            break;
        case 2:
            $cameraInfo[2]['url'] = $cameraInfo[2]['url'] . $cameraInfo[2]['user'] . '&pwd=' . $cameraInfo[2]['pass'];
            break;
        case 3:
            if ($cameraInfo[3]['url']) {
                $cameraInfo[3]['url'] = $cameraInfo[3]['url'] . $cameraInfo[3]['user'] . '&pwd=' . $cameraInfo[3]['pass'];
            } else {
                return displayCameraError();
            }
            break;
        case 5:
            if ($cameraInfo[5]['url']) {
                $cameraInfo[5]['url'] = 'http://'. $cameraInfo[5]['user'] . ':' . $cameraInfo[5]['pass'] . '@' . $cameraInfo[5]['url'];
            } else {
                return displayCameraError();
            }

            break;
        // These cameras don't require any URL manipulation
        case 4:
            break;
        default:
            $buffer = null;
            throw new Exception("Camera not found");
    }

    $buffer = getCameraImage( $cameraInfo[$camera] );

    // Output the image, if there is one...
    if (empty($buffer)) {
        print "";
    } elseif( $buffer == "Can not get image.") {
        print "Can not get image.";
    } else {
        header("Content-Type: image/jpeg");
        print $buffer;
    }
} catch (Exception $e) {
    print "Error: " . $e->getMessage();
    exit();
}
