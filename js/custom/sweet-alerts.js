(function ($) {
    "use strict";
    
    $('.basic-alert').on("click", function () {
        swal("Hello world!");
    });

    $('.title-alert').on("click", function () {
        swal("Here's a message!", "It's pretty, isn't it?");
    });

    $('.success-alert').on("click", function () {
        swal("Good job!", "You clicked the button!", "success");
    });

    $('.warning-message-alert').on("click", function () {

        swal({
                title: "Are you sure?",
                text: "Your will not be able to recover this imaginary file!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn btn-danger",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false,
                className:'swal-button'
            },
            function () {
                swal("Deleted!", "Your imaginary file has been deleted.", "success");
            });
    });


    $('.custom-img-alert').on("click", function () {
        swal({
            title: "Sweet!",
            text: "Here's a custom image.",
            icon: 'http://via.placeholder.com/150x150'
        });
    });

    $('.loader-alert').on("click", function () {
        swal("Are you sure you want to do this?", {
            buttons: ["Oh noez!", "Aww yiss!"],
        });
    });

    $('.error-alert').on("click", function () {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then(function(willDelete) {
            if (willDelete) {
                swal("Poof! Your imaginary file has been deleted!", {
                    icon: "success",
                });
            } else {
                swal("Your imaginary file is safe!");
            }
        });
    });


    $('.html-alert').on("click", function () {
        swal({
            title: "HTML Title!",
            text: "A custom html message.",
            html: true
        });
    });

    $('.password-alert').on("click", function () {
        swal({
            title: "Enter the password",
            content: {
                element: "input",
                attributes: {
                    placeholder: "Type your password",
                    type: "password",
                },
            },
        });
    });


    $('.search-alert').on("click", function () {
        swal({
            text: 'Search for a movie. e.g. "Hello Everyone".',
            content: "input",
            button: {
                text: "Search!",
                closeModal: false,
            },
        })
        .then(function(name) {
            if (!name) throw null;

            return fetch('https://itunes.apple.com/search?term='+name+'&entity=movie');
        })
        .then(function(results) {
            return results.json();
        })
        .then(function(json) {
            var movie = json.results[0];

            if (!movie) {
                return swal("No movie was found!");
            }

            var name = movie.trackName;
            var imageURL = movie.artworkUrl100;

            swal({
                title: "Top result:",
                text: name,
                icon: imageURL,
            });
        })
        .catch(function(err) {
            if (err) {
                swal("Oh noes!", "The AJAX request failed!", "error");
            } else {
                swal.stopLoading();
                swal.close();
            }
        });
    });

    $('.custom-alert').on("click", function () {
        swal({
            title: "Sweet!",
            text: "Here's a custom image.",
            className: "custom-swal-modal",
        });
    });
})(jQuery);

