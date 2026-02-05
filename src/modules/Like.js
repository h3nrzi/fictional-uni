import $ from "jquery";

class Like {
    constructor() {
        this.events();
    }

    events() {
        $(".like-box").on("click", this.ourClickDispatcher.bind(this))
    }

    ourClickDispatcher(e) {
        const currentLikeBox = $(e.target).closest(".like-box");

        if (currentLikeBox.data("exists") === 'yes')
            this.deleteLike(currentLikeBox);
        else
            this.createLike(currentLikeBox);
    }

    createLike(currentLikeBox) {
        $.ajax({
            beforeSend: (xhr) => {
                xhr.setRequestHeader("X-WP-Nonce", university_data.nonce)
            },
            url: `${university_data.root_url}/wp-json/api/v1/manage-like`,
            type: "POST",
            data: {professor_id: currentLikeBox.data("professorid")},
            success: (res) => {
                console.log(res)
            },
            error: (err) => {
                alert(err.responseText);
                console.error(err)
            }
        })
    }

    deleteLike(currentLikeBox) {
        $.ajax({
            url: `${university_data.root_url}/wp-json/api/v1/manage-like`,
            type: "DELETE",
            success: (res) => {
                console.log(res)
            },
            error: (err) => {
                alert(err.responseText);
                console.log(err)
            }
        })

    }
}

export default Like;
