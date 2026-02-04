import $ from "jquery";

/**
 * Manages CRUD interactions for the logged-in user's notes list.
 */
class MyNotes {
    static SELECTORS = {
        list: "#my-notes",
        deleteButton: ".delete-note",
        editButton: ".edit-note",
        updateButton: ".update-note",
        newTitle: ".new-note-title",
        newBody: ".new-note-body",
        createButton: ".submit-note",
        titleField: ".note-title-field",
        bodyField: ".note-body-field",
    };

    static CLASSES = {
        activeField: "note-active-field",
        updateVisible: "update-note--visible",
    };

    static STATES = {
        editable: "editable",
        readonly: "readonly",
    };

    constructor() {
        this.cacheDom();
        this.bindEvents();
    }

    cacheDom() {
        const S = MyNotes.SELECTORS;
        this.$noteList = $(S.list);
        this.$newTitle = $(S.newTitle);
        this.$newBody = $(S.newBody);
        this.$createButton = $(S.createButton);
    }

    bindEvents() {
        const S = MyNotes.SELECTORS;

        this.$noteList.on("click", S.deleteButton, (event) => this.handleDelete(event));
        this.$noteList.on("click", S.editButton, (event) => this.handleEditToggle(event));
        this.$noteList.on("click", S.updateButton, (event) => this.handleUpdate(event));
        this.$createButton.on("click", (event) => this.handleCreate(event));
    }

    handleDelete(event) {
        const $note = this.getNoteElement(event);

        $.ajax({
            beforeSend: MyNotes.setNonceHeader,
            url: `${university_data.root_url}/wp-json/wp/v2/note/${$note.data("id")}`,
            type: "DELETE",
        })
            .done(() => {
                $note.slideUp();
            })
            .fail(() => {
                console.error("Unable to delete the note. Please try again.");
            });
    }

    handleEditToggle(event) {
        const $note = this.getNoteElement(event);
        const isEditable = $note.data("state") === MyNotes.STATES.editable;

        if (isEditable) {
            this.setNoteReadOnly($note);
        } else {
            this.setNoteEditable($note);
        }
    }

    handleUpdate(event) {
        const $note = this.getNoteElement(event);

        const updatedPost = {
            title: $note.find(MyNotes.SELECTORS.titleField).val(),
            content: $note.find(MyNotes.SELECTORS.bodyField).val(),
        };

        $.ajax({
            beforeSend: MyNotes.setNonceHeader,
            url: `${university_data.root_url}/wp-json/wp/v2/note/${$note.data("id")}`,
            type: "POST",
            data: updatedPost,
        })
            .done(() => {
                this.setNoteReadOnly($note);
            })
            .fail(() => {
                console.error("Unable to save the note. Please try again.");
            });
    }

    handleCreate(event) {
        const newPost = {
            title: this.$newTitle.val(),
            content: this.$newBody.val(),
            status: "publish",
        };

        $.ajax({
            beforeSend: MyNotes.setNonceHeader,
            url: `${university_data.root_url}/wp-json/wp/v2/note`,
            type: "POST",
            data: newPost,
        })
            .done((response) => {
                this.$newTitle.val("");
                this.$newBody.val("");
                this.addNoteToList(response);
            })
            .fail((err) => {
                console.log(err);
                alert(err.responseText)
                console.error("Unable to create the note. Please try again.");
            });
    }

    setNoteEditable($note) {
        const C = MyNotes.CLASSES;
        const S = MyNotes.SELECTORS;

        $note
            .find(S.editButton)
            .html("<i class='fa fa-times' aria-hidden='true'></i> Cancel");

        $note
            .find(`${S.titleField}, ${S.bodyField}`)
            .removeAttr("readonly")
            .addClass(C.activeField);

        $note.find(S.updateButton).addClass(C.updateVisible);

        $note.data("state", MyNotes.STATES.editable);
    }

    setNoteReadOnly($note) {
        const C = MyNotes.CLASSES;
        const S = MyNotes.SELECTORS;

        $note
            .find(S.editButton)
            .html("<i class='fa fa-pencil' aria-hidden='true'></i> Edit");

        $note
            .find(`${S.titleField}, ${S.bodyField}`)
            .attr("readonly", "readonly")
            .removeClass(C.activeField);

        $note.find(S.updateButton).removeClass(C.updateVisible);

        $note.data("state", MyNotes.STATES.readonly);
    }

    addNoteToList(response) {
        const {id, title = {}, content = {}} = response;
        const newNoteHtml = `
      <li data-id="${id}">
        <input class="note-title-field" value="${title.raw ?? ""}" type="text" readonly>
        <span class="edit-note">
          <i class="fa fa-pencil" aria-hidden="true"></i> Edit
        </span>
        <span class="delete-note">
          <i class="fa fa-trash-o" aria-hidden="true"></i> Delete
        </span>
        <textarea class="note-body-field" readonly>${content.raw ?? ""}</textarea>
        <span class="update-note btn btn--blue btn--small">
          <i class="fa fa-arrow-right" aria-hidden="true"></i> Save
        </span>
      </li>
    `;

        const $newNote = $(newNoteHtml).prependTo(this.$noteList);
        this.setNoteReadOnly($newNote);
        $newNote.hide().slideDown("fast");
    }

    static setNonceHeader(xhr) {
        xhr.setRequestHeader("X-WP-Nonce", university_data.nonce);
    }

    getNoteElement(event) {
        return $(event.target).closest("li");
    }
}

export default MyNotes;
