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

        if (currentLikeBox.data("exists") === 'yes')xxcc
            this.deleteLike();
        else
            this.createLike();
    }

    createLike() {
        $.ajax({
            url: `${university_data.root_url}/wp-json/api/v1/manage-like`,
            type: "POST",
            success: (res) => {
                console.log(res)
            },
            error: (err) => {
                console.log(err)
            }
        })
    }

    deleteLike() {
        $.ajax({
            url: `${university_data.root_url}/wp-json/api/v1/manage-like`,
            type: "DELETE",
            success: (res) => {
                console.log(res)
            },
            error: (err) => {
                console.log(err)
            }
        })

    }
}

export default Like;
