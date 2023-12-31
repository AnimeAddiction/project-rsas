const createSubjectModal = document.getElementById('createSubjectModal')
createSubjectModal.addEventListener('shown.bs.modal', function() {
    checkOverallCreateSubjectValidity();
    let createSubjectForm = document.getElementById('createSubjectForm');

    ['input','change'].forEach(evt =>
        createSubjectForm.querySelectorAll(".form-control, .form-select, .form-check-input").forEach(input => {
            input.addEventListener(evt, createSubjectInputListener(input));
        })
    );
});

const createSubjectInputListener = (input) => {
    return () => {
        $("#" + input.getAttribute("name") + "_error").children("span").text("");

        if(input.type == "checkbox"){
            var isChecked = $(input).prop('checked');
            var $timeInputs = $(input).closest('.row').find('.time-input');
            if (isChecked){
                $("#daysError").children("span").text("");
                $timeInputs.prop('disabled', false);
            } else if (!isChecked && $("input[type='checkbox']:checked").length < 1){
                $("#daysError").children("span").text("Please check at least one of the days.");
                $timeInputs.prop('disabled', true).val('');
            } else
                $timeInputs.prop('disabled', true).val('');
        }

        if (input.checkValidity() && input.type != 'checkbox' && input.type != 'time') {
            input.classList.remove('is-invalid');
            input.classList.add('is-valid');
        } else if (!input.checkValidity() && input.type != 'checkbox' && input.type != 'time') {
            input.classList.remove('is-valid');
            input.classList.add('is-invalid');
            showCreateSubjectClientError(input);
        }

        checkOverallCreateSubjectValidity();
    };
};

createSubjectModal.addEventListener('hidden.bs.modal', function(){
    // Remove event listeners
    const inputElements = createSubjectModal.querySelectorAll('.form-control, .form-select, .form-check-input');
    inputElements.forEach(input => {
        input.removeEventListener('input', createSubjectInputListener);
        input.removeEventListener('change', createSubjectInputListener);
    });
});

function checkOverallCreateSubjectValidity() {
    var formChildren = $("#createSubjectForm").children();
    var fields = formChildren.find('.form-control, .form-select');
    var validFields = formChildren.find('.form-control.is-valid, .form-select.is-valid');
    var checkedCheckboxes = formChildren.find($("input[type='checkbox']:checked"));
    var timeInputs = checkedCheckboxes.closest('.row').find('.time-input');
    var isTimeInputsFilled = timeInputs.toArray().every(input => input.value.trim() !== '');

    var isValid = fields.length - 10 === validFields.length && checkedCheckboxes.length > 0 && isTimeInputsFilled;
    if (isValid) {
      document.getElementById("submitNewSubject").style.visibility = "visible";
    } else {
      document.getElementById("submitNewSubject").style.visibility = "hidden";
    }
}


function showCreateSubjectClientError(input){
    var input_name = input.getAttribute("name");
    if (input_name == "subject_id"){
        if (input.validity.patternMismatch){
            $("#" + input.getAttribute("name") + "_error").children("span").text("Subject ID must only be digits.");
        } else if (input.validity.tooShort){
            $("#" + input.getAttribute("name") + "_error").children("span").text("Subject ID must be 5 digits.");
        }
    } else if (input_name = "subject_name" && input.validity.patternMismatch){
        $("#" + input.getAttribute("name") + "_error").children("span").text("Subject name must not contain special characters.");
    }
}
