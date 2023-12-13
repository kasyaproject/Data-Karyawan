// public/js/search.js
$(document).ready(function () {
    $("#searchInput").on("keyup", function () {
        let search = $(this).val();
        if (search.length >= 3) {
            // Only trigger the search after at least 3 characters
            $.ajax({
                url: "/search",
                method: "GET",
                data: { search: search },
                success: function (response) {
                    $("#searchResults").html(response);
                },
            });
        } else {
            $("#searchResults").html("");
        }
    });
});
