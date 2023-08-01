<!DOCTYPE html>
<html>
<head>
 @include('head')
</head>
<body>
<div class="container mt-3">
  <div class="row">
    <!-- side bar nav -->
    <div class="col-sm-3">
      @include('calendar/calendar_nav_bar')
    </div>

    <div class="col-sm-9">
        <h2>Events planner</h2>
        <form method="post">
            <div class="row mt-2">
                <div class="col-sm-2 mt-2"><label for="name" class="form-label">Action:</label></div>
                <div class="col-sm-10"><input type="text" class="form-control" name="name" id="name"></div>
            </div>
            <div class="row mt-2">
                <div class="col-sm-2 mt-2"><label for="location" class="form-label">Place:</label></div>
                <div class="col-sm-10"><input type="text" class="form-control" name="location" id="location"></div>
            </div>
            <div class="row mt-2">
                <div class="col-sm-4 mt-2"><label for="datetime" class="form-label">Date and time:</label></div>
                <div class="col-sm-8"><input type="datetime-local" class="form-control" name="datetime" id="datetime"></div>
            </div>
            <div class="row mt-2">
                <div class="col-sm-4 mt-2"><label for="costPerPerson" class="form-label">Cost per person:</label></div>
                <div class="col-sm-8"><input type="number" step="0.01" class="form-control" name="costPerPerson" id="costPerPerson"></div>
            </div>
            <div class="row mt-2">
                <div class="col-sm-4 mt-2"><label for="extraMarks" class="form-label">Extra marks:</label></div>
                <div class="col-sm-8"><input type="text" class="form-control" name="extraMarks" id="extraMarks"></div>
            </div>
            <div class="row mt-2">
                <div class="col-sm-4 mt-2"><input type="button" value="Previous" class="btn btn-secondary"></button></div>
                <div class="col-sm-4 mt-2"><input type="button" value="Add next step" class="btn btn-primary"></button></div>
                <div class="col-sm-4 mt-2"><input type="button" value="Acceptations" class="btn btn-success"></button></div>
            </div>
        </form>
    </div>


  </div>
</div>
</body>
</html>
