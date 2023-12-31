function updateModal(user, student){
    $('#idInputU').val(user.id);

    if (user.role == "admin"){
        $("#adminCheckU").prop("checked", true);
        $("#rfid_numberInputU").val('');
    }
    else if (user.role == "student"){
        $("#studentCheckU").prop("checked", true);
        $("#rfid_numberInputU").val(student.rfid_number);
    }
    else{
        $("#adviserCheckU").prop("checked", true);
        $("#rfid_numberInputU").val('');
    }


    $('#first_nameInputU').val(user.first_name);
    $('#middle_nameInputU').val(user.middle_name);
    $('#last_nameInputU').val(user.last_name);

    if (user.sex == "M")
        $("#maleInputU").prop("checked", true);
    else
        $("#femaleInputU").prop("checked", true);

    $("#originalID").val(user.id);


    $('#updateUserModal').modal('show');
};

function deleteModal(user){
    $("#id").val(user.id);
    $('#deleteModal').modal('show');
}
