
<div class="modal fade" id="createSectionModal" tabindex="-1" role="dialog" aria-labelledby="createSectionModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class='modal-content'>
            <div class='modal-header'>
                <h1 class="modal-title fs-5" id="registerModalLabel"><i class="fa-solid fa-circle"></i> CREATE SECTION</h1>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body" id="modalBody">
                <form method="POST" id="createSectionForm" class="needs-validation" novalidate>
                    @csrf
                    <fieldset>
                        <div class="row mb-3">
                            <div class="col-6 col-md-4 input-field">
                                <div class="form-outline">
                                    <label for="section_name_input" class="input-title">Section Name</label>
                                    <input type="text" class="form-control form-control-sm" placeholder="Enter Section Name" name="section_name" id="section_name_input" maxlength='50' required>
                                    <div class="is-invalid" id="section_name_error">
                                        <span></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-md-4 input-field">
                                <label for="section_grade_level_input" class="input-title">Grade Level</label>
                                <select name="section_grade_level" class="form-select" id="section_grade_level_input" required>
                                    <option value="" disabled selected="selected" class="form-message">Choose a Grade Level</option>
                                    @for ($i = 7; $i < 11; $i++)
                                        <option value={{$i}}>Level {{$i}}</option>
                                    @endfor
                                </select>
                                <div class="is-invalid" id="section_grade_level_error">
                                    <span></span>
                                </div>
                            </div>
                            <div class="col-6 col-md-4 input-field">
                                <div class="form-outline">
                                    <label for="section_schoolyear_id_input" class="input-title">School Year</label>
                                    <select name="section_schoolyear_id" class="form-select" id="section_schoolyear_id_input" required>
                                        <option value="" disabled selected="selected">Select a School Year</option>
                                        @foreach ($schoolyears as $schoolyear)
                                            <option value="{{ $schoolyear->id }}">{{ $schoolyear->start_year }} - {{ $schoolyear->end_year }}</option>
                                        @endforeach
                                    </select>
                                    <div class="is-invalid" id="section_schoolyear_id_error">
                                        <span></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-6 col-md-4 input-field">
                                <div class="form-outline">
                                    <label for="section_adviser_id_input" class="input-title">Adviser</label>
                                    <select name="section_adviser_id" class="form-select" id="section_adviser_id_input" required>
                                        <option value="" disabled selected="selected">Select an Adviser</option>
                                        @foreach ($users as $user)
                                            @if ($user['role'] == "adviser" && $user['is_enrolled'] == 0)
                                                <option value="{{ $user->id }}">{{ $user->last_name }}, {{ $user->first_name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <div class="is-invalid" id="section_adviser_id_error">
                                        <span></span>
                                    </div>
                                </div>
                            </div>


                            <div class="col-6 col-md-4 input-field">
                                <div class="form-outline">
                                    <label for="section_student_id_input" class="input-title">Student</label>
                                    <select name="section_student_id" class="form-select" id="section_student_id_input" required>
                                        <option value="" disabled selected="selected">Select a Student</option>
                                        @foreach ($users as $user)
                                            @if ($user['role'] == "student" && $user['is_enrolled'] == 0)
                                                <option value="{{ $user }}" id="{{ $user->id }}">{{ $user->last_name }}, {{ $user->first_name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <div class="is-invalid" id="section_student_id_error">
                                        <span></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-md-4  input-field float-end">
                                <div class="form-group pt-3">
                                    <button type='button' class="btn btn-secondary create" id="add_student_btn" onclick="add_student_to_row()" disabled><i class="fa-solid fa-user-plus"></i>Add</button>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <hr style="margin-top: 20px; width:47rem;">

                            <div class="modal-body" id=list>
                                    <table class="table table-striped">
                                    <thead>
                                        <tr>
                                        <th>Student ID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th style="width:50px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="student_list">
                                    </tbody>
                                    </table>
                            </div>
                        </div>
                            <hr style="margin-bottom:5px;">
                            <i style="font-size:small;">Total Number of Students: <span id="total_students">0</span></i>

                            <div class="form-group pt-5 float-end" id="submit_new_section" style="visibility:hidden">
                                <button class="btn btn-primary create" type="submit" id="sectionButtonSubmit"><i class="fa-solid fa-square-plus icon-white"></i> Create</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/createSection.js') }}"></script>
<script>
    $('#createSectionForm').submit(function (e) {
        e.preventDefault();

        let allStudentID = document.querySelectorAll('[name=student_row]');
        let arrayStudentID = [];
        allStudentID.forEach(element => {
            arrayStudentID.push(element.textContent);
        });

        let formData = {
            allStudentID : arrayStudentID,
            adviser_id : document.querySelector('#section_adviser_id_input').value,
            name : document.querySelector('#section_name_input').value,
            grade_level : document.querySelector('#section_grade_level_input').value,
            schoolyear_id : document.querySelector('#section_schoolyear_id_input').value,
        };

        $("#createSectionForm").children().find(".is-invalid").children("span").text("");
        $("#createSectionForm input").removeClass("is-invalid");

        $.ajax({
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                Accept: "application/json"
            },
            url: "{{ route('create_section') }}",
            data: formData,
            success: () => window.location.assign(window.location.href) ,
            error: (response) => {
                if(response.status === 422) {
                    let errors = response.responseJSON.errors;
                    Object.keys(errors).forEach(function (key) {
                        $("#section_" + key + "_input").addClass("is-invalid");
                        $("#section_" + key + "_error").children("span").text(errors[key][0]);
                    });
                }
            }
        })
    });
</script>
