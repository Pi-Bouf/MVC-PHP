// ❄
(function() {
    window.onload = function() {
        var screenWidth = windowWidth();
        var screenHeight = windowHeight();
        var body = _tn("body")[0];

        function makeOne() {
            var top = -20;
            var left = (Math.random() * screenWidth);
            var fontSize = parseInt(Math.random() * 12 + 11);
            console.log(fontSize);
            var style = {
                "position": "fixed",
                "color": "white",
                "top": top + "px",
                "left": left + "px",
                "user-select": "none",
                "font-size": fontSize + "px"
            }
            var snow = _cn("div", {}, style, body);
            snow.innerHTML = "❄";
            var intervalMove = setInterval(function() {
                // Move
                top++;
                snow.css({ "top": top + "px" });
                // If snow is outside the screen, destroy it !
                if (top > screenHeight) {
                    clearInterval(intervalMove);
                    _dn(snow);
                }
            }, 30);
        }

        setInterval(makeOne, 800);
    }
})();