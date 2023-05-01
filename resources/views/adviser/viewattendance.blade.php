<link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
<link rel="stylesheet" href="{{ asset('css/adviserview.css') }}">
<link rel="stylesheet" href="{{ asset('css/createUser.css') }}">


@extends('master')
@section('content')

<div class="container mx-10 my-5">
<div class="border rounded px-4 pt-5 pb-3 my-2">
    <div class="row">
        <div class="col col-lg-2">
            <div class="section-title">GRADE LEVEL</div>
            <div class="section-body">GRADE 10</div>
        </div>

        <div class="col-sm-6">
            <div class="section-title">ADVISER</div>
            <div class="section-body">MS. MARY JANE D. PARKER</div>
        </div>

        <div class="col col-md-auto">
            <label for="date" class="section-title">DATE</label>
            <br>
            <input class="mt-2"type="date" id="date" placeholder="Choose Date" required>
        </div>
       
        <div class="col col-md-auto">
            <label for="subject" class="section-title">SUBJECT</label>
                <select name="subject" class="form-select w-auto" placeholder="Choose Subject" id="subject" required>
                    <!--ideally mushow unsay mga subjects naa ang section -->
                    <option value="SCI7">GEOLOGY</option>
                    <option value="MATH7">ALGEBRA</option>
                    <option value="ENG7">ENGLISH</option>
                    <option value="AP7">PHILIPPINE HISTORY</option>
                </select>
                <div class="is-invalid" role="alert" id="subjectError" name="subjectError">
                    <strong></strong>
                </div>
        </div>
    </div>



<hr>

    <div class="container table-responsive">

        <div class="row">
            <div class="col">
                <table class="table table-hover table-hover" id="attendanceTable" data-toggle="table" data-toolbar="#toolbar">
                    <tr>
                        <th class="w-75">Student Name</th>
                        <th data-align="right">Attendance</th>
                        <th data-align="left"></th>
                    </tr>

                    <tr>
                        <td class="name">Snow, Jon Stark</td>
                        <td class="attendace" data-align="right" data-status="late">
                            Late
                            <!-- edit class attendance portion mayhaps?
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="attendance" id="absentCheck" value="0" required>
                                <label class="form-check-label" for="absentCheck">Absent</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="attendance" id="presentCheck" value="1" required>
                                <label class="form-check-label" for="presentCheck">Present</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="attendance" id="lateCheck" value="2" required>
                                <label class="form-check-label" for="lateCheck">Late</label>
                            </div>
                        -->
                        </td>
                        <td><a class="btn btn-primary" role="button" onclick="'/hehe'"><i class="fa-regular fa-pen-to-square icon-white"></i></a></td>
                    </tr>
                    <tr>
                        <td class="name">Lannister, Jamie Tyrion</td>
                        <td class="attendance" data-align="right" data-status="absent">Absent</td>
                        <td><a class="btn btn-primary" role="button" onclick="'/hehe'"><i class="fa-regular fa-pen-to-square icon-white"></i></a></td>
                    </tr>
                    <tr>
                        <td class="name">Baratheon, Stannis Robert</td>
                        <td class="attendance" data-align="right" data-status="present">Present</td>
                        <td><a class="btn btn-primary" role="button" onclick="'/hehe'"><i class="fa-regular fa-pen-to-square icon-white"></i></a></td>
                    </tr>
                </table>
            </div>
        </div>

    </div>

</div>

</div>


@endsection