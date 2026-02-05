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

        if (currentLikeBox.attr("data-exists") === 'yes')
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
                currentLikeBox.attr("data-exists", "yes");
                let likeCount = parseInt(currentLikeBox.find(".like-count").html(), 10);
                likeCount++;
                currentLikeBox.find(".like-count").html(likeCount);
                currentLikeBox.attr("data-like", res)
            },
            error: (err) => {
                alert(err.responseText);
            }
        })
    }

    deleteLike(currentLikeBox) {
        $.ajax({
            beforeSend: (xhr) => {
                xhr.setRequestHeader("X-WP-Nonce", university_data.nonce)
            },
            url: `${university_data.root_url}/wp-json/api/v1/manage-like/${currentLikeBox.attr("data-like")}`,
            type: "DELETE",
            success: (res) => {
                currentLikeBox.attr("data-exists", "no");
                let likeCount = parseInt(currentLikeBox.find(".like-count").html(), 10);
                likeCount--;
                currentLikeBox.find(".like-count").html(likeCount);
                currentLikeBox.attr("data-like", "")
            },
            error: (err) => {
                alert(err.responseText);
            }
        })

    }
}

export default Like;
