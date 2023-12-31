const editUserModal = document.getElementById('updateUserModal')
editUserModal.addEventListener('show.bs.modal', function() {
    if ($("#updateUserForm").children().find("#studentCheckU").is(":checked"))
        document.getElementById("ifStudentU").style.display = "block";
    else
        document.getElementById("ifStudentU").style.display = "none";

    let updateForm = document.getElementById('updateUserForm');

    $("#updateUserForm input").removeClass("is-valid is-invalid");
    updateForm.querySelectorAll(".form-control, .form-check-input").forEach(input => {
        $("#" + input.getAttribute("name") + "ErrorU").children("span").text("");
    });

    ['input','change'].forEach(evt =>
        updateForm.querySelectorAll(".form-control, .form-check-input").forEach(input => {
            input.addEventListener(evt, updateUserInputListener(input));
        })
    );
});

const updateUserInputListener = (input) => {
    return () => {
        $("#" + input.getAttribute("name") + "ErrorU").children("span").text("");
        if (input.type != "radio"){
            if (input.checkValidity()) {
                input.classList.remove('is-invalid');
                if ($(input).attr('name') == "password" && $(input).val() == "")
                    input.classList.remove('is-valid');
                else
                    input.classList.add('is-valid');
            } else {
                input.classList.remove('is-valid');
                input.classList.add('is-invalid');
                showUpdateUserClientError(input);
            }
        } else {
            if (input.getAttribute("id") == "studentCheckU")
                document.getElementById("rfid_numberInputU").required = true;
            else
                document.getElementById("rfid_numberInputU").required = false;
        }

        checkOverallUpdateUserValidity();
    };
};

editUserModal.addEventListener('hidden.bs.modal', function(){
    // Remove event listeners
    const inputElements = editUserModal.querySelectorAll('.form-control, .form-check-input');
    inputElements.forEach(input => {
        input.removeEventListener('input', updateUserInputListener);
        input.removeEventListener('change', updateUserInputListener);
    });
    document.getElementById("submissionU").style.visibility = "hidden";
});

function checkOverallUpdateUserValidity(){
    var form_children = $("#updateUserForm").children();
    var student_selected = form_children.find("#studentCheckU").is(":checked");
    var radios_selected = form_children.find($('input[type="radio"]:checked'));
    var invalid_form_control = form_children.find('.form-control.is-invalid')
    var invalid_rfid = $('#rfid_numberInputU').hasClass('is-invalid');

    if (student_selected){
        document.getElementById("ifStudentU").style.display = "block";
        var is_invalid = invalid_form_control.length > 0 || radios_selected.length < 2 || invalid_rfid || !$('#rfid_numberInputU').val()
    } else {
        document.getElementById("ifStudentU").style.display = "none";
        if (invalid_rfid)
            var is_invalid = invalid_form_control.length > 1 || radios_selected.length < 2;
        else
            var is_invalid = invalid_form_control.length > 0 || radios_selected.length < 2;
    }

    if (is_invalid)
        document.getElementById("submissionU").style.visibility = "hidden";
    else
        document.getElementById("submissionU").style.visibility = "visible";
}

function showUpdateUserClientError(input){
    var input_name = input.getAttribute("name");
    if (input_name == "id"){
        if (input.validity.patternMismatch){
            $("#" + input.getAttribute("name") + "ErrorU").children("span").text("User ID must be an integer.");
        } else if (input.validity.tooShort){
            $("#" + input.getAttribute("name") + "ErrorU").children("span").text("User ID must be 9 digits.");
        }
    } else if (input_name == "first_name" || input_name == "middle_name" || input_name == "last_name"){
        if (input.validity.patternMismatch){
            input_name = input_name.charAt(0).toUpperCase() + input_name.slice(1);
            input_name = input_name.split("_", 1);
            $("#" + input.getAttribute("name") + "ErrorU").children("span").text(input_name + " name must only be alphabetic characters.");
        }
    } else if (input_name == "rfid_number"){
        if (input.validity.patternMismatch)
            $("#" + input.getAttribute("name") + "ErrorU").children("span").text("RFID number must be an integer.");
        else if (input.validity.tooShort || input.validity.tooLong)
            $("#" + input.getAttribute("name") + "ErrorU").children("span").text("RFID number must be between 8-12 digits.");
    }
}
