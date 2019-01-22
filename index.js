/**
* Name: Mariella Gauvreau
* Date: November 14, 2018
* Section: CSE 154 AB
* This is the JS to implement the UI for my color generator page. It makes calls to my php file
* to retrieve data. Similar colors are taken from an API and used to fill the website.
*/

(function() {
    "use strict";
    const URL = "index.php";
    window.addEventListener("load", initialize);

    /**
     * When the 'generate' button is pressed, learnMore is called. When 'exploreColors' button is
     * pressed, findColor is called.
     */
    function initialize() {
        $("generate").addEventListener("click", learnMore);
        $("exploreColors").addEventListener("click", findColor);
    }

    /**
     * Fetches information from a php based on input from the user. Fetches a phrase based on
     * the user's response.
     */
    function learnMore() {
        let learnMoreUrl = URL + "?mode=" + $("learn").value;

        fetch (learnMoreUrl, {mode: "cors"})
            .then(checkStatus)
            .then(JSON.parse)
            .then(learn)
            .then(console.log);
        $("generate").classList.add("hidden");
        $("exploreColors").classList.remove("hidden");
        $("dropdown").classList.remove("hidden");
        $("intro").classList.add("hidden");
    }

    /**
     * Fetches information from a php based on a color chosen by the user. This fetch add similar
     * colors to the webpage.
     */
    function findColor() {
        let colorAndUrl = URL + "?mode=" + $("colorDropdown").value;

        fetch (colorAndUrl)
            .then(checkStatus)
            .then(changeColors)
            .then(console.log);

        $("roygbiv").classList.add("hidden");
        $("generate").classList.add("hidden");
        $("mainbox").classList.remove("hidden");
        $("similar").innerText = "Here are similar colors to " + $("colorDropdown").value;
        $("similar").classList.remove("hidden");
    }

    /**
     * A response of text is added to the center of the website based on the user's response.
     * @param {string} data - JavaScript object described as a String after a JSON string was
     * parsed
     */
    function learn(data) {
        $("rainbow").innerText = data.rainbow;
        $("rainbow").classList.remove("hidden");
        $("learn").classList.add("hidden");
    }

    /**
     * Boxes are displayed on the screen with similar colors to the color selected by the user.
     * The boxes also display the name of the color they have.
     * @param {string} data - text file used to show similar colors.
     */
    function changeColors(data) {
        let similarColorsList = data.split("\n");
        for (let i = 0; i < similarColorsList.length; i++) {
            $("box" + (i + 1)).innerText =
            similarColorsList[i].substring(0, similarColorsList[i].indexOf(":"));
            $("box" + (i + 1)).style["background-color"] =
                    similarColorsList[i].substring(similarColorsList[i].indexOf(":") + 1);
        }
    }

    /**
    * Helper function to return the response's result text if successful, otherwise
    * returns the rejected Promise result with an error status and corresponding text
    * @param {object} response - response to check for success/error
    * @return {object} - valid result text if response was successful, otherwise rejected
    *                    Promise result
    */
    function checkStatus(response) {
        if (response.status >= 200 && response.status < 300 || response.status == 0) {
            return response.text();
        } else {
          return Promise.reject(new Error(response.status + ": " + response.statusText));
        }
      }
    
    /**
    * Returns the element that has the ID attribute with the specified value.
    * @param {string} id - element ID
    * @return {object} DOM object associated with id.
    */
    function $(id) {
    return document.getElementById(id);
    }

})();