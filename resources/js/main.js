import $ from "jquery";

var url = "http://proyecto-laravel.com";

window.addEventListener("load", function () {
    $(".btn-like").css("cursor", "pointer");
    $("btn-dislike").css("cursor", "pointer");

    // Boton de like
    function like() {
        // Boton de like
        $(document)
            .off("click", ".btn-like")
            .on("click", ".btn-like", function () {
                console.log("like");
                $(this).addClass("btn-dislike").removeClass("btn-like");
                $(this).attr("src", url + "/img/heart-red.png");

                $.ajax({
                    url: url + "/like/" + $(this).data("id"),
                    type: "GET",
                    success: function (response) {
                        if (response.like) {
                            console.log("Has dado like a la publicación");
                        } else {
                            console.log("Error al dar like");
                        }
                    },
                });

                dislike();
            });
    }
    like();

    function dislike() {
        // Boton de dislike
        $(document)
            .off("click", ".btn-dislike")
            .on("click", ".btn-dislike", function () {
                console.log("dislike");
                $(this).addClass("btn-like").removeClass("btn-dislike");
                $(this).attr("src", url + "/img/heart-grey.png");

                $.ajax({
                    url: url + "/dislike/" + $(this).data("id"),
                    type: "GET",
                    success: function (response) {
                        if (response.like) {
                            console.log("Has dado dislike a la publicación");
                        } else {
                            console.log("Error al dar dislike");
                        }
                    },
                });

                like();
            });
    }
    dislike();

    //Buscador

    $("#buscador").on("submit", function (e) {
        $(this).attr("action", url + "/gente/" + $("#search").val());
    });
});
