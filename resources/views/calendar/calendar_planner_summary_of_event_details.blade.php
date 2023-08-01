<!DOCTYPE html>
<html>
<head>

 @include('head')
<link href="../vertical_line.css" rel="stylesheet">
</head>
<body>
<div class="container mt-3">
  <div class="row">
    <!-- side bar nav -->
    <div class="col-sm-3">
      @include('calendar/calendar_nav_bar')
    </div>

    <div class="col-sm-9">
        <div class="row">
            <div class="col-sm-10"><h2>Summary</h2></div>
            <div class="col-sm-1"><button class="btn btn-warning" style="width:100%"><i class="fa-solid fa-backward"></i></button></div>
            <div class="col-sm-1"><button class="btn btn-success" style="width:100%"><i class="fa-sharp fa-solid fa-floppy-disk"></i></button></div>
        </div>
        <div class="row">
            <table>
                <thead>
                    <th>Action</th>
                    <th>Name</th>
                    <th>Date-time</th>
                    <th>Cost per person</th>
                    <th>Marks</th>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
        <div class="row border-between">
            <div class="col-sm-6">
                <ul><b>Required acceptance of:</b>
                    <li>1</li>
                    <li>2</li>
                    <li>3</li>
                </ul>
            </div>
            <div class="col-sm-6">
                <ul><b>Participants:</b>
                    <li>1</li>
                    <li>2</li>
                    <li>3</li>
                </ul>
            </div>
        </div>
    </div>


  </div>
</div>
</body>
</html>
