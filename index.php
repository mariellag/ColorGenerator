<?php
error_reporting(E_ALL);

/* Mariella Gauvreau 
 * CSE 154 AB
 * CP 4
 * This API supports GET requests.
 * GET
 * If sent a GET request, a parameter 'mode' is required to be passed with one of the values:
 * - mode==red/orange/yellow/green/blue/indigo/violet
 *   returns a text file with similar colors to the mode and their hex values
 * - mode===yes/no
 *   returns a JSON object with a phrase about colors
 * If none of the responses correspond to one of the responses on the server,
 * returns a 400 response.
 */ 

if (isset($_GET["mode"])) {
    $mode = strtolower($_GET["mode"]);
    $result;
    if ($mode == "red") {
        $result = get_color();
        if ($result) {
            header("Content-type: text/plain");
            echo $result;
        } else {
            print_error("Invalid mode passed. Please pass mode as color (ROYG.BIV).");
        }
    } else if ($mode == "orange") {
        $result = get_color();
        if ($result) {
            header("Content-type: text/plain");
            echo $result;
        } else {
            print_error("Invalid mode passed. Please pass mode as color (ROYG.BIV).");
        }
    } else if ($mode == "yellow") {
        $result = get_color();
        if ($result) {
            header("Content-type: text/plain");
            echo $result;
        } else {
            print_error("Invalid mode passed. Please pass mode as color (ROYG.BIV).");
        }
    } if ($mode == "green") {
        $result = get_color();
        if ($result) {
            header("Content-type: text/plain");
            echo $result;
        } else {
            print_error("Invalid mode passed. Please pass mode as color (ROYG.BIV).");
        }
    } else if ($mode == "blue") {
        $result = get_color();
        if ($result) {
            header("Content-type: text/plain");
            echo $result;
        } else {
            print_error("Invalid mode passed. Please pass mode as color (ROYG.BIV).");
        }
    } else if ($mode == "indigo") {
        $result = get_color();
        if ($result) {
            header("Content-type: text/plain");
            echo $result;
        } else {
            print_error("Invalid mode passed. Please pass mode as color (ROYG.BIV).");
        }
    } else if ($mode == "violet") {
        $result = get_color();
        if ($result) {
            header("Content-type: text/plain");
            echo $result;
        } else {
            print_error("Invalid mode passed. Please pass mode as color (ROYG.BIV).");
        }
    } else if ($mode == "yes") {
        $result = show_rainbow();
        if ($result) {
            header("Content-type: application/json");
            echo $result;
        } else {
            print_error("Invalid mode passed. Please pass mode as color (ROYG.BIV).");
        }
    } else if ($mode == "no") {
        $result = show_rainbow();
        if ($result) {
            header("Content-type: application/json");
            echo $result;
        } else {
            print_error("Invalid mode passed. Please pass mode as color (ROYG.BIV).");
        }
    }
} else {
    print_error("Missing required GET or POST parameters.");
}

/**
 * Returns a txt file containing all colors similar to the color inputed and their respective
 * hex values.
 * @return {string} - text file formatted:
 *      color: hex value
 *      color: hex value
 */
function get_color() {
    $similar_colors = ($_GET["mode"] . ".txt");
    $colors = file_get_contents($similar_colors);
    return $colors;
}

/**
 * Returns a JSON object for the response to the question (yes/no question asked on the 
 * website page).
 * @return {object} - JSON-formatted object with schema:
 * {
 *  "rainbow" : <answer to response>
 * }
 */
function show_rainbow() {
    $rainbow = ($_GET["mode"] . ".txt");
    $rainbow_colors = file_get_contents($rainbow);
    $individual_colors = explode("\n", $rainbow_colors);
    $colors_arr = $individual_colors[1];
    return JSON_encode(array("rainbow" => $colors_arr ));
}

/**
 * Code and comments taken from Melissa Hovik
 * Outputs a 400 error with the given $msg text (plain text output).
 * @param $msg - error message output.
 */
function print_error($msg) {
    header("HTTP/1.1 400 Invalid Request");
    die($msg);
  }

?>
