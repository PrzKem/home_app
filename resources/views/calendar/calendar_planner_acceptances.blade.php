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
      <div class="row mt-2">
        <h2>Acceptations</h2>
        <form>
            <div class="row" id="movable-row">
                <div class="col-sm-8">
                <select class="form-select" id="persons[0]" name="persons[0]" aria-label="" value="">
                    <option>Przemek</option>
                    <option>Kasia</option>
                </select>
                </div>
                <div class="col-sm-4" id="button_row">
                    <button type ="button" class="btn btn-secondary" id="add_row" onclick="addAcceptancePerson()">+</button>
                    <button type="button" class="btn btn-danger" onclick="removeAcceptancePerson(this)"><i class="fa-solid fa-trash"></i></button>
                </div>
            </div>
        </form>
      </div>
      <div class="row mt-2">
          <div class="col-sm-6 mt-2"><input type="button" value="Previous" class="btn btn-secondary"></button></div>
          <div class="col-sm-6 mt-2"><input type="button" value="Summary" class="btn btn-success"></button></div>
      </div>
    </div>


  </div>
</div>
</body>
</html>
