$(document).ready(function() {
    /**
     *  Invoked when the specified element looses focus.
     *  Calls function onInputChange().
     *
     *  @param   eventObject
     */
    $(".autosave-input").on("focusout", function(event) {
        $.fn.onInputChange("focusout", $(this), 0);
    });
    /**
     *  Invoked when the user presses the enter key with the
     *  focused.
     *
     * @param   eventObject
     */
    $(".autosave-input").on("keyup", function (event) {
        $.fn.onInputChange("keyup", $(this), event.keyCode);
    });
    /**
     *  This function is called when the events focus out or key up
     *  are triggered for an input element.
     *
     *  @param   string  Name of event
     *  @param   element The trigger element
     *  @param   string  event.keyCode
     */
    $.fn.onInputChange = function(eventType, element, keyCode) {
        if (eventType === "focusout") {
            // Make sure no save is in progress.
            if (window.autosaveInProgress !== true) {
                $.fn.updateGroup(element);
            }
        } else if (eventType === "keyup" && keyCode === 13) {
            // Set a global variable to prevent the update function
            // to run twice when the input element loses focus.
            window.autosaveInProgress = true;
            $.fn.updateGroup(element);
            // Remove the focus
            element.blur();
        }
    }
    /**
     * Updates a group.
     *
     * @param   HTML element
     */
    $.fn.updateGroup = function (element) {
        var element = element || false;
        if (element === false)
            return false;
        // Get both the old and new value, and compare them before proceeding.
        var oldValue = element.attr("data-value");
        var newValue = element.val();
        if (oldValue != newValue) {
            // Create a form data object with the id and new category name.
            var formData    = new FormData();
            var categoryID  = element.attr("data-id");
            formData.append("id", categoryID);
            formData.append("name", newValue);
            // Create an instance of XMLHttpRequest, and set the readystate trigger.
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4) {
                    var response = jQuery.parseJSON(xhr.responseText);
                    if (response.error)
                        $.fn.createErrorMessage(resresponse.error.message);
                    // Reset the global variable
                    window.autosaveInProgress = false;
                }
            }
            // Make the request
            xhr.open("POST", "/groups/manage/edit", true);
            xhr.send(formData);
        }
    }

});
