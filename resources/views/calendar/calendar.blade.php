<!DOCTYPE html>
<html>
<head>
 @include('head')
 <link rel="dns-prefetch" href="//cdn.jsdelivr.net" />
 <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css">
 	<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>
 	<style>
 		[x-cloak] {
 			display: none;
 		}
 	</style>
</head>
<body>
  <div class="container mt-3">
    <div class="row">
      <!-- side bar nav -->
      <div class="col-sm-3">
        @include('calendar/calendar_nav_bar')
      </div>
      <div class="col-sm-9">
        @include('calendar/calendar_section')
      </div>
    </div>
  </div>

<script type="text/javascript" src="/calendar_script.js"></script>

</body>
</html>
