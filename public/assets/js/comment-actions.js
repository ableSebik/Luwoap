document.addEventListener("DOMContentLoaded", function () {
    const deleteButtons = document.querySelectorAll(".delete-btn");
    const statusOptions = document.querySelectorAll(".status-option");
    const deleteForm = document.getElementById("deleteForm");
    const statusForm = document.getElementById("update-status-form");

    // Set delete form action
    deleteButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const commentId = this.dataset.id;
            deleteForm.action = `/comment/${commentId}/delete`;
        });
    });
    // Set status form action and update status
    $(".status-option").on("click", function (event) {
        event.preventDefault();

        const status = $(this).data("status");
        const commentId = $("#commentModal")
            .find("#modalClientEmail")
            .data("comment-id");
        const form = $("#update-status-form");

        // Ensure the form's action URL is set correctly
        form.attr("action", `/comment/${commentId}/status`);

        // Update the hidden input field with the new status value
        const statusInput = $("<input>")
            .attr("type", "hidden")
            .attr("name", "status")
            .attr("value", status);

        form.append(statusInput);

        // Submit the form
        form.submit();
    });
});

$(document).ready(function () {
    $("#commentModal").on("show.bs.modal", function (event) {
        var button = $(event.relatedTarget);
        var name = button.data("name");
        var commentId = button.data("id");
        var phone = button.data("phone");
        var email = button.data("email");
        var status = button.data("status");
        var comment = button.data("comment");
        var propId = button.data("prop-id");
        var createdAt = button.data("created-at");
        var hrSince = button.data("hr-since");
        var daysSince = button.data("days-since");

        var modal = $(this);
        modal.find("#modalClientName").text(name);
        modal.find("#modalClientStatus").text(status);
        modal
            .find("#modalClientEmail")
            .data("comment-id", commentId)
            .text(email); // Storing commentId in a data attribute
        modal.find("#modalClientPhone").text(phone);
        modal.find("#modalClientComment").text(comment);
        modal
            .find("#modalViewProperty")
            .attr("href", "/props/details/" + propId);

        if (hrSince < 24) {
            modal.find("#modalTimeSince").text(hrSince + " hrs ago.");
        } else if (daysSince <= 3) {
            modal.find("#modalTimeSince").text(daysSince + " days ago.");
        } else {
            modal.find("#modalTimeSince").text(createdAt);
        }
    });
});
